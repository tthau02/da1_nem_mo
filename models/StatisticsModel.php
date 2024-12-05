<?php

class StatisticsModel extends BaseModel {
    // Doanh thu theo tuần
        public function getWeeklyRevenue($month, $year) {
            // Lấy tuần của tháng và năm
            $startDate = "$year-$month-01"; // Ngày đầu tháng
            $endDate = date("Y-m-t", strtotime($startDate)); // Ngày cuối tháng

            // Truy vấn doanh thu theo tuần
            $stmt = $this->conn->prepare("
                SELECT WEEK(created_at) AS week, SUM(total_price) AS revenue
                FROM orders 
                WHERE created_at BETWEEN ? AND ?
                GROUP BY WEEK(created_at)
            ");
            $stmt->execute([$startDate, $endDate]);

            // Trả về doanh thu theo tuần
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


    // Tổng đơn hàng
    public function getTotalOrders() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total_orders FROM orders");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_orders'] ?? 0;
    }

    // Tổng khách hàng
    public function getTotalCustomers() {
        $stmt = $this->conn->query("SELECT COUNT(*) AS total_customers FROM users");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_customers'] ?? 0;
    }

    public function getTopSellingProducts() {
        // Truy vấn lấy sản phẩm với số lượng bán ra cao nhất từ bảng order_details
        $stmt = $this->conn->prepare("
            SELECT p.name, SUM(od.quantity) AS total_orders, SUM(od.quantity * p.price) AS total_sales, MAX(o.created_at) AS last_order_date
            FROM order_details od
            INNER JOIN products p ON od.product_id = p.id
            INNER JOIN orders o ON od.order_id = o.id
            GROUP BY od.product_id
            ORDER BY total_orders DESC
            LIMIT 5
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sản phẩm
    }
    
}
