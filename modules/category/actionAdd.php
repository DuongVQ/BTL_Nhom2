<?php
session_start();
include_once "../../config.php"; 

// Get data from the form
$name = $_POST['name'];
$description = $_POST['description'];

// Upload image
$folder = "../../image/"; 
$filename = basename($_FILES['image']['name']);
$path = $folder . $filename;

// Check if the folder already exists
if (!file_exists($folder)) {
    mkdir($folder, 0777, true);
}

// Check if the file already exists
if (!file_exists($path)) {
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
}

// Check if the category name already exists
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