<?php
    include "../../config.php";
    $userId = $_GET['userId'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "UPDATE `user` SET `fullname` = '$fullname', `email` = '$email', `phone` = '$phone', `password` = '$password' WHERE `user`.`id` ='$userId'";
    $sqlEmailExits = "SELECT * FROM user WHERE `user`.id != '$userId'";
    $resultEmailExits = mysqli_query($con, $sqlEmailExits);
    if(mysqli_num_rows($resultEmailExits) > 0){
        while ($arrEmail = mysqli_fetch_array($resultEmailExits)) {
            if ($arrEmail['email'] == $email) {
                echo "<script>alert('Email này đã có người sử dụng, vui lòng nhập email khác!');</script>";
                echo "<script>window.location.href = 'inforUser.php';</script>";
                exit;
            }
        }
    }
    if($con->query($sql) == true){
        echo "<script> alert('Cập nhật thông tin thành công!'); </script>";
        echo "<script>window.location.href = 'inforUser.php';</script>";
        exit;
    }
?>