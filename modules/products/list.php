<?php
include_once "../../config.php";
include_once "../../layout/slidebar/slidebar.php";

// Fetch all products
$result = $con->query("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category = c.id ORDER BY p.id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <h1>Danh sách sản phẩm</h1>
                    <a href="../../layout/slidebar/slidebar.php?page_layout=addproduct" class="btn btn-success mb-3">Thêm sản phẩm</a>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Mã sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Hình ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                $count = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $count++;
                                    // Fetch the main image for the product
                                    $image_result = $con->query("SELECT image_url FROM product_images WHERE product_id = " . $row['id'] . " LIMIT 1");
                                    $image_row = $image_result->fetch_assoc();
                                    $image_url = $image_row ? $image_row['image_url'] : 'no_image.png'; // Default image if none found
                            ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['code'] ?></td>
                                        <td><?= $row['category_name'] ?></td>
                                        <td><?= number_format($row['price'], 0, ',', '.') ?> VND</td>
                                        <td><?= $row['status'] ?></td>
                                        <td><img src="<?= $image_url ?>" width="100"></td>
                                        <td>
                                            <a href="../../layout/slidebar/slidebar.php?page_layout=editproducts&id=<?= $row['id'] ?>" class="btn btn-primary">Sửa</a>
                                            <a href="../../modules/products/delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Xóa</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='10' class='text-center'>No products found.</td></tr>";
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
