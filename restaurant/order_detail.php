<?php
   session_start();
   include '../admin/connection.php';
   $title = "Order Details";
   $code = "order_details";
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
               <div class="card">
                  <div class="row g-0">
                     <?php
                        if(isset($_REQUEST["order"]))
                        {
                        	$id = $_REQUEST["order"];
                            $result=mysqli_query($conn,"select * from tbl_order where order_id='".$id."'");
                            while($row=mysqli_fetch_array($result))
                            {
                            ?> 
                     <div class="col-md-12">
                        <div class="card-body">
                           <div>
                              <img src="../admin/assets/images/logo-icon.png" class="logo-icon" alt="logo icon"    >
                           </div>
                           <br>
                           <h4 class="card-title">#<?php echo $id?></h4>
                           <div class="mb-3">
                              <!-- <span class="price h4">$100</span>  -->
                              <!-- <span class="text-muted">/per kg</span>  -->
                           </div>
                           <!-- <p class="card-text fs-6">Virgil Abloh’s Off-White is a streetwear-inspired collection that continues to break away from the conventions of mainstream fashion. Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p> -->
                           <dl class="row">
                              <dt class="col-sm-3">Order Amount</dt>
                              <dd class="col-sm-9">£<?php echo $row["order_total"];?></dd>
                              <dt class="col-sm-3">Date</dt>
                              <dd class="col-sm-9"><?php echo $row["order_date"];?></dd>
                              <dt class="col-sm-3">Time</dt>
                              <dd class="col-sm-9"><?php echo $row["order_hour"];?> </dd>
                           </dl>
                        </div>
                     </div>
                     <?php }}?>
                  </div>
                  <hr/>
                  <div class="card-body">
                     <div class="row">
                        <div class="col">
                           <div class="card radius-10 mb-0">
                              <div class="card-body">
                                 <div class="d-flex align-items-center">
                                    <div>
                                       <h5 class="mb-1">Orders</h5>
                                    </div>
                                    <div class="ms-auto">
                                       <a href="javscript:;" class="btn btn-primary btn-sm radius-30">View All Orders</a>
                                    </div>
                                 </div>
                                 <div class="table-responsive mt-3">
                                    <table class="table align-middle mb-0">
                                       <thead class="table-light">
                                          <tr>
                                             <th>#</th>
                                             <th>Meal Name</th>
                                             <th>Quantity</th>
                                             <th>Price</th>
                                             <th>Total</th>
                                             <th>Actions</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
                                             if(isset($_REQUEST["order"], $_SESSION["restaurant_id"]))
                                             {
                                                 $id = $_REQUEST["order"];
                                                 $restaurant = $_SESSION["restaurant_id"];
                                             
                                                 $count=1;
                                                 $total_of_all = 0;
                                             
                                                 $result=mysqli_query($conn,"SELECT m.meal_id, m.meal_name, m.meal_image, od.od_price, od.od_quantity
                                                 FROM tbl_order_detail AS od 
                                                 LEFT JOIN tbl_meal AS m ON m.meal_id = od.meal_id 
                                                 WHERE od.order_id = '".$id."'");
                                                 while($row=mysqli_fetch_array($result))
                                                 {
                                             ?> 
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
                                             <td><?php echo $row['od_quantity'];?></td>
                                             <td>£<?php echo $row['od_price'];?></td>
                                             <td>£<?php echo $total = $row['od_price'] * $row['od_quantity'];?></td>
                                             
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
                                       <thead class="table-light">
                                          <tr>
                                             <th>#</th>
                                             <th>Meal Name</th>
                                             <th>Quantity</th>
                                             <th>Price</th>
                                             <th>Total</th>
                                             <th>Actions</th>
                                          </tr>
                                       </thead>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--end row-->
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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!--app JS-->
      <script src="../admin/assets/js/app.js"></script>
   </body>
</html>