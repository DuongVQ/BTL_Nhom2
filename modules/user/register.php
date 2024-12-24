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
            background-color: #f8f9fa;
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
    </style>
</head>
<body>

<form action="resiter.php" method ="post">
  <!-- Email input -->
  <h3 class="text-uppercase text-center mb-5">Create an account</h3>
  <div data-mdb-input-init class="form-outline mb-4">
  <label class="form-label" for="form2Example1">Your name</label>
  <input type="text" id="form2Example1" class="form-control" name ="fullname"/>

  </div>
  <div data-mdb-input-init class="form-outline mb-4">
  <label class="form-label" for="form2Example1">Your email </label>
  <input type="email" id="form2Example1" class="form-control" name ="email"/>

  </div>
  <div data-mdb-input-init class="form-outline mb-4">
  <label class="form-label" for="form2Example1">Phone number</label>
  <input type="text" id="form2Example1" class="form-control" name ="phone"/>

  </div>

  <!-- Password input -->
  <div data-mdb-input-init class="form-outline mb-4">
  <label class="form-label" for="form2Example2">Password</label>
    <input type="password" id="form2Example2" class="form-control" name ="password"/>
    </div>

  <div data-mdb-input-init class="form-outline mb-4">
  <label class="form-label" for="form2Example2">Repeat Your Password</label>
    <input type="password" id="form2Example2" class="form-control" name ="repeatPass"/>
    
  </div>

  <!-- Submit button -->
  <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Đăng ký</button>

  <!-- Register buttons -->
  <div class="text-center">
  <p>Have already an account?<a href="/BTL_Nhom2/modules/dashboard/login.php">Login</a></p>
    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
      <i class="fab fa-facebook-f"></i>
    </button>

    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
      <i class="fab fa-google"></i>
    </button>

    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
      <i class="fab fa-twitter"></i>
    </button>

    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
      <i class="fab fa-github"></i>
    </button>
  </div>
</form>
</body>
</html>
<?php
    
?>
