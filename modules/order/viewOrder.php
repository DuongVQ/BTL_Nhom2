<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../templates/css/vieworder.css">

</head>

<body>
    <main>
        <div class="main-left">
            <form action="" method="post">
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
                        <input type="radio" id="nhanh" name="shipping" value="nhanh">
                        <div class="it-lb">
                            <label for="nhanh">Giao hàng nhanh</label><br>
                            <label for="nhanh">30.000</label><br>

                        </div>
                    </div>
                    <div class="it-vc">
                        <input type="radio" id="hoatoc" name="shipping" value="hoatoc">
                        <div class="it-lb">
                            <label for="hoatoc">Giao hàng hỏa tốc</label><br>
                            <label for="hoatoc">60.000</label><br>

                        </div>
                    </div>
                </div>
                <div>
                    <p>Phương thức thanh toán</p>

                    <div class="it-tt">
                        <input type="radio" id="cod" name="cod" value="cod">
                        <div class="it-lb">
                            <label for="cod">Giao hàng nhanh</label><br>

                        </div>
                    </div>
                </div>
                <input type="submit" value="Hoàn tất đơn hàng">

            </form>

        </div>

        <div class="main-right">

        </div>
    </main>
</body>

</html>