<?php
include_once "../../config.php";
include_once "../../layout/slidebar/slidebar.php";

$result = $con->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <h1 class="card-title">Danh sách người dùng</h1>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Mật khẩu</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Vai trò</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['fullname'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['password'] ?></td>
                                    <td><span class='badge <?= $row['status'] == 'active' ? 'bg-success' : 'bg-danger' ?>'><?= $row['status'] ?></span></td>
                                    <td><?= $row['create_at'] ?></td>
                                    <td><?= $row['update_at'] ?></td>
                                    <td><?= $row['role'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['role'] == "admin") {
                                        ?>
                                            <a class="btn btn-success" href='../../modules/manager_user/edit.php?id=<?= $row['id'] ?>&lenh=down' onclick='return confirm("Bạn có chắc chắn muốn cho người dùng này thành khách hàng?")'>Hạ xuống khách hàng</a>
                                        <?php
                                        } else {
                                        ?>
                                            <a class="btn btn-primary" href='../../modules/manager_user/edit.php?id=<?= $row['id'] ?>&lenh=up' onclick='return confirm("Bạn có chắc chắn muốn nâng cấp người dùng này?")'>Nâng cấp lên admin</a>
                                        <?php
                                        }
                                        ?>
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
