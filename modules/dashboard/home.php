<?php
include_once "../../layout/header/header.php";
include_once "../../config.php";

$result = $con->query("SELECT * FROM categories LIMIT 7");
$listCategories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $listCategories[] = $row;
    }
}

$saleResult = $con->query("SELECT p.*, pi.image_url FROM products p LEFT JOIN product_images pi ON p.id = pi.product_id WHERE p.discount > 0 GROUP BY p.id");
$saleProducts = [];

if ($saleResult->num_rows > 0) {
    while ($row = $saleResult->fetch_assoc()) {
        // Fetch colors
        $colorResult = $con->query("SELECT color_name FROM product_colors WHERE product_id = " . $row['id']);
        $colors = [];
        if ($colorResult->num_rows > 0) {
            while ($colorRow = $colorResult->fetch_assoc()) {
                $colors[] = $colorRow['color_name']; // Thêm từng màu sắc vào mảng
            }
        }
        $row['colors'] = $colors; // Gán mảng màu sắc hoàn chỉnh

        // Fetch sizes
        $sizeResult = $con->query("SELECT size_name FROM product_sizes WHERE product_id = " . $row['id']);
        $sizes = [];
        if ($sizeResult->num_rows > 0) {
            while ($sizeRow = $sizeResult->fetch_assoc()) {
                $sizes[] = $sizeRow['size_name']; // Thêm từng kích thước vào mảng
            }
        }
        $row['sizes'] = $sizes; // Gán mảng kích thước hoàn chỉnh

        $saleProducts[] = $row; // Thêm sản phẩm vào mảng kết quả
        print_r($row['sizes']);
    }
}


$con->close();
?>

<!-- banner -->
<div class="banner">
    <div class="swiper-container">
        <div class="swiper-wrapper slides-banner">
            <div class="swiper-slide">
                <img alt="New Collection FW24" src="//theme.hstatic.net/200000690725/1001078549/14/slide_1_img.jpg?v=603">
            </div>
            <div class="swiper-slide">
                <img alt="Mini Lookbook FW24" src="//theme.hstatic.net/200000690725/1001078549/14/slide_3_img.jpg?v=603">
            </div>
            <div class="swiper-slide">
                <img alt="SALE 149K" src="//theme.hstatic.net/200000690725/1001078549/14/slide_4_img.jpg?v=614">
            </div>
        </div>
        <!-- Thêm nút điều hướng -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <!-- Thêm Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- product catalog -->
<div class="product-catalog">
    <div class="d-flex justify-content-between align-items-center position-relative">
        <h2 class="text-uppercase">Danh mục sản phẩm</h2>

        <div class="d-flex" style="height: 44px;">
            <!-- Navigation buttons -->
            <div class="swiper-button-prev catalog-prev position-relative me-3"></div>
            <div class="swiper-button-next catalog-next position-relative ms-3"></div>
        </div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php if (!empty($listCategories)): ?>
                <?php foreach ($listCategories as $category): ?>
                    <div class="swiper-slide">
                        <div class="item-product-catalog">
                            <img src="<?= !empty($category['image']) ? $category['image'] : '/uploads/default.png'; ?>"
                                alt="<?= htmlspecialchars($category['name']); ?>">
                            <div class="title-item-product-catalog">
                                <span><?= htmlspecialchars($category['name']); ?></span>
                                <a href="#">
                                    <button>
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="swiper-slide">
                    <div class="item-product-catalog">
                        <p>Không có danh mục nào được tìm thấy.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- product sale -->
<div class="product-sale">
    <div class="d-flex justify-content-between align-items-center position-relative">
        <h2 class="text-uppercase">Sản phẩm khuyến mãi</h2>

        <div class="d-flex" style="height: 44px;">
            <!-- Navigation buttons -->
            <div class="swiper-button-prev sale-prev position-relative me-3"></div>
            <div class="swiper-button-next sale-next position-relative ms-3"></div>
        </div>
    </div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ($saleProducts as $saleProduct): ?>
                <div class="swiper-slide">
                    <div class="item-product">
                        <!-- Giảm giá -->
                        <div class="sale">-<?= intval($saleProduct['discount']) ?>%</div>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($saleProduct['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($saleProduct['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                                <img src="../../templates/image/after.png" alt="Ảnh phụ">
                                <div class="wrapper-addCart">
                                    <div class="addCart">
                                        <i class="fa-solid fa-bag-shopping me-1"></i>Thêm
                                    </div>
                                    <div class="quick-view">
                                        <i class="fa-regular fa-eye"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin sản phẩm -->
                        <div class="info-item-product">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>+<?= count($saleProduct['colors']) ?> Màu sắc</span>
                                <span>+<?= count($saleProduct['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($saleProduct['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($saleProduct['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($saleProduct['old_price']) && ($saleProduct['old_price'] != $saleProduct['price'])): ?>
                                    <div class="old"><?= number_format($saleProduct['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="w-100 text-center mt-3">
        <a href="#" class="see-more">
            <button class="btn"><i class="fa-solid fa-angles-right"></i> Xem thêm</button>
        </a>
    </div>
</div>
<?php
include_once "../../layout/footer/footer.php";
?>