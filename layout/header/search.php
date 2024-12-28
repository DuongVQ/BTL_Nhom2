<?php
include_once '../../config.php'; // Include your database connection

$query = $_GET['query'] ?? '';

if ($query) {
    $stmt = $con->prepare("SELECT * FROM products WHERE name LIKE ?");
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $products = [];
}
?>
<?php include_once '../header/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
</head>
<body>

    <div class="container mt-5">
        <h1>Search Results for "<?= htmlspecialchars($query) ?>"</h1>
        <div class="product-grid">
            <?php if ($products): ?>
                <?php foreach ($products as $product): ?>
                    <div class="item-product">
                        <?php if ($product['discount'] > 0): ?>
                            <div class="sale">-<?= intval($product['discount']) ?>%</div>
                        <?php endif; ?>
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($product['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                                <img src="../../templates/image/after.png" alt="Ảnh phụ">
                                <div class="wrapper-addCart">
                                    <div class="addCart">
                                        <i class="fa-solid fa-bag-shopping me-1"></i>Thêm vào giỏ
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info-product">
                            <h3><?= htmlspecialchars($product['name']) ?></h3>
                            <div class="price"><?= number_format($product['price'], 0, ',', '.') ?>đ</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
<?php include_once '../footer/footer.php'; ?>