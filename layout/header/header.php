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
    <!-- Link css -->
    <link rel="stylesheet" href="../../templates/css/header.css">
    <link rel="stylesheet" href="../../templates/css/home.css">
    <link rel="stylesheet" href="../../templates/css/footer.css">
</head>

<body>
    <div class="header w-100">
        <div class="header-wrapper">
            <!-- logo -->
            <div class="logo">
                <a href="#">
                    <img itemprop="logo" src="//theme.hstatic.net/200000690725/1001078549/14/logo.png?v=603" alt="Torano" class="img-responsive logoimg ls-is-cached lazyloaded" width="180">
                </a>
            </div>

            <!-- menu header -->
            <div class="menu-header">
                <a href="#" class="item-menu-header">New product</a>
                <a href="#" class="item-menu-header">Sale</a>
                <a href="#" class="item-menu-header secondary">
                    men's shirts
                    <div class="menu-header-secondary">
                        <div class="item-menu-header-secondary">blazer</div>
                        <div class="item-menu-header-secondary">jacket</div>
                        <div class="item-menu-header-secondary">polo</div>
                        <div class="item-menu-header-secondary">shirt</div>
                        <div class="item-menu-header-secondary">t-shirt</div>
                        <div class="item-menu-header-secondary">sweater</div>
                    </div>
                </a>
                <a href="#" class="item-menu-header secondary">
                    men's pants
                    <div class="menu-header-secondary">
                        <div class="item-menu-header-secondary">jeans</div>
                        <div class="item-menu-header-secondary">kakis</div>
                        <div class="item-menu-header-secondary">shorts</div>
                        <div class="item-menu-header-secondary">trousers</div>
                    </div>
                </a>
                <a href="#" class="item-menu-header">Collection</a>
                <a href="?module=home&action=about-us" class="item-menu-header">About us</a>
            </div>

            <!-- header action -->
            <div class="header-action">
                <div class="header-search">
                    <a href="#">
                        <button class="header-action-btn">
                            <box-icon name='search'></box-icon>
                        </button>
                    </a>
                </div>
                <div class="header-user">
                    <a href="#">
                        <button class="header-action-btn">
                            <box-icon name='user'></box-icon>
                        </button>
                    </a>
                </div>
                <div class="header-cart">
                    <button class="header-action-btn" data-bs-toggle="offcanvas" data-bs-target="#demo">
                        <box-icon name='shopping-bag'></box-icon>
                    </button>

                    <!-- Offcanvas Sidebar -->
                    <div class="offcanvas offcanvas-end" id="demo">
                        <div class="offcanvas-header border-bottom">
                            <h5 class="offcanvas-title">Giỏ hàng</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" style="font-size: 16px;"></button>
                        </div>
                        <div class="offcanvas-body">
                            <!-- Content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>