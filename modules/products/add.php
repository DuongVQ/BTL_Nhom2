<?php
include_once "../../config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        if (!empty($image_name)) {
            $folder = "../../image/";
            $filename = basename($image_name);
            $path = $folder . $filename;

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $path)) {
                $con->query("INSERT INTO product_images (product_id, image_url) VALUES ('$product_id', '$path')");
            }
        }
    }

    // Xử lý màu sắc (dữ liệu là chuỗi)
    $colors = explode(',', $_POST['colors']); // Tách các màu bằng dấu phẩy
    foreach ($colors as $color) {
        $color = trim($color); // Loại bỏ khoảng trắng thừa
        if (!empty($color)) {
            $con->query("INSERT INTO product_colors (product_id, color_name) VALUES ('$product_id', '$color')");
        }
    }

    // Xử lý kích thước (dữ liệu là chuỗi)
    $sizes = explode(',', $_POST['sizes']); // Tách các kích thước bằng dấu phẩy
    foreach ($sizes as $size) {
        $size = trim($size); // Loại bỏ khoảng trắng thừa
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
</head>
<body>
    <div class="container">
        <h2>Add Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="old_price" class="form-label">Old Price</label>
                <input type="number" class="form-control" id="old_price" name="old_price">
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
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
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Còn hàng">Còn hàng</option>
                    <option value="Hết hàng">Hết hàng</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
            </div>
            <div class="mb-3">
                <label for="colors" class="form-label">Colors</label>
                <input type="text" class="form-control" id="colors" name="colors" placeholder="Enter colors separated by commas">
            </div>
            <div class="mb-3">
                <label for="sizes" class="form-label">Sizes</label>
                <input type="text" class="form-control" id="sizes" name="sizes" placeholder="Enter sizes separated by commas">
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
            <a href="../../layout/slidebar/slidebar.php?page_layout=products" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>