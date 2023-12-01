<?php
    session_start();
    include '../admin/connection.php';
    $title = "Add Surplus Food";
    $code = "add_surplus_food";
    $status = "1";
    if (!isset($_SESSION["restaurant_id"])) {
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
    <title><?php echo $title; ?> - <?php echo $webname; ?></title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->

        <?php include 'sidebar.php'; ?>

        <!--end sidebar wrapper -->
        <!--start header -->

        <?php include 'header.php'; ?>

        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><?php echo $title; ?></div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add <?php echo $title; ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="row">
                    <div class="col">
                        
                        <?php
                            if(isset($_REQUEST["BtnSave"]))
                            {
                                $date = date('Y-m-d');
                               $result=mysqli_query($conn,"insert into tbl_surplus_meals (restaurant_id,meal_id,surplus_quantity,surplus_total_quantity,surplus_date) 
                                values ('".$_REQUEST['restaurant_id']."','".$_REQUEST['meal_id']."','".$_REQUEST['quantity']."','".$_REQUEST['quantity']."','".$date."')") or die(mysqli_error($conn));
                                if($result=true)
                                {   
                                    ?><div class="alert alert-success mb-2" role="alert">
                                    <strong>Well done!</strong> <?php $title; ?> has successfully added.
                                    </div><?php
                                        echo "<script>window.location='surplus_food.php';</script>";
                                }
                                else
                                {
                                    echo Error;
                                }
                            }
                        ?>
                        <hr />
                        <div class="card">
                            <div class="card-body">
                                <div class="p-4 border rounded">
                                    <form class="row g-3 needs-validation" novalidate method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Select Restaurant</label>
                                            <select class="form-select" id="restaurant_id" name="restaurant_id" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                                $result = mysqli_query($conn, "select * from tbl_restaurant");
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                    <option value="<?php echo $row["restaurant_id"]; ?>"><?php echo $row["restaurant_name"]; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the restaurant.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Select Meal</label>
                                            <select class="form-select" id="meal_id" name="meal_id" required>
                                                <option selected disabled value="">Choose Meal...</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the meal.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Surplus Quantity</label>
                                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                                            <div class="invalid-feedback">
                                                Please enter the quantity.
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit" name="BtnSave">Save</button>
                                        </div>
                                    </form>
                                </div>
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

        <?php include 'footer.php'; ?>

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

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    <script>
        // Add an event listener to the restaurant select dropdown
        $(document).ready(function () {
            $('#restaurant_id').change(function () {
                var restaurantId = $(this).val();
    
                // Make an AJAX request to get_meals.php with the selected restaurant ID
                $.ajax({
                    type: 'POST',
                    url: 'include/get_meals.php',
                    data: { restaurant_id: restaurantId },
                    success: function (response) {
                        // Update the meal select dropdown with the retrieved meal options
                        $('#meal_id').html(response);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#surplusForm').submit(function (e) {
                e.preventDefault();

                // Check if the form is valid
                if (this.checkValidity() === false) {
                    e.stopPropagation();
                } else {
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: 'include/add_surplus_food.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            console.log(response);
                            // You can handle the response here (e.g., show a success message)
                            alert('Surplus Food added successfully!');
                        },
                        error: function (error) {
                            console.log(error);
                            alert('Error adding surplus food: ' + response.error);
                            // Handle errors
                        }
                    });
                }

                // Mark the form as validated
                $(this).addClass('was-validated');
            });
        });
    </script>



    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function () {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });
    </script>
    <!--app JS-->
    <script src="../admin/assets/js/app.js"></script>
</body>

</html>
