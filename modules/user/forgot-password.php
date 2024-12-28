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
    <form method="POST" action="forgot-password.php">
        <?php
        $url = "localhost";
        $uname = "root";
        $upass = "";
        $dbname = "manager_user";
        
        $conn = new mysqli($url, $uname, $upass, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['phone'])) {
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
        
            // Kiểm tra email và số điện thoại trong cơ sở dữ liệu
            $query = $conn->prepare("SELECT id FROM user WHERE email = ? AND phone = ?");
            $query->bind_param("ss", $email, $phone);
            $query->execute();
            $result = $query->get_result();
        
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $userId = $user['id'];
        
              
        
                // Gửi thông báo
                echo "<script>alert('Đã xạc nhân email và số điện thoại thành công !'); location.href='reset-password.php?';</script>";
                
                echo "<script>alert('Xác thục mật khẩu không đúng !');</script>";
            }
        }

        ?>
        <h3 class="text-uppercase text-center mb-5"><b>forgot password</b></h3>


        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Your email </label>
            <input type="email" id="form2Example1" class="form-control" name="email" />

        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Your phone number</label>
            <input type="text" id="form2Example1" class="form-control" name="phone" />

        </div>


        <!-- Submit button -->
         <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Xác
            nhận</button> 


    </form>

</body>

</html>