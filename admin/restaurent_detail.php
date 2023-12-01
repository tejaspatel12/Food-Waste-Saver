<?php
   session_start();
   include 'connection.php';
   $title = "Restaurent Details";
   $code = "restaurent_details";
   $status = "1";
   if(!isset($_SESSION["admin_id"]))
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
      <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
      <!--plugins-->
      <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
      <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
      <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
      <!-- loader-->
      <link href="assets/css/pace.min.css" rel="stylesheet" />
      <script src="assets/js/pace.min.js"></script>
      <!-- Bootstrap CSS -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
      <link href="assets/css/app.css" rel="stylesheet">
      <link href="assets/css/icons.css" rel="stylesheet">
      <!-- Theme Style CSS -->
      <link rel="stylesheet" href="assets/css/dark-theme.css" />
      <link rel="stylesheet" href="assets/css/semi-dark.css" />
      <link rel="stylesheet" href="assets/css/header-colors.css" />
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
                  <div class="breadcrumb-title pe-3"> <?php echo $webname;?></div>
                  <div class="ps-3">
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                           <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                           </li>
                           <li class="breadcrumb-item active" aria-current="page"> <?php echo $title;?></li>
                        </ol>
                     </nav>
                  </div>
                  <div class="ms-auto">
                     <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                           <a class="dropdown-item" href="javascript:;">Action</a>
                           <a class="dropdown-item" href="javascript:;">Another action</a>
                           <a class="dropdown-item" href="javascript:;">Something else here</a>
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="javascript:;">Separated link</a>
                        </div>
                     </div>
                  </div>
               </div>
               <!--end breadcrumb-->
			   <?php
			   if(isset($_REQUEST["id"]))
			   {
				$restaurant_id = $_REQUEST["id"];

				$resultorder=mysqli_query($conn,"select * from tbl_order where restaurant_id='$restaurant_id'");
				$totalorder = mysqli_num_rows($resultorder);

				$resulttotal=mysqli_query($conn,"select order_total from tbl_order where restaurant_id='$restaurant_id'");
				while($row = mysqli_fetch_assoc($resulttotal)) 
				{
					$total_amount += $row['order_total']; 
				}

			   }
			   ?>
               <div class="card">
                  <div class="row g-0">
                     <?php
                        if(isset($_REQUEST["id"]))
                        {
                        	$id = $_REQUEST["id"];
                            $result=mysqli_query($conn,"select * from tbl_restaurant as r left join tbl_city as c on c.city_id=r.city_id where r.restaurant_id='".$_REQUEST["id"]."'");
                            while($row=mysqli_fetch_array($result))
                            {
                            ?> 
                     <div class="col-md-12">
                        <div class="card-body">
                           <div>
                              <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon"    >
                           </div>
                           <br>
                           <h4 class="card-title"><?php echo $row["restaurant_name"]?></h4>
                           <div class="d-flex gap-3 py-3">
                              <div class="cursor-pointer">
                                 <i class='bx bxs-star text-warning'></i>
                                 <i class='bx bxs-star text-warning'></i>
                                 <i class='bx bxs-star text-warning'></i>
                                 <i class='bx bxs-star text-warning'></i>
                                 <i class='bx bxs-star text-secondary'></i>
                              </div>
                              <div>0 reviews</div>
                              	<div class="text-success"><i class='bx bxs-cart-alt align-middle'></i> 
								  	<?php echo $totalorder?> orders
								</div>

								<div class="text-danger"><i class='fadeIn animated bx bx-money'></i> 
									£ <?php echo $total_amount?>
								</div>

                           </div>
                           <div class="mb-3">
                              <!-- <span class="price h4">$149.00</span>  -->
                              <!-- <span class="text-muted">/per kg</span>  -->
                           </div>
                           <!-- <p class="card-text fs-6">Virgil Abloh’s Off-White is a streetwear-inspired collection that continues to break away from the conventions of mainstream fashion. Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p> -->
                           <dl class="row">
                              <dt class="col-sm-3">Number</dt>
                              <dd class="col-sm-9"><i class='bx bx-phone'></i> <?php echo $row["restaurant_number"];?></dd>
                              <dt class="col-sm-3">Email</dt>
                              <dd class="col-sm-9"><?php echo $row["restaurant_mail"];?></dd>
                              <dt class="col-sm-3">Address</dt>
                              <dd class="col-sm-9"><?php echo $row["restaurant_location"];?> </dd>
                           </dl>
                        </div>
                     </div>
                     <?php }}?>
                  </div>
                  <hr/>
                  <div class="card-body">
                     <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                           <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                              <div class="d-flex align-items-center">
                                 <div class="tab-icon"><i class='bx bx-food-menu font-18 me-1'></i>
                                 </div>
                                 <div class="tab-title"> Meal </div>
                              </div>
                           </a>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                              <div class="d-flex align-items-center">
                                 <div class="tab-icon"><i class='bx bx-shopping-bag font-18 me-1'></i>
                                 </div>
                                 <div class="tab-title">Orders</div>
                              </div>
                           </a>
                        </li>
                        <li class="nav-item" role="presentation">
                           <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
                              <div class="d-flex align-items-center">
                                 <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
                                 </div>
                                 <div class="tab-title">Reviews</div>
                              </div>
                           </a>
                        </li>
                     </ul>
                     <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                           <div class="row">
                              <div class="col">
                                 <div class="card radius-10 mb-0">
                                    <div class="card-body">
                                       <div class="d-flex align-items-center">
                                          <div>
                                             <h5 class="mb-1">Meals</h5>
                                          </div>
                                          <div class="ms-auto">
                                             <!-- <a href="javscript:;" class="btn btn-primary btn-sm radius-30">View All Products</a> -->
                                          </div>
                                       </div>
                                       <div class="table-responsive mt-3">
                                          <table class="table align-middle mb-0">
                                             <thead class="table-light">
                                                <tr>
                                                   <th>#</th>
                                                   <th>Meal Name</th>
                                                   <th>Meal Deal</th>
                                                   <th>Hot-Cold</th>
                                                   <th>Price</th>
                                                   <th>Actions</th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                   if(isset($_REQUEST["id"]))
                                                   {
                                                       $id = $_REQUEST["id"];
                                                       $count=1;
                                                       $result=mysqli_query($conn,"select * from tbl_meal where restaurant_id ='".$id."'");
                                                       while($row=mysqli_fetch_array($result))
                                                       {
                                                   ?> 
                                                <tr>
                                                   <td>#<?php echo $count++;?></td>
                                                   <td>
                                                      <div class="d-flex align-items-center">
                                                         <div class="recent-product-img">
                                                            <img src="<?php echo $ADMIN_PRODUCT_IMG."/".$row['meal_image'];?>" alt="">
                                                         </div>
                                                         <div class="ms-2">
                                                            <h6 class="mb-1 font-14"><?php echo $row['meal_name'];?></h6>
                                                         </div>
                                                      </div>
                                                   </td>
                                                   <td class="">
                                                      <?php if($row["meal_type"]=='1'){?>
                                                      <span class="badge bg-light-danger text-danger">No</span>
                                                      <?php }else {?>
                                                      <span class="badge bg-light-success text-success">Yes</span>
                                                      <?php }?>
                                                   </td>
                                                   <td class="">
                                                      <?php if($row["hot_cold"]=='hot'){?>
                                                      <span class="badge bg-light-danger text-danger">Hot</span>
                                                      <?php }else {?>
                                                      <span class="badge bg-light-info text-info">Cold</span>
                                                      <?php }?>
                                                   </td>
                                                   <td>£<?php echo $row['meal_price'];?></td>
                                                   <td>
                                                      <div class="d-flex order-actions">
                                                         <a href="javascript:;" class="text-primary bg-light-primary border-0"><i class='fadeIn animated bx bx-show-alt' ></i></a>
                                                         <!-- <a href="javascript:;" class="text-primary bg-light-primary border-0"><i class='bx bxs-edit' ></i></a>
                                                            <a href="javascript:;" class="ms-2 text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a> -->
                                                      </div>
                                                   </td>
                                                </tr>
                                                <?php }}?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!--end row-->
                        </div>
                        <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
							<div class="row">
								<div class="col">
									<div class="card radius-10 mb-0">
										<div class="card-body">
										<div class="d-flex align-items-center">
											<div>
												<h5 class="mb-1">Recent Orders</h5>
											</div>
											<div class="ms-auto">
												<!-- <a href="javscript:;" class="btn btn-primary btn-sm radius-30">View All Products</a> -->
											</div>
										</div>
										<div class="table-responsive mt-3">
											<table class="table align-middle mb-0">
												<thead class="table-light">
													<tr>
													<th>Order ID</th>
													<th>Order Time</th>
													<th>Total</th>
													<th>View Details</th>
													<th>Actions</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if(isset($_REQUEST["id"]))
													{
														$id = $_REQUEST["id"];
														$count=1;
														$result=mysqli_query($conn,"select * from tbl_order where restaurant_id ='".$id."' order by order_date ASC limit 1000");
														while($row=mysqli_fetch_array($result))
														{
													?> 
													<tr>
													<td>#<?php echo $row['order_id'];?></td>
													
													<td><?php echo $row['order_date']." ".$row['order_hour'];?></td>
													<td>£<?php echo $row['order_total'];?></td>

													<!-- Modal -->
													<div class="modal fade" id="orderDetailsModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
														<div class="modal-dialog" role="document">
															<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
																<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<!-- Place the list of items for the order here -->
																<ul id="orderItemsList"></ul>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
															</div>
															</div>
														</div>
													</div>
													<!-- Modal -->

													<td>
														<!--<button type="button" data-id="<?php echo $row['order_id']; ?>" class="btn btn-primary btn-sm radius-30 px-4 view-details">View Details</button>-->
														<button type="button" onclick="window.location='order_detail.php?order=<?php echo $row['order_id'];?>&restaurant=<?php echo $id;?>';"  class="btn btn-primary btn-sm radius-30 px-4">View Details</button>
													</td>
													<td>
														<div class="d-flex order-actions">
															<a href="javascript:;" class="text-primary bg-light-primary border-0"><i class='fadeIn animated bx bx-show-alt' ></i></a>
															<!-- <a href="javascript:;" class="text-primary bg-light-primary border-0"><i class='bx bxs-edit' ></i></a>
																<a href="javascript:;" class="ms-2 text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a> -->
														</div>
													</td>
													</tr>
													<?php }}?>
												</tbody>
											</table>
										</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                           <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                        </div>
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
      <script src="assets/js/bootstrap.bundle.min.js"></script>
      <!--plugins-->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
      <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
      <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      <!--app JS-->
      <script src="assets/js/app.js"></script>

	  <script>
		$(document).ready(function () {
    $('.view-details').on('click', function () {
        var orderID = $(this).data('id');
        // Use AJAX to fetch the list of items for the order
        $.ajax({
            url: 'get_order_details.php', // Replace with the actual PHP file to fetch order items
            type: 'POST',
            data: { orderID: orderID },
            success: function (data) {
                // Parse the JSON data
                var orderItems = JSON.parse(data);

                // Create an HTML table to display the order items
                var tableHtml = '<table class="table">';
                tableHtml += '<thead><tr><th>ID</th><th>Name</th><th>Image</th><th>Price</th></tr></thead>';
                tableHtml += '<tbody>';

                for (var i = 0; i < orderItems.length; i++) {
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + orderItems[i].id + '</td>';
                    tableHtml += '<td>' + orderItems[i].name + '</td>';
                    tableHtml += '<td><img src="' + orderItems[i].image + '" alt="Meal Image" style="max-width: 50px;"></td>';
                    tableHtml += '<td>£' + orderItems[i].price.toFixed(2) + '</td>';
                    tableHtml += '</tr>';
                }

                tableHtml += '</tbody></table>';

                // Populate the modal with the HTML table
                $('#orderItemsList').html(tableHtml);
                $('#orderDetailsModal').modal('show');
            }
        });
    });
});


		</script>







	  <!-- <script>
		// Get modal element
		var orderModal = document.getElementById('order-modal');

		// Click handler
		$('.view-details').click(function() {

		// Get order ID
		var orderId = $(this).data('id');
		
		// Open modal 
		orderModal.style.display = "block";

		// Load order details
		loadOrderDetails(orderId);

		});
	  </script>

	  <script>
		function loadOrderDetails(orderId) {
		$.ajax({
			url: 'get_order_details.php',
			data: {id: orderId},
			success: function(response) {
				// Insert details into modal body
			}
		});
		}
	  </script> -->
   </body>
</html>