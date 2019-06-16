<?php
    session_start();
    include 'admin/includes/auth.php';
    include 'admin/includes/dbconnection.php';

    if(isset($_POST['signup'])){
        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $bday = $_POST['bday'];
        $email_add = $_POST['email_add'];
        $contact_num = $_POST['contact_num'];
        $user_type = $_POST['user_type'];
        $password = md5('secret');

        if ($query = mysqli_query($con, "INSERT INTO users (full_name, address, bday, email_add, contact_num, user_type, password) 
                                                VALUES ('$full_name', '$address', '$bday', '$email_add', '$contact_num', '$user_type', '$password')")){
            $transac_mes = $full_name . ' has registered as a ' . $user_type . '.';
            $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user) VALUES (current_timestamp(), '$transac_mes', '$full_name')");
        }
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
  <link href="./assets/img/brand/logocldh.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="./assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="./assets/css/argon.css?v=1.0.1" rel="stylesheet">
  <!-- Docs CSS -->
  <link type="text/css" href="./assets/css/docs.min.css" rel="stylesheet">
</head>

<body>
    <header class="header-global">
        <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
          <div class="container">
            <a class="navbar-brand js-scroll-trigger mr-lg-5" href="index.php">
              <p class="text-white" style="font-weight: bold; font-size: 30px;">CLDH</p>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
              <div class="navbar-collapse-header">
                <div class="row">
                  <div class="col-6 collapse-brand">
                    <a href="index.php">
                      <p class="text-primary" style="font-weight: bold; font-size: 30px;">CLDH</p>
                    </a>
                  </div>
                  <div class="col-6 collapse-close">
                      <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                          <li class="nav-item">
                              <a class="nav-link js-scroll-trigger" href="index.php">Services</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link js-scroll-trigger" href="index.php">About Us</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link js-scroll-trigger" href="index.php">Contact Us</a>
                          </li>
                        <!-- <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                              <i class="ni ni-collection d-lg-none"></i>
                              <span class="nav-link-inner--text">Examples</span>
                            </a>
                            <div class="dropdown-menu">
                              <a href="../examples/landing.php" class="dropdown-item">Landing</a>
                              <a href="../examples/profile.html" class="dropdown-item">Profile</a>
                              <a href="../examples/index.php" class="dropdown-item">Login</a>
                              <a href="../examples/register.php" class="dropdown-item">Register</a>
                            </div>
                          </li> -->
                      </ul>
                  </div>
                </div>
              </div>
              <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                  <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="index.php">Services</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="index.php">About Us</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link js-scroll-trigger" href="index.php">Contact Us</a>
                  </li>
                <!-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                      <i class="ni ni-collection d-lg-none"></i>
                      <span class="nav-link-inner--text">Examples</span>
                    </a>
                    <div class="dropdown-menu">
                      <a href="../examples/landing.php" class="dropdown-item">Landing</a>
                      <a href="../examples/profile.html" class="dropdown-item">Profile</a>
                      <a href="../examples/index.php" class="dropdown-item">Login</a>
                      <a href="../examples/register.php" class="dropdown-item">Register</a>
                    </div>
                  </li> -->
              </ul>
            </div>
            </div>
          </div>
        </nav>
      </header>
  <main>
    <section class="section section-shaped section-lg">
        <div class="shape shape-style-1 bg-gradient-default">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="container pt-lg-md">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card bg-secondary shadow border-0">
                <div class="card-header bg-white pb-0">
                  <div class="text-muted text-center mb-0">
                        <p class="text-primary" style="font-weight: bold; font-size: 20px;">CLDH Online Scheduling for Medical Appointment System</p>
                  </div>
                </div>
                <div class="card-body px-lg-5 py-lg-5">
                  <div class="text-center text-muted mb-4">
                    <small>Sign up with credentials</small>
                  </div>
                  <form role="form" action="" method="post">
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                          </div>
                          <input class="form-control"name="full_name" placeholder="Full Name" type="text" required autofocus>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                            </div>
                            <input class="form-control" name="address" placeholder="Address" type="text" required autofocus>
                          </div>
                        </div>
                       <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                          </div>
                          <input class="form-control" name="contact_num" placeholder="Contact Number" type="number" required autofocus>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="input-group input-group-alternative mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                          </div>
                          <input class="form-control" name="email_add" placeholder="Email" type="email" required autofocus>
                        </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group input-group-alternative mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                            </div>
                            <select class="form-control form-control-alternative" name="user_type" id="" required autofocus>
                                <option value="">Select User Type</option>
                                <option value="Patient">Patient</option>
                                <option value="Guardian">Guardian</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" name="bday" placeholder="Select date" type="text" required autofocus >
                            </div>
                          </div>
                      <div class="form-group">
                        <div class="input-group input-group-alternative">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                          </div>
                          <input class="form-control" name="password" placeholder="Password" type="password" required autofocus>
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" name="signup" class="btn btn-primary mt-4">Create account</button>
                      </div>
                    </form>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-12 text-center">
                  <a href="login.php" class="text-light">
                    <i class="ni ni-bold-left"></i>
                    <small>Back to login</small>
                  </a>
                </div>
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
  <script src="./assets/vendor/jquery/jquery.min.js"></script>
  <script src="./assets/vendor/popper/popper.min.js"></script>
  <script src="./assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="./assets/vendor/headroom/headroom.min.js"></script>
  <!-- Argon JS -->
  <script src="./assets/js/argon.js?v=1.0.1"></script>
  <script src="./assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
</body>

</html>