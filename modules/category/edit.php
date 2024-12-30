<?php
session_start();
include_once "../../config.php";

$id = $_GET['id'];

// Lấy thông tin category từ id
$result = $con->query("SELECT * FROM categories WHERE id='$id'");

// Kiểm tra xem category có tồn tại không
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Category not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $row['image']; // Keep the existing image by default

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $folder = "../../image/";
        $filename = basename($_FILES['image']['name']);
        $path = $folder . $filename;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
            $image = $path; // Update the image path
        }
    }

    // Update category
    $con->query("UPDATE categories SET name='$name', image='$image', description='$description' WHERE id='$id'");
    $_SESSION['message'] = "Category updated successfully!";
    header("Location:../../layout/slidebar/slidebar.php?page_layout=category");
    exit();
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Category</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $row['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="<?php echo $row['image']; ?>" width="100" alt="Current Image">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../../layout/slidebar/slidebar.php?page_layout=category" class="btn btn-secondary">Back</a>
        </form>
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