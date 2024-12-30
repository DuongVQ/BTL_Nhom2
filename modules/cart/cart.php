<?php
session_start();
include_once '../../config.php';
include_once '../../layout/header/header.php';

// Kiểm tra đăng nhập
$user_id = $_SESSION['login'] ?? null;

if ($user_id) {
    // Số lượng sản phẩm trong giỏ hàng
    $cartCountQuery = "SELECT COUNT(*) as count FROM cart WHERE user_id = ?";
    $stmt = $con->prepare($cartCountQuery);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cartCount = 0;

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

    // Tính tổng tiền
    if ($cartItemsResult) {
        while ($row = $cartItemsResult->fetch_assoc()) {
            $cartItems[] = $row;
            $totalPrice += $row['price'] * $row['quantity'];
        }
    }
} else {
    // Chưa đăng nhập
    $cartCount = 0;
    $cartItems = [];
    $totalPrice = 0;
}
?>
<div class="wrapper-cart">
    <?php if ($cartItems): ?>
        <div class="d-flex justify-content-between align-items-start gap-5">
            <ul class="list-group" style="flex: 1;">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
                    <h4>Giỏ hàng của bạn</h4>
                    <span>Hiện đang có <b><?= $cartCount ?> sản phẩm</b></span>
                </div>

                <!-- Lấy sản phẩm từ bảng Cart -->
                <?php foreach ($cartItems as $item): ?>
                    <li class="list-group-item p-3 mb-3 border-1 rounded-3 d-flex justify-content-between gap-1">
                        <div style="width: 80px;">
                            <img src="<?= htmlspecialchars($item['image_url'] ?? 'default-image.png') ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" style="width: 100%; height: 100px; object-fit: cover; border: 1px solid #eee;">
                        </div>
                        <div style="flex: 1;">
                            <!-- Tên sản phẩm -->
                            <h6 style="font-size: 14px;"><?= htmlspecialchars($item['product_name']) ?></h6>
                            <!-- Màu, size, giá tiền -->
                            <div class="d-flex justify-content-between align-items-center">
                                <p style="font-size: 12px; margin-bottom: 0;"><?= htmlspecialchars($item['color']) ?> / <?= htmlspecialchars($item['size_product']) ?></p>
                                <p style="font-size: 12px; margin-bottom: 0;"><?= number_format($item['price'], 0, ',', '.') ?>đ x <?= $item['quantity'] ?></p>
                            </div>
                            <!-- Xóa -->
                            <form action="../../modules/cart/delete-cart.php" method="POST" class="text-end">
                                <input type="hidden" name="cart_item_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-sm mt-2 text-white" style="font-size: 12px; box-shadow:none; background-color: red;">Xóa</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <!-- Thông tin đơn hàng -->
            <div class="border p-3 rounded-2" style="width: 400px;">
                <h4>Thông tin đơn hàng</h4>
                <hr>
                <div class="d-flex justify-content-between w-100">
                    <b>Tổng tiền:</b>
                    <b style="color: red; font-size: 20px"><?= number_format($totalPrice, 0, ',', '.') . 'đ' ?></b>
                </div>
                <hr>
                <ul class="ps-3">
                    <li class="text-secondary" style="font-size: 12px;">Phí vận chuyển sẽ được tính ở trang thanh toán.</li>
                    <li class="text-secondary" style="font-size: 12px;">Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.</li>
                </ul>

                <!-- Thanh toán -->
                <a href="../../modules/checkout/viewOrder.php" class="btn w-100 text-white rounded-0" style="box-shadow:none; background-color: red; font-size: 14px; cursor: pointer;">Thanh toán</a>
            </div>
        </div>
    <?php else: ?>
        <p>Giỏ hàng của bạn trống.</p>
    <?php endif; ?>
</div>

<?php
include_once '../../layout/footer/footer.php';
?>