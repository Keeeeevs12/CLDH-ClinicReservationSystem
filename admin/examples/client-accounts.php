<?php
    session_start();
    include '../includes/unauth.php';
    include '../includes/dbconnection.php';
    auth_admin();

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: http://www.cldhclinicreservation.epizy.com/login.php");
    }
    
    if (isset($_POST['sec_delete'])) {
        $s_id = $_POST['get_id'];
        $result = mysqli_query($con, "SELECT * FROM users WHERE users.patients_id = '$s_id'");
        $rows = mysqli_fetch_assoc($result);
        $p_name = $rows['full_name'];

        if ($query = mysqli_query($con, "DELETE FROM users WHERE users.patients_id = '$s_id'")){
            $transac_mes = 'Admin has deleted Client ' . $p_name . ' account.';
            $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', 'Administrator', 'Administrator')");
        }
         $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text"><strong>You have successfully deleted '. $p_name .'.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
    }

    if (isset($_POST['sec_edit'])) {
        $s_id = $_POST['n_get_id'];
        $n_full_name = $_POST['n_full_name'];
        $n_email_add = $_POST['n_email_add'];
        $n_address = $_POST['n_address'];
        $n_bday = $_POST['n_bday'];
        $n_user_type = $_POST['n_user_type'];

        if ($query = mysqli_query($con, "UPDATE users SET full_name = '$n_full_name', address = '$n_address', bday = '$n_bday', email_add = '$n_email_add', user_type = '$n_user_type' WHERE users.patients_id = '$s_id'")){
            $transac_mes = 'Admin has edited Client ' . $n_full_name . ' informations.';
            $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', 'Administrator', 'Administrator')");
        }
         $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text"><strong>You have successfully edited '. $n_full_name .' information.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>CLDH Clinic Reservation System</title>
    <!-- Favicon -->
    <link href="../assets/img/brand/logocldh.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
</head>

<body>
<!-- Sidenav -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" style="padding-bottom: 0px;" href="../index-admin.php">
            <p class="text-primary" style="font-weight: bold; font-size: 40px;">ADMIN</p>
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="mb-0 text-sm  font-weight-bold">Admin</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <div class="dropdown"></div>
                    <a href="#!" class="dropdown-item">
                        <i class="ni ni-user-run"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="../index-admin.php">
                            <p class="text-primary" style="font-weight: bold; font-size: 40px;">ADMIN</p>
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
        
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index-admin.php">
                        <i class="ni ni-tv-2 text-primary"></i> Generate Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./client-accounts.php">
                        <i class="ni ni-single-02 text-blue"></i> Client/Patient Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./sec-accounts.php">
                        <i class="ni ni-single-02 text-yellow"></i> Secretary Accounts
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./client-accounts.php">Client / Patient Accounts</a>
            <!-- Form -->

            <!-- User -->
            <form action="" method="post">
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">ADMIN</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <div class="dropdown"></div>
                            <button name="logout" type="submit" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </button>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
        <!-- Dark table -->
        <div class="row mt-5">
            <div class="col">
            <?php echo $success; ?>
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white mb-0">Client / Patient Accounts Table</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = mysqli_query($con,"SELECT * FROM users");
                            while ($rows = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td> <?php echo $rows['patients_id']; ?> </td>
                                <td> <?php echo $rows['full_name'] ?> </td>
                                <td> <?php echo $rows['contact_num']; ?> </td>
                                <td> <?php echo $rows['email_add']; ?> </td>
                                <td> <?php echo $rows['address']; ?> </td>
                                <td> <?php echo $rows['user_type']; ?> </td>
                                <td> <?php echo $rows['bday']; ?> </td>
                                <td>
                                    <button type="button" name="edit" value="Edit" onclick="test(this.id)" id="<?php echo $rows['patients_id']; ?>" data-user-id="<?php echo $rows['patients_id']; ?>" data-full-name="<?php echo $rows['full_name']; ?>" data-email-add="<?php echo $rows['email_add']; ?>" data-address="<?php echo $rows['address']; ?>" data-user-type="<?php echo $rows['user_type']; ?>" data-bday="<?php echo $rows['bday']; ?>" class="btn btn-success btn-sm edit_data" data-toggle="modal" data-target="#modal-editUser">Edit</button>
                                    <button type="button" onclick="test(this.id)" id="<?php echo $rows['patients_id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete">Delete</button>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        &copy; 2019 <a href="" class="font-weight-bold ml-1" target="_blank">Central Luzon Doctor's Hospital Clinic Reservation System</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!--edit secretary account modal-->
    <div class="row">
        <div class="col-md-4">
            <div class="modal fade" id="modal-editUser" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h2 class="modal-title" id="modal-title-default">Edit Secretary Account:</h2>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form method="post" action="" autocomplete="off">

                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">User ID:</label>
                                        <input type="text" name="patients_id" id="patients_id" class="form-control form-control-alternative" value="" disabled autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="">Full Name:</label>
                                        <input type="text" name="n_full_name" id="n_full_name" class="form-control form-control-alternative" value="" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="">Email:</label>
                                        <input type="email" name="n_email_add" id="n_email_add" class="form-control form-control-alternative" value="" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label" for="">Address:</label>
                                        <input type="text" name="n_address" id="n_address" class="form-control form-control-alternative" value="" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">User Type:</label>
                                        <select class="form-control form-control-alternative" name="n_user_type" id="n_user_type" required autofocus>
                                            <option value="">Select User Type</option>
                                            <option value="Patient">Patient</option>
                                            <option value="Guardian">Guardian</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-control-label">Birthday:</label>
                                        <div class="input-group input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                            </div>
                                            <input class="form-control datepicker" name ="n_bday" id="n_bday" placeholder="Select date" type="text" value="">
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <input type="hidden" id="n_gets_id" name="n_get_id" value=""/>
                                    <button type="submit" name="sec_edit" id="sec_edit" class="btn btn-success mt-4">Save changes</button>
                                    <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Close</button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--end edit secretary account modal-->

<!-- delete secretary account modal -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Delete account</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">

                <p>Are you sure you want to <span class="text-danger" style="font-weight: bold;">DELETE</span> this account?</p>

            </div>
            <form action="" method="post">
            <div class="modal-footer">
                <input type="hidden" id="gets_id" name="get_id" value=""/>
                <button type="submit" name="sec_delete" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>

        <!-- end delete secretary account modal -->

    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Argon JS -->
    <script src="../assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../assets/js/argon.js?v=1.0.0"></script>
      <script>
        window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
}, 4000);
    </script>

    <script>
        function test(clickedID){
            document.getElementById("gets_id").value = clickedID;
            document.getElementById("n_gets_id").value = clickedID;
        };
		$('#modal-editUser').on('show.bs.modal', function(e) {
			var userid = $(e.relatedTarget).data('user-id');
			var fullname = $(e.relatedTarget).data('full-name');
			var emailadd = $(e.relatedTarget).data('email-add');
			var address = $(e.relatedTarget).data('address');
			var usertype = $(e.relatedTarget).data('user-type');
			var bday = $(e.relatedTarget).data('bday');
			$(e.currentTarget).find('input[name="patients_id"]').val(userid);
			$(e.currentTarget).find('input[name="n_full_name"]').val(fullname);
			$(e.currentTarget).find('input[name="n_email_add"]').val(emailadd);
			$(e.currentTarget).find('input[name="n_address"]').val(address);
			$(e.currentTarget).find('select[name="n_user_type"]').val(usertype);
			$(e.currentTarget).find('input[name="n_bday"]').val(bday);
		});
    </script>
</body>

</html>