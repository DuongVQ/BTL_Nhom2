
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <h1>Nhập thông tin danh mục</h1>
    <form action="actionAdd.php" method="post" enctype="multipart/form-data">
        <label for="name">Tên danh mục</label>
        <input type="text" name="name" class="form-control">

        <label for="image">Hình ảnh</label>
        <input type="file" name="image" class="form-control">

        <label for="description">Mô tả</label>
        <textarea name="description" class="form-control"></textarea>

        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="../../layout/slidebar/slidebar.php?page_layout=category" class="btn btn-secondary">Quay lại</a>
    </form>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        <?php
        if (isset($_SESSION['message'])) {
            echo "toastr.success('" . $_SESSION['message'] . "');";
            unset($_SESSION['message']);
        }
        ?>
    </script>
</body>
</html>