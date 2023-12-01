<?php
   session_start();
   include '../admin/connection.php';
   $title = "Login";
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
    <title><?php echo $title; ?> - <?php echo $webname;?></title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<div class="authentication-header" style="background:#f8f9fe"></div>
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						
						
						<div class="card">
							<div class="card-body">
								<div class="p-4 rounded">
								    
								    <?php
                                    if(isset($_REQUEST["btnLogin"]))
                                    {
                                        
                                        $result = mysqli_query($conn,"select * from tbl_foodbank where foodbank_mail='".$_REQUEST["txtUser"]."' and foodbank_password='".$_REQUEST["txtPass"]."'");
                                        if(mysqli_num_rows($result)<=0)
                                        {
                                            ?>
                                            <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>Opps!</strong> UserName or password not found
                                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            while($row=mysqli_fetch_array($result))
                                            {
                                                if($row["foodbank_mail"]==$_REQUEST["txtUser"] && $row["foodbank_password"]==$_REQUEST["txtPass"])
                                                {
                                                    $_SESSION["foodbank_id"]=$row["foodbank_id"];
                                                    $_SESSION['foodbank_name']=$row['foodbank_name'];
                                                    echo "<script>window.location='index.php';</script>";
                                                }
                                                else
                                                {
                                                    ?>
                                            <div class="alert bg-danger alert-icon-left alert-dismissible mb-2" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong>Oh snap!</strong> User Name or password not found
                                                </div>
                                            <?php
                                            break;
                                                }
                                            }
                                        } 
                                    }
                                ?>
                                
								    <div class="mb-4 text-center">
            							<img src="../admin/assets/images/logo-img_bank.png" width="180" alt="" />
            						</div>
									<div class="text-center">
										<h3 class="">Sign in</h3>
										
									</div>
									
									<div class="form-body">
										<form class="row g-3" method="post">
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label">Email Address</label>
												<input type="email" class="form-control" name="txtUser" placeholder="Email Address">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label">Enter Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" class="form-control border-end-0" name="txtPass" placeholder="Enter Password"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-check form-switch">
													<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
													<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
												</div>
											</div>
											<div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">Forgot Password ?</a>
											</div>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" name="btnLogin" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="../admin/assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="../admin/assets/js/jquery.min.js"></script>
	<script src="../admin/assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="../admin/assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="../admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	<!--app JS-->
	<script src="../admin/assets/js/app.js"></script>
</body>

</html>