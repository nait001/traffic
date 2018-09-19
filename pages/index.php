<?php session_start();
$msg ="";
	if(isset($_SESSION['error'])){
		$msg = "Incorrect username or password";
		unset($_SESSION['error']);
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../includes/css.php" ?>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
  <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- =======================================================
	  Theme Name: NiceAdmin
	  Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
	  Author: BootstrapMade
	  Author URL: https://bootstrapmade.com
	======================================================= -->
</head>

<body class="login-img3-body">

  <div class="container">

	<form class="login-form" method="post" action="process/login-process.php">
	  <div class="login-wrap">
		<p class="login-img"><i class="icon_lock_alt"></i></p>
		<div class="input-group">
		  <span class="input-group-addon"><i class="icon_profile"></i></span>
		  <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
		</div>
		<div class="input-group">
		  <span class="input-group-addon"><i class="icon_key_alt"></i></span>
		  <input type="password" class="form-control" name="password" placeholder="Password">
		</div>
		  <p style="color:red !important;"><?php echo $msg; ?></p>
		<!---<label class="checkbox">
				<input type="checkbox" value="remember-me"> Remember me
				<span class="pull-right"> <a href="#"> Forgot Password?</a></span>
			</label>--->
		<button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
	   <!--- <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>-->
	  </div>
	</form>
  </div>


</body>
<?php include "../includes/js.php"; ?>
</html>
