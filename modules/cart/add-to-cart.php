<?php
session_start();
include_once "../../config.php";

$product_id = $_POST['product_id'];
$product_name = $_POST['product_name'];
$price = $_POST['price'];
$old_price = $_POST['old_price'];
$image_url = $_POST['image_url'];
$color = $_POST['color'];
$size_product = $_POST['size_product'];
$quantity = $_POST['quantity'];

// Kiểm tra xem product_id có tồn tại trong bảng products không
$product_check_query = "SELECT id FROM products WHERE id = '$product_id'";
$product_check_result = $con->query($product_check_query);

if ($product_check_result->num_rows > 0) {
    $query = "INSERT INTO cart (product_id, product_name, price, old_price, image_url, color, size_product, quantity) VALUES ('$product_id', '$product_name', '$price', '$old_price', '$image_url', '$color', '$size_product', '$quantity')";

    if ($con->query($query) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $con->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid product_id']);
}

$con->close();
header("Location: ../dashboard/home.php");
?>