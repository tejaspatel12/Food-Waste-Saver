<?php
    session_start();
    include 'connection.php';
    $title = "Restaurent";
    $code = "restaurent";
    $status = "1";
    if (!isset($_SESSION["admin_id"])) {
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
    <link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
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

                        <hr />
                        <div class="card">
                            <div class="card-body">
                                <div class="p-4 border rounded">
                                    <form class="row g-3 needs-validation" novalidate id="restaurantForm" action="add_restaurant.php" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Restaurant Name</label>
                                            <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" required>
                                            <div class="invalid-feedback">
                                                Please enter the restaurant name.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Restaurant Image</label>
                                            <input type="file" class="form-control" id="restaurant_image" name="restaurant_image" accept="image/*" required>
                                            <div class="invalid-feedback">
                                                Please choose a restaurant image.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="validationCustom02" class="form-label">Contact Number</label>
                                            <input type="number" class="form-control" id="restaurant_number" name="restaurant_number" required>
                                            <div class="invalid-feedback">
                                                Please enter the contact number.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="validationCustom01" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="restaurant_mail" name="restaurant_mail" required>
                                            <div class="invalid-feedback">
                                                Please enter a valid email address.
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="validationCustom02" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="restaurant_password" name="restaurant_password" required>
                                            <div class="invalid-feedback">
                                                Please enter a password.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom03" class="form-label">City</label>
                                            <select class="form-select" id="city_id" name="city_id" required>
                                                <option selected disabled value="">Choose...</option>
                                                <?php
                                                $result = mysqli_query($conn, "select * from tbl_city");
                                                while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                    <option value="<?php echo $row["city_id"]; ?>"><?php echo $row["city_name"]; ?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select a city.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom05" class="form-label">Location</label>
                                            <input type="text" class="form-control" id="restaurant_location" name="restaurant_location" required>
                                            <div class="invalid-feedback">
                                                Please enter the restaurant location.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom01" class="form-label">Latitude</label>
                                            <input type="text" class="form-control" id="restaurant_latitude" name="restaurant_latitude" required>
                                            <div class="invalid-feedback">
                                                Please enter the latitude.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Longitude</label>
                                            <input type="text" class="form-control" id="restaurant_longitude" name="restaurant_longitude" required>
                                            <div class="invalid-feedback">
                                                Please enter the longitude.
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="validationCustom02" class="form-label">Veg/Non-Veg</label>
                                            <select class="form-select" id="veg_nonveg" name="veg_nonveg" required>
                                                <option selected disabled value="">Choose...</option>
                                                <option value="Vegetarian">Vegetarian</option>
                                                <option value="Non-Vegetarian">Non-Vegetarian</option>
                                                <option value="Both">Both</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select the restaurant type.
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Save</button>
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
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#restaurantForm').submit(function (e) {
                e.preventDefault();

                // Check if the form is valid
                if (this.checkValidity() === false) {
                    e.stopPropagation();
                } else {
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: 'include/add_restaurant.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            console.log(response);
                            // You can handle the response here (e.g., show a success message)
                            alert('Restaurant added successfully!');
                        },
                        error: function (error) {
                            console.log(error);
                            alert('Error adding restaurant: ' + response.error);
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
    <script src="assets/js/app.js"></script>
</body>

</html>
