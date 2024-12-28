<?php
session_start();
include_once "../../layout/header/header.php";
include_once "../../config.php";
include_once "../../includes/function.php";

$result = $con->query("SELECT * FROM categories LIMIT 7");
$listCategories = [];


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $listCategories[] = $row;
    }
}

$saleResult = $con->query("SELECT  p.*, pi.image_url FROM products p LEFT JOIN product_images pi ON p.id = pi.product_id WHERE p.discount > 0 GROUP BY p.id");
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
                    <div class="item-product" data-product-id="<?= htmlspecialchars($saleProduct['id']) ?>"
                        data-colors="<?= htmlspecialchars(implode(', ', $saleProduct['colors'])) ?>"
                        data-sizes="<?= htmlspecialchars(implode(', ', $saleProduct['sizes'])) ?>">
                        <!-- Giảm giá -->
                        <div class="sale">-<?= intval($saleProduct['discount']) ?>%</div>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($saleProduct['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($saleProduct['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                                
                            <?php
                            if (!empty($saleProducts)) {
                                
                                
                                    echo '<button>';
                                    echo '<a href="chitetsanpham.php?id=' . $saleProduct['id'] . '">';
                                    echo '<img src="../../templates/image/after.png" alt="' . $saleProduct['name'] . '">';
                                    echo '</a>';
                                    echo '</button>';
                                
                            } 
                            ?>
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

<div class="tabs">
    <!-- Danh mục -->
    <div class="tab-menu">
        <button class="tab-link active" data-tab="tab-1">Áo Khoác</button>
        <button class="tab-link" data-tab="tab-2">Bộ Nỉ</button>
        <button class="tab-link" data-tab="tab-3">Sơ Mi - Quần Dài</button>
        <button class="tab-link" data-tab="tab-4">Áo Polo</button>
    </div>

    <!-- Nội dung từng danh mục -->
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <div class="product-grid">
                <?php foreach ($aoKhoacs as $aoKhoac): ?>
                    <div class="item-product" data-product-id="<?= htmlspecialchars($aoKhoac['id']) ?>"
                        data-colors="<?= htmlspecialchars(implode(', ', $aoKhoac['colors'])) ?>"
                        data-sizes="<?= htmlspecialchars(implode(', ', $aoKhoac['sizes'])) ?>">
                        <!-- Giảm giá -->
                        <?php if ($aoKhoac['discount'] > 0): ?>
                            <div class="sale">-<?= intval($aoKhoac['discount']) ?>%</div>
                        <?php endif; ?>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($aoKhoac['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($aoKhoac['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                            <?php
                            if (!empty($saleProducts)) {
                                
                                
                                    echo '<button>';
                                    echo '<a href="chitetsanpham.php?id=' . $aoKhoac['id'] . '">';
                                    echo '<img src="../../templates/image/after.png" alt="' . $aoKhoac['name'] . '">';
                                    echo '</a>';
                                    echo '</button>';
                                
                            } 
                            ?>
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
                                <span>+<?= count($aoKhoac['colors']) ?> Màu sắc</span>
                                <span>+<?= count($aoKhoac['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($aoKhoac['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($aoKhoac['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($aoKhoac['old_price']) && ($aoKhoac['old_price'] != $aoKhoac['price'])): ?>
                                    <div class="old"><?= number_format($aoKhoac['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="tab-2" class="tab-pane">
            <div class="product-grid">
                <?php foreach ($boNis as $boNi): ?>
                    <div class="item-product" data-product-id="<?= htmlspecialchars($boNi['id']) ?>"
                        data-colors="<?= htmlspecialchars(implode(', ', $boNi['colors'])) ?>"
                        data-sizes="<?= htmlspecialchars(implode(', ', $boNi['sizes'])) ?>">
                        <!-- Giảm giá -->
                        <?php if ($boNi['discount'] > 0): ?>
                            <div class="sale">-<?= intval($boNi['discount']) ?>%</div>
                        <?php endif; ?>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($boNi['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($boNi['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                            <?php
                            if (!empty($saleProducts)) {
                                
                                
                                    echo '<button>';
                                    echo '<a href="chitetsanpham.php?id=' . $boNi['id'] . '">';
                                    echo '<img src="../../templates/image/after.png" alt="' . $boNi['name'] . '">';
                                    echo '</a>';
                                    echo '</button>';
                                
                            } 
                            ?>
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
                                <span>+<?= count($boNi['colors']) ?> Màu sắc</span>
                                <span>+<?= count($boNi['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($boNi['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($boNi['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($boNi['old_price']) && ($boNi['old_price'] != $boNi['price'])): ?>
                                    <div class="old"><?= number_format($boNi['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="tab-3" class="tab-pane">
            <div class="product-grid">
                <?php foreach ($soMis as $soMi): ?>
                    <div class="item-product" data-product-id="<?= htmlspecialchars($soMi['id']) ?>"
                        data-colors="<?= htmlspecialchars(implode(', ', $soMi['colors'])) ?>"
                        data-sizes="<?= htmlspecialchars(implode(', ', $soMi['sizes'])) ?>">
                        <!-- Giảm giá -->
                        <?php if ($soMi['discount'] > 0): ?>
                            <div class="sale">-<?= intval($soMi['discount']) ?>%</div>
                        <?php endif; ?>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($soMi['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($soMi['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                            <?php
                            if (!empty($saleProducts)) {
                                
                                
                                    echo '<button>';
                                    echo '<a href="chitetsanpham.php?id=' . $soMi['id'] . '">';
                                    echo '<img src="../../templates/image/after.png" alt="' . $soMi['name'] . '">';
                                    echo '</a>';
                                    echo '</button>';
                                
                            } 
                            ?>
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
                                <span>+<?= count($soMi['colors']) ?> Màu sắc</span>
                                <span>+<?= count($soMi['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($soMi['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($soMi['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($soMi['old_price']) && ($soMi['old_price'] != $soMi['price'])): ?>
                                    <div class="old"><?= number_format($soMi['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="tab-4" class="tab-pane">
            <div class="product-grid">
                <?php foreach ($aoPolos as $aoPolo): ?>
                    <div class="item-product" data-product-id="<?= htmlspecialchars($aoPolo['id']) ?>"
                        data-colors="<?= htmlspecialchars(implode(', ', $aoPolo['colors'])) ?>"
                        data-sizes="<?= htmlspecialchars(implode(', ', $aoPolo['sizes'])) ?>">
                        <!-- Giảm giá -->
                        <?php if ($aoPolo['discount'] > 0): ?>
                            <div class="sale">-<?= intval($aoPolo['discount']) ?>%</div>
                        <?php endif; ?>

                        <!-- Hình ảnh sản phẩm -->
                        <div class="img-product">
                            <img src="<?= htmlspecialchars($aoPolo['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($aoPolo['name']) ?>" style="width: 100%; height: 280px; object-fit: cover;">
                            <div class="img-product-after">
                            <?php
                            if (!empty($saleProducts)) {
                                
                                
                                    echo '<button>';
                                    echo '<a href="chitetsanpham.php?id=' . $aoPolo['id'] . '">';
                                    echo '<img src="../../templates/image/after.png" alt="' . $aoPolo['name'] . '">';
                                    echo '</a>';
                                    echo '</button>';
                                
                            } 
                            ?>
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
                                <span>+<?= count($aoPolo['colors']) ?> Màu sắc</span>
                                <span>+<?= count($aoPolo['sizes']) ?> Kích thước</span>
                            </div>
                            <div class="name-product"><?= htmlspecialchars($aoPolo['name']) ?></div>
                            <div class="price">
                                <div class="new"><?= number_format($aoPolo['price'], 0, ',', '.') ?>đ</div>
                                <?php if (!empty($aoPolo['old_price']) && ($aoPolo['old_price'] != $aoPolo['price'])): ?>
                                    <div class="old"><?= number_format($aoPolo['old_price'], 0, ',', '.') ?>đ</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>


<!-- info -->
<hr>
<div class="support-information">
    <div class="item-support-information">
        <img class=" lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_1.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_1.png?v=614" alt="Miễn phí vận chuyển">
        <div class="info-item-support-information">
            <h3 class="">Miễn phí vận chuyển</h3>
            <span>Áp dụng cho mọi đơn hàng từ 500k</span>
        </div>
    </div>
    <div class="item-support-information">
        <img class=" lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_2.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_2.png?v=614" alt="Đổi hàng dễ dàng">
        <div class="info-item-support-information">
            <h3 class="">Dễ dàng đổi hàng</h3>
            <span>7 ngày đổi hàng vì bất cứ lý do gì</span>
        </div>
    </div>
    <div class="item-support-information">
        <img class=" lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_3.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_3.png?v=614" alt="Hỗ trợ nhanh chóng">
        <div class="info-item-support-information">
            <h3 class="">Hỗ trợ nhanh chóng</h3>
            <span>HOTLINE 24/7 : 0967083126</span>
        </div>
    </div>
    <div class="item-support-information">
        <img class=" lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_4.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/home_policy_icon_4.png?v=614" alt="Thanh toán đa dạng">
        <div class="info-item-support-information">
            <h3 class="">Thanh toán đa dạng</h3>
            <span>Thanh toán khi nhận hàng, Napas, Visa, Chuyển Khoản</span>
        </div>
    </div>
</div>

<?php
include_once "../../layout/footer/footer.php";
include_once "../../layout/modal/modal-product.php";
?>