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
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <table class='table'>
        <tr>
            <td>ID</td>
            <td>Họ Tên</td>
            <td>Email</td>
            <td>Số điện thoại</td>
            <td>Mật khẩu</td>
            <td>Forgot Token</td>
            <td>Active Token</td>
            <td>Trạng thái</td>
            <td>Create At</td>
            <td>Update At</td>
            <td>Role</td>
            <td>Thao tác</td>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['password'] ?></td>
                <td><?= $row['forgotToken'] ?></td>
                <td><?= $row['activeToken'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['create_at'] ?></td>
                <td><?= $row['update_at'] ?></td>
                <td><?= $row['role'] ?></td>
                <?php
                if ($row['role'] == "admin") {
                ?>
                    <td></td>
                <?php
                } else {
                ?>
                    <td><a class='btn btn-danger' href='../../modules/manager_user/delete.php?id=<?= $row['id'] ?>&lenh=close' onclick='return confirm("Bạn có chắc chắn muốn xóa người dùng này?")'>Xóa</a></td>
                <?php
                }
                ?>

            </tr>
        <?php
        }
        $con->close();
        ?>
    </table>
</body>

</html>