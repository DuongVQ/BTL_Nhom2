<?php
    session_start();
    include "../../layout/header/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử mua hàng</title>
</head>
<body>
    <div class="wrapper_list_ordered">
        <div class="container">
            <h4 class="title_notf mb-3">Lịch sử mua hàng</h4>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Số thứ tự</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ngày hoàn thành</th>
                    <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <?php
                    include "../../config.php";
                    if(isset($_SESSION["user_id"])){
                        $userId = $_SESSION["user_id"];
                        $sql = "SELECT * FROM orders WHERE `user_id` = '$userId' AND `status` = 'Đã giao'";
                        $listOrdered = mysqli_query($con, $sql);
                        if(mysqli_num_rows($listOrdered) > 0){
                            $no = 0;
                            while($arrOrdered = mysqli_fetch_array($listOrdered)){
                ?>

                                <tr>
                                    <td class="no_ordered"> <?= ++$no ?> </td>
                                    <td> <?= $arrOrdered['status'] ?> </td>
                                    <td> <?= $arrOrdered['created_at'] ?> </td>
                                    <td><a href="./orderedDetails.php?orderId=<?=$arrOrdered['id']?>" class="btn btn-info">Chi tiết</a> </td>
                                </tr>

                <?php
                            }
                        }
                    }
                ?>
            </table>
        </div>
    </div>

    <?php
        include "../../layout/footer/footer.php";
    ?>
</body>
</html>