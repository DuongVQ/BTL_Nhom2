
<?php
session_start();
// Kiểm tra đăng xuất
if (isset($_GET['page_layout']) && $_GET['page_layout'] === 'logout') {
    unset($_SESSION['login']);
    header("Location: ../../modules/dashboard/home.php");
    exit;
}
// Kiểm tra đăng nhập
if (!isset($_SESSION['login'])) {
    header("Location:../../modules/dashboard/home.php");
    exit;
}

?>
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Link font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" />

    <!-- Link bootstrap -->
    <link rel="stylesheet" href="../../templates/css/bootstrap.min.css">

    <!-- Link swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Link Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div style="display:flex">
        <!-- Sidebar -->
        <div class="d-flex flex-column bg-dark text-light vh-100 position-fixed" style="width: 250px;">
            <div class="pt-4 text-center">
                <h4 class="text-uppercase">Admin</h4>
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a class="nav-link text-light" href="?page_layout=thongKe">
                        <i class="fa-solid fa-chart-column me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="?page_layout=user">
                        <i class="fa-solid fa-id-card me-2"></i> Quản lý người dùng
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="?page_layout=category">
                        <i class="fa-solid fa-tags me-2"></i> Quản lý danh mục
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="?page_layout=products">
                        <i class="fas fa-tshirt me-2"></i> Quản lý sản phẩm
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="?page_layout=orders">
                        <i class="far fa-file-alt me-2"></i> Quản lý hóa đơn
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="?page_layout=logout">
                        <i class="fa fa-sign-out me-2"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="container-fluid" style="margin-left: 250px;">
            <div class="p-4">
                <?php
                if (isset($_GET['page_layout'])) {
                    switch ($_GET['page_layout']) {
                        case 'thongKe':
                            include_once('../../modules/thongKe/index.php');
                            break;
                        case 'user':
                            include_once('../../modules/manager_user/list.php');
                            break;
                        case 'category':
                            include_once('../../modules/category/list.php');
                            break;
                        case 'addcategory':
                            include_once('../../modules/category/add.php');
                            break;
                        case 'editcategory':
                            include_once('../../modules/category/edit.php');
                            break;;
                        case 'products':
                            include_once('../../modules/products/list.php');
                            break;
                        case 'addproduct':
                            include_once('../../modules/products/add.php');
                            break;
                        case 'editproducts':
                            include_once('../../modules/products/edit.php');
                            break;
                        case 'orders':
                            include_once('../../modules/orders/list.php');
                            break;
                        case 'vieworders':
                            include_once('../../modules/orders/view.php');
                            break;
                        case 'logout':
                            unset($_SESSION['login']);
                            header("Location:../../modules/dashboard/home.php");
                            break;
                    }

                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>