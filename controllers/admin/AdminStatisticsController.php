<?php

class AdminStatisticsController {
    public function index() {
        // Dữ liệu mặc định: tháng hiện tại
        $month = date('m');
        $year = date('Y');

        // Lấy dữ liệu từ model
        $weeklyRevenue = (new StatisticsModel())->getWeeklyRevenue($month, $year);
        $totalOrders = (new StatisticsModel())->getTotalOrders();
        $totalCustomers = (new StatisticsModel())->getTotalCustomers();
        $topSellingProducts = (new StatisticsModel())->getTopSellingProducts();

        // Trả về view với dữ liệu thống kê
        return view(
            "admin.dashboard", // View
            compact('weeklyRevenue', 'totalOrders', 'totalCustomers', 'topSellingProducts') // Dữ liệu được truyền vào view
        );
    }
}


?>