<?php
include_once "../../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container mt-4">
        <h1>Danh sách hóa đơn</h1>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            // Truy vấn cơ sở dữ liệu để lấy danh sách đơn hàng
                            $sql_str = "SELECT orders.*, shipment.fullname
                                FROM orders 
                                JOIN shipment ON orders.id = shipment.order_id 
                                WHERE orders.id
                                ORDER BY created_at";
                            $result = mysqli_query($con, $sql_str);
                            $stt = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $stt++;
                            ?>
                                <tr>
                                    <td><?=$stt?></td>
                                    <td><?=$row['id']?></td>
                                    <td><?=$row['fullname']?></td>
                                    <td><?=$row['created_at']?></td>
                                    <td><span class='<?=$row['status']?>'><?=$row['status']?></span></td>
                                    <td>
                                        <a class="btn btn-warning" href="../../modules/orders/view.php?id=<?=$row['id']?>">Xem</a>
                                        <a class="btn btn-warning" href="../../modules/orders/indon.php?id=<?=$row['id']?>">In đơn hàng</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>                                 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        <?php
        if (isset($_SESSION['message'])) {
            echo "toastr.success('" . $_SESSION['message'] . "');";
            unset($_SESSION['message']);
        }
        ?>
    </script>
</body>

</html>
