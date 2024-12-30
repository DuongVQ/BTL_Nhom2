<?php
session_start(); // Khởi động session

include_once "../header/header.php";
// Kiểm tra xem có sản phẩm nào trong session không
if (isset($_SESSION['sptk']) && !empty($_SESSION['sptk'])) {
    $products = $_SESSION['sptk'];
} else {
    echo "<p>Không tìm thấy sản phẩm nào.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">

</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    h1 {
        font-size: 24px;
        font-weight: 700;
        text-align: center;
        margin-top: 30px;
        margin-bottom: 20px;
        color: #333;
    }


    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .card {
        width: 100%;
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }


    .img-product img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 8px;
    }


    .card-body {
        padding: 15px;
        background-color: #fff;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .price {
        font-size: 16px;
        font-weight: bold;
        color: #e74c3c;
    }

    .old-price {
        font-size: 14px;
        color: #7f8c8d;
        text-decoration: line-through;
        margin-top: 5px;
    }

    .sale {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #e74c3c;
        color: #fff;
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 3px;
    }


    .card-footer {
        background-color: #fff;
        padding: 10px;
    }

    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    button {
        border: none;
        width: 100%;
    }


    p {
        text-align: center;
        font-size: 18px;
        color: #555;
        margin-top: 20px;
    }


    @media (max-width: 767px) {
        .card {
            width: 100%;
        }

        h1 {
            font-size: 20px;
        }

        .price {
            font-size: 14px;
        }

        .card-footer {
            padding: 8px;
        }
    }
</style>

<body>
    <div class="container" style="margin-top: 120px;">
        <div class="row">
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100">

                            <?php if (isset($product['discount']) && $product['discount'] > 0): ?>
                                <div class="sale badge badge-danger">-<?= intval($product['discount']) ?>%</div>
                            <?php endif; ?>


                            <div class="img-product card-img-top">
                                <?php
                                include_once "../../config.php";
                                // Truy vấn lấy hình ảnh của sản phẩm theo product_id
                                $sql_image = "SELECT * FROM product_images WHERE product_id = '" . $product['id'] . "'";

                                $result = mysqli_query($con, $sql_image);
                                if ($row = $result->fetch_assoc()) {
                                    $image_url = $row['image_url'] ?? 'default-image.png';
                                }

                                ?>
                                <button>
                                    <a href="../../modules/dashboard/chitetsanpham.php?id=<?= $product['id'] ?>">
                                        <img src="<?= htmlspecialchars($image_url) ?>"
                                            alt="<?= htmlspecialchars($product['name'] ?? 'Sản phẩm không tên') ?>"
                                            class="img-fluid" style="height: 280px; object-fit: cover;">
                                    </a>

                                </button>
                            </div>

                            <!-- Thông tin sản phẩm -->
                            <div class="card-body text-center">
                                <h3 class="card-title"><?= htmlspecialchars($product['name'] ?? 'Sản phẩm không tên') ?></h3>
                                <div class="price"><?= number_format($product['price'] ?? 0, 0, ',', '.') ?>đ</div>
                                <div class="old-price">
                                    <?php if (isset($product['old_price']) && $product['old_price'] > 0): ?>
                                        <span class="text-muted"><?= number_format($product['old_price'], 0, ',', '.') ?>đ</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Thêm vào giỏ hàng -->
                            <div class="card-footer text-center">
                                <button class="btn btn-primary">Thêm vào giỏ</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không tìm thấy sản phẩm nào.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>

<?php include_once '../footer/footer.php'; ?>