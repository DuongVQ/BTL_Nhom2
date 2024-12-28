<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infor User</title>
</head>
<body>
    <?php
        include "../../layout/header/header.php";
        include "../../config.php";
        if(isset($_SESSION["user_id"])){
            $userId = $_SESSION["user_id"];
            $sql = "SELECT * FROM user WHERE `id`='$userId' ";
            $inforUser = mysqli_query($con, $sql);
            $fullname = "x";
            $email = "";
            $phone = "";
            $password = "";
            if(mysqli_num_rows($inforUser) > 0){
                $arrInforUser = mysqli_fetch_array($inforUser);
                $fullname = $arrInforUser['fullname'];
                $email = $arrInforUser['email'];
                $phone = $arrInforUser['phone'];
                $password = $arrInforUser['password'];
            }
        }
    ?>
    <div class="wrapper_infor_user">
        <div class="container">
            <h4 class="title_notf mb-3">Tài khoản của bạn</h4>
            <form action="editInforUser.php?userId=<?= trim($userId) ?>" method="POST">
                <div class="form-group mb-3">
                    <label for="fullname">Fullname</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" value= "<?= trim($fullname) ?>">
                </div>
                <div class="form-group mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" value= "<?= trim($email) ?>" aria-describedby="emailHelp">
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Phone number</label>
                    <input type="text" class="form-control" name="phone" id="phone" value= "<?= trim($phone) ?>">
                </div>
                <div class="form-group mb-3 mt-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" value= "<?= trim($password) ?>">
                </div>
                <div class="submit_infor_user">
                    <button type="submit" class="btn btn_submit btn-primary mb-4">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <?php
        include "../../layout/footer/footer.php";
    ?>
</body>
</html>