<?php
session_start();
include_once "../../config.php";

$con = new mysqli($url, $uname, $upass, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$id = $_GET['id'];

if ($con->query("DELETE FROM user WHERE id='$id'") === TRUE) {
    $_SESSION['message'] = "Category deleted successfully!";
} else {
    $_SESSION['message'] = "Error deleting category: " . $con->error;
}

$con->close();

header("Location:list.php");
exit();
?>