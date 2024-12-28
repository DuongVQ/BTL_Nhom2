<?php
session_start();
include_once "../../config.php"; 

$name = $_POST['name'];
$description = $_POST['description'];

$folder = "../../image/"; 
$filename = basename($_FILES['image']['name']);
$path = $folder . $filename;

if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

if (!file_exists($path)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
}

if (isset($con)) {
    $con->query("INSERT INTO categories (name, image, description) VALUES('$name', '$path', '$description')");
    $con->close();
    $_SESSION['message'] = "Category added successfully!";
} else {
    die("Database connection failed.");
}

header("Location:../../layout/slidebar/slidebar.php?page_layout=category");
exit();
?>