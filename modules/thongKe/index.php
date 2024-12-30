<?php
include_once "../../config.php";

// Lấy dữ liệu tổng tiền theo ngày
function GetTotalRevenueByDay($con)
{
    $query = " SELECT 
                DATE(orders.created_at) AS order_date, 
                SUM(order_details.quantity * order_details.price_product) AS total_revenue
                FROM orders
                JOIN order_details ON orders.id = order_details.order_id
                WHERE orders.status = 'Đã giao'
                GROUP BY DATE(orders.created_at)
                ORDER BY DATE(orders.created_at) ASC;
";

    $result = $con->query($query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

// Lấy dữ liệu số lượng sản phẩm theo ngày
function GetProductQuantityByDay($con)
{
    $query = "SELECT 
                DATE(orders.created_at) AS order_date,
                order_details.product_id,
                order_details.product_name,
                SUM(order_details.quantity) AS total_quantity,
                SUM(order_details.quantity * order_details.price_product) AS total_price
                FROM orders
                JOIN order_details ON orders.id = order_details.order_id
                WHERE orders.status = 'Đã giao'
                GROUP BY DATE(orders.created_at), order_details.product_id, order_details.product_name
                ORDER BY DATE(orders.created_at) ASC, total_quantity DESC;
";

    $result = $con->query($query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

$totalRevenueData = GetTotalRevenueByDay($con);
$productQuantityData = GetProductQuantityByDay($con);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê doanh thu và sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center">Thống kê doanh thu và sản phẩm theo ngày</h2>

        <canvas id="totalRevenueChart" width="500" height="200"></canvas>
        <script>
            var totalRevenueData = <?php echo json_encode($totalRevenueData); ?>;
            var productQuantityData = <?php echo json_encode($productQuantityData); ?>;

            var revenueLabels = totalRevenueData.map(item => item.order_date);
            var revenueData = totalRevenueData.map(item => item.total_revenue);

            var ctx = document.getElementById('totalRevenueChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: revenueLabels,
                    datasets: [{
                        label: 'Tổng doanh thu (VND)',
                        data: revenueData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Tổng doanh thu theo ngày'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    onClick: function (event, elements) {
                        if (elements.length > 0) {

                            var index = elements[0].index;
                            var selectedDate = revenueLabels[index];
                            var filteredData = productQuantityData.filter(item => item.order_date === selectedDate);


                            var tableBody = document.querySelector("#productQuantityTable tbody");
                            tableBody.innerHTML = ""; 
                            filteredData.forEach(item => {
                                var row = `
                            <tr>
                                <td>${item.order_date}</td>
                                <td>${item.product_id}</td>
                                <td>${item.product_name}</td>
                                <td>${item.total_quantity}</td>
                                <td>${new Intl.NumberFormat('vi-VN').format(item.total_price)} VNĐ</td>
                            </tr>
                        `;
                                tableBody.innerHTML += row;
                            });
                            var table = document.getElementById('productQuantityTable');
                            table.style.display = 'table';
                        }
                    }
                }
            });
        </script>




        <table id="productQuantityTable" class="table table-bordered" style="display: none;">

            <thead>
                <th colspan="5">
                    <h3 class="text-center mt-5">Bảng số lượng sản phẩm theo ngày</h3>
                </th>
                <tr>
                    <th>Ngày</th>
                    <th>ID Sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Tổng số lượng</th>
                    <th>Tổng tiền (VND)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productQuantityData as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['order_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_quantity']); ?></td>
                        <td><?php echo number_format($row['total_price'], 0, '', '.') . " VNĐ"; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
$con->close();
?>