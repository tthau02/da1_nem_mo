  <?php include_once ROOT_DIR . "views/admin/sidebar.php"; ?>
  <div class="main">
    <?php include_once ROOT_DIR . "views/admin/header.php"; ?>

    <section class="container mt-3">
	   <!-- row -->
	   
	   <div class="table-responsive-xl mb-6 mb-lg-0">
		  <div class="row flex-nowrap pb-3 pb-lg-0">
			 <div class="col-lg-4 col-12 mb-6">
				<!-- card -->
				<div class="card h-100 card-lg">
    <!-- card body -->
    <div class="card-body p-6">
        <!-- heading -->
        <div class="d-flex justify-content-between align-items-center mb-6">
            <div>
                <h4 class="mb-0 fs-5">Doanh thu theo tuần</h4>
            </div>
            <div class="icon-shape icon-md bg-light-danger text-dark-danger rounded-circle">
                <i class="bi bi-currency-dollar fs-5"></i>
            </div>
        </div>
        <!-- Loop through weekly revenue data -->
        <div class="lh-1">
            <?php foreach ($weeklyRevenue as $weekData): ?>
                <h4 class="mb-2 fw-bold">
                    <?= number_format($weekData['revenue']) ?> VND
                </h4>
            <?php endforeach; ?>
        </div>
    </div>
</div>
			 </div>
			 <div class="col-lg-4 col-12 mb-6">
				<!-- card -->
				<div class="card h-100 card-lg">
				   <!-- card body -->
				   <div class="card-body p-6">
					  <!-- heading -->
					  <div class="d-flex justify-content-between align-items-center mb-6">
						 <div>
							<h4 class="mb-0 fs-5">Đơn hàng</h4>
						 </div>
						 <div class="icon-shape icon-md bg-light-warning text-dark-warning rounded-circle">
							<i class="bi bi-cart fs-5"></i>
						 </div>
					  </div>
					  <!-- project number -->
					  <div class="lh-1">
						 <h1 class="mb-2 fw-bold fs-2">
             <?php echo number_format($totalOrders, 0, ',', '.') ?>
             </h1>
						 <span>
             <span>Tổng đơn hàng</span>
					  </div>
				   </div>
				</div>
			 </div>
			 <div class="col-lg-4 col-12 mb-6">
				<!-- card -->
				<div class="card h-100 card-lg">
				   <!-- card body -->
				   <div class="card-body p-6">
					  <!-- heading -->
					  <div class="d-flex justify-content-between align-items-center mb-6">
						 <div>
							<h4 class="mb-0 fs-5">Khách hàng</h4>
						 </div>
						 <div class="icon-shape icon-md bg-light-info text-dark-info rounded-circle">
							<i class="bi bi-people fs-5"></i>
						 </div>
					  </div>
					  <!-- project number -->
					  <div class="lh-1">
						 <h1 class="mb-2 fw-bold fs-2">
             <?php echo $totalCustomers ?>
             </h1>
             <span>Tổng số khách hàng</span>
					  </div>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>

	  
		  
	   <!-- row -->
	   <div class="row">
		  <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
			 <div class="card h-100 card-lg">
				<!-- heading -->
				<div class="p-6">
				   <h3 class="mb-0 fs-5">Top 5 sản phẩm bán chạy</h3>
				</div>
				<div class="card-body p-0">
				   <!-- table -->
				   <div class="table-responsive">
					  <table class="table table-centered table-borderless text-nowrap table-hover">
						 <thead class="bg-light">
							<tr>
							   <th scope="col">Số đơn hàng</th>
							   <th scope="col">Tên sản phẩm</th>
							   <th scope="col">Ngày mua</th>
							   <th scope="col">Tổng doanh thu</th>
							   <th scope="col">Trạng thái</th>
							</tr>
						 </thead>
						 <tbody>
                  <?php foreach ($topSellingProducts as $product): ?>
                      <tr>
                          <td><?= $product['total_orders'] ?></td>
                          <td class="text-truncate" style="max-width: 200px;"><?= $product['name'] ?></td>
                          <td><?= date("d/m/Y", strtotime($product['last_order_date'])) ?></td>
                          <td><?= number_format($product['total_sales']) ?> VND</td>
                          <td>
                              <span class="badge bg-light-primary text-dark-primary">Hoàn thành</span>
                          </td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</section>
  </main>
    
    <?php include_once ROOT_DIR . "views/admin/footer.php" ?>