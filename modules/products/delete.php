<?php
session_start();
include_once "../../config.php";

$product_id = $_GET['id'];

// Delete product images
$con->query("DELETE FROM product_images WHERE product_id = $product_id");

// Delete product colors
$con->query("DELETE FROM product_colors WHERE product_id = $product_id");

// Delete product sizes
$con->query("DELETE FROM product_sizes WHERE product_id = $product_id");

// Delete product
$con->query("DELETE FROM products WHERE id = $product_id");

$_SESSION['message'] = "Product deleted successfully!";
header("Location:../../layout/slidebar/slidebar.php?page_layout=products");
exit();

$con->close();
?>