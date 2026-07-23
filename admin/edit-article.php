<?php
require_once '../config.php';

// Check if logged in
if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

// Get article ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch article data
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article) {
    header('Location: dashboard.php');
    exit();
}

// Check if user can edit this article (author or admin)
if (!canEditArticle($pdo, $id, $_SESSION['user_id'])) {
    header('Location: dashboard.php?error=unauthorized');
    exit();
}

$error = '';
$success = '';

// Handle image upload function
function uploadImage($file, $target_dir = "../uploads/articles/") {
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
        // Return path relative to root
        return ['success' => '/' . str_replace('../', '', $target_file)];
    } else {
        return ['error' => 'Sorry, there was an error uploading your file.'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $heading = trim($_POST['heading']);
    $subject = trim($_POST['subject']);
    $content = cleanEditorContent($_POST['content']);
    $featured_image = $_POST['featured_image'] ?? '';
    $image_option = $_POST['image_option'] ?? 'link';
    $status = $_POST['status'];
    
    // Handle image upload
    if ($image_option == 'upload' && isset($_FILES['featured_image_file']) && $_FILES['featured_image_file']['error'] == 0) {
        $upload_result = uploadImage($_FILES['featured_image_file']);
        if (isset($upload_result['success'])) {
            $featured_image = $upload_result['success'];
        } else {
            $error = $upload_result['error'];
        }
    } else if ($image_option == 'link') {
        // Clean the image path
        if (!empty($featured_image)) {
            if (!preg_match('/^https?:\/\//', $featured_image) && !str_starts_with($featured_image, '/')) {
                $featured_image = '/' . $featured_image;
            }
        }
    }
    
    // Auto-generate summary from content
    $summary = strip_tags($content);
    $summary = substr($summary, 0, 500);
    if (strlen($summary) >= 500) {
        $summary = substr($summary, 0, strrpos($summary, ' ')) . '...';
    }
    
    // Create new slug if heading changed
    $slug = createSlug($heading);
    if ($slug !== $article['slug']) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE slug = ? AND id != ?");
        $stmt->execute([$slug, $id]);
        if ($stmt->fetchColumn() > 0) {
            $slug = $slug . '-' . time();
        }
    } else {
        $slug = $article['slug'];
    }
    
    if (empty($heading) || empty($subject) || empty($content)) {
        $error = 'Heading, subject, and content are required!';
    } else if ($image_option == 'upload' && empty($featured_image) && empty($error)) {
        $error = 'Please upload a valid image file.';
    } else {
        $stmt = $pdo->prepare("UPDATE articles 
                               SET heading = ?, slug = ?, subject = ?, content = ?, 
                                   summary = ?, featured_image = ?, status = ?, 
                                   updated_at = CURRENT_TIMESTAMP 
                               WHERE id = ?");
        
        if ($stmt->execute([$heading, $slug, $subject, $content, $summary, $featured_image, $status, $id])) {
            $success = 'Article updated successfully!';
            // Refresh article data
            $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
            $stmt->execute([$id]);
            $article = $stmt->fetch();
        } else {
            $error = 'Failed to update article. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article - Admin Dashboard</title>
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
        .form-container {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .btn-save {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-save:hover {
            background: #1a4a5a;
        }
        .btn-cancel {
            background: var(--dark-blue);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-cancel:hover {
            background: #0d1a24;
            color: white;
        }
        .alert-success a {
            color: #155724;
            font-weight: 600;
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
        .current-image {
            background: #e7f3ff;
            padding: 0.5rem;
            border-radius: 8px;
            margin-top: 0.5rem;
        }
        .current-image img {
            max-width: 100px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
            </a>
            <div>
                <span class="text-white me-3"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2 class="mb-4">
                <i class="fas fa-edit me-2" style="color: var(--primary-blue);"></i>
                Edit Article
            </h2>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i> <?php echo $success; ?>
                    <a href="../article.php?slug=<?php echo $article['slug']; ?>" target="_blank">View article →</a>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST" id="editForm" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Article Heading *</label>
                    <input type="text" name="heading" class="form-control form-control-lg" 
                           value="<?php echo htmlspecialchars($article['heading']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Subject/Category *</label>
                    <input type="text" name="subject" class="form-control" 
                           value="<?php echo htmlspecialchars($article['subject']); ?>" required>
                </div>
                
                <!-- Featured Image Section with Upload or Link Option -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Featured Image</label>
                    
                    <!-- Show current image if exists -->
                    <?php if ($article['featured_image']): ?>
                        <div class="current-image mb-3">
                            <strong>Current Image:</strong><br>
                            <?php 
                            $current_img = $article['featured_image'];
                            if (!preg_match('/^https?:\/\//', $current_img) && !str_starts_with($current_img, '/')) {
                                $current_img = '/' . $current_img;
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($current_img); ?>" alt="Current featured image">
                            <small class="text-muted d-block">Current image will be replaced if you upload a new one.</small>
                        </div>
                    <?php endif; ?>
                    
                    <div class="image-option">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="image_option" id="option_link" value="link" checked>
                            <label class="form-check-label" for="option_link">
                                <i class="fas fa-link me-1"></i> Use Image URL
                            </label>
                        </div>
                        <div id="link_section">
                            <input type="text" name="featured_image" class="form-control" 
                                   value="<?php echo htmlspecialchars($article['featured_image']); ?>" 
                                   placeholder="https://images.unsplash.com/...">
                            <small class="text-muted">Paste an image URL for the article thumbnail</small>
                        </div>
                    </div>
                    
                    <div class="image-option">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="image_option" id="option_upload" value="upload">
                            <label class="form-check-label" for="option_upload">
                                <i class="fas fa-upload me-1"></i> Upload New Image
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
                    <label class="form-label fw-bold">Status</label>
                    <select name="status" class="form-select">
                        <option value="published" <?php echo $article['status'] == 'published' ? 'selected' : ''; ?>>Published</option>
                        <option value="draft" <?php echo $article['status'] == 'draft' ? 'selected' : ''; ?>>Draft</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Content *</label>
                    <textarea name="content" id="content" class="form-control" rows="15"><?php echo htmlspecialchars($article['content']); ?></textarea>
                </div>
                
                <div class="text-end">
                    <a href="dashboard.php" class="btn-cancel me-2">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save me-1"></i> Save Changes
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
        
        // Form validation
        document.getElementById('editForm').addEventListener('submit', function(e) {
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