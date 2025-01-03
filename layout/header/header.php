<?php
include_once '../../config.php'; 

// Lấy thông tin user_id từ session
$user_id = $_SESSION['login'] ?? null; 

if ($user_id) {
    // Lấy ra thông tin giỏ hàng của người dùng
    $cartCountQuery = "SELECT COUNT(*) as count FROM cart WHERE user_id = ?";
    $stmt = $con->prepare($cartCountQuery);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cartCount = 0;

    // Số lượng sản phẩm trong giỏ hàng
    if ($result && $row = $result->fetch_assoc()) {
        $cartCount = $row['count'];
    }

    // Danh sách sản phẩm trong giỏ hàng
    $cartItemsQuery = "SELECT * FROM cart WHERE user_id = ?";
    $stmt = $con->prepare($cartItemsQuery);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $cartItemsResult = $stmt->get_result();
    $cartItems = [];
    $totalPrice = 0;

    // Tính tổng giá tiền của giỏ hàng
    if ($cartItemsResult) {
        while ($row = $cartItemsResult->fetch_assoc()) {
            $cartItems[] = $row;
            $totalPrice += $row['price'] * $row['quantity'];
        }
    }
} else {
    // Nếu chưa đăng nhập thì giỏ hàng rỗng
    $cartCount = 0;
    $cartItems = [];
    $totalPrice = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Link font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- Link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link bootstrap -->
    <link rel="stylesheet" href="../../templates/css/bootstrap.min.css">
    <!-- Link swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Link Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js"
        integrity="sha512-Dm5UxqUSgNd93XG7eseoOrScyM1BVs65GrwmavP0D0DujOA8mjiBfyj71wmI2VQZKnnZQsSWWsxDKNiQIqk8sQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Link css -->
    <link rel="stylesheet" href="../../templates/css/header.css">
    <link rel="stylesheet" href="../../templates/css/home.css">
    <link rel="stylesheet" href="../../templates/css/cart.css">
    <link rel="stylesheet" href="../../templates/css/footer.css">
    <link rel="stylesheet" href="../../templates/css/orderDetails.css">
    <link rel="stylesheet" href="../../templates/css/inforUser.css">
    <link rel="stylesheet" href="../../templates/css/listOrdered.css">
    <link rel="stylesheet" href="../../templates/css/detailProduct.css">
    <style>
        .header-cart ul.list-group {
        max-height: 400px;
        overflow-y: auto; 
        scrollbar-width: none; 
    }
    </style>
</head>

<body>
    <div class="header w-100">
        <div class="header-wrapper">
            <!-- logo -->
            <div class="logo">
                <a href="../../modules/dashboard/home.php">
                    <img itemprop="logo" src="//theme.hstatic.net/200000690725/1001078549/14/logo.png?v=603"
                        alt="Torano" class="img-responsive logoimg ls-is-cached lazyloaded" width="180">
                </a>
            </div>

            <!-- menu header -->
            <div class="menu-header">
                <a href="#" class="item-menu-header">New product</a>
                <a href="#" class="item-menu-header">Sale</a>
                <a href="#" class="item-menu-header secondary">
                    men's shirts
                    <div class="menu-header-secondary">
                        <div class="item-menu-header-secondary">blazer</div>
                        <div class="item-menu-header-secondary">jacket</div>
                        <div class="item-menu-header-secondary">polo</div>
                        <div class="item-menu-header-secondary">shirt</div>
                        <div class="item-menu-header-secondary">t-shirt</div>
                        <div class="item-menu-header-secondary">sweater</div>
                    </div>
                </a>
                <a href="#" class="item-menu-header secondary">
                    men's pants
                    <div class="menu-header-secondary">
                        <div class="item-menu-header-secondary">jeans</div>
                        <div class="item-menu-header-secondary">kakis</div>
                        <div class="item-menu-header-secondary">shorts</div>
                        <div class="item-menu-header-secondary">trousers</div>
                    </div>
                </a>
                <a href="#" class="item-menu-header">Collection</a>
                <a href="#" class="item-menu-header">About us</a>
            </div>

            <!-- header action -->
            <div class="header-action">
                <div class="header-search">
                    <!-- Offcanvas Sidebar -->
                    <div class="offcanvas offcanvas-top" id="search" style="height: 100px !important;">

                        <!-- Form search product -->
                        <form action="../../layout/header/search.php" method="GET" class="d-flex">
                            <div class="offcanvas-body d-flex justify-content-between align-items-center mt-2">
                                <img itemprop="logo" src="//theme.hstatic.net/200000690725/1001078549/14/logo.png?v=603"
                                    alt="Torano" class="img-responsive logoimg ls-is-cached lazyloaded" width="180">
                                <div class="d-flex align-items-center border-1 border border-dark">
                                    <!-- Nhập dữ liệu tìm kiếm -->
                                    <input type="text" name="query" class="form-control header-search-input border-0"
                                        placeholder="Tìm kiếm sản phẩm" style="box-shadow: none; width: 500px;">
                                
                                    <!-- Btn tìm kiếm -->
                                    <button type="submit" class="header-action-btn">
                                        <box-icon name='search'></box-icon>
                                    </button>
                                </div>

                                <!-- Btn đóng offcanvas -->
                                <button type="button" class="header-action-btn" data-bs-dismiss="offcanvas"
                                    style="width: 180px;">
                                    <box-icon name='x'></box-icon>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Nút tìm kiếm -->
                    <button class="header-action-btn" data-bs-toggle="offcanvas" data-bs-target="#search">
                        <box-icon name='search'></box-icon>
                    </button>
                </div>

                <!-- Giỏ hàng -->
                <div class="header-cart">
                    <button class="header-action-btn" data-bs-toggle="offcanvas" data-bs-target="#demo"
                        style="position: relative;">
                        <box-icon name='shopping-bag'></box-icon>

                        <!-- Hiển thị số lượng sản phẩm trong giỏ hàng -->
                        <?php if ($cartCount > 0): ?>
                            <span class="total-products bg-danger"><?= $cartCount ?></span>
                        <?php endif; ?>
                    </button>

                    <!-- Offcanvas Sidebar -->
                    <div class="offcanvas offcanvas-end" id="demo">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title">Giỏ hàng</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                style="font-size: 16px; box-shadow: none;"></button>
                        </div>
                        <div class="offcanvas-body position-relative">
                            <?php if ($cartItems): ?>
                            <ul class="list-group rounded-0">
                                <!-- Hiển thị sản phẩm trong giỏ hàng -->
                                <?php foreach ($cartItems as $item): ?>
                                <li
                                    class="list-group-item p-0 pt-1 pb-3 border-0 border-bottom d-flex justify-content-between gap-1">
                                    <div style="width: 80px;">
                                        <!-- Ảnh sản phẩm -->
                                        <img src="<?= htmlspecialchars($item['image_url'] ?? 'default-image.png') ?>"
                                            alt="<?= htmlspecialchars($item['product_name']) ?>"
                                            style="width: 100%; height: 100px; object-fit: cover; border: 1px solid #eee;">
                                    </div>
                                    <div style="flex: 1;">
                                        <!-- Tên sản phẩm -->
                                        <h6 style="font-size: 14px;"><?= htmlspecialchars($item['product_name']) ?></h6>
                                        <!-- Thông tin màu, size -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p style="font-size: 12px; margin-bottom: 0;">
                                                <?= htmlspecialchars($item['color']) ?> /
                                                <?= htmlspecialchars($item['size_product']) ?></p>
                                            <p style="font-size: 12px; margin-bottom: 0;">
                                                <?= number_format($item['price'], 0, ',', '.') ?>đ x
                                                <?= $item['quantity'] ?></p>
                                        </div>
                                        <!-- Xóa sản phẩm khỏi giỏ hàng -->
                                        <form action="../../modules/cart/delete-cart.php" method="POST"
                                            class="text-end">
                                            <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                            <button type="submit" class="btn btn-sm mt-2 text-white"
                                                style="font-size: 12px; box-shadow:none; background-color: red;">Xóa</button>
                                        </form>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>

                            <!-- Thanh toán -->
                            <div class="mt-3 position-absolute bottom-0 start-0 w-100 p-2 border-top bg-white z-index-1">
                                <!-- Tổng tiền -->
                                <div class="d-flex justify-content-between w-100">
                                    <p>Thành tiền:</p>
                                    <p><?= number_format($totalPrice, 0, ',', '.') . 'đ' ?></p>
                                </div>

                                <!-- Btn thanh toán -->
                                <a href="../../modules/checkout/viewOrder.php" class="btn w-100 text-white"
                                    style="box-shadow:none; background-color: red; font-size: 14px;">Thanh toán</a>
                                
                                <!-- Xem giỏ hàng -->
                                <a href="../../modules/cart/cart.php"
                                    style="font-size: 12px; text-decoration:underline;">Xem giỏ hàng</a>

                            </div>

                            <!-- Nếu không có sản phẩm -->
                            <?php else: ?>
                                <p>Giỏ hàng của bạn trống.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Chức năng người dùng -->
                <div class="header-user">
                    <?php
                        // Chưa đăng nhập hiện login
                        if (!isset($_SESSION['login'])) {
                    ?>
                    <a href="../../modules/dashboard/login.php">
                        <div class="header-action-btn" style="cursor: pointer;">
                            <box-icon name='log-in'></box-icon>
                        </div>
                    </a>
                    <?php
                    } else { // Đã đăng nhập hiện chức năng người dùng
                    ?>
                    <button class="header-action-btn header-user-parent">
                        <box-icon name='user'></box-icon>
                        <div class="header-user-secondary">
                            <!-- Chỉnh sửa thông tin -->
                            <a href="../../modules/dashboard/inforUser.php">
                                <div class="item-header-user-secondary">
                                    <box-icon type='solid' name='user'></box-icon>
                                    Thông tin cá nhân
                                </div>
                            </a>

                            <!-- Đơn hàng của tôi -->
                            <a href="../../modules/dashboard/donhangcuatoi.php">
                                <div class="item-header-user-secondary">
                                    <box-icon type='solid' name='box'></box-icon>
                                    Đơn hàng của tôi
                                </div>
                            </a>

                            <!-- Lịch sử đặt hàng -->
                            <a href="../../modules/dashboard/history-order.php">
                                <div class="item-header-user-secondary">
                                    <box-icon name='history'></box-icon>
                                    Lịch sử đặt hàng
                                </div>
                            </a>

                            <!-- Đăng xuất -->
                            <a href="../../modules/user/logout.php">
                                <div class="item-header-user-secondary" style="border-top: 1px solid #ccc;">
                                    <box-icon name='log-out'></box-icon>
                                    Đăng xuất
                                </div>
                            </a>
                            <?php
                        }
                            ?>

                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>