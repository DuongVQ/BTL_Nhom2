<?php
session_start();
$user_id = $_SESSION['login'] ?? null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../templates/css/vieworder.css">
    <link rel="stylesheet" href="../../templates/css/bootstrap.min.css">
</head>
<style>

</style>

<body>

    <form action="addship.php" method="post" class="content">
        <main>
            <div class="main-left">

                <div class="logo">

                </div>
                <?php
                    include_once "../../config.php";

                    // Lấy thông tin shipment tu user_id
                    $shipment_info = null;
                    if ($user_id) {
                        // lay don hang moi nhat tu user id
                        $sql_order = "SELECT id FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
                        $stmt_order = $con->prepare($sql_order);
                        $stmt_order->bind_param("i", $user_id);
                        $stmt_order->execute();
                        $result_order = $stmt_order->get_result();

                        if ($result_order->num_rows > 0) {
                            $order = $result_order->fetch_assoc();
                            $order_id = $order['id'];

                            // Lay thong tin shipment tư id cua order
                            $sql_shipment = "SELECT * FROM shipment WHERE order_id = ?";
                            $stmt_shipment = $con->prepare($sql_shipment);
                            $stmt_shipment->bind_param("i", $order_id);
                            $stmt_shipment->execute();
                            $result_shipment = $stmt_shipment->get_result();

                            if ($result_shipment->num_rows > 0) {
                                $shipment_info = $result_shipment->fetch_assoc();
                            }
                        }
                        $sql_email = "SELECT email FROM user WHERE id = '$user_id'";
                        $rse = mysqli_query($con, $sql_email);
                        if($row = mysqli_fetch_assoc($rse)){
                            $mail = $row['email'];
                        }
                    }
                ?>
                <div>
                    <p>Thông tin giao hàng</p>
                </div>

                <div class="infor-order">
                    <input type="text" placeholder="Họ và tên" name="name" value="<?php echo $shipment_info['fullname'] ?? ''; ?>">
                    <div class="">
                        <input type="email" placeholder="Email" name="email" value="<?php echo $mail ?? ''; ?>">
                        <input type="text" placeholder="Số điện thoại" name="sdt" value="<?php echo $shipment_info['phone'] ?? ''; ?>">
                    </div>
                    <input type="text" placeholder="Địa chỉ" name="diachi" value="<?php echo $shipment_info['address'] ?? ''; ?>">
                    <div>
                        <input type="text" placeholder="Tỉnh" name="tinh" value="<?php echo $shipment_info['city'] ?? ''; ?>">
                        <input type="text" placeholder="Quận/Huyện" name="huyen" value="<?php echo $shipment_info['district'] ?? ''; ?>">
                    </div>
                </div>

                <div>
                    <p>Phương thức vận chuyển</p>

                    <div class="it-vc">
                        <input type="radio" id="nhanh" name="shipping" value="nhanh" checked>
                        <div class="it-lb">
                            <label for="nhanh">Giao hàng nhanh</label><br>
                            <label for="nhanh">30.000đ</label><br>

                        </div>
                    </div>

                </div>
                <div>
                    <p>Phương thức thanh toán</p>

                    <div class="it-tt">
                        <input type="radio" id="cod" name="cod" value="cod" checked>
                        <div class="it-lb">
                            <label for="cod">Thanh toán khi nhận hàng(COD)</label><br>

                        </div>
                    </div>
                </div>
                
                <a href="../../modules/cart/cart.php" class="btn btn-outline-danger w-100 mb-3">Giỏ hàng</a>

                <button type="submit" class="btn btn-dark text-uppercase w-100">Thanh toán đơn hàng</button>

            </div>

            <div class="main-right">
                <?php
                include_once "../../config.php";
                $sql = "SELECT * FROM cart WHERE `user_id` = '$user_id'";

                // echo $user_id;
                $rs = mysqli_query($con, $sql);
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                $count = 0;
                $total = 0;
                while ($r = $rs->fetch_assoc()) {
                    $count++;
                    $_SESSION['cart'][] = [
                        'product_id' => $r['product_id'],
                        'product_name' => $r['product_name'],
                        'price' => $r['price'],
                        'quantity' => $r['quantity'],
                        'image_url' => $r['image_url'],
                        'color' => $r['color'],
                        'size_product' => $r['size_product']
                    ];
                    $total += $r['price'] * $r['quantity'];
                    echo "<div  class='item'>
                            <div>
                                <img src='{$r['image_url']}' />
                            </div>
                            <div class='item-name'>
                                <p>{$r['product_name']}</p>
                                <span>{$r['color']}/ {$r['size_product']}</span>
                            </div>
                            <div>
                                <p>{$r['price']}đ</p>
                            </div>
                        </div>";
                }

                if ($count = 0) {
                    echo "giỏ hàng trống";
                }
                $totalfinal = $total + 30000;
                echo "<hr style='width: 50%; margin: 0 auto;'>";
                echo "<div class='tinh-tien'>
                        <div class='tinh'>
                            <p>Tạm tính</p>
                            <p>{$total}đ</p>
                        </div>
                        <div class='phivc'>
                            <p>Phí vận chuyển</p>
                            <p>30000đ</p>
                        </div>
                        <div>
                            <p>Tổng cộng</p>
                            <p>{$totalfinal}đ</p>
                        </div>
                    </div>"
                ?>

            </div>
        </main>
    </form>

    <script src="../../templates/js/bootstrap.min.js"></script>
</body>

</html>