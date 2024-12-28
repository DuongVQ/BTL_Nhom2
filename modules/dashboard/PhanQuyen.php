<?php
session_start();
include_once "../../config.php";

$email = $_POST['email'];
$password = $_POST['password'];

// Lưu User_id vào session - NHD
$sqlUser = "SELECT * FROM user WHERE `email`='$email' ";
$resultUser = mysqli_query($con, $sqlUser);
if(mysqli_num_rows($resultUser) > 0){
    $arrUser = mysqli_fetch_array($resultUser);
    if($arrUser["email"]){
        $_SESSION["user_id"] = $arrUser["id"];
    }
}

// Truy vấn kiểm tra email và mật khẩu
$sql = "SELECT * FROM user WHERE email = ? AND password = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['login'] = $row['id'];
    $_SESSION['role'] = $row['role'];

    // Điều hướng dựa trên vai trò
    if ($row['role'] == 'admin') {
        header("Location:../../layout/slidebar/slidebar.php");
    } else {
        header("Location:home.php");
    }
    exit;
} else {
    // Hiển thị thông báo lỗi nếu email hoặc mật khẩu sai
    $_SESSION['error'] = "Email hoặc mật khẩu không đúng!";
    header("Location:login.php"); // Điều hướng về trang đăng nhập
    exit;
}

$con->close();
?>

