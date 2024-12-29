<?php
session_start();
include "../../layout/header/header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết mua hàng</title>
</head>

<body>
    <div class="wrapper_list_ordered">
        <div class="container">
            <h4 class="title_notf mb-3">Chi tiết mua hàng</h4>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Số thứ tự</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tổng tiền</th>
                    </tr>
                </thead>
                <?php
                include "../../config.php";
                $orderId = $_GET['orderId'];
                $sql = "SELECT * FROM order_details WHERE `order_id` = '$orderId'";
                $listOrder = mysqli_query($con, $sql);
                if (mysqli_num_rows($listOrder) > 0) {
                    $no = 0;
                    $total = 0;
                    while ($arrOrderDetails = mysqli_fetch_array($listOrder)) {
                        $total += $arrOrderDetails['total'];
                ?>

                        <tr>
                            <td class="no_ordered"> <?= ++$no ?> </td>
                            <td> <?= $arrOrderDetails['product_name'] ?> </td>
                            <td> <?= $arrOrderDetails['price_product'] ?> </td>
                            <td> <?= $arrOrderDetails['quantity'] ?> </td>
                            <td> <?= $arrOrderDetails['total'] ?> </td>
                        </tr>
                        

                <?php
                    }
                    echo "<tr>
                            <td>Chi phí vận chuyển: 30.000đ</td>
                        </tr>";
                    $total += 30000;
                    echo "<tr>
                            <td>Tổng tiền thanh toán:  $total</td>
                        </tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <?php
    include "../../layout/footer/footer.php";
    ?>
</body>

</html>