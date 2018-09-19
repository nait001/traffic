<?php session_start();
require 'config/config.php';
	if(isset($_SESSION['user']) && $_SESSION['level'] != 2 && $_SESSION['level'] != 3){
		
	}
	else{
		header('location:index.php');
	}
	if(isset($_GET['username'])){
		$username = $_GET['username']; 
		$sql = "select * from admin where username=?";
		$query = $theConnection->prepare($sql);
		$query->bind_param('s', $username);
		$query->execute();
		$query->bind_result($user, $pass, $fname, $mname, $lname, $level);
		$query->fetch();
		$admin = "";
		$traffic = "";
		$police = "";
		if($level == 1){
			$admin = "selected";
		}
		else if($level == 2){
			$traffic = "selected";
		}
		else if($level == 3){
			$police = "selected";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
  <?php include "../includes/css.php" ?>
  <!-- =======================================================
	Theme Name: NiceAdmin
	Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
	Author: BootstrapMade
	Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>
<style>
  input, select {
	color: black !important;
	font-weight: bold !important;
  }
</style>
<body>
  <!-- container section start -->
  <section id="container" class="">


	<?php include "../includes/header.php"; ?>
	<!--header end-->

	<!--sidebar start-->
	<?php include "../includes/sidebar.php"; ?>
	
	<!--sidebar end-->

	<!--main content start-->
	<section id="main-content">
		<section class="wrapper">
		<!--overview start-->
			<div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-edit"></i> Update User</h3>
				</div>
				<div class="col-lg-3">
					<a class="btn btn-md btn-default" href="view_users.php">Back</a>
				</div>
			</div>
	
	<?php if(isset($_SESSION['success'])): ?>
		<div class="alert alert-success">
			<?php
				echo $_SESSION['success']; 
				unset($_SESSION['success']);
			?>
		</div>
	<?php endif ?>
	<?php if(isset($_SESSION['error'])): ?>
		<div class="alert alert-danger">
			<?php
				echo $_SESSION['error']; 
				unset($_SESSION['error']);
			?>
		</div>
	<?php endif ?>
	<div style="margin-top:5px;" class="row">
		<div class="col-lg-12">
			<section class="panel">
				<header class="panel-heading">
					Update User </span>
				</header>
				<div class="panel-body">
					<div class="form">
						<form class="form-validate form-horizontal" id="feedback_form" method="POST" action="process/change_credentials.php">
							<div class="form-group ">
								<label for="username" class="control-label col-lg-2">Username <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control" id="username" value="<?php echo $username ?>" name="username" type="text" readonly />
							</div>
							</div>
							<div class="form-group ">
								<label for="fname" class="control-label col-lg-2">First Name <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control" id="fname" value="<?php echo $fname ?>" name="fname" type="text" required />
							</div>
							</div>
							<div class="form-group ">
								<label for="mname" class="control-label col-lg-2">Middle Name </label>
							<div class="col-lg-10">
								<input class="form-control" id="mname" value="<?php echo $mname ?>" name="mname" type="text" required />
							</div>
							</div>
							<div class="form-group ">
								<label for="lname" class="control-label col-lg-2">Last name <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control" id="lname" value="<?php echo $lname ?>" name="lname" type="text" required />
							</div>
							</div>
							<input type="hidden" name="pass" value="<?php echo $pass ?>" />
							<div class="form-group ">
								<label for="password" class="control-label col-lg-2">New Password <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control" id="password" name="password" type="password" required />
							</div>
							</div>
							<div class="form-group ">
								<label for="con_pass" class="control-label col-lg-2">Confirm Password <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control" id="con_pass" name="con_pass" type="password" required />
							</div>
							</div>
							 <div class="form-group ">
								<label for="user_level" class="control-label col-lg-2">User Level <span class="required">*</span></label>
							<div class="col-lg-10"> 
								<select name="user_level" id="user_level" class="form-control">
									<option value="">Select Level</option>
									<option value="1" <?php echo $admin ?>>Admin</option>
									<option value="2" <?php echo $traffic ?>>Traffic</option>
									<option value="3" <?php echo $police ?>>Police</option>
								</select>
							</div>
							</div>
							<div class="form-group">
								<div class="col-lg-offset-2 col-lg-10">
									<button class="btn btn-primary" type="submit">Save</button>
									<button class="btn btn-default" type="reset">Cancel</button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</section>
		</div>
	</div>

		</section>

	</section>
		<!--main content end-->
</section>
  <!-- container section start -->

  <!-- javascripts -->
  <?php include "../includes/js.php"; ?>
	<script>
	  //knob
	  $(function() {
		$(".knob").knob({
		  'draw': function() {
			$(this.i).val(this.cv + '%')
		  }
		})
	  });

	  //carousel
	  $(document).ready(function() {
		$("#owl-slider").owlCarousel({
		  navigation: true,
		  slideSpeed: 300,
		  paginationSpeed: 400,
		  singleItem: true

		});
	  });

	  //custom select box

	  $(function() {
		$('select.styled').customSelect();
	  });

	  /* ---------- Map ---------- */
	  $(function() {
		$('#map').vectorMap({
		  map: 'world_mill_en',
		  series: {
			regions: [{
			  values: gdpData,
			  scale: ['#000', '#000'],
			  normalizeFunction: 'polynomial'
			}]
		  },
		  backgroundColor: '#eef3f7',
		  onLabelShow: function(e, el, code) {
			el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
		  }
		});
	  });
	</script>

</body>

</html>
