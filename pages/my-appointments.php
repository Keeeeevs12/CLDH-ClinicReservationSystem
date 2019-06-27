<?php
    session_start();
	
	include '../sms/SMS.php';
	include '../admin/includes/unauth.php';
    include '../admin/includes/dbconnection.php';

	auth_user();
	
	$sms = new SMS();
	
	if(!$_SESSION['status'] == '1') {
		header("Location: ../verification.php");
	}
	
	$user_name = $_SESSION['full_name'];
	$user_id = $_SESSION['patients_id'];
	$user_phone = $_SESSION['contact_num'];
	
	$query_app = mysqli_query($con,"SELECT * FROM appointments WHERE patients_id = '$user_id'");
	$rows_app = mysqli_fetch_assoc($query_app);

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: http://www.cldhclinicreservation.epizy.com/login.php");
    }
	
	if (isset($_POST['can_app'])) {
        $can_id = $_POST['can_id'];
        $result = mysqli_query($con, "SELECT * FROM appointments 
										LEFT JOIN users ON appointments.patients_id = users.patients_id 
										LEFT JOIN schedules ON appointments.sched_id = schedules.sched_id
										LEFT JOIN sec_accnts ON appointments.sec_id = sec_accnts.sec_id
											WHERE appointments.app_id = '$can_id'");
        $rows = mysqli_fetch_assoc($result);
		$sched_id = $rows['sched_id'];
		$docName = $rows['doc_name'];
		
        if ($query = mysqli_query($con, "UPDATE appointments SET status = '4' WHERE appointments.app_id = '$can_id'")){
    
			$isSendSuccessfuly = $sms->sendSMS(array(
				"number"=>"$user_phone",
				"message"=>"You have cancelled your appointment with Dr. ".$docName."."
			));
	
            $transac_mes = $user_name . ' has cancelled his/her appointment.';
            $query1 = mysqli_query($con, "UPDATE schedules SET status = '0' WHERE sched_id = '$sched_id'");
            $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', '$user_name', 'Client/Patient')");
        }
        $success = '<div class="alert alert-success alert-dismissible fade show" role="alert" >
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text">The appointment has been <strong>SUCCESSFULLY</strong> canceled.</span>
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

<body id="page-top">
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
  <main>
    <div class="position-relative">
      <!-- shape Hero -->
      <section class="section section-lg section-shaped pb-250" style="height: 446px;" >
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
				<span class="text-white"><?php echo $_SESSION['full_name']; ?></span>
                </h1>
                <p class="lead  text-white">This is where you can see your transaction history.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- 1st Hero Variation -->
    </div>

    <!-- Clinics -->

     <section class="section section-lg pt-lg-0 bg-secondary">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row row-grid justify-content-center" style="padding-top: 30px;">
                        <div class="col-lg-8 text-center">
                          <h2 class="display-3" style="padding-bottom: 30px;"><i class="ni ni-calendar-grid-58" aria-hidden="true"></i> Transaction History</h2>
                          </div>
                    </div>
                </div>
            </div>
           
            <div class="card bg-default shadow center" style="max-width: 1000px">
              <div class="card-header bg-transparent border-0">
                  <div class="row align-items-center">
                      <div class="col-8">
                          <h3 class="text-white mb-0">Your Appointments</h3>
                      </div>
                  </div>
              </div>
              <div class="table-responsive">
                  <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Transaction Date</th>
                        <th scope="col">Doctor's Name</th>
                        <th scope="col">Day</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Room</th>
                        <th scope="col">Action</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php
						$query_fetchapp = mysqli_query($con, "SELECT transacs.transac_datetime, appointments.app_id, appointments.status, sec_accnts.doc_name, schedules.start_time, schedules.day, schedules.end_time, schedules.room FROM appointments 
																LEFT JOIN sec_accnts ON appointments.sec_id = sec_accnts.sec_id 
																LEFT JOIN schedules ON appointments.sched_id = schedules.sched_id 
																LEFT JOIN users ON appointments.patients_id = users.patients_id 
																LEFT JOIN transacs ON appointments.app_id = transacs.app_id 
																	WHERE appointments.patients_id = '$user_id'");
						while ($rows_fetchapp = mysqli_fetch_assoc($query_fetchapp)) {
					?>
                      <tr>
                        <td>
                            <?php echo $rows_fetchapp['transac_datetime']; ?>
                        </td>
                        <td>
							<?php echo $rows_fetchapp['doc_name']; ?>
                        </td>
                        <td>
							<?php echo $rows_fetchapp['day']; ?>
                        </td>
                        <td>
							<?php echo $rows_fetchapp['start_time']; ?>
                       </td>
                        <td>
							<?php echo $rows_fetchapp['end_time']; ?>
                        </td>
                        <td>
							<?php echo $rows_fetchapp['room']; ?>
                        </td>
                        <td>
                            <button type="button" onclick="test(this.id)" id="<?php echo $rows_fetchapp['app_id']; ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#cancel" <?php if ($rows_fetchapp['status']!='0'){ echo 'disabled';}?>>Cancel Appoinment</button>
                        </td>
                        <td>
                            <?php if ($rows_fetchapp['status']=='3'){?><span class="badge badge-pill badge-danger">Declined</span><?php } ?>
                            <?php if ($rows_fetchapp['status']=='1'){?><span class="badge badge-pill badge-success">Confirmed</span><?php } ?>
                            <?php if ($rows_fetchapp['status']=='2'){?><span class="badge badge-pill badge-success">Done</span><?php } ?>
                            <?php if ($rows_fetchapp['status']=='4'){?><span class="badge badge-pill badge-warning">Canceled</span><?php } ?>
                            <?php if ($rows_fetchapp['status']=='0'){?><span class="badge badge-pill badge-default">Pending</span><?php } ?>
                        </td>
                      </tr>
						<?php } ?>
                    </tbody>
                  </table>
              </div>
          </div>
              </div>
            </div>
          </div>
        </div>
      </section>



     <!--add doctor modal-->
     <div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure you want to <strong class="text-danger">CANCEL</strong> your appointment?
            </div>
            <form method="post" action="">
            <div class="modal-footer">
              <input type="hidden" id="can_id" name="can_id" value=""/>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="can_app" class="btn btn-primary">Yes</button>
            </div>
			</form>
          </div>
        </div>
      </div>
    <!--end add doctor modal-->

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
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/popper/popper.min.js"></script>
  <script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/vendor/headroom/headroom.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.1"></script>

    <!-- Bootstrap core JavaScript -->
  <script src="../assets/vendor/jquery/jquery-scroll/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom JavaScript for this theme -->
  <script src="../assets/js/scrolling-nav.js"></script>

  <script src="../assets/js/jquery-1.11.1.min.js"></script>

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

function test(clickedID){
        document.getElementById("can_id").value = clickedID;
    }

function myFunction() {
    var input, filter, cards, cardContainer, h6, title, i;
    input = document.getElementById("myFilter");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("card");
    for (i = 0; i < cards.length; i++) {
        title = cards[i].querySelector(".card-body h6.card-title");
        if (title.innerText.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";  
        }
    }
}

  </script>
</body>

</html>