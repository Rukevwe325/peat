<?php

// Keep counters outside the document root. Never trust client-supplied forwarding headers.
function peatech_enquiry_rate_limit(string $email): int
{
    $directory = sys_get_temp_dir() . '/peatech-enquiries-' . hash('sha256', __DIR__);
    if (!is_dir($directory) && !@mkdir($directory, 0700, true) && !is_dir($directory)) {
        error_log('Peatech enquiry rate-limit storage could not be created.');
        return 503;
    }
    $file = @fopen($directory . '/limits.json', 'c+');
    if ($file === false) {
        error_log('Peatech enquiry rate-limit storage could not be opened.');
        return 503;
    }
    if (!flock($file, LOCK_EX)) {
        fclose($file);
        return 503;
    }
    try {
        $contents = stream_get_contents($file);
        $counters = $contents === '' ? [] : json_decode($contents, true);
        if (!is_array($counters)) {
            error_log('Peatech enquiry rate-limit storage is invalid.');
            return 503;
        }
        $now = time();
        foreach ($counters as $key => $counter) {
            if ($counter['expires'] <= $now) {
                unset($counters[$key]);
            }
        }
        $buckets = [
            ['ip:' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'), 5, 900],
            ['email:' . strtolower($email), 3, 3600],
            ['site', 120, 3600],
        ];
        foreach ($buckets as [$identity, $limit, $window]) {
            $key = hash('sha256', $identity);
            if (($counters[$key]['count'] ?? 0) >= $limit) {
                return 429;
            }
        }
        foreach ($buckets as [$identity, $limit, $window]) {
            $key = hash('sha256', $identity);
            $counter = $counters[$key] ?? ['count' => 0, 'expires' => $now + $window];
            $counter['count']++;
            $counters[$key] = $counter;
        }
        $encoded = json_encode($counters);
        // With the global bucket, no more than 120 new identities can be recorded per hour.
        if ($encoded === false || !ftruncate($file, 0) || !rewind($file)
            || fwrite($file, $encoded) !== strlen($encoded) || !fflush($file)) {
            error_log('Peatech enquiry rate-limit counters could not be saved.');
            return 503;
        }
        return 0;
    } finally {
        flock($file, LOCK_UN);
        fclose($file);
    }
}
