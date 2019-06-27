<?php
    session_start();
	
	include '../sms/SMS.php';
    include '../admin/includes/unauth.php';
    include '../admin/includes/dbconnection.php';

	auth_user();
	
	if(!$_SESSION['status'] == '1') {
		header("Location: ../verification.php");
	}

	$sms = new SMS();

	$req_id = $_REQUEST['id'];
	$req_docid = $_REQUEST['docid'];
	
	$user_name = $_SESSION['full_name'];
	$user_id = $_SESSION['patients_id'];
	$user_phone = $_SESSION['contact_num'];
	
	$query_clinicname = mysqli_query($con,"SELECT * FROM clinic  WHERE clinic_id = '$req_id'");
	$rows_clinicname = mysqli_fetch_assoc($query_clinicname);

	if (isset($_POST['reserve_sched'])) {
        $sched_id = $_POST['schedule_id'];
		
		$query_fetchsched = mysqli_query($con, "SELECT * FROM schedules LEFT JOIN sec_accnts ON schedules.sec_id = sec_accnts.sec_id WHERE sched_id = '$sched_id'");
        $rows_fetchsched = mysqli_fetch_assoc($query_fetchsched);
		$secID = $rows_fetchsched['sec_id'];
		$clinicID = $rows_fetchsched['clinic_id'];
		$docNAME = $rows_fetchsched['doc_name'];
		
		$result1 = mysqli_query($con, "SELECT * FROM clinic WHERE clinic_id = '$clinicID'");
        $rows1 = mysqli_fetch_assoc($result1);
		
		if ($query_reserve = mysqli_query($con, "INSERT INTO appointments (patients_id, sec_id, sched_id, status) VALUES ('$user_id', '$secID', '$sched_id', '0')")) {
			
			$isSendSuccessfuly = $sms->sendSMS(array(
				"number"=>"$user_phone",
				"message"=>"You have requested an appointment with Dr. ".$docNAME." on ".$rows_fetchsched['day']." ".$rows_fetchsched['start_time']." - ".$rows_fetchsched['end_time']." in ".$rows1['clinic_name']." ".$rows_fetchsched['room']."."
			));
			
			$result2 = mysqli_query($con, "SELECT * FROM appointments WHERE sec_id = '$secID' AND patients_id = '$user_id' AND sched_id = '$sched_id' AND status = '0'");
			$rows2 = mysqli_fetch_assoc($result2);
			$app_ids = $rows2['app_id'];
			$query1 = mysqli_query($con, "UPDATE schedules SET status = '1' WHERE sched_id = '$sched_id'");
			$transac_mes = $user_name.' made an appointment with Dr. '.$docNAME.'.' ;
            $query = mysqli_query($con, "INSERT INTO transacs (app_id, transac_datetime, transac_mes, transac_user, user_type) VALUES ($app_ids, current_timestamp(), '$transac_mes', '$user_name', 'Client/Patient')");
		}

        $success = '<div class="alert alert-success alert-dismissible fade show" role="alert" id="succ">
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text">You have <strong>SUCCESSFULLY</strong> made your appointment.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                <span class="alert-inner--text"><strong>ATTENTION!</strong> Wait for further notice if your appointment will be declined or confirmed. You can view your transaction history at My Appointments page. THANK YOU!</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
		
	}

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
                          <a class="nav-link js-scroll-trigger" href="./landing.php">Contact Us</a>
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
                          <a class="nav-link js-scroll-trigger" href="./landing.php">Contact Us</a>
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
                <h1 class="display-3  text-white">WELCOME TO CLINIC:
                  <span class="text-white"><?php echo $rows_clinicname["clinic_name"]; ?></span>
                </h1>
                <p class="lead  text-white">This is the online scheduling of medical appointment of CLDH.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- 1st Hero Variation -->
    </div>

    <!-- Clinics -->
	  
	  <div class="container-fluid mt--7">
        <div class="row mt-5">
            <div class="col">
			<div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row row-grid justify-content-center" style="padding-top: 30px;">
                        <div class="col-lg-8 text-center">
						<a href="./clinic-sched.php?id=<?php echo $req_id; ?>"><button class="btn btn-1 btn-outline-danger" type="submit">Go Back</button></a>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row row-grid justify-content-center" style="padding-top: 30px;">
                        <div class="col-lg-8 text-center">
						<h2 class="display-3" style="padding-bottom: 30px;"><i class="ni ni-calendar-grid-58" aria-hidden="true"></i> Doctor's Schedule</h2>
                          </div>
                    </div>
                </div>
            </div>
            <?php echo $success; ?>
                <div class="card bg-default shadow center" style="max-width: 1000px">
                    <div class="card-header bg-transparent border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="text-white mb-0">Reserve your schedule</h3>
                            </div>
                            <div class="col-4">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    </div>
                                <input class="form-control" placeholder="Search Date" type="text" id="myInput" onkeyup="myFunction()" >
                             </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark table-flush" id="appointment">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">Doctor's Name</th>
                              <th scope="col">Date</th>
                              <th scope="col">From</th>
                              <th scope="col">To</th>
                              <th scope="col">Room</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
								$query_fetchsched = mysqli_query($con, "SELECT * FROM schedules LEFT JOIN sec_accnts ON schedules.sec_id = sec_accnts.sec_id WHERE schedules.sec_id = '$req_docid'");
								while ($rows_fetchsched = mysqli_fetch_assoc($query_fetchsched)) {
							?>
                            <tr>
                              <td>
                                <?php echo $rows_fetchsched['doc_name']; ?>
                              </td>
                              <td>
                                <?php echo $rows_fetchsched['day']; ?>
                              </td>
                              <td>
                                <?php echo $rows_fetchsched['start_time']; ?>
								</td>
                              <td>
                                <?php echo $rows_fetchsched['end_time']; ?>
                              </td>
                              <td>
                                <?php echo $rows_fetchsched['room']; ?>
                              </td>
                              <td>
									<button type="button" onclick="test(this.id)" id="<?php echo $rows_fetchsched['sched_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#confirm" <?php if($rows_fetchsched['status']=='1'){echo 'disabled';} ?>>Reserve an Appointment</button>
							  </td>
                            </tr>
								<?php }?>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	</div>

    <!-- end Clinics -->
    <section class="section section-lg pt-lg-0 bg-secondary">
        <div class="container ">
          
        </div>
      </section>

    <!-- end Clinics -->

     <!--add doctor modal-->
<div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Appointment Confirmation:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to make your Appointment?
      </div>
	  <form method="post" action="">
      <div class="modal-footer">
		<input type="hidden" id="schedule_id" name="schedule_id" value=""/>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="reserve_sched" class="btn btn-primary">Confirm</button>
      </div>
	  </form/>
    </div>
  </div>
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
        window.setTimeout(function() {
    $("#succ").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
}, 4000);
    </script>

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
    function test(clickedID){
        document.getElementById("schedule_id").value = clickedID;
    }

  </script>

  <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("appointment");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

</body>

</html>