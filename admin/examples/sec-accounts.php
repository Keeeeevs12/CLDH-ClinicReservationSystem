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

    if (isset($_POST['add_sec'])) {
		$clinic_id = $_POST['clinic'];
        $sec_name = $_POST['sec_name'];
        $doc_name = $_POST['doc_name'];
        $email_add = $_POST['email_add'];
        $contact_num = $_POST['contact_num'];
        $password = md5('secret');
		
        if ($query_addsec = mysqli_query($con, "INSERT INTO sec_accnts (clinic_id, sec_name, doc_name, contact_num, email_add, password) VALUES ('$clinic_id', '$sec_name', '$doc_name', '$contact_num', '$email_add', '$password')")) {
			$transac_mes = 'Admin has added Dr. ' . $doc_name . ' with his/her secretary ' . $sec_name . '.';
			$query_addtrans = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', 'Administrator', 'Administrator')");
        }
         $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text"><strong>You have <strong>SUCCESSFULLY</strong> added '. $sec_name .' account.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
    }

    if (isset($_POST['sec_delete'])) {
        $s_id = $_POST['get_id'];
        $result = mysqli_query($con, "SELECT * FROM sec_accnts WHERE sec_id = '$s_id'");
        $rows = mysqli_fetch_assoc($result);
        $sec_name = $rows['sec_name'];
        if ($query = mysqli_query($con, "DELETE FROM sec_accnts WHERE sec_id = '$s_id'")){
            $transac_mes = 'Admin has deleted secretary ' . $sec_name . ' account.';
            $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', 'Administrator', 'Administrator')");
        }
        $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text"><strong>You have <strong>SUCCESSFULLY</strong> deleted '. $sec_name .' account.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';

    }

    if (isset($_POST['sec_edit'])) {
        $s_id = $_POST['n_get_id'];
        $n_sec_name = $_POST['n_sec_name'];
        $n_doc_name = $_POST['n_doc_name'];
        $n_email_add = $_POST['n_email_add'];
        $n_clinic = $_POST['n_clinic'];
        if ($query = mysqli_query($con, "UPDATE sec_accnts SET sec_name = '$n_sec_name', doc_name = '$n_doc_name', email_add = '$n_email_add', clinic_id = '$n_clinic' WHERE sec_id = '$s_id'")){
        $transac_mes = 'Admin has edited secretary ' . $n_sec_name . ' informations.';
        $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', 'Administrator', 'Administrator')");
        }
        $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text"><strong>You have <strong>SUCCESSFULLY</strong> edited '. $n_sec_name .' account.</span>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
    }
	
	if (isset($_POST['add_cli'])) {
        $clinic_name = $_POST['cli_name'];
        if ($query = mysqli_query($con, "INSERT INTO clinic (clinic_name) VALUES ('$clinic_name')")) {
            $transac_mes = 'Admin has added a new clinic.';
            $query = mysqli_query($con, "INSERT INTO transacs (transac_datetime, transac_mes, transac_user, user_type) VALUES (current_timestamp(), '$transac_mes', 'Administrator', 'Administrator')");
        }
        $success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-check-bold"></i></span>
                                <span class="alert-inner--text"><strong>You have <strong>SUCCESSFULLY</strong> added '. $clinic_name .' clinic.</span>
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
                <a class="nav-link" href="client-accounts.php">
                  <i class="ni ni-single-02 text-blue"></i> Client/Patient Accounts
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sec-accounts.php">
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
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="sec-accounts.php">Secretary Accounts</a>
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
          <div class="card bg-default shadow" style="height: 500px;">
            <div class="card-header bg-transparent border-0">
              <div class="row align-items-center">
                  <div class="col-8">
                      <h3 class="text-white mb-0">Secretary Accounts Table</h3>
                  </div>
                  <div class="col-4 text-right" >
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-addClinic">Add Clinic</button>
					  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-addSec">Add Secretary</button>
                  </div>
              </div>
          </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Secretary ID</th>
                    <th scope="col">Secretary's Name</th>
                    <th scope="col">Doctor's Name</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Clinic</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                      <?php
                          $query = mysqli_query($con,"SELECT * FROM sec_accnts LEFT JOIN clinic ON sec_accnts.clinic_id = clinic.clinic_id");
                          while ($rows = mysqli_fetch_assoc($query)) {
                              echo "<tr>";
                              echo "<td>" . $rows['sec_id'] . "</td>";
                              echo "<td>" . $rows['sec_name'] . "</td>";
                              echo "<td>" . $rows['doc_name'] . "</td>";
                              echo "<td>" . $rows['contact_num'] . "</td>";
                              echo "<td>" . $rows['email_add'] . "</td>";
                              echo "<td>" . $rows['clinic_name'] . "</td>";
                      ?>
                    <td>
                      <button type="button" onclick="test(this.id)" id="<?php echo $rows['sec_id']; ?>"  data-user-id="<?php echo $rows['sec_id']; ?>" data-doc-name="<?php echo $rows['doc_name']; ?>" data-full-name="<?php echo $rows['sec_name']; ?>" data-email-add="<?php echo $rows['email_add']; ?>" data-clinic="<?php echo $rows['clinic_id']; ?>" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-editSec">Edit</button>
                      <button type="button" onclick="test(this.id)" id="<?php echo $rows['sec_id']; ?>" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete">Delete</button>
                    </td>
                    <?php
                            echo "</tr>";
                          }
                    ?>
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

<!--add secretary account modal-->
<div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="modal-addSec" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
          <div class="modal-content">
  
              <div class="modal-header">
                  <h2 class="modal-title" id="modal-title-default">Add Secretary Account:</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
  
              <div class="modal-body">
                          <form method="post" action="" autocomplete="off">

                              <div class="pl-lg-4">
                                  <div class="form-group">
                                      <label class="form-control-label" for="">Secretary's Name:</label>
                                      <input type="text" name="sec_name" id="" class="form-control form-control-alternative"  required autofocus>
                                  </div>

								  <div class="form-group">
                                      <label class="form-control-label" for="">Doctor's Name:</label>
                                      <input type="text" name="doc_name" id="" class="form-control form-control-alternative"  required autofocus>
                                  </div>

                                  <div class="form-group">
                                      <label class="form-control-label" for="">Contact Number:</label>
                                      <input type="number" name="contact_num" id="" class="form-control form-control-alternative"  required autofocus>
                                  </div>

                                  <div class="form-group">
                                        <label class="form-control-label" for="">Email:</label>
                                        <input type="email" name="email_add" id="" class="form-control form-control-alternative"  required autofocus>
                                  </div>

                                  <div class="form-group">
                                        <label class="form-control-label" for="">Clinic:</label>
                                        <select class="form-control form-control-alternative" name="clinic" required autofocus>
											<option value="">Select Clinic</option>
											<?php
												$query_cli = mysqli_query($con, "SELECT * FROM clinic");
												while ($rowss =  mysqli_fetch_assoc($query_cli)) { ?>
													<option value="<?php echo $rowss['clinic_id']; ?>"><?php echo $rowss['clinic_name']; ?></option>
											<?php } ?>
										</select>
                                  </div>
                                </div>                             
                                          
                                  <div class="modal-footer">
                                      <button type="submit" name="add_sec" class="btn btn-success mt-4">Add Secretary</button>
                                      <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                          </form>
                    </div>
                </div>
          </div>
      </div>
  </div>
<!--end add secretary account modal-->
<!--edit secretary account modal-->
<div class="row">
        <div class="col-md-4">
            <div class="modal fade" id="modal-editSec" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
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
                                          <label class="form-control-label" for="">Secretary ID:</label>
                                          <input type="text" name="sec_id" id="sec_id" class="form-control form-control-alternative" value="" disabled autofocus>
                                      </div>

                                      <div class="form-group">
                                          <label class="form-control-label" for="">Secretary's Name:</label>
                                          <input type="text" name="n_sec_name" id="n_sec_name" class="form-control form-control-alternative" value="" required autofocus>
                                      </div>
									  
									  <div class="form-group">
                                          <label class="form-control-label" for="">Doctor's Name:</label>
                                          <input type="text" name="n_doc_name" id="n_doc_name" class="form-control form-control-alternative" value="" required autofocus>
                                      </div>
    
                                      <div class="form-group">
                                            <label class="form-control-label" for="">Email:</label>
                                            <input type="email" name="n_email_add" id="n_email_add" class="form-control form-control-alternative" value="" required autofocus>
                                      </div>

                                      <div class="form-group">
                                            <label class="form-control-label" for="">Clinic:</label>
											<select class="form-control form-control-alternative" name="n_clinic" id="n_clinic" required autofocus>
												<option value="">Select Clinic</option>
												<?php
												$query_cli = mysqli_query($con, "SELECT * FROM clinic");
												while ($rowss =  mysqli_fetch_assoc($query_cli)) { ?>
													<option value="<?php echo $rowss['clinic_id']; ?>"><?php echo $rowss['clinic_name']; ?></option>
												<?php } ?>
											</select>
									  </div>

                                    </div>                             
                                              
                                      <div class="modal-footer">
                                          <input type="hidden" id="n_gets_id" name="n_get_id" value=""/>
                                          <button type="submit" name="sec_edit" class="btn btn-success mt-4">Save changes</button>
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
				</div>
			</div>
  <!-- end delete secretary account modal -->
  
  <!--add doctor modal-->
<div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="modal-addClinic" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h2 class="modal-title" id="modal-title-default">Add Clinic:</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form method="post" action="" autocomplete="off">

                            <div class="pl-lg-4">
                                <h3>Clinic's Name</h3>
                                <div class="form-group">
                                    <input type="text" name="cli_name" id="" placeholder="Clinic's name..." class="form-control form-control-alternative"  required autofocus>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" name="add_cli" class="btn btn-success mt-4">Add Clinic</button>
                                <button type="button" class="btn btn-danger  ml-auto" data-dismiss="modal">Close</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end add doctor modal-->

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

  <script>
      function test(clickedID){
          document.getElementById("gets_id").value = clickedID;
          document.getElementById("n_gets_id").value = clickedID;
      }
	  
	  $('#modal-editSec').on('show.bs.modal', function(e) {
			var userid = $(e.relatedTarget).data('user-id');
			var fullname = $(e.relatedTarget).data('full-name');
			var docname = $(e.relatedTarget).data('doc-name');
			var emailadd = $(e.relatedTarget).data('email-add');
			var clinic = $(e.relatedTarget).data('clinic');
			$(e.currentTarget).find('input[name="sec_id"]').val(userid);
			$(e.currentTarget).find('input[name="n_sec_name"]').val(fullname);
			$(e.currentTarget).find('input[name="n_doc_name"]').val(docname);
			$(e.currentTarget).find('input[name="n_email_add"]').val(emailadd);
			$(e.currentTarget).find('select[name="n_clinic"]').val(clinic);
		});
  </script>
  
  
</body>

</html>