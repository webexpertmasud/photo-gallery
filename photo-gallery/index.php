<?php include 'includes/config.php'; include 'includes/header.php'; ?>

<h2>All Photos</h2>
<div class="row">
<?php
$stmt = $pdo->query("SELECT * FROM images ORDER BY upload_date DESC");
while ($row = $stmt->fetch()) {
    echo '
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="assets/images/' . htmlspecialchars($row['filename']) . '" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>
                <p class="card-text"><small class="text-muted">Uploaded on ' . $row['upload_date'] . '</small></p>
            </div>
        </div>
    </div>';
}
?>
</div>

<?php include 'includes/footer.php'; ?>
