<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location:../../modules/dashboard/home.php");
    exit;
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Link font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link bootstrap -->
    <link rel="stylesheet" href="../../templates/css/bootstrap.min.css">
    <!-- Link swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Link Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js" integrity="sha512-Dm5UxqUSgNd93XG7eseoOrScyM1BVs65GrwmavP0D0DujOA8mjiBfyj71wmI2VQZKnnZQsSWWsxDKNiQIqk8sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
    .slidebar {
        background-color: #383A3C;
        box-shadow: 0 0 10px #00000036;
    }
    ul {
        margin: 0;
        padding: 0;
    }
    ul li {
        padding: 15px 0px;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    ul li::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%; 
        width: 100%;
        height: 100%;
        background: linear-gradient(to right, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
        transition: left 0.3s ease-in-out; 
    }
    ul li:hover::before {
        left: 0; 
    }
    ul li:hover {
        background-color: transparent; 
    }
    .list-unstyled a {
        color:rgb(197, 206, 215); 
        font-size: 18px;
        font-weight: 600;
        margin-left: 20px;
        text-decoration: none;
        position: relative; 
        z-index: 1;
        transition: color 0.3s ease-in-out; 
    }
    ul li:hover .list-unstyled a {
        color: white; 
    }
</style>
</head>
<body>
<div class="container-fluid d-flex">
    <div class="slidebar position-fixed top-0 start-0" style="width: 250px; height: 100vh; padding-top: 100px;">
        <ul>
            <li class="list-unstyled">
                <a href="?page_layout=user">
                    <i class="fa-solid fa-id-card"></i>
                    Quản lý người dùng
                </a>
            </li>
            <li class="list-unstyled">
                <a href="?page_layout=category">
                    <i class="fa-solid fa-tags"></i>
                    Quản lý danh mục
                </a>
            </li>
            <li class="list-unstyled">
                <a href="?page_layout=products">
                    <i class="fas fa-tshirt"></i>
                    Quản lý sản phẩm
                </a>
            </li>
            <li class="list-unstyled">
                <a href="?page_layout=orders">
                    <i class="	far fa-file-alt"></i>
                    Quản lý hóa đơn
                </a>
            </li>
            <li class="list-unstyled">
                <a href="?page_layout=logout">
                    <i class="fa fa-sign-out"></i>
                    Đăng xuất
                </a>
            </li>
            
        </ul>
    </div>
    <div class="right ms-auto" style="margin-left: 250px; padding: 20px; width: calc(100% - 250px);">
        <?php
        if (isset($_GET['page_layout'])) {
            switch ($_GET['page_layout']) {
                case 'user';
                    include_once('../../modules/manager_user/list.php');
                    break;

                case 'category';
                    include_once('../../modules/category/list.php');
                    break;

                case 'products';
                    include_once('../../modules/products/list.php');
                    break;
                case 'orders';
                    include_once('../../modules/orders/list.php');
                    break;
                case 'logout';
                    unset($_SESSION['role']);
                    header("Location:../../modules/dashboard/home.php");
                    break;       
            }
        }
        ?>
    </div>
</div>

<style>
    .right{    
        display: block;
    }
</style>
</body>
</html>




