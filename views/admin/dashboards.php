<?php
// Kết nối cơ sở dữ liệu MySQL
$host = 'localhost'; // Hoặc tên host của bạn
$username = 'root'; // Tên người dùng
$password = ''; // Mật khẩu
$database = 'du-an-1'; // Tên cơ sở dữ liệu của bạn

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy thông tin tổng số sản phẩm
$sql_products = "SELECT COUNT(*) as total_products FROM products";
$result_products = $conn->query($sql_products);
$total_products = $result_products->fetch_assoc()['total_products'];

// Lấy thông tin tổng số đơn hàng
$sql_orders = "SELECT COUNT(*) as total_orders FROM orders";
$result_orders = $conn->query($sql_orders);
$total_orders = $result_orders->fetch_assoc()['total_orders'];

// Lấy thông tin tổng số nhận xét
$sql_comments = "SELECT COUNT(*) as total_comments FROM comments";
$result_comments = $conn->query($sql_comments);
$total_comments = $result_comments->fetch_assoc()['total_comments'];

// Lấy thông tin tổng số người dùng
$sql_users = "SELECT COUNT(*) as total_users FROM users";
$result_users = $conn->query($sql_users);
$total_users = $result_users->fetch_assoc()['total_users'];

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thống Kê</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Thêm Chart.js -->
    <style>
        .card-body {
            text-align: center;
        }
        .card-header {
            font-size: 1.2rem;
        }
        h3 {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Thống Kê Dữ Liệu</h1>
        
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Số lượng Sản phẩm</div>
                    <div class="card-body ">
                        <h5 class="card-title"><?php echo $total_products; ?></h5>
                        <p class="card-text">Tổng sản phẩm trong cửa hàng.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Số lượng Đơn hàng</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_orders; ?></h5>
                        <p class="card-text">Tổng số đơn hàng đã được tạo.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-header">Số lượng Nhận xét</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_comments; ?></h5>
                        <p class="card-text">Tổng số nhận xét về sản phẩm.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Số lượng Người dùng</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_users; ?></h5>
                        <p class="card-text">Tổng số người dùng đã đăng ký.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biểu đồ tròn và cột -->
        <div class="row">
            <div class="col-md-6">
                <h3>Biểu đồ Sản phẩm, Đơn hàng, Nhận xét, Người dùng</h3>
                <div class="card mb-4">
                    <div class="card-body">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h3>Biểu đồ Cột</h3>
                <div class="card mb-4">
                    <div class="card-body">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Dữ liệu cho Biểu đồ Tròn
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Sản phẩm', 'Đơn hàng', 'Nhận xét', 'Người dùng'],
                datasets: [{
                    data: [<?php echo $total_products; ?>, <?php echo $total_orders; ?>, <?php echo $total_comments; ?>, <?php echo $total_users; ?>],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                    borderColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff'],
                    borderWidth: 1
                }]
            }
        });

        // Dữ liệu cho Biểu đồ Cột
        var ctxBar = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Sản phẩm', 'Đơn hàng', 'Nhận xét', 'Người dùng'],
                datasets: [{
                    label: 'Số lượng',
                    data: [<?php echo $total_products; ?>, <?php echo $total_orders; ?>, <?php echo $total_comments; ?>, <?php echo $total_users; ?>],
                    backgroundColor: '#007bff',
                    borderColor: '#0056b3',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
