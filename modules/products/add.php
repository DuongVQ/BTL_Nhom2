<?php
include_once "../../config.php";

// Kiểm tra quyền
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $code = $_POST['code'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $discount = $_POST['discount'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];

    // Insert sản phẩm
    $con->query("INSERT INTO products (name, code, description, price, old_price, discount, category, status) VALUES ('$name', '$code', '$description', '$price', '$old_price', '$discount', '$category_id', '$status')");
    $product_id = $con->insert_id;

    // Xử lý tải lên hình ảnh
    foreach ($_FILES['images']['name'] as $key => $image_name) {
        // Nếu có hình ảnh được chọn
        if (!empty($image_name)) {
            $folder = "../../image/";
            $filename = basename($image_name);
            $path = $folder . $filename;

            // Kiểm tra xem thư mục chứa hình ảnh đã tồn tại chưa, nếu chưa thì tạo mới
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            // Di chuyển hình ảnh vào thư mục
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $path)) {
                $con->query("INSERT INTO product_images (product_id, image_url) VALUES ('$product_id', '$path')");
            }
        }
    }

    // Xử lý màu sắc (vì dữ liệu được đưa vào đang ở dạng chuỗi)
    $colors = explode(',', $_POST['colors']); // Tách các màu bằng dấu phẩy
    foreach ($colors as $color) {
        $color = trim($color); 
        if (!empty($color)) {
            $con->query("INSERT INTO product_colors (product_id, color_name) VALUES ('$product_id', '$color')");
        }
    }

    // Xử lý kích thước (vì dữ liệu được đưa vào đang ở dạng chuỗi)
    $sizes = explode(',', $_POST['sizes']); // Tách các kích thước bằng dấu phẩy
    foreach ($sizes as $size) {
        $size = trim($size); 
        if (!empty($size)) {
            $con->query("INSERT INTO product_sizes (product_id, size_name) VALUES ('$product_id', '$size')");
        }
    }

    $_SESSION['message'] = "Product added successfully!";
    header("Location:../../layout/slidebar/slidebar.php?page_layout=products");
    exit();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h1 class="card-title">Thêm Sản Phẩm</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Sản Phẩm</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="code" class="form-label">Mã Sản Phẩm</label>
                        <input type="text" name="code" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="old_price" class="form-label">Giá Cũ</label>
                        <input type="number" name="old_price" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">Giảm Giá (%)</label>
                        <input type="number" name="discount" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh Mục</label>
                        <select name="category_id" class="form-control" required>
                            <?php
                            // Fetch categories from the database
                            $con = new mysqli($url, $uname, $upass, $dbname);
                            $result = $con->query("SELECT * FROM categories");
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                            }
                            $con->close();
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng Thái</label>
                        <select name="status" class="form-control" required>
                            <option value="Còn hàng">Còn hàng</option>
                            <option value="Hết hàng">Hết hàng</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">Hình Ảnh</label>
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>

                    <div class="mb-3">
                        <label for="colors" class="form-label">Màu Sắc</label>
                        <input type="text" name="colors" class="form-control" placeholder="Nhập màu sắc cách nhau bằng dấu phẩy">
                    </div>

                    <div class="mb-3">
                        <label for="sizes" class="form-label">Kích Thước</label>
                        <input type="text" name="sizes" class="form-control" placeholder="Nhập kích thước cách nhau bằng dấu phẩy">
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="../../layout/slidebar/slidebar.php?page_layout=products" class="btn btn-secondary">Quay lại</a>
                </form>
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