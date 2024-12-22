<?php
include_once "../../layout/header/header.php";
include_once "../../config.php";

$con = new mysqli($url, $uname, $upass, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con->query("SELECT * FROM categories");
$listCategories = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $listCategories[] = $row;
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

<?php
include_once "../../layout/footer/footer.php";
?>