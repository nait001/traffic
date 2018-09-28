<?php session_start();
	if(isset($_SESSION['user'])){
		
	}
	else{
		header('location:index.php');
	}
	require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head> 
	<title>Traffic Management System</title>
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
	}
	label {
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
			<h3 class="page-header"><i class="fa fa-home"></i> Add Violator</h3>
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
		  <div class="row">
			  <div class="col-lg-12">
				  <section class="panel">
					  <header class="panel-heading">
						  Add Violator Form
					  </header>
					  <div class="panel-body">
						  <div class="form">
							  <form class="form-validate form-horizontal" id="violator_form" method="post" action="process/add_violator.php" enctype="multipart/form-data">
								<div class="active tab-pane" id="violator_li">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#first" data-toggle="tab">Violator Profile</a></li>
									</ul>
									<div style="margin-top:5px;" class="tab-content" style="color:black">
										<div id="first" class="active tab-pane">
											<div class="form-group row">
											  <label for="pic" class="control-label col-lg-2">Driver Picture<span class="required">*</span>	</label>
											  <div class="col-lg-1" style="margin-right:20px;">
												  <img style="width:100px;height:100px;" id="img_pic"/>
											  </div>
											  <div class="col-lg-3">
												  <input name="pic" type="file" accept="image/*" class="form-control" id="pic" required autofocus/>
											  </div>
											</div>
										  <!-- <div class="form-group row">
											  <label for="ctc" class="control-label col-lg-2">CTC No.<span class="required">*</span>	</label>
											  	<div class="col-lg-3">
												  <input class="form-control" id="ctc" name="ctc"  type="number" min=0 required/>
											  	</div>
											  	<div class="form-group ">
													<label for="endorser" class="control-label col-lg-2">Endorser<span class="required">*</span>	</label>
													<div class="col-lg-3">
														<select class="form-control" id="endorser" name="endorser" required>
															<option value="">Select Endorser</option>
															<?php
																$sql = "select endorser_id, fname, mname, lname from endorser";
																$query = $theConnection->prepare($sql);
																$query->execute();
																$query->bind_result($id, $fname, $mname, $lname);
																while($query->fetch()){
																	echo "<option value='".$id."'>".ucfirst($fname." ".$mname." ".$lname)."</option>";
																}
															?>
														</select>
													</div>
											  	</div>
										  </div> -->

										  <div class="form-group row">
											  <label for="fname" class="control-label col-lg-2">First Name <span class="required">*</span>	</label>
											  <div class="col-lg-3">
												  <input class="form-control" id="fname" name="fname"  type="text" required/>
											  </div>

											  <label for="mname" class="control-label col-lg-2">Middle Name <span class="required">*</span></label>
											  <div class="col-lg-3">
												  <input class="form-control " id="mname" type="text" name="mname" required />
											  </div>

											  <!-- <div class="form-group ">
												  <label for="impound" class="control-label col-lg-2">Impound Vehicle <span class="required">*</span>	</label>
												  <div class="col-lg-3">
													  <input class="form-control" id="impound" name="impound" type="text" required/>
												  </div>
											  </div> -->
											  	
										  </div>

										  <!-- <div class="form-group row"> -->
											  
											  
											  <!-- <div class="form-group ">
												  <label for="chassis_no" class="control-label col-lg-2">C.R No. / Chassis No. <span class="required">*</span></label>
												  <div class="col-lg-3">
													  <input class="form-control " id="chassis_no" type="text" name="chassis_no" required />
												  </div>
											  </div> -->

										  <!-- </div> -->

										  <div class="form-group row">
											  <label for="lname" class="control-label col-lg-2">Last Name <span class="required">*</span></label>
											  <div class="col-lg-3">
												  <input class="form-control " id="lname" type="text" name="lname" required/>
											  </div>

											  <label for="gender" class="control-label col-lg-2">Gender <span class="required">*</span></label>
											  <div class="col-lg-3"> 
												<select class="form-control" id="gender" name="gender" required>
													<option value="">Select Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
												</select>
											  </div>

											  <!-- <div class="form-group ">
												  <label for="engine_no" class="control-label col-lg-2">O.R No. / Engine No. <span class="required">*</span></label>
												  <div class="col-lg-3">
													  <input class="form-control " id="engine_no" type="text" name="engine_no" required/>
												  </div>
											  </div> -->
											  
										  </div>

										  <div class="form-group row">
											  

											  <label for="bday" class="control-label col-lg-2">Birth Date <span class="required">*</span></label>
											  <div class="col-lg-3">
												  <input class="form-control" type="date" id="bday" name="bday" required />
											  </div>

											  <label for="address" class="control-label col-lg-2">Address <span class="required">*</span>	</label>
											  <div class="col-lg-3">
												  <input class="form-control" id="address" name="address" type="text" required 	/>

											  </div>

											  <!-- <div class="form-group ">
												  <label for="date_release" class="control-label col-lg-2">Date Released <span class="required">*</span>	</label>
												  <div class="col-lg-3">
													  <input class="form-control" id="date_release" name="date_release" type="date" required 	/>
												  </div>
											  </div> -->
											  
										  </div>



										  <!-- <div class="form-group row">
											  

											  
											  
										  </div> -->

										  <div class="form-group row">

										  		<label for="violation" class="control-label col-lg-2">Violation <span class="required">*	</span>
											  </label>
											  <div class="col-lg-3">
												  <select class="form-control" onchange="getOffense()" id="violation" multiple="true" required>

												  </select>
											  </div>

											  <label for="offense_type" class="control-label col-lg-2">Offense <span class="required">*	</span>
											  </label>
											  <div class="col-lg-3">
												  <select class="form-control" id="offense_type" name="offense_type[]" required>
													  <option value="">Select Offense</option>
												  </select>
											  </div>

										  </div>

  										  <div class="form-group row">

												<label for="noted" class="control-label col-lg-2">Noted By:</label>
												<div class="col-lg-3">
												 	<input class="form-control" type="text" id="noted" name="noted" />
												</div>

											  
										  </div>

										 <!--  <div class="form-group row">
											  
											  	
										  </div> -->

										</div>
									</div>
								</div>

								  <div class="form-group" style="margin-top:5px;">
									  <div class="col-lg-offset-8 col-lg-10">
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
		function getOffense(){
			var pen_id = $("#violation").val();
			$.ajax({
				method: 'GET',
				url: 'process/get_offense.php',
				data: {pen_id:pen_id},
				success: function(e){
					console.log(e);
					if(e.length > 0){
						var data = JSON.parse(e);
						$("#offense_type").empty();
						$.each(data, function(index, val){
							$.each(val, function(i, v) {
								
								if(v.violation != "") {
									$("#offense_type").append("<optgroup label="+v.violation+">");
								}
								$("#offense_type").append(
									"<option value='"+v['pen_id']+"'>"+v['offense']+"</option>"
								);
								if(v.violation != "") {
									$("#offense_type").append("</optgroup>");
								}
								
							});
						});
						$("#offense_type").select2({
							multiple: true,
							placeholder: "Select Offense"
						});
					}
				}
			});
		}

		function get_violation_penalties() {
			$.ajax({
				method: "GET",
				url: "process/get_pen_dropdown.php",
				success: function(e) {
					$("#violation").empty();
					let resp = JSON.parse(e);

					$.each(resp, function(i, v) {
						$("#violation").append(
							`<option value='${v.pen_id}' id='id${v.pen_id}'>${v.violation}</option>`
						);
					});
					$("#violation").select2({
						placeholder: "Select Violation",
					});
				}
			});
		}

	  //knob
		$("#pic").on('change', function(){
			var reader = new FileReader();
			var file = pic.files[0];
			reader.readAsDataURL(file);
			reader.onload = function(e){
				img_pic.src = e.target.result;
			}
		});
	  $(function() {
		get_violation_penalties();
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

	</script>

</body>

</html>
