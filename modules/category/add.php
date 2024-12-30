<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <h1 class="card-title">Thêm Danh Mục</h1>
                <form action="../../modules/category/actionAdd.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên Danh Mục</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Hình Ảnh</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô Tả</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="../../layout/slidebar/slidebar.php?page_layout=category" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>

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