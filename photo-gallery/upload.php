<?php include 'includes/config.php'; include 'includes/header.php'; ?>

<h2>Upload New Photo</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file = $_FILES['image'];

    if ($file['size'] > 5000000) {
        echo '<div class="alert alert-danger">File size must be under 5MB.</div>';
    } else {
        $filename = time() . '_' . basename($file['name']);
        $targetPath = 'assets/images/' . $filename;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $stmt = $pdo->prepare("INSERT INTO images (title, description, filename) VALUES (?, ?, ?)");
            $stmt->execute([$title, $description, $filename]);
            echo '<div class="alert alert-success">Image uploaded successfully!</div>';
        } else {
            echo '<div class="alert alert-danger">Image upload failed.</div>';
        }
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Select Image</label>
        <input type="file" name="image" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php include 'includes/footer.php'; ?>
