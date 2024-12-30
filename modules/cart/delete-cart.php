<?php
include '../../config.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the cart item ID
    $cartItemId = $_POST['cart_item_id'];

    // Delete the cart item
    $stmt = $con->prepare("DELETE FROM cart WHERE id = ?");
    $stmt->bind_param('i', $cartItemId);
    $stmt->execute();

    // Redirect back to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>