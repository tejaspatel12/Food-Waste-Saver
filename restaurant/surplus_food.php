<?php
    session_start();
    include '../admin/connection.php';
    $title = "Surplus Food";
    $code = "surplus_food";
    $status = "1";
	if(!isset($_SESSION["restaurant_id"]))
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
	<link href="../admin/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="../admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3"><?php echo $title;?></div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"><?php echo $title;?> Table</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
							<button type="button" onclick="window.location='add_<?php echo $code;?>.php';" class="btn btn-primary">Add <?php echo $title;?></button>
							
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
		
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example2" class="table table-striped table-bordered">
								<thead>
									<tr>
                                        <th>#</th>
                                        <th>Meal Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Actions</th>
									</tr>
								</thead>
								<tbody>
									
                                    <?php
                                        $count=1;
                                        $result=mysqli_query($conn,"select * from tbl_surplus_meals as sm left join tbl_meal as m on m.meal_id=sm.meal_id where sm.restaurant_id='".$_SESSION["restaurant_id"]."'");
                                        while($row=mysqli_fetch_array($result))
                                    {?>

                                        <tr>
                                           <td>#<?php echo $count++;?></td>
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
                                           
                                           <td>
                                               <?php echo $row['surplus_quantity'];?>
                                           </td>
                                           <?php
                                           
                                            $discount = 40;
                                            $price = ($row["meal_price"] * ($discount / 100));
                                            ?>
                                            
                                           <td>
                                               <s>£<?php echo $row['meal_price'];?></s><br>
                                                <b style"color: red;">£<?php echo $price?></b></td>
                                           <td>
                                              <div class="d-flex order-actions">
                                                 <a href="javascript:;" class="text-primary bg-light-primary border-0"><i class='fadeIn animated bx bx-show-alt' ></i></a>
                                                 <!-- <a href="javascript:;" class="text-primary bg-light-primary border-0"><i class='bx bxs-edit' ></i></a>
                                                    <a href="javascript:;" class="ms-2 text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a> -->
                                              </div>
                                           </td>
                                        </tr>
                                    <?php } ?>

								</tbody>
								<tfoot>
									<tr>
                                        <th>#</th>
                                        <th>Meal Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Actions</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
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
	<script src="../admin/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<script src="../admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
	<script>
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				lengthChange: false,
				buttons: [ 'copy', 'excel', 'pdf', 'print']
			} );
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	</script>
	<!--app JS-->
	<script src="../admin/assets/js/app.js"></script>
</body>

</html>