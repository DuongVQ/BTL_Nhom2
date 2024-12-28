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

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('../../uploads/other/background-login.jpg') no-repeat center/cover;
        }

        form {
            width: 500px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: auto;
        }
    </style>
</head>

<body>
    <form method="POST" action="forgot-password.php" style="width: 500px;">
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
        <h3 class="text-uppercase text-center mb-4"><b>Quên mật khẩu</b></h3>


        </div>
        <div data-mdb-input-init class="form-outline mb-4">
            <input type="email" id="form2Example1" class="form-control border-0 border-bottom rounded-0 bg-transparent" style="box-shadow: none;" name="email" placeholder="Nhập email của bạn" />
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="form2Example1" class="form-control border-0 border-bottom rounded-0 bg-transparent" style="box-shadow: none;" name="phone" placeholder="Nhập số điện thoại" />
        </div>


        <!-- Submit button -->
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark w-100 btn-block mb-4">Xác
            nhận</button>


    </form>

</body>

</html>