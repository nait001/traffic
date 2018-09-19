<?php session_start();
require 'config/config.php';
	if(isset($_SESSION['user']) && $_SESSION['level'] != 2){
		
	}
	else{
		header('location:index.php');
	}
	if(isset($_GET['penalty_id'])){
		$penalty_id = $_GET['penalty_id'];
		$sql = "select * from penalty where pen_id=?";
		$query = $theConnection->prepare($sql);
		$query->bind_param('i', $_GET['penalty_id']);
		$query->execute();
		$query->bind_result($pen_id, $vio_id, $penalty, $offense);
		$query->fetch();
		$query->close();
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
					<a class="btn btn-md btn-default" href="penalty.php">Back</a>
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
					Edit Penalty Form
				</header>
				<div class="panel-body">
					<div class="form">
						<form class="form-validate form-horizontal" id="feedback_form" method="POST" action="process/edit_penalty.php">
							<input type="hidden" value="<?php echo $penalty_id ?>" name="penalty_id" >
							<select name="violzz_idz" id="violation_id" value="<?php echo $vio_id ?>" class="form-control m-bot15" required disabled="true">
								<option value="">Select Violation</option>
								<?php
								$sql = "select * from violation";
								$query = $theConnection->prepare($sql);
								$query->execute();
								$query->bind_result($idz,$vi,$no);
								while($query->fetch()){
									if($vio_id == $idz){
										echo "<option value='$idz' selected>$vi</option>";
									} 
									else {
										echo "<option value='$idz'>$vi</option>";  
									}
								}
								?>
							</select>
							<select name="offense" id="offense" class="form-control m-bot15" required autofocus>
								 <option value="">Select Offense</option>
							</select>
							<input class="form-control input-lg m-bot15 te" value="<?php echo $penalty ?>" name="penz" id='fr_vio' type="text" placeholder="Penalty" required >
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
		$(document).ready(function(){
			var offense = "<?php echo $offense ?>";
			$.ajax({
				method: "GET",
				url: "process/get_offense.php",
				data: {offense: $("#violation_id").val()},
				success: function(e){
					var data = JSON.parse(e);
					$("#offense").empty();
					$("#offense").append("<option value=''>Select Offense</option>"); 
					var count = 1;
					for(var i = 0; i<data['offense_no'];i++){ 
						if("Offense "+count==offense){
							$("#offense").append(
								"<option value='Offense "+count+"' selected>Offense "+count+"</option>"
							);
						}
						else {
							$("#offense").append(
								"<option value='Offense "+count+"'>Offense "+count+"</option>"
							);
						}
						count++;
					}
				}
			});
			$("#feedback_form").on("submit", function(e){
				$("#violation_id").prop('disabled', false);
			});
		});
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
