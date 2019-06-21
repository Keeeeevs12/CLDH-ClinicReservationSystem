<?php
    session_start();
    include '../admin/includes/unauth.php';
    include '../admin/includes/dbconnection.php';
	
	auth_user();
	
	if($_SESSION['status'] == '1') {
		header("Location: landing.php");
	}
	
	$user_name = $_SESSION['full_name'];
    $user_id = $_SESSION['patients_id'];
	
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: ../login.php");
    }
	
	if (isset($_POST['ver_user'])) {
        $ver_code = $_POST['ver_code'];
		
		if ($rows_fetchver['ver_code'] == $ver_code) {
			$_SESSION['status'] = '1';
			$query_verify = mysqli_query($con, "UPDATE users SET status = '1' WHERE patients_id = '$user_id'");
			header("Location: landing.php");
		}
    }
?>

<!DOCTYPE html>
<html>
	<body>
	<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger mr-lg-5" href="#page-top">
          <p class="text-white" style="font-weight: bold; font-size: 30px;">CLDH</p>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar_global">
          <div class="navbar-collapse-header">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="./client-index.html">
                  <p class="text-primary" style="font-weight: bold; font-size: 30px;">CLDH</p>
                </a>
              </div>
              <div class="col-6 collapse-close">
                  <form action="" method="post">
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
                      <li class="nav-item">
                          <a class="nav-link js-scroll-trigger" href="./profile.php">Profile</a>
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
                  <a class="nav-link js-scroll-trigger" href="#services">Services</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#about">About Us</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="#contact">Contact Us</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link js-scroll-trigger" href="./profile.php">Profile</a>
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
		<h3>VERIFY!!!</h3>
		<form action="" method="post">
			<input type="text" name="ver_code"/>
			<input type="submit" name="ver_user"/>
		</form>
	</body>
</html>