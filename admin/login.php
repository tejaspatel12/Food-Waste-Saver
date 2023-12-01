<?php
   session_start();
   include 'connection.php';
   $title = "Login";
   	if(!isset($_SESSION["admin_id"]))
	{
	    
	}
	else
	{
		echo "<script>window.location='index.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
   <title><?php echo $title; ?> - <?php echo $webname;?></title>
</head>

<body class="bg-lock-screen">
	<!-- wrapper -->
	<div class="wrapper">
		<div class="authentication-lock-screen d-flex align-items-center justify-content-center">
			<div class="card shadow-none bg-transparent">
				<div class="card-body p-md-5 text-center">

               <?php
                  if(isset($_REQUEST["btnLogin"]))
                  {
                        
                        $result = mysqli_query($conn,"select * from tbl_admin where username='admin' and password='".$_REQUEST["txtPass"]."'");
                        if(mysqli_num_rows($result)<=0)
                        {
                           ?>

                        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
									<div class="d-flex align-items-center">
										<div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
										</div>
										<div class="ms-3">
											<h6 class="mb-0 text-white">Danger Alerts</h6>
											<div class="text-white"><strong>Opps!</strong> Password was wrong</div>
										</div>
									</div>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
                           <?php
                        }
                        else
                        {
                           while($row=mysqli_fetch_array($result))
                           {
                              if($row["password"]==$_REQUEST["txtPass"])
                              {
                                    $_SESSION["admin_id"]=$row["admin_id"];
                                    $_SESSION['username']='admin';
                                    echo "<script>window.location='index.php';</script>";
                              }
                              else
                              {
                                    ?>
                           <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                              </button>
                              <strong>Oh snap!</strong> Password not found
                              </div>
                           <?php
                           break;
                              }
                           }
                        } 
                  }
               ?>
               

					<!--<h2 class="text-white"><?php echo date("h:i A");?></h2>-->
					<!--<h5 class="text-white"> <?php echo date("F j, Y");?></h5>-->
					<h2 class="text-white">01:12 PM</h2>
					<h5 class="text-white">Nov 30,2023</h5>
					
					<div class="">
						<img src="assets/images/icons/user.png" class="mt-5" width="120" alt="" />
					</div>
					<p class="mt-2 text-white">Administrator</p>
               <form method="post">
					<div class="mb-3 mt-3">
						<input type="password" name="txtPass" class="form-control" placeholder="Password" />
					</div>
					<div class="d-grid">
						<button type="submit" name="btnLogin" class="btn btn-white">Login</button>
					</div>
               </form>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
</body>

</html>