<?php
    session_start();
    include '../admin/includes/unauth.php';
    include '../admin/includes/dbconnection.php';

	auth_user();
	
	if(!$_SESSION['status'] == '1') {
		header("Location: ../verification.php");
	}
	
	$user_name = $_SESSION['full_name'];
    $user_id = $_SESSION['patients_id'];

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: http://www.cldhclinicreservation.epizy.com/login.php");
    }
	
	if (isset($_POST['user_edit'])) {
        $n_full_name = $_POST['n_full_name'];
        $n_email_add = $_POST['n_email_add'];
        $n_contact_num = $_POST['n_contact_num'];
        $n_user_type = $_POST['n_user_type'];
        $n_password = md5($_POST['n_password']);
        $n_c_password = md5($_POST['n_c_password']);
		
        if ($n_password == $n_c_password) {
            if ($query = mysqli_query($con, "UPDATE users SET full_name = '$n_full_name', email_add = '$n_email_add', contact_num = '$n_contact_num', user_type = '$n_user_type', password = '$n_password' WHERE users.patients_id = '$user_id'")){
                
				$_SESSION['contact_num']=$n_contact_num;
                $_SESSION['full_name']=$n_full_name;
                $_SESSION['email_add']=$n_email_add;
                $_SESSION['user_type']=$n_user_type;
				$user_name = $_SESSION['full_name'];
				
				$transac_mes = $user_name . ' has edited his/her informations.';
                $query1 = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', '$user_name', 'Client/Patient')");
            }
        }
         $success = '<div class="alert alert-success alert-dismissible fade show" role="alert" id="succ">
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text">You have <strong>SUCCESSFULLY</strong> edited your informations.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
        
        //else {
            // failed :(
        //}
    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Design System for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>CLDH Clinic Reservation</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/logocldh.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.1" rel="stylesheet">
  <!-- Docs CSS -->
  <link type="text/css" href="../assets/css/docs.min.css" rel="stylesheet">

  <style type="text/css" rel="stylesheet">
    .back-to-top {
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display:none;
}
    .pb-20 {
      padding-bottom: 20px;
    }
  </style>
</head>

<body>
    <header class="header-global">
        <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
          <div class="container">
            <a class="navbar-brand js-scroll-trigger mr-lg-5" href="#page-top">
              <p class="text-white" style="font-weight: bold; font-size: 30px;"><img src="../assets/img/brand/logocldh-1.png" style="height: 50px; width: 50px;"> CLDH</p>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
              <div class="navbar-collapse-header">
                <div class="row">
                  <div class="col-6 collapse-brand">
                    <a href="./client-index.html">
                      <p class="text-primary" style="font-weight: bold; font-size: 30px;"><img src="../assets/img/brand/logocldh-1.png" style="height: 50px; width: 50px;"> CLDH</p>
                    </a>
                  </div>
                  <div class="col-6 collapse-close">
                      <form action="" method="post">
                  <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./landing.php">Services</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./landing.php">About Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./profile.php">Profile</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./my-appointments.php">My Appointments</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" ><button name="logout" class="btn btn-1 btn-outline-info" type="submit">Logout</button></a>
                      </li>
                  </ul>
                  </form>
                  </div>
                </div>
              </div>
              <div class="collapse navbar-collapse" id="navbarResponsive">
              <form action="" method="post">
                  <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./landing.php">Services</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./landing.php">About Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./profile.php">Profile</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./my-appointments.php">My Appointments</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" ><button name="logout" class="btn btn-1 btn-outline-info" type="submit">Logout</button></a>
                      </li>
                  </ul>
                  </form>
            </div>
            </div>
          </div>
        </nav>
      </header>
  <main class="profile-page">
    <section class="section-profile-cover section-shaped my-0">
      <!-- Circles background -->
      <div class="shape shape-style-1 shape-primary alpha-4">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="container py-lg-md d-flex">
          <div class="col px-0">
            <div class="row" style="padding-top: 55px;">
              <div class="col-lg-12">
                <h1 class="display-3  text-white">WELCOME!
                  <span class="text-white"><?php echo $_SESSION['full_name']; ?></span>
                </h1>
                <?php echo $success; ?>
              </div>
            </div>
          </div>
        </div>
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="card card-profile shadow mt--300">
          <div class="px-4">
            <div class="row justify-content-center">
              <div class="col order-lg-3 align-self-lg-center">
                  <div class="card-body">
                      <form action="" method="post">
                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="">Full Name:</label>
                                <input type="text" id="" name="n_full_name" value="<?php echo $_SESSION['full_name'];?>" class="form-control form-control-alternative" placeholder="Joshua" required autofocus>
                              </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="">Contact Number:</label>
                                  <input type="text" name="n_contact_num" id="" value="<?php echo $_SESSION['contact_num'];?>" class="form-control form-control-alternative" placeholder="Contact Number" required autofocus>
                                </div>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="">Email Address:</label>
                                <input type="email" name="n_email_add" id="" value="<?php echo $_SESSION['email_add'];?>" class="form-control form-control-alternative" placeholder="Email" required autofocus>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label class="form-control-label">User Type:</label>
                                  <select class="form-control form-control-alternative" name="n_user_type" id="" required autofocus>
                                      <option value="">Select User Type</option>
                                      <option <?php if ($_SESSION['user_type'] == 'Patient' ) echo 'selected' ; ?> value="Patient">Patient</option>
                                      <option <?php if ($_SESSION['user_type'] == 'Guardian' ) echo 'selected' ; ?> value="Guardian">Guardian</option>
                                  </select>
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
                              <button type="submit" name="user_edit" class="btn btn-success">Save Changes</button>
                          </div>
                      </form>
                    </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer">
      <div class="container">
        <div class="row row-grid align-items-center mb-5">
          <div class="col-lg-12">
            <h3 class="text-primary font-weight-light mb-0">Let's get in touch!</h3>
            <section class="section section-lg" style="padding-top: 0px;" id="contact">
                <div class="container">
                  <div class="row row-grid align-items-center">
                    <div class="col-md-6 order-md-2">
                      <img class="img-fluid floating">
                      <div class="mapouter"><div class="gmap_canvas"><iframe width="502" height="544" id="gmap_canvas" src="https://maps.google.com/maps?q=cldh&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.bitgeeks.net/embed-google-map/">bitgeeks.net</a></div><style>.mapouter{position:relative;text-align:right;height:544px;width:502px;}.gmap_canvas {overflow:hidden;background:none!important;height:544px;width:502px;}</style></div>
                    </img>
                    </div>
                    <div class="col-md-6 order-md-1">
                      <div class="pr-md-5">
                        <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-5">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </div>
                        <h3>Contact US</h3>
                        <ul class="list-unstyled mt-5">
                          <li class="py-2">
                            <div class="d-flex align-items-center">
                              <div>
                                <div class="badge badge-circle badge-primary mr-3">
                                  <i class="ni ni-pin-3"></i>
                                </div>
                              </div>
                              <div>
                                <h6 class="mb-0">Hospital Drive, Barangay San Vicente Tarlac City, Tarlac, 2300, Philippines</h6>
                              </div>
                            </div>
                          </li>
                          <li class="py-2">
                            <div class="d-flex align-items-center">
                              <div>
                                <div class="badge badge-circle badge-primary mr-3">
                                    <i class="fa fa-phone-square" aria-hidden="true"></i>
                                </div>
                              </div>
                              <div>
                                <h6 class="mb-0">(045) 982 - 0806</h6>
                              </div>
                            </div>
                          </li>
                          <li class="py-2">
                            <div class="d-flex align-items-center">
                              <div>
                                <div class="badge badge-circle badge-primary mr-3">
                                  <i class="ni ni-email-83"></i>
                                </div>
                              </div>
                              <div>
                                <h6 class="mb-0">CRO@cldh.com.ph</h6>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
          </div>
        </div>
        <hr>
        <div class="row align-items-center justify-content-md-between">
            <div class="col-md-6">
              <div class="copyright">
                &copy; 2019
                <a href="" target="_blank">Central Luzon Doctor's Hospital - Online Scheduling for Medical Appointment System  </a>.
              </div>
            </div>
          </div>
      </div>
    </footer>
  <!-- Core -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/popper/popper.min.js"></script>
  <script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/vendor/headroom/headroom.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.1"></script>

  <script>
        window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
}, 4000);
    </script>
</body>

</html>