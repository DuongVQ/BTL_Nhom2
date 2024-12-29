<?php
session_start(); // Khởi động session

include_once "../../config.php";

$query = $_GET['query'] ?? '';
$products = [];

// Nếu có truy vấn tìm kiếm
if ($query !== '') {
    
    unset($_SESSION['sptk']); 

    // Lưu trữ kết quả tìm kiếm mới vào session
    $queryParam = "%" . strtolower($query) . "%"; 
    $sql = "SELECT * FROM products WHERE LOWER(name) LIKE ?"; 

    $stmt = $con->prepare($sql);


    if ($stmt === false) {
        die("Lỗi chuẩn bị truy vấn: " . $con->error);
    }

    $stmt->bind_param("s", $queryParam);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }


    $_SESSION['sptk'] = $products;

    
    $stmt->close();
}


$con->close();


header("Location: viewSearch.php");
exit;
?>
