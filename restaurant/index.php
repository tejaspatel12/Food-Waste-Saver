<?php
	session_start();
	include '../admin/connection.php';
	$Code = "Home";
	if(!isset($_SESSION["restaurant_id"]))
	{
		echo "<script>window.location='login.php';</script>";
	}
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor3 color-header headercolor1">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../admin/assets/images/favicon-32x32.png" type="image/png" />
	
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	<!--plugins-->
	<link href="../admin/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
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
	<title><?php echo $Code; ?> - <?php echo $webname;?></title>
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
				<div class="row row-cols-1 row-cols-lg-3">
					<div class="col">
						<div class="card radius-10 overflow-hidden bg-gradient-cosmic">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Orders</p>
										<h5 class="mb-0 text-white">
										    <?php
												$resultOrder=mysqli_query($conn,"select order_id from tbl_order where restaurant_id='".$_SESSION["restaurant_id"]."'");
												echo mysqli_num_rows($resultOrder);
											?> 
										</h5>
									</div>
									<div class="ms-auto text-white"><i class='bx bx-cart font-30'></i>
									</div>
								</div>
								<div class="progress bg-white-2 radius-10 mt-4" style="height:4.5px;">
									<div class="progress-bar bg-white" role="progressbar" style="width: 46%"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="col">
						<div class="card radius-10 overflow-hidden bg-gradient-burning">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Total Income</p>
										<h5 class="mb-0 text-white">£
										    <?php
                                            $resultOrderAmt = mysqli_query($conn, "SELECT SUM(order_total) AS totalAmount FROM tbl_order WHERE restaurant_id='" . $_SESSION["restaurant_id"] . "'");
                                            $row = mysqli_fetch_assoc($resultOrderAmt);
                                            $totalAmount = $row['totalAmount'];
                                            
                                            echo $totalAmount;
                                            ?>
										</h5>
									</div>
									<div class="ms-auto text-white"><i class='bx bx-wallet font-30'></i>
									</div>
								</div>
								<div class="progress bg-white-2 radius-10 mt-4" style="height:4.5px;">
									<div class="progress-bar bg-white" role="progressbar" style="width: 72%"></div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col">
						<div class="card radius-10 overflow-hidden bg-gradient-moonlit">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div>
										<p class="mb-0 text-white">Comments</p>
										<h5 class="mb-0 text-white">869</h5>
									</div>
									<div class="ms-auto text-white"><i class='bx bx-chat font-30'></i>
									</div>
								</div>
								<div class="progress  bg-white-2 radius-10 mt-4" style="height:4.5px;">
									<div class="progress-bar bg-white" role="progressbar" style="width: 66%"></div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end row-->
				
				<div class="card radius-10">
					<div class="card-header border-bottom-0 bg-transparent">
						<div class="d-lg-flex align-items-center">
							<div>
								<h6 class="font-weight-bold mb-2 mb-lg-0">Monthly Revenue</h6>
							</div>
							
						</div>
					</div>
					
					<!--code-->
					<!--code-->
					<div class="card-body">
						<div id="chartmonth"></div>
					</div>
					<!--code-->
					<!--code-->
					
					
					
					
					
				</div>

				<div class="row row-cols-1 row-cols-lg-2">
                   <div class="col d-flex">
					<div class="card radius-10 w-100">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="font-weight-bold mb-0">Best Selling Products</h6>
								</div>
								<div class="dropdown ms-auto">
									<div class="cursor-pointer text-dark font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>
									</div>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="javaScript:;">Action</a>
										<a class="dropdown-item" href="javaScript:;">Another action</a>
										<div class="dropdown-divider"></div>	
										<a class="dropdown-item" href="javaScript:;">Something else here</a>
									</div>
								</div>
							</div>
						   </div>
							<div class="best-selling-products p-3 mb-3">
							    
							     <?php
                                    if(isset($_SESSION["restaurant_id"]))
                                    {
                                        $restaurant_id = $_SESSION["restaurant_id"];
                                        $count = 1;

                                        $sql = "SELECT m.meal_id, m.meal_name, m.meal_image, m.meal_price, COUNT(od.meal_id) as meal_count 
                                        FROM tbl_order_detail od
                                        JOIN tbl_meal m ON od.meal_id = m.meal_id where restaurant_id='$restaurant_id'
                                        GROUP BY od.meal_id 
                                        ORDER BY meal_count DESC";

                                        // Execute the query and retrieve data
                                        $result = $conn->query($sql);

                                        $top3Meals = array(); // Initialize an array to store the top 3 meals

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $meal_id = $row['meal_id'];
                                                $meal_name = $row['meal_name'];
                                                $meal_image = $row['meal_image'];
                                                $meal_count = $row['meal_count'];
                                                $meal_price = $row['meal_price'];
                                        
                                                $mealDetails = array(
                                                    'meal_id' => $meal_id,
                                                    'meal_name' => $meal_name,
                                                    'meal_image' => $meal_image,
                                                    'meal_count' => $meal_count,
                                                    'meal_price' => $meal_price
                                                );
                                        
                                                $top3Meals[] = $mealDetails;
                                            }
                                        }
                                        foreach ($top3Meals as $meal) {
                                    ?> 
								<div class="d-flex align-items-center">
									<div class="product-img">
										<img src="<?php echo $RES_PRODUCT_IMG.$restaurant."/".$meal['meal_image'];?>" class="p-1" alt="" />
									</div>
									<div class="ps-3">
										<h6 class="mb-0 font-weight-bold"><?php echo $meal['meal_name'];?></h6>
										<p class="mb-0 text-secondary">£<?php echo $meal['meal_price'];?>/Each <?php echo $meal['meal_count'];?> Orders</p>
										<?php $total = $meal['meal_price'] * $meal['meal_count'];?>
									</div>
									<p class="ms-auto mb-0 text-purple">£<?php echo $total;?></p>
								</div>
								<hr/>
								
								<?php }}?>
								
							</div>
					</div>
				   </div>
				   <div class="col d-flex">
					<div class="card radius-10 w-100">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div>
									<h6 class="font-weight-bold mb-0">Recent Reviews</h6>
								</div>
								<div class="dropdown ms-auto">
									<div class="cursor-pointer text-dark font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>
									</div>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="javaScript:;">Action</a>
										<a class="dropdown-item" href="javaScript:;">Another action</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="javaScript:;">Something else here</a>
									</div>
								</div>
							</div>
						  </div>
							<div class="recent-reviews p-3 mb-3">
							    
							    <?php
                                    if(isset($_SESSION["restaurant_id"]))
                                    {
                                        $restaurant_id = $_SESSION["restaurant_id"];
                                        $count = 1;

                                        $sql = "SELECT m.meal_id, m.meal_name, m.meal_image, m.meal_price, COUNT(od.meal_id) as meal_count 
                                        FROM tbl_order_detail od
                                        JOIN tbl_meal m ON od.meal_id = m.meal_id where restaurant_id='$restaurant_id'
                                        GROUP BY od.meal_id 
                                        ORDER BY meal_count ASC limit 4";

                                        // Execute the query and retrieve data
                                        $result = $conn->query($sql);

                                        $top3Meals = array(); // Initialize an array to store the top 3 meals

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $meal_id = $row['meal_id'];
                                                $meal_name = $row['meal_name'];
                                                $meal_image = $row['meal_image'];
                                                $meal_count = $row['meal_count'];
                                                $meal_price = $row['meal_price'];
                                        
                                                $mealDetails = array(
                                                    'meal_id' => $meal_id,
                                                    'meal_name' => $meal_name,
                                                    'meal_image' => $meal_image,
                                                    'meal_count' => $meal_count,
                                                    'meal_price' => $meal_price
                                                );
                                        
                                                $top3Meals[] = $mealDetails;
                                            }
                                        }
                                        foreach ($top3Meals as $meal) {
                                    ?> 
								<div class="d-flex align-items-center">
									<div class="product-img">
										<img src="<?php echo $RES_PRODUCT_IMG.$restaurant."/".$meal['meal_image'];?>" class="p-1" alt="" />
									</div>
									<div class="ps-3">
										<h6 class="mb-0 font-weight-bold"><?php echo $meal['meal_name'];?></h6>
									</div>
									<p class="ms-auto mb-0"><i class='bx bxs-star text-warning mr-1'></i> 5.00</p>
								</div>
								<hr/>
								<?php }}?>
								
							</div>
						
					</div>
				   </div>
				</div>
				<!--end row-->

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
	<script src="../admin/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
	<script src="../admin/assets/js/index3.js"></script>
	<script>
		new PerfectScrollbar('.best-selling-products');
		new PerfectScrollbar('.recent-reviews');
		new PerfectScrollbar('.support-list');
	</script>
	<!--app JS-->
	<script src="../admin/assets/js/app.js"></script>
	
    <script>
    
    $(function () {
    "use strict";

    // Fetch data using AJAX
    fetch('include/order_month.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (isValidChartData(data)) {
                renderMonthlyRevenueChart(data);
            } else {
                console.error('Invalid or empty data received:', data);
            }
        })
        .catch(error => console.error('Error fetching or parsing data:', error));

    // Function to check if data is valid for chart rendering
    function isValidChartData(data) {
        return Array.isArray(data) && data.length > 0 && data[0]?.hasOwnProperty('month') && data[0]?.hasOwnProperty('total');
    }

    // Function to render the monthly revenue chart
    function renderMonthlyRevenueChart(data) {
        var options = {
            series: [{
                name: 'Revenue',
                data: data.map(item => parseFloat(item.total))
            }],
            chart: {
                foreColor: '#9a9797',
                type: 'area',
                height: 380,
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: false,
                    top: 3,
                    left: 14,
                    blur: 4,
                    opacity: 0.10,
                }
            },
            stroke: {
                width: 4,
                curve: 'smooth'
            },
            xaxis: {
                categories: data.map(item => getMonthName(parseInt(item.month)))
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    gradientToColors: ['#8833ff'],
                    shadeIntensity: 1,
                    type: 'vertical',
                    opacityFrom: 0.8,
                    opacityTo: 0.3,
                },
            },
            colors: ["#8833ff"],
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value + "£";
                    }
                },
            },
            markers: {
                size: 4,
                colors: ["#8833ff"],
                strokeColors: "#fff",
                strokeWidth: 2,
                hover: {
                    size: 7,
                }
            },
            grid: {
                show: true,
                borderColor: '#ededed',
                strokeDashArray: 4,
            }
        };

        // Create the chart
        var chart = new ApexCharts(document.querySelector("#chartmonth"), options);
        chart.render();
    }

    // Function to get month name from month number
    function getMonthName(monthNumber) {
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return months[monthNumber - 1];
    }
});

</script>

</body>

</html>