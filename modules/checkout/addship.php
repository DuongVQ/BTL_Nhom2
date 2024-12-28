<?php
    session_start();
    $user_id = $_SESSION['login'] ?? null;
    include_once "../../config.php";

    $name = $_POST['name'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $tinh = $_POST['tinh'];
    $huyen = $_POST['huyen'];

    $status = 'Đang xử lý';
    $sql_order = "INSERT INTO orders (user_id, status) VALUES (?, ?)";
    $duc_order = $con->prepare($sql_order);
    $duc_order->bind_param("is", $user_id, $status);

    if ($duc_order->execute()) {
        $order_id = $duc_order->insert_id;

        

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $sql_order_detail = "INSERT INTO order_details (order_id, product_id, product_name, price_product, quantity, total) VALUES (?, ?, ?, ?, ?, ?)";
            
     
            $duc_order_detail = $con->prepare($sql_order_detail);
            

            foreach ($_SESSION['cart'] as $item) {
                
                $product_id = $item['product_id'];
                $product_name = $item['product_name'];  
                $price_product = $item['price'];       
                $quantity = $item['quantity'];         
                $total = $price_product * $quantity;   

                
                $duc_order_detail->bind_param("iisdis", $order_id, $product_id, $product_name, $price_product, $quantity, $total);

                
                if (!$duc_order_detail->execute()) {
                    
                    echo "Lỗi khi thêm chi tiết đơn hàng: " . $duc_order_detail->error;
                }
            }
            
            
            $duc_order_detail->close();
        } else {
            echo "Giỏ hàng trống hoặc chưa được khởi tạo.";
        }

        $sql = "INSERT INTO shipment (order_id, fullname, phone, country, city, district, address) 
        VALUES ('$order_id', '$name', '$sdt', 'Viet Nam', '$tinh', '$huyen', '$diachi')";
        $dele_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
        if($con->query($dele_cart) === true){
            unset($_SESSION['cart']);
        }
        if($con->query($sql) === true){
            header("location: ./ordersuss.php");
        }
        $duc_order->close();
    }
    $con->close();

?>