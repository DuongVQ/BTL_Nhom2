<?php
include_once "../../config.php";
include_once "../../layout/slidebar/slidebar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách danh mục</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <h1>Danh sách danh mục</h1>
                    <a href="../../layout/slidebar/slidebar.php?page_layout=addcategory" class="btn btn-success mb-3">Thêm danh mục</a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên danh mục</th>
                                <th>Hình ảnh</th>
                                <th>Mô tả</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Lấy danh sách danh mục từ database
                            $result = $con->query("SELECT * FROM categories");
                            $count = 0;
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $count++;
                            ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><img src="<?= $row['image'] ?>" width="100"></td>
                                        <td><?= $row['description'] ?></td>
                                        <td>
                                            <a href='../../layout/slidebar/slidebar.php?page_layout=editcategory&id=<?= $row['id'] ?>' class='btn btn-primary'>Sửa</a>
                                            <a href='../../modules/category/delete.php?id=<?= $row['id'] ?>' class='btn btn-danger' onclick='return confirm("Are you sure you want to delete this category?")'>Xóa</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No categories found.</td></tr>";
                            }

                            $con->close();
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
