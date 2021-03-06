<?php session_start();
require 'config/config.php';
	if(isset($_SESSION['user']) && $_SESSION['level'] != 2){
		
	}
	else{
		header('location:index.php');
	}
	if(isset($_GET['endorser_id'])){
		$endorser_id = $_GET['endorser_id'];
		$sql = "select * from endorser where endorser_id=?";
		$query = $theConnection->prepare($sql);
		$query->bind_param('i', $_GET['endorser_id']);
		$query->execute();
		$query->bind_result($id, $fname, $mname, $lname, $contact);
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
					<a class="btn btn-md btn-default" href="endorser.php">Back</a>
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
					Edit Enforcer Form
				</header>
				<div class="panel-body">
					<div class="form">
						<form class="form-validate form-horizontal" id="feedback_form" method="POST" action="process/edit_endorser.php">
							<input type="hidden" value="<?php echo $endorser_id ?>" name="endorser_id" >
							<div class="form-group ">
								<label for="fname" class="control-label col-lg-2">First Name: <span class="required">*</span>    </label>
								<div class="col-lg-4">
									<input class="form-control" id="fname" name="fname" value="<?php echo $fname ?>"  type="text" required/>
								</div>
							</div>
							<div class="form-group ">
								<label for="mname" class="control-label col-lg-2">Middle Name:  </label>
								<div class="col-lg-4">
									<input class="form-control" id="mname" name="mname" value="<?php echo $mname ?>"  type="text" />
								</div>
							</div>
							<div class="form-group ">
								<label for="lname" class="control-label col-lg-2">Last Name: <span class="required">*</span>    </label>
								<div class="col-lg-4">
									<input class="form-control" id="lname" name="lname" value="<?php echo $lname ?>"  type="text"  required/>
								</div>
							</div>
							<div class="form-group ">
								<label for="contact" class="control-label col-lg-2">Contact: <span class="required">*</span>    </label>
								<div class="col-lg-4">
									<input class="form-control" id="contact" name="contact" value="<?php echo $contact ?>"  type="text" required/>
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
