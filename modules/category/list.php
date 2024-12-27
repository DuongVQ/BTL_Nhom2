<?php
if (!isset($_SESSION['role'])) {
    header("Location:../../modules/dashboard/home.php");
    exit;
}
include_once "../../config.php";
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
    <h1>Danh sách danh mục</h1>
    <a href="../../modules/category/add.php" class="btn btn-success">Thêm danh mục</a>
    <?php
    $result = $con->query("SELECT * FROM categories");
    $count = 0;
    if ($result->num_rows > 0) {
        echo "<table class='table'>
            <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Hình ảnh</th>
                <th>Mô tả</th>
                <th>Thao tác</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            $count++;
            echo "<tr>
                <td>" . $count . "</td>
                <td>" . $row['name'] . "</td>
                <td><img src='" . $row['image'] . "' width='100'></td>
                <td>" . $row['description'] . "</td>
                <td>
                    <a href='../../modules/category/edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Sửa</a>
                    <a href='../../modules/category/delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Xóa</a>
                </td>
              </tr>";
        }
        echo "</table>";
    } else {
        echo "No categories found.";
    }

    $con->close();
    ?>
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