<?php
require_once 'config.php';

// Check if logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$success = '';
$error = '';

// Get all departments for the select box
$stmt = $pdo->query("SELECT * FROM departments ORDER BY name");
$departments = $stmt->fetchAll();

// Handle image upload
function uploadImage($file, $target_dir = "uploads/articles/") {
    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    $file_name = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "", basename($file["name"]));
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is actual image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return ['error' => 'File is not an image.'];
    }
    
    // Check file size (max 5MB)
    if ($file["size"] > 5000000) {
        return ['error' => 'File is too large. Max 5MB.'];
    }
    
    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif", "webp"])) {
        return ['error' => 'Only JPG, JPEG, PNG, WEBP & GIF files are allowed.'];
    }
    
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return ['success' => $target_file];
    } else {
        return ['error' => 'Sorry, there was an error uploading your file.'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heading = trim($_POST['heading']);
    $subject = trim($_POST['subject']);
    $content = cleanEditorContent($_POST['content']);
    $featured_image = $_POST['featured_image'] ?? '';
    $image_option = $_POST['image_option'] ?? 'link';
    
    // Handle image upload
    if ($image_option == 'upload' && isset($_FILES['featured_image_file']) && $_FILES['featured_image_file']['error'] == 0) {
        $upload_result = uploadImage($_FILES['featured_image_file']);
        if (isset($upload_result['success'])) {
            $featured_image = $upload_result['success'];
        } else {
            $error = $upload_result['error'];
        }
    }
    
    $publication_option = $_POST['publication_option'] ?? 'publish';
    $review_department_id = $_POST['review_department'] ?? null;
    
    // Auto-generate summary from content
    $summary = strip_tags($content);
    $summary = substr($summary, 0, 500);
    if (strlen($summary) >= 500) {
        $summary = substr($summary, 0, strrpos($summary, ' ')) . '...';
    }
    
    // Create slug from heading
    $slug = createSlug($heading);
    
    // Make sure slug is unique
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE slug = ?");
    $stmt->execute([$slug]);
    if ($stmt->fetchColumn() > 0) {
        $slug = $slug . '-' . time();
    }
    
    if (empty($heading) || empty($subject) || empty($content)) {
        $error = 'Heading, subject, and content are required!';
    } else if ($image_option == 'upload' && empty($featured_image) && empty($error)) {
        $error = 'Please upload a valid image file.';
    } else {
        try {
            $pdo->beginTransaction();
            
            if ($publication_option == 'publish') {
                $review_status = 'published';
                $status = 'published';
                $review_department_id = null;
            } else {
                $review_status = 'pending_review';
                $status = 'draft';
                
                if (empty($review_department_id)) {
                    throw new Exception('Please select a department for review.');
                }
            }
            
            // Insert article
            $stmt = $pdo->prepare("INSERT INTO articles (heading, slug, subject, content, summary, featured_image, author_id, status, review_status, review_department_id, submitted_by, submitted_at) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$heading, $slug, $subject, $content, $summary, $featured_image, $_SESSION['user_id'], $status, $review_status, $review_department_id, $_SESSION['user_id']]);
            
            $article_id = $pdo->lastInsertId();
            
            // If sending for review, assign all department members as reviewers
            if ($publication_option == 'review' && $review_department_id) {
                $stmt = $pdo->prepare("SELECT u.id FROM users u 
                                       JOIN user_departments ud ON u.id = ud.user_id 
                                       WHERE ud.department_id = ? AND u.id != ?");
                $stmt->execute([$review_department_id, $_SESSION['user_id']]);
                $department_users = $stmt->fetchAll();
                
                $stmt = $pdo->prepare("INSERT INTO article_review_assignments (article_id, reviewer_id, status) VALUES (?, ?, 'pending')");
                foreach ($department_users as $reviewer) {
                    $stmt->execute([$article_id, $reviewer['id']]);
                    createNotification($pdo, $reviewer['id'], $article_id, 'review_assigned', 
                                      "A new article has been submitted for review to your department: " . substr($heading, 0, 50));
                }
                
                $success = 'Article submitted for department review! Department members have been notified.';
            } else {
                $success = 'Article published successfully!';
            }
            
            $pdo->commit();
            $_POST = [];
            
        } catch(Exception $e) {
            $pdo->rollBack();
            $error = $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Article - Peatech Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.3/tinymce.min.js"></script>
    <style>
        :root {
            --primary-blue: #266075;
            --accent-orange: #ff7b25;
            --dark-blue: #1a2a3a;
            --light-grey: #f8f9fa;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-grey);
        }
        .navbar-custom {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }
        .btn-primary-custom {
            background: var(--primary-blue);
            border: none;
            padding: 12px 30px;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary-custom:hover {
            background: #1a4a5a;
            color: white;
        }
        .btn-secondary-custom {
            background: var(--dark-blue);
            border: none;
            padding: 12px 30px;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-secondary-custom:hover {
            background: #0d1a24;
            color: white;
        }
        .info-box {
            background: #e7f3ff;
            border-left: 4px solid var(--primary-blue);
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
        }
        .alert-success a {
            color: #155724;
            font-weight: 600;
        }
        .department-section {
            background: var(--light-grey);
            padding: 1rem;
            border-radius: 8px;
            margin-top: 1rem;
        }
        .image-preview {
            margin-top: 10px;
            max-width: 200px;
            display: none;
        }
        .image-preview img {
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .image-option {
            background: var(--light-grey);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-custom navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/peatechlogo.webp" alt="Peatech Logo" height="40">
            </a>
            <div class="ms-auto">
                <span class="me-3"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2><i class="fas fa-pen-alt me-2" style="color: var(--primary-blue);"></i> Post New Article</h2>
                <a href="articles.php" class="btn-secondary-custom">
                    <i class="fas fa-eye me-2"></i> View All Articles
                </a>
            </div>
            
            <div class="info-box">
                <i class="fas fa-info-circle me-2" style="color: var(--primary-blue);"></i>
                <strong>Auto-Generated Summary:</strong> The summary will be automatically created from the first 500 characters of your article content.
            </div>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i> <?php echo $success; ?> 
                    <a href="my-submissions.php">View my submissions →</a>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" id="articleForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Article Heading *</label>
                    <input type="text" name="heading" class="form-control form-control-lg" value="<?php echo htmlspecialchars($_POST['heading'] ?? ''); ?>" required>
                    <small class="text-muted">This will be used to create the URL slug</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Subject/Category *</label>
                    <input type="text" name="subject" class="form-control" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" required>
                    <small class="text-muted">e.g., Technology, Health, Business, Innovation</small>
                </div>
                
                <!-- Featured Image Section with Upload or Link Option -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Featured Image</label>
                    <div class="image-option">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="image_option" id="option_link" value="link" checked>
                            <label class="form-check-label" for="option_link">
                                <i class="fas fa-link me-1"></i> Use Image URL
                            </label>
                        </div>
                        <div id="link_section">
                            <input type="text" name="featured_image" class="form-control" value="<?php echo htmlspecialchars($_POST['featured_image'] ?? ''); ?>" placeholder="https://images.unsplash.com/...">
                            <small class="text-muted">Paste an image URL for the article thumbnail</small>
                        </div>
                    </div>
                    
                    <div class="image-option">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="image_option" id="option_upload" value="upload">
                            <label class="form-check-label" for="option_upload">
                                <i class="fas fa-upload me-1"></i> Upload Image
                            </label>
                        </div>
                        <div id="upload_section" style="display: none;">
                            <input type="file" name="featured_image_file" id="featured_image_file" class="form-control" accept="image/jpeg,image/png,image/gif,image/webp">
                            <small class="text-muted">Upload an image (Max 5MB, JPG, PNG, GIF, WEBP)</small>
                            <div id="image_preview" class="image-preview">
                                <img id="preview_img" src="#" alt="Preview">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Content *</label>
                    <textarea name="content" id="content" class="form-control" rows="15"><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>
                    <small class="text-muted">The first 500 characters will automatically become the article summary</small>
                </div>
                
                <!-- Publication Options -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Publication Option</label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="publication_option" id="option_publish" value="publish" checked>
                        <label class="form-check-label" for="option_publish">
                            <i class="fas fa-globe me-1" style="color: #28a745;"></i> 
                            <strong>Publish Immediately</strong>
                            <small class="text-muted d-block">Article will be visible to everyone immediately</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="publication_option" id="option_review" value="review">
                        <label class="form-check-label" for="option_review">
                            <i class="fas fa-users me-1" style="color: var(--accent-orange);"></i> 
                            <strong>Send to Department for Review</strong>
                            <small class="text-muted d-block">Any member of the selected department can approve this article</small>
                        </label>
                    </div>
                </div>
                
                <!-- Department Selection (hidden by default) -->
                <div id="department_section" style="display: none;">
                    <div class="department-section">
                        <label class="form-label fw-bold mb-3">
                            <i class="fas fa-building me-2" style="color: var(--primary-blue);"></i>
                            Select Department for Review
                        </label>
                        
                        <select name="review_department" id="review_department" class="form-select">
                            <option value="">-- Select Department --</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?php echo $dept['id']; ?>">
                                    <?php echo htmlspecialchars($dept['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted mt-2 d-block">
                            <i class="fas fa-info-circle me-1"></i> 
                            Any user in this department can review and approve this article.
                        </small>
                    </div>
                </div>
                
                <div class="text-end mt-4">
                    <button type="submit" class="btn-primary-custom" id="submitBtn">
                        <i class="fas fa-paper-plane me-2"></i> 
                        <span id="submitBtnText">Publish Article</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        // Toggle image option sections
        const optionLink = document.getElementById('option_link');
        const optionUpload = document.getElementById('option_upload');
        const linkSection = document.getElementById('link_section');
        const uploadSection = document.getElementById('upload_section');
        const imagePreview = document.getElementById('image_preview');
        const previewImg = document.getElementById('preview_img');
        const fileInput = document.getElementById('featured_image_file');
        
        optionLink.addEventListener('change', function() {
            if (this.checked) {
                linkSection.style.display = 'block';
                uploadSection.style.display = 'none';
                imagePreview.style.display = 'none';
            }
        });
        
        optionUpload.addEventListener('change', function() {
            if (this.checked) {
                linkSection.style.display = 'none';
                uploadSection.style.display = 'block';
            }
        });
        
        // Image preview
        fileInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(loadEvent) {
                    previewImg.src = loadEvent.target.result;
                    imagePreview.style.display = 'block';
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        
        // Toggle department section based on publication option
        const optionPublish = document.getElementById('option_publish');
        const optionReview = document.getElementById('option_review');
        const departmentSection = document.getElementById('department_section');
        const submitBtnText = document.getElementById('submitBtnText');
        const reviewDepartment = document.getElementById('review_department');
        
        function updateSubmitButton() {
            if (optionReview.checked) {
                submitBtnText.textContent = 'Submit for Review';
                departmentSection.style.display = 'block';
            } else {
                submitBtnText.textContent = 'Publish Article';
                departmentSection.style.display = 'none';
            }
        }
        
        optionPublish.addEventListener('change', updateSubmitButton);
        optionReview.addEventListener('change', updateSubmitButton);
        
        // Form validation
        document.getElementById('articleForm').addEventListener('submit', function(e) {
            if (optionReview.checked) {
                if (!reviewDepartment.value) {
                    e.preventDefault();
                    alert('Please select a department for review.');
                    return false;
                }
            }
            if (optionUpload.checked && fileInput.files.length === 0) {
                e.preventDefault();
                alert('Please select an image to upload.');
                return false;
            }
            return true;
        });
        
        // TinyMCE initialization
        tinymce.init({
            selector: '#content',
            height: 500,
            menubar: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Inter,Helvetica,Arial,sans-serif; font-size:16px; line-height:1.6; }',
            forced_root_block: 'p',
            remove_trailing_brs: true,
            apply_source_formatting: false,
            verify_html: true,
            cleanup_callback: function(type, data) {
                if (type === 'insert') {
                    data = data.replace(/<p>\s*<\/p>/g, '');
                    data = data.replace(/<p><br\s*\/?><\/p>/g, '');
                    data = data.replace(/&nbsp;/g, ' ');
                }
                return data;
            }
        });
    </script>
</body>
</html>