<?php
session_start();
$user_id = $_SESSION['login'] ?? null;
include_once '../../config.php';
include_once '../../layout/header/header.php';

$product_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($product_id) {
    // Truy vấn sản phẩm và hình ảnh sản phẩm
    $sql = "SELECT p.*, pi.image_url FROM products p 
            LEFT JOIN product_images pi ON p.id = pi.product_id 
            WHERE p.id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Truy vấn màu sắc sản phẩm
        $colorResult = $con->query("SELECT color_name FROM product_colors WHERE product_id = " . $product['id']);
        $colors = [];
        if ($colorResult->num_rows > 0) {
            while ($colorRow = $colorResult->fetch_assoc()) {
                $colors[] = $colorRow['color_name'];
            }
        }

        // Truy vấn kích thước sản phẩm
        $sizeResult = $con->query("SELECT size_name FROM product_sizes WHERE product_id = " . $product['id']);
        $sizes = [];
        if ($sizeResult->num_rows > 0) {
            while ($sizeRow = $sizeResult->fetch_assoc()) {
                $sizes[] = $sizeRow['size_name'];
            }
        }
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

<style>
    .productButtons {
        display: flex;
        gap: 10px !important;
        flex-wrap: wrap;
    }

    .productButtons label {
        font-size: 14px !important;
        box-shadow: none !important;
        cursor: pointer;
    }

    .wrapper-detailProduct #addCart {
        border: 1px solid red; 
        color: red; 
        font-size: 14px;
        box-shadow: none;
    }

    .wrapper-detailProduct #addCart:hover {
        background-color: red;
        color: #fff;
    }
</style>

<div class="container wrapper-detailProduct">
    <div class="d-flex justify-content-center gap-4">
        <!-- Ảnh sản phẩm -->
        <div class="border border-1 h-100">
            <img src="<?= htmlspecialchars($product['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid">
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="" style="flex: 1;">
            <!-- Tên sản phẩm -->
            <h2><?= htmlspecialchars($product['name']) ?></h2>

            <!-- Giá sản phẩm -->
            <div class="p-2 d-flex align-items-center" style="background-color: #f5f5f5;">
                <span style="color: red; font-weight: 500; margin-right: 10px">
                    <strong style="font-size: 16px; margin-right: 50px; color: #222;">Giá:</strong>
                    <strong><?= number_format($product['price'], 0, ',', '.') ?>đ</strong>
                </span>
                <?php if (!empty($product['old_price']) && ($product['old_price'] != $product['price'])): ?>
                    <span class="text-muted text-decoration-line-through" style="font-size: 14px; margin-right: 10px"><?= number_format($product['old_price'], 0, ',', '.') ?>đ</span>
                    <span style="background-color: red; color: #fff; padding: 5px; border-radius: 25px; font-size: 10px;"><?= $product['discount'] ?>%</span>
                <?php endif; ?>
            </div>

            <!-- Form truyền thông tin -->
            <form action="../../modules/cart/add-to-cart.php" method="POST">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($user_id) ?>">
                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']) ?>">
                <input type="hidden" name="old_price" value="<?= htmlspecialchars($product['old_price']) ?>">
                <input type="hidden" name="image_url" value="<?= htmlspecialchars($product['image_url']) ?>">

                <!-- Chọn màu sắc -->
                <div class="productButtons mb-3 d-flex flex-column">
                    <p class="m-0 mt-2" style="font-size: 15px; font-weight: 500;">Màu sắc:</p>
                    <div>
                        <?php foreach ($colors as $color): ?>
                            <input type="radio" class="btn-check" name="color" id="color-<?= htmlspecialchars($color) ?>" value="<?= htmlspecialchars($color) ?>" required>
                            <label class="btn btn-outline-dark" for="color-<?= htmlspecialchars($color) ?>"><?= htmlspecialchars($color) ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Chọn kích thước -->
                <div class="productButtons mb-3 d-flex flex-column">
                    <p class="m-0" style="font-size: 15px; font-weight: 500;">Kích thước:</p>
                    <div>
                        <?php foreach ($sizes as $size): ?>
                            <input type="radio" class="btn-check" name="size_product" id="size-<?= htmlspecialchars($size) ?>" value="<?= htmlspecialchars($size) ?>" required>
                            <label class="btn btn-outline-dark" for="size-<?= htmlspecialchars($size) ?>"><?= htmlspecialchars($size) ?></label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Số lượng -->
                <div class="mb-3 d-flex align-items-center">
                    <label for="quantity" class="form-label" style="font-size: 15px; font-weight: 500;">Số lượng:</label>
                    <div class="border border-1 d-flex align-items-center ms-2">
                        <button type="button" class="btn border-0 rounded-0" style="box-shadow: none; background: #f5f5f5;" onclick="document.getElementById('quantity').stepDown()">-</button>
                        <input type="number" class="border-0 text-center" id="quantity" style="width: 50px; box-shadow: none; font-size: 14px;" name="quantity" value="1" min="1" required>
                        <button type="button" class="btn border-0 rounded-0" style="box-shadow: none; background: #f5f5f5;" onclick="document.getElementById('quantity').stepUp()">+</button>
                    </div>
                </div>

                <!-- Nút thêm vào giỏ hàng, mua sản phẩm -->
                <div class="d-flex gap-2">
                    <button id="addCart" type="submit" class="btn text-uppercase w-100">Thêm vào giỏ</button>
                    <a href="../checkout/viewOrder.php" class="btn text-uppercase w-100" style="background-color: red; color: #fff; font-size: 14px; box-shadow: none;">Mua ngay</a>
                </div>
                <img src="../../uploads/other/Screenshot 2024-12-30 113857.png" alt="" style="width: 100%; height: 80px; object-fit: cover; margin-top: 10px;">
            </form>
        </div>
    </div>
    <hr>

    <!-- Mô tả sản phẩm -->
    <p style="font-size: 16px; margin-bottom: 100px;"><?= htmlspecialchars($product['description']) ?></p>
</div>

<?php
include_once '../../layout/footer/footer.php';
?>