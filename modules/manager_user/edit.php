<?php
session_start();
include_once "../../config.php";

$con = new mysqli($url, $uname, $upass, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$id = $_GET['id'];
$lenh = $_GET['lenh'];
if($_GET['lenh'] == "up"){
    if ($con->query("UPDATE user SET role = 'admin' WHERE id='$id'") === TRUE) {
        $_SESSION['message'] = "Category deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting category: " . $con->error;
    }
}else{
    if ($con->query("UPDATE user SET role = 'customer' WHERE id='$id'") === TRUE) {
        $_SESSION['message'] = "Category deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting category: " . $con->error;
    }
}


$con->close();

header("Location:../../layout/slidebar/slidebar.php?page_layout=user");
exit();
?>