<?php
    session_start();
	
	include '../../sms/SMS.php';
    include '../includes/unauth.php';
    include '../includes/dbconnection.php';
	
    auth_sec();
	
	$sms = new SMS();
    
    $sec_name = $_SESSION['sec_name'];
    $sec_id = $_SESSION['sec_id'];
	
	$query_fetch = mysqli_query($con,"SELECT * FROM sec_accnts LEFT JOIN clinic ON sec_accnts.clinic_id = clinic.clinic_id WHERE sec_accnts.sec_id LIKE '$sec_id'");
	$rows_fetch = mysqli_fetch_assoc($query_fetch);
	
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: http://www.cldhclinicreservation.epizy.com/login.php");
    }

    if (isset($_POST['del_app'])) {
        $del_id = $_POST['del_id'];
        $result = mysqli_query($con, "SELECT * FROM appointments 
										LEFT JOIN users ON appointments.patients_id = users.patients_id 
										LEFT JOIN schedules ON appointments.sched_id = schedules.sched_id
											WHERE appointments.app_id = '$del_id'");
        $rows = mysqli_fetch_assoc($result);
		$sched_id = $rows['sched_id'];
        $phone = $rows['contact_num'];
		
        if ($query = mysqli_query($con, "UPDATE appointments SET status = '3' WHERE appointments.app_id = '$del_id'")){
        
            $isSendSuccessfuly = $sms->sendSMS(array(
				"number"=>"$phone",
				"message"=>"Your appointment with Dr. ".$_SESSION['doc_name']." has been declined."
			));
        
            $transac_mes = $sec_name . ' has declined '.$rows['full_name'].' appointment.';
            $query1 = mysqli_query($con, "UPDATE schedules SET status = '0' WHERE sched_id = '$sched_id'");
            $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', '$sec_name', 'Secretary')");
        }
        $success = '<div class="alert alert-success alert-dismissible fade show" role="alert" >
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text">The appointment has been <strong>SUCCESSFULLY</strong> declined.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
    }

    if (isset($_POST['con_app'])) {
        $con_id = $_POST['con_id'];
        $result = mysqli_query($con, "SELECT * FROM appointments 
										LEFT JOIN users ON appointments.patients_id = users.patients_id 
										LEFT JOIN schedules ON appointments.sched_id = schedules.sched_id
											WHERE appointments.app_id = '$con_id'");
        $rows = mysqli_fetch_assoc($result);
		
		$phone = $rows['contact_num'];
		$clinicID = $_SESSION['clinic_id'];
		
		$result1 = mysqli_query($con, "SELECT * FROM clinic WHERE clinic_id = '$clinicID'");
        $rows1 = mysqli_fetch_assoc($result1);
		
        if ($query = mysqli_query($con, "UPDATE appointments SET status = '1' WHERE appointments.app_id = '$con_id'")){
            
			$isSendSuccessfuly = $sms->sendSMS(array(
				"number"=>"$phone",
				"message"=>"Your requested appointment with Dr. ".$_SESSION['doc_name']." on ".$rows['day']." ".$rows['start_time']." - ".$rows['end_time']." in ".$rows1['clinic_name']." ".$rows['room']."has been confirmed."
			));
			
			$transac_mes = $sec_name . ' has confirmed '.$rows['full_name'].' appointment.';
            $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', '$sec_name', 'Secretary')");
        }
        $success = '<div class="alert alert-success alert-dismissible fade show" role="alert" >
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text">The appointment has been <strong>SUCCESSFULLY</strong> confirmed.</span>
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
    <title>CLDH Clinic Reservation</title>
    <!-- Favicon -->
    <link href="../assets/img/brand/logocldh.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
    <!-- Datatables CSS -->
    <!-- <link type="text/css" href="./assets/css/datatables/jquery.dataTables.min.css">
    <link type="text/css" href="./assets/css/datatables/buttons.dataTables.min.css">
    <link type="text/css" href="./assets/vendor/datatables/buttons.bootstrap4.css"> -->
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
        <a class="navbar-brand pt-0" style="padding-bottom: 0px;" href="../index-sec.php">
            <!-- <img src="./assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
            <p class="text-primary" style="font-weight: bold; font-size: 38px;">SECRETARY</p>
        </a>
        <p class="text-center" style="font-weight: bold; font-size: 15px;"><?php echo $rows_fetch['clinic_name'];?></p>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="mb-0 text-sm  font-weight-bold">SECRETARY</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome!</h6>
                    </div>
                    <div class="dropdown"></div>
                    <a href="profile.php" class="dropdown-item">
                        <i class="ni ni-circle-08"></i>
                        <span>User Profile</span>
                    </a>
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
                        <a href="../index-sec.php">
                            <p class="text-primary" style="font-weight: bold; font-size: 35px;">SECRETARY</p>
                        </a>
                        <p class="text-center" style="font-weight: bold; font-size: 15px;"><?php echo $rows_fetch['clinic_name'];?></p>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index-sec.php">
                        <i class="ni ni-calendar-grid-58 text-primary"></i> Clinic Schedule
                    </a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="./examples/sec-accounts.html">
                    <i class="fas fa-calendar-check text-yellow"></i> Appointments
                  </a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="" id="navbar-default_dropdown_1" role="button" data-toggle="dropdown" aria-expanded="false" aria-controls="navbar-examples">
                        <i class="fas fa-calendar-check text-yellow"></i>
                        <span class="nav-link-text">Appointments</span>
                    </a>

                    <div class="dropdown-menu" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="./pending-appointments.php">
                                    <i class="ni ni-bullet-list-67 text-red"></i>Pending Appointments
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./accepted-appointments.php">
                                    <i class="ni ni-bullet-list-67 text-success"></i>Accepted Appointments
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">
                        <i class="ni ni-single-02 text-danger"></i> Profile
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
            <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./pending-appointments.php">Pending Appointments</a>
            <!-- User -->
            <form action="" method="post">
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">Secretary</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome!</h6>
                            </div>
                            <div class="dropdown"></div>
                            <a href="./secretary/profile.html" class="dropdown-item">
                                <i class="ni ni-circle-08"></i>
                                <span>User Profile</span>
                            </a>
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
            <div class="col">
            <?php echo $success; ?>
                <div class="card bg-default shadow">
                    <div class="card-header bg-transparent border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white mb-0">Pending Appointments</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Appointment No.</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time Schedule</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Room</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = mysqli_query($con,"SELECT users.contact_num, users.full_name, appointments.app_id, schedules.day, schedules.start_time, schedules.end_time, schedules.room, sec_accnts.doc_name FROM appointments 
															LEFT JOIN users ON appointments.patients_id = users.patients_id
															LEFT JOIN schedules ON appointments.sched_id = schedules.sched_id
															LEFT JOIN sec_accnts ON appointments.sec_id = sec_accnts.sec_id
																WHERE appointments.status = '0' AND appointments.sec_id = '$sec_id'");
                            while ($rows = mysqli_fetch_assoc($query)) {
							?>
                                <tr>
                                    <td> <?php echo $rows['app_id']; ?> </td>
                                    <td> <?php echo $rows['full_name']; ?> </td>
                                    <td> <?php echo $rows['contact_num'] ?> </td>
                                    <td> <?php echo $rows['day'] ?> </td>
                                    <td> <?php echo $rows['start_time'].' - '.$rows['end_time']; ?> </td>
                                    <td> <?php echo $rows['doc_name']; ?> </td>
                                    <td> <?php echo $rows['room']; ?> </td>
                                    <td>
                                        <button type="button" onclick="test(this.id)" id="<?php echo $rows['app_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-confirm">Confirm</button>
                                        <button type="button" onclick="test(this.id)" id="<?php echo $rows['app_id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-decline">Decline</button>
                                    </td>
                                </tr>
                            <?php }?>
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

        <!-- confirm sched modal -->
        <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Confirm Appointment</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <p>Are you sure you want to <span class="text-success" style="font-weight: bold;">CONFIRM</span> this appointment?</p>

                    </div>
                    <form method="post" action="">
                    <div class="modal-footer">
                        <input type="hidden" id="con_id" name="con_id" value=""/>
                        <button type="submit" name="con_app" class="btn btn-primary">Confirm</button>
                        <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end confirm sched modal -->

        <!-- confirm sched modal -->
        <div class="modal fade" id="modal-decline" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Decline Appointment</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <p>Are you sure you want to <span class="text-danger" style="font-weight: bold;">DECLINE</span> this appointment?</p>

                    </div>

                    <form method="post" action="">
                        <div class="modal-footer">
                            <input type="hidden" id="del_id" name="del_id" value=""/>
                            <button type="submit" name="del_app" class="btn btn-primary">Confirm</button>
                            <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- end confirm sched modal -->

    </div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script>
    function test(clickedID){
        document.getElementById("con_id").value = clickedID;
        document.getElementById("del_id").value = clickedID;
    }
</script>
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional JS -->
<script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="../assets/js/argon.js?v=1.0.0"></script>

<script>
        window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
}, 4000);
    </script>
    
<!-- Datatables JS -->
<!-- <script src="./assets/js/datatables/jquery-3.3.1.js"></script>
<script src="./assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="./assets/js/datatables/buttons.print.min.js"></script>
<script src="./assets/vendor/datatables/dataTables.bootstrap4.js"></script>
<script src="./assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
  $(document).ready(function() {
  $('#genReport').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'print'
      ]
  } );
} );
</script> -->
</body>

</html>