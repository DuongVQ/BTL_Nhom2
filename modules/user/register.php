<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Centered Form</title>

  <!-- Link font-family -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <!-- Link fontawesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Link bootstrap -->
  <link rel="stylesheet" href="../../templates/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <!-- Link Boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js" integrity="sha512-Dm5UxqUSgNd93XG7eseoOrScyM1BVs65GrwmavP0D0DujOA8mjiBfyj71wmI2VQZKnnZQsSWWsxDKNiQIqk8sQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: auto;
      margin: 0;
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
        url('../../uploads/other/background-login.jpg') no-repeat center/cover;
    }

    form {
      width: 500px;
      padding: 20px;
      margin-top: 50px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      height: auto;
    }
  </style>
</head>

<body>

  <form action="register.php" method="post" style="width: 500px;">
    <?php
    include_once '../../config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $fullname = htmlspecialchars(trim($_POST['fullname']));
      $email = htmlspecialchars(trim($_POST['email']));
      $phone = htmlspecialchars(trim($_POST['phone']));
      $password = htmlspecialchars(trim($_POST['password']));
      $confirm_password = htmlspecialchars(trim($_POST['repeatPass']));
      $role = "customer"; // Default role
      $status = 1;
      $create_at = date('Y-m-d H:i:s');
      $update_at = date('Y-m-d H:i:s');

      // Validate input fields
      if (empty($fullname) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('Bạn cần nhập đủ thông tin !');</script>";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Định dạng email không đúng !');</script>";
      } elseif ($password !== $confirm_password) {
        echo "<script>alert('Xác thục mật khẩu không đúng !');</script>";
      } else {
        // Check if email already exists
        $check_email = $con->prepare("SELECT id FROM user WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $check_email->store_result();

        if ($check_email->num_rows > 0) {
          echo "<script>alert('Email đã tồn tại');</script>";
        } else {
          // Insert the plain password into the database
          $stmt = $con->prepare("INSERT INTO user (fullname, email, phone, password, status, create_at, update_at, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("ssssisss", $fullname, $email, $phone, $password, $status, $create_at, $update_at, $role);

          if ($stmt->execute()) {
            echo "<script>alert('Bạn đã tạo tài khoản thành công'); window.location.href = '../../modules/dashboard/home.php';</script>";
          } else {
            echo "<script>alert('Error occurred: " . $stmt->error . "');</script>";
          }

          $stmt->close();
        }
      }
    }
    ?>



    <!-- Email input -->
    <h3 class="text-uppercase text-center mb-3"><b>Đăng ký</b></h3>
    <div data-mdb-input-init class="form-outline mb-4">
      <input type="text" id="form2Example1" class="form-control border-0 border-bottom bg-transparent rounded-0" style="box-shadow:none;" name="fullname" placeholder="Nhập tên của bạn" />
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
      <input type="email" id="form2Example1" class="form-control border-0 border-bottom bg-transparent rounded-0" style="box-shadow:none;" name="email" placeholder="Nhập email của bạn" />
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
      <input type="text" id="form2Example1" class="form-control border-0 border-bottom bg-transparent rounded-0" style="box-shadow:none;" name="phone" placeholder="Nhập số điện thoại của bạn" />
    </div>

    <!-- Password input -->
    <div data-mdb-input-init class="form-outline mb-4">
      <input type="password" id="form2Example2" class="form-control border-0 border-bottom bg-transparent rounded-0" style="box-shadow:none;" name="password" placeholder="Nhập mật khẩu" />
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
      <input type="password" id="form2Example2" class="form-control border-0 border-bottom bg-transparent rounded-0" style="box-shadow:none;" name="repeatPass" placeholder="Nhập lại mật khẩu" />
    </div>

    <!-- Submit button -->
    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-block mb-4 w-100">Đăng ký</button>

    <!-- Register buttons -->
    <div class="text-center">
      <p>Have already an account?<a href="/BTL_Nhom2/modules/dashboard/login.php">Login</a></p>
      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
        <i class="fab fa-facebook-f"></i>
      </button>

      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
        <i class="fab fa-google"></i>
      </button>

      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
        <i class="fab fa-twitter"></i>
      </button>

      <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
        <i class="fab fa-github"></i>
      </button>
    </div>
  </form>
</body>

</html>
<?php

?>