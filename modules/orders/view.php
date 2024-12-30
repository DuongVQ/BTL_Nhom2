<?php
session_start();
include_once "../../config.php";

$id = $_GET['id'];
$result = $con->query("SELECT orders.*, shipment.*, user.email 
                                FROM orders 
                                JOIN user ON orders.user_id = user.id 
                                JOIN shipment ON orders.id = shipment.order_id 
                                WHERE orders.id='$id'");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Order not found.");
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];

    $con->query("UPDATE orders SET status='$status' WHERE id='$id'");
    $_SESSION['message'] = "Order status updated successfully!";
    header("Location:../../layout/slidebar/slidebar.php?page_layout=orders");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h1 text-gray-900">Xem và cập nhật trạng thái đơn hàng</h1>
                            </div>
                            <div class="col-md-6 mx-auto">
                                <div class="card shadow mb-4">
                                    <div class="card-body">
                                        <div class="text-center mb-4">
                                            <h1 class="h3 text-gray-900">Thông tin khách hàng</h1>
                                        </div>
                                        <form class="user" method="post" action="#">
                                            <div class="row mb-3">
                                                <div class="col-md-3"><strong>Mã hóa đơn:</strong></div>
                                                <div class="col-md-9"><?= $row['id'] ?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3"><strong>Khách hàng:</strong></div>
                                                <div class="col-md-9"><?= $row['fullname'] ?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3"><strong>Số điện thoại:</strong></div>
                                                <div class="col-md-9"><?= $row['phone'] ?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3"><strong>Email:</strong></div>
                                                <div class="col-md-9"><?= $row['email'] ?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3"><strong>Địa chỉ:</strong></div>
                                                <div class="col-md-9"><?= $row['address'] . ', ' . $row['district']. ', ' . $row['city']?></div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-3"><strong>Trạng thái đơn hàng:</strong></div>
                                                <div class="col-md-9">
                                                    <select name="status" class="form-select">
                                                        <option <?= $row['status'] == 'Đang xử lý' ? 'selected' : '' ?>>
                                                            Đang xử lý</option>
                                                        <option <?= $row['status'] == 'Đang giao' ? 'selected' : '' ?>>Đang
                                                            giao</option>
                                                        <option <?= $row['status'] == 'Đã giao' ? 'selected' : '' ?>>Đã
                                                            giao</option>
                                                        <option <?= $row['status'] == 'Đã hủy' ? 'selected' : '' ?>>Đã hủy
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-primary" name="btnUpdate">Update</button>
                                                <a href="../../layout/slidebar/slidebar.php?page_layout=orders" class="btn btn-secondary">Back</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4 mt-5">
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <h1 class="h3 text-gray-900">Chi tiết đơn hàng</h1>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Sản phẩm</th>
                                                    <th>Giá</th>
                                                    <th>Số lượng</th>
                                                    <th>Tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $sql = "SELECT *, products.name AS pname, order_details.price_product AS oprice 
                                                    FROM products, order_details 
                                                    where products.id=order_details.product_id and order_id=$id";
                                                    
                                                    $res = mysqli_query($con, $sql);
                                                    $stt = 0;
                                                    $tongtien = 0;
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                    $tongtien += $row['quantity'] * $row['oprice'];
                                                ?>
                                                    <tr>
                                                        <td><?= ++$stt ?></td>
                                                        <td><?= $row['pname'] ?></td>
                                                        <td><?= number_format($row['oprice'], 0, '', '.') . " VNĐ" ?></td>
                                                        <td><?= $row['quantity'] ?></td>
                                                        <td><?= number_format($row['total'], 0, '', '.') . " VNĐ" ?></td>
                                                    </tr>
                                                    <?php
                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                                <td colspan="4" class="text-right"><strong>Tổng tiền:</strong></td>
                                                <td><strong><?= number_format($tongtien, 0, '', '.') . " VNĐ" ?></strong></td>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
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
<?php
$con->close();
?>