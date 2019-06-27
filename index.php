<?php
    session_start();
    include 'admin/includes/auth.php';
    include 'admin/includes/dbconnection.php';
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

  <style type="text/css" rel="stylesheet">
    .back-to-top {
    cursor: pointer;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display:none;
}
  </style>
</head>

<body id="page-top">
  <header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger mr-lg-5" href="#page-top">
          <p class="text-white" style="font-weight: bold; font-size: 30px;"><img src="./assets/img/brand/logocldh-1.png" style="height: 50px; width: 50px;"> CLDH</p>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="index.php">
                  <p class="text-primary" style="font-weight: bold; font-size: 30px;"><img src="./assets/img/brand/logocldh-1.png" style="height: 50px; width: 50px;"> CLDH</p>
                </a>
              </div>
              <div class="col-6 collapse-close">
                  <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="#services">Services</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
                      </li>
                    <!-- <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                          <i class="ni ni-collection d-lg-none"></i>
                          <span class="nav-link-inner--text">Examples</span>
                        </a>
                        <div class="dropdown-menu">
                          <a href="../examples/landing.php" class="dropdown-item">Landing</a>
                          <a href="../examples/profile.html" class="dropdown-item">Profile</a>
                          <a href="../examples/login.php" class="dropdown-item">Login</a>
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
                  <a class="nav-link js-scroll-trigger" href="#services">Services</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
              </li>
            <!-- <li class="nav-item dropdown">
                <a href="#" class="nav-link" data-toggle="dropdown" href="#" role="button">
                  <i class="ni ni-collection d-lg-none"></i>
                  <span class="nav-link-inner--text">Examples</span>
                </a>
                <div class="dropdown-menu">
                  <a href="../examples/landing.php" class="dropdown-item">Landing</a>
                  <a href="../examples/profile.html" class="dropdown-item">Profile</a>
                  <a href="../examples/login.php" class="dropdown-item">Login</a>
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
    <div class="position-relative">
      <!-- shape Hero -->
      <section class="section section-lg section-shaped pb-250">
        <div class="shape shape-style-1 shape-default">
          <span></span>
          <span></span>
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
            <div class="row">
              <div class="col-lg-8">
                <h1 class="display-3  text-white">WELCOME!
                  <span class="text-white">Central Luzon Doctor's Hospital</span>
                </h1>
                <p class="lead  text-white">This is the online scheduling of medical appointment of CLDH.</p>
                <div class="btn-wrapper">
                  <a href="login.php" class="btn btn-white btn-icon mb-3 mb-sm-0">
                    <span class="btn-inner--icon"><i class="ni ni-book-bookmark"></i></span>
                    <span class="btn-inner--text">Set an <span style="font-weight: bold;"> APPOINMENT</span>.</span>
                  </a>
                </div>
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
      <!-- 1st Hero Variation -->
    </div>
    <section class="section section-lg pt-lg-0 mt--200">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="card bg-gradient-default shadow-lg border-0">
              <div class="p-5">
                <div class="row align-items-center">
                  <div class="col-lg-10">
                    <h3 class="text-white">According to:</h3>
                    <blockquote class="blockquote">
                      <p class="mb-0 text-white" style="font-size: 25px">Just as a battlefield is haloed by noble deeds, we dedicate this piece of land to the continuing battle against diseases and infirmity.</p>
                      <footer class="blockquote-footer text-white">Dr. Constante D. Quirino
                        <cite title="Source Title">- Late Presidents & Chairman of the Board</cite>
                      </footer>
                    </blockquote>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services -->

    <section class="section section-lg pt-lg-0" id="services">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-12">
                  <div class="row row-grid justify-content-center">
                      <div class="col-lg-8 text-center">
                        <h2 class="display-3">Why Choose Us?</h2>
                        </div>
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="row row-grid">
              <div class="col-lg-4">
                <div class="card card-lift--hover shadow border-0">
                  <div class="card-body py-5">
                    <img src="./assets/img/theme/choose-1.jpg" class="img-center img-fluid shadow shadow-lg--hover" >
                    <br>
                    <h6 class="text-primary text-uppercase">Dietary Services</h6>
                    <p class="description mt-3">Central Luzon Doctors' Hospital is looking forward to better services, so Central Luzon Doctors' Hospital have dietary services.</p>
                    <div>
                  </div>
                </div>
              </div>
              </div>
              <div class="col-lg-4">
                  <div class="card card-lift--hover shadow border-0">
                    <div class="card-body py-5">
                      <img src="./assets/img/theme/choose-2.jpg" class="img-center img-fluid shadow shadow-lg--hover" >
                      <br>
                      <h6 class="text-primary text-uppercase">Consultation Fee</h6>
                      <p class="description mt-3">For the patients, Central Luzon Doctors' Hospital have lower price consultaion fee for only 50 pesos you can now avail consultaion.</p>
                      <div>
                    </div>
                  </div>
                </div>
                </div>
                <div class="col-lg-4">
                <div class="card card-lift--hover shadow border-0">
                  <div class="card-body py-5">
                    <img src="./assets/img/theme/choose-3.jpg" class="img-center img-fluid shadow shadow-lg--hover" >
                    <br>
                    <h6 class="text-primary text-uppercase">Improvements</h6>
                    <p class="description mt-3">Clinics of Central Luzon Doctors' Hospital have now appointment reservation so that you can now choose your own appointment and also you can see the availability of the doctors.</p>
                    <div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-lg pt-lg-0">
        <div class="container">
            <div class="row justify-content-left">
                <div class="col-lg-12">
                    <div class="row row-grid justify-content-center">
                        <div class="col-lg-8 text-center">
                          <h2 class="display-3">HOSPITAL RULES AND POLICIES</h2>
                          </div>
          <div class="row justify-content-center">
              <div class="col-lg-12">
                  <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">SMOKING</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">APPLIANCES</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">NO SMALL CHILDREN</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false">SERVICES</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false">INFORMATION</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                          <h6 class="text-primary text-uppercase">Smoking is forbidden</h6>
                          <p class="description">Smoking is not allowed anywhere within CLDH. This means that no one should smoke inside or outside the rooms, in the parking lot, in the gymnasium, canteen, or anywhere else within the hospital campus. We expect both patients and guests to abide by this policy.</p>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                          <h6 class="text-primary text-uppercase">ELECTRONIC APPLIANCES</h6>
                          <p class="description">Please consult the nurse on duty for permission before using any electronic appliances (some electronic devices may not be used within the hospital). To avoid inconveniencing other patients and staff, please use headphones when using audio appliances.</p>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                          <h6 class="text-primary text-uppercase">NO SMALL CHILDREN PLEASE!</h6>
                          <p class="description">Unless the child is a patient, no minor below the age of seven (7) years will be allowed entry into the patient rooms. This prohibition is for the child's safety. However, the child may be allowed to go within safer areas of the hospital but accompanied by an adult.</p>
                          <p class="description"><span style="font-weight: bold;">VIOLATORS: </span>Patients who do not obey the rules of the hospital may be discharged. Visitors who do not obey the rules will be asked to leave the hospital premises. We appreciate your cooperation and understanding in these matters.</p>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                          <h6 class="text-primary text-uppercase">COUNSELLING AND CONSULTATION SERVICES</h6>
                          <p class="description">In order to protect patient privacy, we ask that patients select a family member or (members) to receive information and consult with doctors regarding your treatment.</p>
                          <p class="description">Doctors and nurses will give thorough explanations of your illness, diagnostic tests, and treatment, but should you have any questions or concerns, additional consultation is available.</p>
                          <p class="description">For matters related to hospital life, financial concerns regarding your treatment, the social welfare system, the public healthcare system, and post-discharge concerns (rehabilitation, etc.), specialist caseworkers and social rehabilitation counsellors are available for consultation. Please don't hesitate to request a meeting with a counsellor. The clinics of the various specialists are found in the Medical Arts building.</p>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                          <h6 class="text-primary text-uppercase">Admitting Information</h6>
                          <p class="description">Please direct all questions regarding the contents of your bill to the Billing Service Assistants. For payment, please contact the Cashier. Payments are accepted only by the Cashier beside Billing Services or at the Business Center. Payment may be made by cash or by credit cards(Visa, Mastercard, American Express and Diners Club or JCB International)</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </div>
      </section>

      <section class="section section-lg bg-gradient-default" style="padding-top: 0px;">
          <div class="container pt-lg">
            <div class="row text-center justify-content-center">
              <div class="col-lg-10">
                <h2 class="display-3 text-white">Board of Directors</h2>
              </div>
            </div>
            <div class="row row-grid mt-5">
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Mr. Augusto Palisoc Jr.</h5>
                <p class="text-white mt-3">Chairman of the Board</p>
              </div>
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Mr. Reymundo S. Cochangco</h5>
                <p class="text-white mt-3">Treasurer</p>
              </div>
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Atty. Ricardo Pilares, III</h5>
                <p class="text-white mt-3">Corporate Secretary</p>
              </div>
            </div>
            <div class="row row-grid mt-5">
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Dr. Maria Lourdes Kipping</h5>
                <p class="text-white mt-3">Assistant Corp. Sec</p>
              </div>
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Mr. Jose Noel Dela Paz</h5>
                <p class="text-white mt-3">Member</p>
              </div>
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Mr. Ricardo S. Pascua</h5>
                <p class="text-white mt-3">Member</p>
              </div>
            </div>
            <div class="row row-grid mt-5">
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Dr. Ferdinand Francis Ma. D.L. Cid</h5>
                <p class="text-white mt-3">Member / CEO & President</p>
              </div>
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Dr. John Paul Cadaing</h5>
                <p class="text-white mt-3">Member</p>
              </div>
              <div class="col-lg-4">
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-single-02 text-primary"></i>
                </div>
                <h5 class="text-white mt-3">Dr. Dorcas N. Lumba</h5>
                <p class="text-white mt-3">Member</p>
              </div>
            </div>
          </div>
        </section>

    <!-- end Services Section -->

    <!-- About Us -->

        <section class="section bg-secondary" id="about">
            <div class="container">
              <div class="row row-grid align-items-center">
                <div class="col-md-6">
                  <div class="card bg-default shadow border-0">
                    <img src="./assets/img/theme/history.png" class="card-img-top">
                    <blockquote class="card-blockquote">
                      <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="svg-bg">
                        <polygon points="0,52 583,95 0,95" class="fill-default" />
                        <polygon points="0,42 583,95 683,0 0,95" opacity=".2" class="fill-default" />
                      </svg>
                      <h4 class="display-3 font-weight-bold text-white">CLDH HISTORY</h4>
                      <blockquote class="blockquote">
                          <p class="mb-0 text-white" style="font-size: 25px">Just as a battlefield is haloed by noble deeds, we dedicate this piece of land to the continuing battle against diseases and infirmity.</p>
                          <footer class="blockquote-footer text-white">Dr. Constante D. Quirino
                            <cite title="Source Title">- Late Presidents & Chairman of the Board</cite>
                          </footer>
                        </blockquote>
                    </blockquote>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="pl-md-5">
                    <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle mb-5">
                      <i class="fa fa-hospital-o" aria-hidden="true"></i>
                    </div>
                    <h3>MedArt History</h3>
                    <p class="lead">Central Luzon Doctors' Hospital is a private 175-bed tertiary-level training hospital located along Hospital Drive, Barangay San Vicente, Tarlac City, Tarlac, Philippines. CLDH is accredited by the Department of Health (DOH) and by the Philippine Health Insurance Corporation (PhilHealth).
                    CLDH is a proud member of the Private Hospitals Association of the Philippines (PHAP) and the Philippine Hospital Association (PHA), and recently the Institute for Healthcare Improvement (IHI).</p>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <section class="section pb-0 bg-gradient-primary">
            <div class="container">
              <div class="row row-grid align-items-center">
                <div class="col-md-6 order-lg-2 ml-lg-auto">
                  <div class="position-relative pl-md-5">
                    <img src="./assets/img/ill/med.svg" class="img-center img-fluid">
                  </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                  <div class="d-flex px-3">
                    <div>
                    </div>
                    <div class="pl-4">
                      <h4 class="display-3 text-white">Mission and Vision</h4>
                    </div>
                  </div>
                  <div class="card shadow shadow-lg--hover mt-5">
                    <div class="card-body">
                      <div class="d-flex px-3">
                        <div>
                          <div class="icon icon-shape bg-gradient-default rounded-circle text-white">
                            <i class="fa fa-dot-circle-o" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="pl-4">
                          <h5 class="title text-primary">Our Mission</h5>
                          <p>To provide superior personalized medical services with compassion to the community.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card shadow shadow-lg--hover mt-5">
                    <div class="card-body">
                      <div class="d-flex px-3">
                        <div>
                          <div class="icon icon-shape bg-gradient-default rounded-circle text-white">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                          </div>
                        </div>
                        <div class="pl-4">
                          <h5 class="title text-primary">Our Vision</h5>
                          <p>The leading medical center providing excellent patient experience, medical training and research in Central Luzon.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- SVG separator -->
            <div class="separator separator-bottom separator-skew zindex-100">
              <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
              </svg>
            </div>
          </section>

          <section class="section section-lg">
            <div class="container">
              <div class="row justify-content-center text-center mb-lg">
                <div class="col-lg-8">
                  <h2 class="display-3">CLDH Top Managers</h2>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="px-4">
                    <img src="./assets/img/theme/tm-1.jpg" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
                    <div class="pt-4 text-center">
                      <h5 class="title">
                        <span class="d-block mb-1">Dr. Ferdinand Francis</span>
                        <small class="h6 text-muted">CEO / President</small>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="px-4">
                    <img src="./assets/img/theme/tm-2.jpg" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
                    <div class="pt-4 text-center">
                      <h5 class="title">
                        <span class="d-block mb-1">Robert Caracas</span>
                        <small class="h6 text-muted">Chief Finance Officer</small>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="px-4">
                    <img src="./assets/img/theme/tm-3.png" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
                    <div class="pt-4 text-center">
                      <h5 class="title">
                        <span class="d-block mb-1">Dr. Godofredo V. Dungca III</span>
                        <small class="h6 text-muted">Medical Director</small>
                      </h5>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-3 mb-lg-0">
                  <div class="px-4">
                    <img src="./assets/img/theme/tm-4.jpg" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
                    <div class="pt-4 text-center">
                      <h5 class="title">
                        <span class="d-block mb-1">Christian D. Baron</span>
                        <small class="h6 text-muted">HRMD Director</small>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

    <!-- end About US -->

    <!-- Contacts -->

    <section class="section section-lg" id="contact">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-lg-12">
                  <h2 class="display-3 text-black"><i class="ni ni-square-pin text-black"></i> Find us Here</h2>
                </div>
              </div>
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

    <!-- end Contacts -->
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="fa fa-chevron-up"></span></a>

  </main>
  <footer class="footer has-cards">
    <div class="container">
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

    <!-- Bootstrap core JavaScript -->
  <script src="./assets/vendor/jquery/jquery-scroll/jquery.min.js"></script>
  <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="./assets/js/scrolling-nav.js"></script>

  <script src="./assets/js/jquery-1.11.1.min.js"></script>

  <script>
    $(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

});
  </script>
</body>

</html>