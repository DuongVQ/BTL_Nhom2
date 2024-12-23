<?php
session_start();
include_once "../../config.php";

$con = new mysqli($url, $uname, $upass, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con->query("SELECT p.*, c.name as category_name FROM products p JOIN categories c ON p.category = c.id");
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
    <h2>Product List</h2>
    <a href="/BTL_Nhom2/modules/products/add.php" class="btn btn-success mb-3">Add Product</a>
    <?php
    if ($result->num_rows > 0) {
        echo "<table class='table'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Old Price</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>";
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $count++;
            // Fetch the main image for the product
            $image_result = $con->query("SELECT image_url FROM product_images WHERE product_id = " . $row['id'] . " LIMIT 1");
            $image_row = $image_result->fetch_assoc();
            $image_url = $image_row ? $image_row['image_url'] : 'no_image.png'; // Default image if none found

            echo "<tr>
                        <td>" . $count . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['code'] . "</td>
                        <td>" . $row['category_name'] . "</td>
                        <td>" . $row['price'] . "</td>
                        <td>" . $row['old_price'] . "</td>
                        <td>" . $row['discount'] . "%</td>
                        <td>" . $row['status'] . "</td>
                        <td><img src='" . $image_url . "' width='100'></td>
                        <td>
                            <a href='/BTL_Nhom2/modules/products/edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                            <a href='/BTL_Nhom2/modules/products/delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
                        </td>
                      </tr>";
        }
        echo "</table>";
    } else {
        echo "No products found.";
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