<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Purchase Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f9fafb; padding:20px;">
    <div style="max-width:600px; margin:auto; background:#ffffff; padding:30px; border-radius:8px;">
        <h2 style="color:#16a34a;">Payment Successful 🎉</h2>

        <p>Hello {{ $purchase->user->name }},</p>

        <p>
            Your payment for the car purchase was successful.
        </p>

        <hr>

        <p><strong>Ticket ID:</strong> {{ $purchase->ticket_id }}</p>
        <p><strong>Car Model:</strong> {{ $purchase->car_details['model'] }}</p>
        <p><strong>Year:</strong> {{ $purchase->car_details['year'] }}</p>
        <p><strong>Amount Paid:</strong> ₦{{ number_format($purchase->car_details['price']) }}</p>

        <hr>

        <p>
            Our team will contact you shortly with next steps.
        </p>

        <p style="margin-top:30px;">
            Thanks for trusting us,<br>
            <strong>PeaAuto Team</strong>
        </p>
    </div>
</body>
</html>
