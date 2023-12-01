<?php
	session_start();
	include '../admin/connection.php';
	$title = "Home";
	if(!isset($_SESSION["foodbank_id"]))
	{
		echo "<script>window.location='login.php';</script>";
	}
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../admin/assets/images/favicon-32x32.png" type="image/png" />
	<!--plugins-->
	<link href="../admin/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../admin/assets/plugins/highcharts/css/highcharts.css" rel="stylesheet" />
	<link href="../admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
	<link href="../admin/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="../admin/assets/css/pace.min.css" rel="stylesheet" />
	<script src="../admin/assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="../admin/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../admin/assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="../admin/assets/css/app.css" rel="stylesheet">
	<link href="../admin/assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="../admin/assets/css/dark-theme.css" />
	<link rel="stylesheet" href="../admin/assets/css/semi-dark.css" />
	<link rel="stylesheet" href="../admin/assets/css/header-colors.css" />
	<title><?php echo $title; ?> - <?php echo $webname;?></title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->

		<?php include 'sidebar.php';?>

		<!--end sidebar wrapper -->
		<!--start header -->

		<?php include 'header.php';?>

		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
			
			  <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
			    <div class="col">
						<div class="card radius-10 overflow-hidden">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total Orders Received</p>
										<h5 class="mb-0">
										    <?php
                                            $resultOrderAmt = mysqli_query($conn, "SELECT SUM(fbm_quantity) AS totalQty FROM tbl_foodbank_meal WHERE food_bank_id='" . $_SESSION["foodbank_id"] . "'");
                                            $row = mysqli_fetch_assoc($resultOrderAmt);
                                            $totalQty = $row['totalQty'];
                                            
                                            echo $totalQty;
                                            ?>
										</h5>
									</div>
									<div class="ms-auto">	<i class='bx bx-cart font-30'></i>
									</div>
								</div>
							</div>
							<div class="" id="chart1"></div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 overflow-hidden">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0">Total Available Meals</p>
										<h5 class="mb-0">
										    
										    <?php
                                            $resultOrder = mysqli_query($conn, "SELECT SUM(fbm_quantity) AS totalQt FROM tbl_foodbank_meal WHERE food_bank_id='" . $_SESSION["foodbank_id"] . "'");
                                            $row = mysqli_fetch_assoc($resultOrder);
                                            $totalQt = $row['totalQt'];
                                            
                                            echo $totalQt;
                                            ?>
                                            
										</h5>
									</div>
									<div class="ms-auto">	<i class='bx bx-wallet font-30'></i>
									</div>
								</div>
							</div>
							<div class="" id="chart2"></div>
						</div>
					</div>
					
			  </div><!--end row-->
			  
			  


				<div class="row">
					<div class="col">
						<div class="card radius-10 mb-0">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<h5 class="mb-1">Recent Orders</h5>
									</div>
									<div class="ms-auto">
										<a href="javscript:;" class="btn btn-primary btn-sm radius-30">View All Products</a>
									</div>
								</div>

                               <div class="table-responsive mt-3">
								   <table class="table align-middle mb-0">
									   <thead class="table-light">
										   <tr>
											   <th>Tracking ID</th>
											   <th>Products Name</th>
											   <th>Date</th>
											   <th>Status</th>
											   <th>Actions</th>
										   </tr>
									   </thead>
									   <tbody>
									       
									       <?php
                                                $count=1;
                                                $result=mysqli_query($conn,"select * from tbl_foodbank_meal as fm left join tbl_meal as m on m.meal_id=fm.meal_id left join tbl_surplus_meals as sm on sm.surplus_id=fm.surplus_id where fm.food_bank_id='" . $_SESSION["foodbank_id"] . "'");
                                                while($row=mysqli_fetch_array($result))
                                            {?>
                                    
										   <tr>
											   <td>#<?php echo $count?></td>
											   <td>
                                                 <div class="d-flex align-items-center">
                                                     <div class="recent-product-img">
                                                        <img src="<?php echo $RES_PRODUCT_IMG."/".$row['meal_image'];?>" alt="">
                                                     </div>
                                                     <div class="ms-2">
                                                        <h6 class="mb-1 font-14"><?php echo $row['meal_name'];?></h6>
                                                     </div>
                                                  </div>
                                               </td>
											   <td><?php echo $row['surplus_date'];?></td>
											   <td class=""><span class="badge bg-light-success text-success w-100">Completed</span></td>
											   <td>#149.25</td>
											   <td>
												<div class="d-flex order-actions">
												    <a href="javascript:void(0);" class="text-primary bg-light-primary border-0 surplus-popup-btn">
												</div>
											   </td>
										   </tr>
										   
										   <?php }?>
									   </tbody>
								   </table>
							   </div>
								
							</div>
						</div>
					</div>
				</div><!--end row-->
			
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		
        <?php include 'footer.php';?>
        
	</div>
	<!--end wrapper-->
	<!--start switcher-->

	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="../admin/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="../admin/assets/js/jquery.min.js"></script>
	<script src="../admin/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="../admin/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="../admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="../admin/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="../admin/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="../admin/assets/plugins/highcharts/js/highcharts.js"></script>
	<script src="../admin/assets/plugins/highcharts/js/exporting.js"></script>
	<script src="../admin/assets/plugins/highcharts/js/variable-pie.js"></script>
	<script src="../admin/assets/plugins/highcharts/js/export-data.js"></script>
	<script src="../admin/assets/plugins/highcharts/js/accessibility.js"></script>
	<script src="../admin/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="../admin/assets/js/index2.js"></script>
	<!--app JS-->
	<script src="../admin/assets/js/app.js"></script>
	<script>
		new PerfectScrollbar('.customers-list');
		new PerfectScrollbar('.store-metrics');
		new PerfectScrollbar('.product-list');
	</script>
</body>

</html>
