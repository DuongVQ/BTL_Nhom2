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

</head>
<style>

</style>

<body>

    <form action="addship.php" method="post" class="content">
        <main>
            <div class="main-left">

                <div class="logo">

                </div>

                <div>
                    <p>Thông tin giao hàng</p>
                </div>

                <div class="infor-order">
                    <input type="text" placeholder="Họ và tên" name="name">
                    <div class="">
                        <input type="email" placeholder="Email" name="email">
                        <input type="text" placeholder="Số điện thoại" name="sdt">
                    </div>
                    <input type="text" placeholder="Địa chỉ" name="diachi">
                    <div>
                        <input type="text" placeholder="Tỉnh" name="tinh">
                        <input type="text" placeholder="Quận/Huyện" name="huyen">
                        <input type="text" placeholder="Phường/Xã" name="xa">
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
                <button>
                    <a href="../../modules/cart/cart.php">Giỏ hàng</a>
                </button>


                <button type="submit">Hoàn tất đơn hàng</button>


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


</body>

</html>