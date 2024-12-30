<!-- Lấy ra thông tin sản phẩm -->

<?php
$aoKhoacResult = $con->query("SELECT p.*, pi.image_url FROM products p LEFT JOIN product_images pi ON p.id = pi.product_id WHERE p.category = 2 GROUP BY p.id");
$aoKhoacs = [];

if ($aoKhoacResult->num_rows > 0) {
    while ($row = $aoKhoacResult->fetch_assoc()) {
        // Fetch colors
        $colorResult = $con->query("SELECT color_name FROM product_colors WHERE product_id = " . $row['id']);
        $colors = [];
        if ($colorResult->num_rows > 0) {
            while ($colorRow = $colorResult->fetch_assoc()) {
                $colors[] = $colorRow['color_name']; // Thêm từng màu sắc vào mảng
            }
        }
        $row['colors'] = $colors; // Gán mảng màu sắc hoàn chỉnh

        // Fetch sizes
        $sizeResult = $con->query("SELECT size_name FROM product_sizes WHERE product_id = " . $row['id']);
        $sizes = [];
        if ($sizeResult->num_rows > 0) {
            while ($sizeRow = $sizeResult->fetch_assoc()) {
                $sizes[] = $sizeRow['size_name']; // Thêm từng kích thước vào mảng
            }
        }
        $row['sizes'] = $sizes; // Gán mảng kích thước hoàn chỉnh

        $aoKhoacs[] = $row; // Thêm sản phẩm vào mảng kết quả
    }
}


$boNiResult = $con->query("SELECT p.*, pi.image_url FROM products p LEFT JOIN product_images pi ON p.id = pi.product_id WHERE p.category = 1 GROUP BY p.id");
$boNis = [];

if ($boNiResult->num_rows > 0) {
    while ($row = $boNiResult->fetch_assoc()) {
        // Fetch colors
        $colorResult = $con->query("SELECT color_name FROM product_colors WHERE product_id = " . $row['id']);
        $colors = [];
        if ($colorResult->num_rows > 0) {
            while ($colorRow = $colorResult->fetch_assoc()) {
                $colors[] = $colorRow['color_name']; // Thêm từng màu sắc vào mảng
            }
        }
        $row['colors'] = $colors; // Gán mảng màu sắc hoàn chỉnh

        // Fetch sizes
        $sizeResult = $con->query("SELECT size_name FROM product_sizes WHERE product_id = " . $row['id']);
        $sizes = [];
        if ($sizeResult->num_rows > 0) {
            while ($sizeRow = $sizeResult->fetch_assoc()) {
                $sizes[] = $sizeRow['size_name']; // Thêm từng kích thước vào mảng
            }
        }
        $row['sizes'] = $sizes; // Gán mảng kích thước hoàn chỉnh

        $boNis[] = $row; // Thêm sản phẩm vào mảng kết quả
    }
}


$somiResult = $con->query("SELECT p.*, pi.image_url FROM products p LEFT JOIN product_images pi ON p.id = pi.product_id WHERE p.category = 3 GROUP BY p.id");
$soMis = [];

if ($somiResult->num_rows > 0) {
    while ($row = $somiResult->fetch_assoc()) {
        // Fetch colors
        $colorResult = $con->query("SELECT color_name FROM product_colors WHERE product_id = " . $row['id']);
        $colors = [];
        if ($colorResult->num_rows > 0) {
            while ($colorRow = $colorResult->fetch_assoc()) {
                $colors[] = $colorRow['color_name']; // Thêm từng màu sắc vào mảng
            }
        }
        $row['colors'] = $colors; // Gán mảng màu sắc hoàn chỉnh

        // Fetch sizes
        $sizeResult = $con->query("SELECT size_name FROM product_sizes WHERE product_id = " . $row['id']);
        $sizes = [];
        if ($sizeResult->num_rows > 0) {
            while ($sizeRow = $sizeResult->fetch_assoc()) {
                $sizes[] = $sizeRow['size_name']; // Thêm từng kích thước vào mảng
            }
        }
        $row['sizes'] = $sizes; // Gán mảng kích thước hoàn chỉnh

        $soMis[] = $row; // Thêm sản phẩm vào mảng kết quả
    }
}


$aopoloResult = $con->query("SELECT p.*, pi.image_url FROM products p LEFT JOIN product_images pi ON p.id = pi.product_id WHERE p.category = 4 GROUP BY p.id");
$aoPolos = [];

if ($aopoloResult->num_rows > 0) {
    while ($row = $aopoloResult->fetch_assoc()) {
        // Fetch colors
        $colorResult = $con->query("SELECT color_name FROM product_colors WHERE product_id = " . $row['id']);
        $colors = [];
        if ($colorResult->num_rows > 0) {
            while ($colorRow = $colorResult->fetch_assoc()) {
                $colors[] = $colorRow['color_name']; // Thêm từng màu sắc vào mảng
            }
        }
        $row['colors'] = $colors; // Gán mảng màu sắc hoàn chỉnh

        // Fetch sizes
        $sizeResult = $con->query("SELECT size_name FROM product_sizes WHERE product_id = " . $row['id']);
        $sizes = [];
        if ($sizeResult->num_rows > 0) {
            while ($sizeRow = $sizeResult->fetch_assoc()) {
                $sizes[] = $sizeRow['size_name']; // Thêm từng kích thước vào mảng
            }
        }
        $row['sizes'] = $sizes; // Gán mảng kích thước hoàn chỉnh

        $aoPolos[] = $row; // Thêm sản phẩm vào mảng kết quả
    }
}