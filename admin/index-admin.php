<?php
    session_start();
    include 'includes/unauth.php';
    include 'includes/dbconnection.php';
    auth_admin();

    if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: http://www.cldhclinicreservation.epizy.com/login.php");
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>CLDH Clinic Reservation</title>
    <!-- Favicon -->
    <link href="./assets/img/brand/logocldh.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">
	<!-- Datatables CSS -->
	<link type="text/css" href="./assets/js/jquery.dataTables.min.css" rel="stylesheet">
	<link type="text/css" href="./assets/js/buttons.dataTables.min.css" rel="stylesheet">
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
        <a class="navbar-brand pt-0" style="padding-bottom: 0px;" href="index-admin.php">
            <!-- <img src="./assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
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
                        <a href="index-admin.php">
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
                    <a class="nav-link" href="index-admin.php">
                        <i class="ni ni-tv-2 text-primary"></i> Generate Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./examples/client-accounts.php">
                        <i class="ni ni-single-02 text-blue"></i> Client/Patient Accounts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./examples/sec-accounts.php">
                        <i class="ni ni-single-02 text-yellow"></i> Secretary Accounts
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="index-admin.php">Generate Reports</a>
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
        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card light border-primary">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Generate Reports</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table table-striped table-bordered" id="example" style="width: 100%">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Transaction</th>
                                <th scope="col">Name</th>
                                <th scope="col">User Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = mysqli_query($con,"SELECT * FROM transacs");
                            while ($rows = mysqli_fetch_assoc($query)) {
                                $split_time = explode(" ",$rows['transac_datetime']);
                                ?>
                                <tr>
                                    <td> <?php echo "$split_time[0]"; ?> </td>
                                    <td> <?php echo "$split_time[1]" ?> </td>
                                    <td> <?php echo $rows['transac_mes']; ?> </td>
                                    <td> <?php echo $rows['transac_user']; ?> </td>
                                    <td> <?php echo $rows['user_type']; ?> </td>
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
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional JS -->
<script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="./assets/js/argon.js?v=1.0.0"></script>
<!-- Datatables JS -->
<script src="./assets/js/jquery-3.3.1.js"></script>
<script src="./assets/js/jquery.dataTables.min.js"></script>
<script src="./assets/js/dataTables.buttons.min.js"></script>
<script src="./assets/js/buttons.print.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
} );
</script>
</body>

</html>