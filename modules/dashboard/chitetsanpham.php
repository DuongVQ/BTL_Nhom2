<?php
include_once "../../config.php"; 
include_once "../../layout/header/header.php";
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($product_id) {
    // truy van bang produc và product image
    $sql = "SELECT p.*, pi.image_url FROM products p 
            LEFT JOIN product_images pi ON p.id = pi.product_id 
            WHERE p.id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        //truy van mau sac san pham
        $colorResult = $con->query("SELECT color_name FROM product_colors WHERE product_id = " . $product['id']);
        $colors = [];
        if ($colorResult->num_rows > 0) {
            while ($colorRow = $colorResult->fetch_assoc()) {
                $colors[] = $colorRow['color_name'];
            }
        }

        //truy van size
        $sizeResult = $con->query("SELECT size_name FROM product_sizes WHERE product_id = " . $product['id']);
        $sizes = [];
        if ($sizeResult->num_rows > 0) {
            while ($sizeRow = $sizeResult->fetch_assoc()) {
                $sizes[] = $sizeRow['size_name'];
            }
        }

     
        $stmt->close();
    } else {
        echo "Sản phẩm không tồn tại.";
        exit;
    }
} else {
    echo "Không có ID sản phẩm.";
    exit;
}

$con->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
</head>
<style>
  body {
    margin-top: 90px;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    }

  
    main {
        display: flex;
        justify-content: space-between;
        background-color: #fff;
        padding: 30px;
        margin: 20px auto;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 80%;
    }

  
    .product-container {
        display: flex;
        gap: 30px;
        width: 100%;
    }

   
    .if-img {
        flex: 1;
        max-width: 400px;
    }

    .product-image {
        width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

   
    .infor {
        flex: 2;
        max-width: 600px;
    }

    
    h1 {
        font-size: 26px;
        color: #333;
        margin-bottom: 15px;
        font-weight: bold;
    }

   
    .price p {
        font-size: 20px;
        color: #e74c3c;
        font-weight: bold;
    }

    .mausac, .size {
        margin-top: 15px;
        font-size: 16px;
        color: #555;
    }

    label {
        margin-right: 15px;
        font-size: 16px;
        color: #555;
        cursor: pointer;
    }

    input[type="radio"] {
        margin-right: 8px;
        vertical-align: middle;
    }

    input[type="radio"]:checked + label {
        font-weight: bold;
        color: #e74c3c;
    }


    p {
        font-size: 16px;
        color: #333;
        line-height: 1.6;
        margin-top: 20px;
        font-family: Arial, sans-serif;
    }

    .mausac, .size, .price {
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .product-container {
            flex-direction: column;
            align-items: center;
        }

        .if-img {
            max-width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .infor {
            max-width: 100%;
        }
    }

</style>
<body> 

    <main>
        <div class="product-container">
            <div class="if-img">
                <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-image">
            </div>
            <div class="infor">
                <h1>Chi tiết sản phẩm: <?= htmlspecialchars($product['name']) ?></h1>
                <div class="price">
                    <p><strong>Giá: </strong><?= number_format($product['price'], 0, ',', '.') ?> VND</p>
                </div>
                <div class="mausac">
                <p><strong>Màu sắc: </strong>
                    <?php
                    if (!empty($colors)) {
                        foreach ($colors as $index => $color) {
                            echo '<label>';
                            echo '<input type="radio" name="color" value="' . htmlspecialchars($color) . '" id="color' . $index . '">';
                            echo htmlspecialchars($color);
                            echo '</label><br>';
                        }
                    } else {
                        echo "Không có màu sắc";
                    }
                    ?>
                </p>

                </div>
                <div class="size">
                    <p><strong>Kích thước: </strong>
                        <?php
                        foreach ($sizes as $index => $size) {
                            echo '<label>';
                            echo '<input type="radio" name="size" value="' . htmlspecialchars($size) . '" id="color' . $index . '">';
                            echo htmlspecialchars($size);
                            echo '</label><br>';
                        }
                        ?>
                    </p>
                </div>
                <button><a href="">Thêm vào giỏ hàng</a></button>
                <button><a href="">Thanh toán ngay</a></button>
                <a href=""></a>
            </div>
        </div>
        
    </main>
    <p><strong>Mô tả: </strong><?= nl2br(htmlspecialchars($product['description'])) ?></p>
    

    
</body>
</html>

<?php  
include_once "../../layout/footer/footer.php";
?>