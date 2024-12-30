<?php
session_start();
include_once "../../config.php";

$product_id = $_GET['id'];

// Tìm sản phẩm theo id
$productResult = $con->query("SELECT * FROM products WHERE id = $product_id");
$product = $productResult->fetch_assoc();

// Tìm màu sắc sản phẩm
$colorResult = $con->query("SELECT color_name FROM product_colors WHERE product_id = $product_id");
$colors = [];
while ($colorRow = $colorResult->fetch_assoc()) {
    $colors[] = $colorRow['color_name'];
}

// Tìm kích thước sản phẩm
$sizeResult = $con->query("SELECT size_name FROM product_sizes WHERE product_id = $product_id");
$sizes = [];
while ($sizeRow = $sizeResult->fetch_assoc()) {
    $sizes[] = $sizeRow['size_name'];
}

// Tìm ảnh sản phẩm
$imageResult = $con->query("SELECT image_url FROM product_images WHERE product_id = $product_id LIMIT 1");
$imageRow = $imageResult->fetch_assoc();
$image = $imageRow ? $imageRow['image_url'] : 'no_image.png'; // Default image if none found

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin sản phẩm từ form
    $name = $_POST['name'];
    $code = $_POST['code'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $discount = $_POST['discount'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];

    // Handle image upload
    if (!empty($_FILES['images']['name'][0])) {
        $folder = "../../image/";
        $filename = basename($_FILES['images']['name'][0]);
        $path = $folder . $filename;

        // Delete old image
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // Upload new image
        if (move_uploaded_file($_FILES['images']['tmp_name'][0], $path)) {
            $image = $path;
            // Update image in the database
            $con->query("UPDATE product_images SET image_url='$image' WHERE product_id='$product_id'");
        }
    }

    // Update product
    $con->query("UPDATE products SET name='$name', code='$code', description='$description', price='$price', old_price='$old_price', discount='$discount', category='$category_id', status='$status' WHERE id='$product_id'");

    // Update colors
    $con->query("DELETE FROM product_colors WHERE product_id = $product_id");
    $colors = explode(',', $_POST['colors']);
    foreach ($colors as $color) {
        $color = trim($color); // Loại bỏ khoảng trắng thừa
        if (!empty($color)) {
            $con->query("INSERT INTO product_colors (product_id, color_name) VALUES ('$product_id', '$color')");
        }
    }

    // Update sizes
    $con->query("DELETE FROM product_sizes WHERE product_id = $product_id");
    $sizes = explode(',', $_POST['sizes']);
    foreach ($sizes as $size) {
        $size = trim($size); // Loại bỏ khoảng trắng thừa
        if (!empty($size)) {
            $con->query("INSERT INTO product_sizes (product_id, size_name) VALUES ('$product_id', '$size')");
        }
    }

    $_SESSION['message'] = "Product updated successfully!";
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
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" class="form-control" id="code" name="code" value="<?= htmlspecialchars($product['code']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="old_price" class="form-label">Old Price</label>
                <input type="number" class="form-control" id="old_price" name="old_price" value="<?= htmlspecialchars($product['old_price']) ?>">
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" value="<?= htmlspecialchars($product['discount']) ?>">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php
                    // Fetch categories from the database
                    $con = new mysqli($url, $uname, $upass, $dbname);
                    $result = $con->query("SELECT * FROM categories");
                    while ($row = $result->fetch_assoc()) {
                        $selected = $row['id'] == $product['category'] ? 'selected' : '';
                        echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
                    }
                    $con->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Còn hàng" <?= $product['status'] == 'Còn hàng' ? 'selected' : '' ?>>Còn hàng</option>
                    <option value="Hết hàng" <?= $product['status'] == 'Hết hàng' ? 'selected' : '' ?>>Hết hàng</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
                <img src="<?= htmlspecialchars($image) ?>" width="100" alt="Current Image">
            </div>
            <div class="mb-3">
                <label for="colors" class="form-label">Colors</label>
                <input type="text" class="form-control" id="colors" name="colors" value="<?= implode(', ', $colors) ?>" placeholder="Enter colors separated by commas">
            </div>
            <div class="mb-3">
                <label for="sizes" class="form-label">Sizes</label>
                <input type="text" class="form-control" id="sizes" name="sizes" value="<?= implode(', ', $sizes) ?>" placeholder="Enter sizes separated by commas">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="../../layout/slidebar/slidebar.php?page_layout=products" class="btn btn-secondary">Back</a>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
