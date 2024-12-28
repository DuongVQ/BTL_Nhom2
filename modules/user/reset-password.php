<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Link font-family -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
         rel="stylesheet">
     <!-- Link fontawesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
         integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
         crossorigin="anonymous" referrerpolicy="no-referrer" />
     <!-- Link bootstrap -->
     <link rel="stylesheet" href="../../templates/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
     <!-- Link Boxicons -->
     <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js"
         integrity="sha512-Dm5UxqUSgNd93XG7eseoOrScyM1BVs65GrwmavP0D0DujOA8mjiBfyj71wmI2VQZKnnZQsSWWsxDKNiQIqk8sQ=="
         crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <form action="reset-password.php" method="post">
        <?php
        $url = "localhost";
        $uname = "root";
        $upass = "";
        $dbname = "manager_user";
        
        $conn = new mysqli($url, $uname, $upass, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = trim($_POST['password']); 
            $confirm_password = trim($_POST['confirm_password']);
            $email = trim($_POST['email']);
            
        
            if ($password == $confirm_password) {
                
                
        
                // Cập nhật mật khẩu
                $updatePassword = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
                $updatePassword->bind_param("ss", $password, $email);
                $updatePassword->execute();
                if($updatePassword->execute()) {
                    echo "<script>alert('Mật khẩu của bạn đã được đặt lại thành công!'); window.location.href = '../../modules/dashboard/login.php';</script>";
            } 
            }else {
                echo "<script>alert('Xác nhập mật khẩu không giống nhau !');</script>";
        } 
    }    
        ?>
        <h3 class="text-uppercase text-center mb-5"><b>Reset password</b></h3>


        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Nhập lại email </label>
            <input type="email" id="form2Example1" class="form-control" name="email" />

        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Nhập mật khẩu mới </label>
            <input type="password" id="form2Example1" class="form-control" name="password" />

        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Nhập lại mật khẩu vừa nhập:</label>
            <input type="password" id="form2Example1" class="form-control" name="confirm_password" />

        </div>


        <!-- Submit button -->
         <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Đặt lại mật khẩu.</button> 
    </form>
</body>
</html>