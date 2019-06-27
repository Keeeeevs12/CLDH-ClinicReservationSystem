<?php
    session_start();
    include '../includes/unauth.php';
    include '../includes/dbconnection.php';
    auth_sec();
    
    
	$sec_name = $_SESSION['sec_name'];
    $sec_id = $_SESSION['sec_id'];
	
	$query_fetch = mysqli_query($con,"SELECT * FROM sec_accnts LEFT JOIN clinic ON sec_accnts.clinic_id = clinic.clinic_id WHERE sec_accnts.sec_id LIKE '$sec_id'");
	$rows_fetch = mysqli_fetch_assoc($query_fetch);
	
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: http://www.cldhclinicreservation.epizy.com/login.php");
    }

    if (isset($_POST['sec_edit'])) {
        $n_full_name = $_POST['n_full_name'];
        $n_email_add = $_POST['n_email_add'];
        $n_contact_num = $_POST['n_contact_num'];
        $n_password = md5($_POST['n_password']);
        $n_c_password = md5($_POST['n_c_password']);
		
        if ($n_password == $n_c_password) {
            if ($query = mysqli_query($con, "UPDATE sec_accnts SET sec_name = '$n_full_name', email_add = '$n_email_add', contact_num = '$n_contact_num', password = '$n_password' WHERE sec_id = '$sec_id'")){
                $_SESSION['contact_num']=$n_contact_num;
                $_SESSION['sec_name']=$n_full_name;
                $sec_name = $_SESSION['sec_name'];
                $_SESSION['email_add']=$n_email_add;
                $transac_mes = $sec_name . ' has edited his/her informations.';
                $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', '$sec_name', 'Secretary')");
            }
            $success = '<div class="alert alert-success alert-dismissible fade show" role="alert" >
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text">You have <strong>SUCCESSFULLY</strong> edited your informations.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
        }
        else {
             $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert" >
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text"><strong>ERROR!</strong> Mismatched password.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
        }
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
              <a href="./index-sec.php">
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
                          <i class="ni ni-bullet-list-67 text-red"></i> Pending Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./accepted-appointments.php">
                          <i class="ni ni-bullet-list-67 text-primary"></i> Accepted Appointments
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">User profile</a>
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
                          <a href="secretary/profile.php" class="dropdown-item">
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
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 300px; background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-12 col-md-10">
            <h1 class="display-2 text-white">Hello <?php echo $_SESSION['sec_name'];?></h1>
            <p class="text-white mt-0 mb-0">This is your profile page. You can change your informations here.</p>
            <?php echo $success; echo $error; ?>
          </div>
        </div>
      </div>
    </div>  
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-10 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form action="" method="post">
                <h6 class="heading-small text-muted mb-4">Secretary information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="form-group">
                        <label class="form-control-label" for="">Full Name:</label>
                        <input type="text" name="n_full_name" id="" class="form-control form-control-alternative"  value="<?php echo $_SESSION['sec_name'];?>" required autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Contact Number:</label>
                        <input type="text" name="n_contact_num" id="" class="form-control form-control-alternative"  value="<?php echo $_SESSION['contact_num'];?>" required autofocus>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Email Address:</label>
                        <input type="email" name="n_email_add" id="" class="form-control form-control-alternative" value="<?php echo $_SESSION['email_add'];?>" required autofocus>
                      </div>
                    </div>
                    </div>
                    <hr class="my-4" />
                <!-- Password -->
                <h6 class="heading-small text-muted mb-4">Change Password</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Password</label>
                        <input type="password" name="n_password" id="" class="form-control form-control-alternative" placeholder="******" required autofocus>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="">Confirm Password</label>
                        <input type="password" name="n_c_password" id="" class="form-control form-control-alternative" placeholder="******" required autofocus>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                    <div class="modal-footer">
                      <button type="submit" name="sec_edit" class="btn btn-success">Save Changes</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-8">
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
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>

  <script>
        window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
}, 4000);
    </script>
</body>

</html>