<?php
session_start();
include_once "../../config.php";

$id = $_GET['id'];

if ($con->query("DELETE FROM categories WHERE id='$id'") === TRUE) {
    $_SESSION['message'] = "Category deleted successfully!";
} else {
    $_SESSION['message'] = "Error deleting category: " . $con->error;
}

$con->close();

header("Location: list.php");
exit();
?>