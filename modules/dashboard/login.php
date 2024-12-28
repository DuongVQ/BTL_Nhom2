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
      height: 100vh;
      margin: 0;
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
        url('../../uploads/other/background-login.jpg') no-repeat center/cover;
    }

    form {
      width: 100%;
      max-width: 400px;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    input {
      /* border: none !important;
      border-bottom: 1px solid #ddd !important;
      background-color: transparent !important; */
      outline: none !important;
      box-shadow: none !important;
      border-radius: 0 !important;
    }
  </style>
</head>

<body>
  <form action="PhanQuyen.php" method="post">
    <h3 class="text-center mb-4">Đăng nhập</h3>
    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
      <input type="email" id="form2Example1" class="form-control" name="email" placeholder="Nhập địa chỉ email" />
    </div>

    <!-- Password input -->
    <div data-mdb-input-init class="form-outline mb-4">
      <input type="password" id="form2Example2" class="form-control" name="password" placeholder="Nhập mật khẩu" />
    </div>
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
      echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
      unset($_SESSION['error']); // Xóa thông báo lỗi sau khi hiển thị
    }
    ?>
    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
      <div class="col d-flex justify-content-center">
        <!-- Checkbox -->
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
          <label class="form-check-label" for="form2Example31"> Remember me </label>
        </div>
      </div>

      <div class="col">
        <!-- Simple link -->
        <a href="#!">Forgot password?</a>
      </div>
    </div>

    <!-- Submit button -->
    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4 w-100">Đăng nhập</button>

    <!-- Register buttons -->
    <div class="text-center">
      <p>Not a member? <a href="/BTL_Nhom2/modules/user/register.php">Register</a></p>
      <p>or sign up with:</p>
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