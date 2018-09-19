<?php session_start();
require 'config/config.php';
	if(isset($_SESSION['user']) && $_SESSION['level'] != 2){
		
	}
	else{
		header('location:index.php');
	}
	if(isset($_GET['violation_id'])){
		$violation_id = $_GET['violation_id'];
		$sql = "select violation, no_offense from violation where vio_id=?";
		$query = $theConnection->prepare($sql);
		$query->bind_param('i', $_GET['violation_id']);
		$query->execute();
		$query->bind_result($violation, $offense);
		$query->fetch();
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
					<h3 class="page-header"><i class="fa fa-edit"></i> Edit Violation</h3>
				</div>
				<div class="col-lg-3">
					<a class="btn btn-md btn-default" href="violation.php">Back</a>
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
					Violation ID <span id="violation_id"><?php echo $violation_id; ?></span>
				</header>
				<div class="panel-body">
					<div class="form">
						<form class="form-validate form-horizontal" id="feedback_form" method="POST" action="process/edit_violation.php">
							<input type="hidden" value="<?php echo $violation_id ?>" name="violation_id"> 
							<div class="form-group ">
								<label for="violation" class="control-label col-lg-2">Violation <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control" id="violation" value="<?php echo $violation ?>" name="violation" minlength="5" type="text" required />
							</div>
							</div>
							<div class="form-group ">
								<label for="offense" class="control-label col-lg-2">No. of Offense <span class="required">*</span></label>
							<div class="col-lg-10">
								<input class="form-control" value="<?php echo $offense ?>" id="offense" type="number" name="offense" required />
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
