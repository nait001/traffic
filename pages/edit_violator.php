<?php session_start();
  if(isset($_SESSION['user'])){
	
  }
  else{
	header('location:index.php');
  }
  require_once 'config/config.php';
  	$offenses = array();
	$violations = array();
	$pen_idz = array();
	$vio_ids = array();
	if(isset($_GET['violator_id'])){
		$violator_id = $_GET['violator_id'];
		$sql = "select v.gender, v.pic, v.ctc, v.fname, v.mname, v.lname, v.address, v.owner, v.bday, vio.violation, p.offense, e.fname, e.mname, e.lname, v.impound, v.chassis_no, v.engine_no, v.noted_by, vf.pen_id, vio.vio_id, e.endorser_id from violator as v inner join endorser as e on e.endorser_id=v.endorser_id left join violator_offense as vf on vf.v_id = v.v_id left join penalty as p on p.pen_id = vf.pen_id left join violation as vio on vio.vio_id = p.vio_id where v.v_id=?";
		$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
		$query->bind_param('i', $violator_id);
		$query->execute();
		$query->bind_result($gender, $pic, $ctc, $violator_fname, $violator_mname, $violator_lname, $address, $owner, $bday, $violation, $offense, $endorser_fname, $endorser_mname, $endorser_lname, $impound, $chassis_no, $engine_no, $noted_by, $p_ids, $vio_id, $endorser_id);
		while($query->fetch()) {
			$offenses[] = $offense;
			$violations[] =  $violation;
			$pen_idz[] = $p_ids;
			$vio_ids[] = $vio_id;
		}
		$query->close();
		$male="";
		$female="";
		// $selected1 = "";
		// $selected2 = "";
		// $selected3 = "";
		// $selected4 = "";
		$selected_remark1 = "";
		$selected_remark2 = "";
		// switch($status){
		// 	case 1:
		// 		$selected1 = "selected";
		// 		break;
		// 	case 2:
		// 		$selected2 = "selected";
		// 		break;
		// 	case 3:
		// 		$selected3 = "selected";
		// 		break;
		// 	case 4:
		// 		$selected4 = "selected";
		// 		break;
		// }
		if($gender == "Male"){
			$male = "selected";
		}
		else{
			$female = "selected";
		}
	}
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
				<a class="btn btn-primary" style="margin-bottom:5px;" href="view.php"><i class="fa fa-reply"></i> Back</a>
			</div>
		</div>
		<div class="row">
		  <div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-home"></i> Edit Violator</h3>
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
			  Edit Violator Form
			</header>
			<div class="panel-body">
			  <div class="form">
				<form class="form-validate form-horizontal" id="violator_form" method="post" action="process/update_record.php" enctype="multipart/form-data">
				  <div class="active tab-pane" id="violator_li">
					<ul class="nav nav-tabs">
					  <li class="active"><a href="#first" data-toggle="tab">Violator Profile</a></li>
					</ul>
					<div style="margin-top:5px;" class="tab-content" style="color:black">
					  <div id="first" class="active tab-pane">
						<input type="hidden" value="<?php echo $violator_id; ?>" name="violator_id" />
						<div class="form-group ">
						  <label for="pic" class="control-label col-lg-2">Driver Picture<span class="required">*</span> </label>
						  <div class="col-lg-1" style="margin-right:10px;">
							<img style="width:100px;height:100px;" src="imgs/<?php echo $pic; ?>" id="img_pic"/>
						  </div>
						  <div class="col-lg-3">
							<input name="pic" type="file" accept="image/*" class="form-control" id="pic" autofocus/>
						  </div>
						</div>
					  <div class="form-group ">
						<label for="ctc" class="control-label col-lg-2">CTC No.<span class="required">*</span>  </label>
						<div class="col-lg-3">
						  <input class="form-control" id="ctc" name="ctc" value="<?php echo $ctc; ?>"  type="number" min=0 required/>
						</div>

						<div class="form-group ">
						<label for="endorser" class="control-label col-lg-2">Endorser<span class="required">*</span>  </label>
						<div class="col-lg-3">
						  <select class="form-control" id="endorser" name="endorser" required>
							<option value="">Select Endorser</option>
							<?php
							  $sql = "select endorser_id, fname, mname, lname from endorser";
							  $query = $theConnection->prepare($sql);
							  $query->execute();
							  $query->bind_result($id, $fname, $mname, $lname);
							  while($query->fetch()){
								if($id == $endorser_id){
									echo "<option value='".$id."' selected>".ucfirst($fname." ".$mname." ".$lname)."</option>";
								}
								else {
									echo "<option value='".$id."'>".ucfirst($fname." ".$mname." ".$lname)."</option>";
								}
							  }
							  $query->close();
							?>
						  </select>
						</div>
					  </div>

					  </div>
					  <div class="form-group ">
						<label for="fname" class="control-label col-lg-2">First Name <span class="required">*</span>  </label>
						<div class="col-lg-3">
						  <input class="form-control" id="fname" name="fname" value="<?php echo $violator_fname ?>"  type="text" required/>
						</div>

						<div class="form-group ">
						<label for="impound" class="control-label col-lg-2">Impound Vehicle <span class="required">*</span> </label>
						<div class="col-lg-3">
						  <input class="form-control" id="impound" name="impound" value="<?php echo $impound; ?>" type="text" required/>
						</div>
					  </div>

					  </div>
					  <div class="form-group ">
						<label for="mname" class="control-label col-lg-2">Middle Name <span class="required">*</span></label>
						<div class="col-lg-3">
						  <input class="form-control " id="mname" type="text" value="<?php echo $violator_mname ?>" name="mname" />
						</div>

						<div class="form-group ">
						<label for="chassis_no" class="control-label col-lg-2">C.R No. / Chassis No. <span class="required">*</span></label>
						<div class="col-lg-3">
						  <input class="form-control " id="chassis_no" type="text" value="<?php echo $chassis_no; ?>" name="chassis_no" required />
						</div>
					  </div>

					  </div>
					  <div class="form-group ">

					  	<label for="lname" class="control-label col-lg-2">Last Name <span class="required">*</span></label>
						<div class="col-lg-3">
						  <input class="form-control " id="lname" type="text" value="<?php echo $violator_lname ?>" name="lname" required/>
						</div>
						  

						  <div class="form-group ">
						<label for="engine_no" class="control-label col-lg-2">O.R No. / Engine No. <span class="required">*</span></label>
						<div class="col-lg-3">
						  <input class="form-control " id="engine_no" type="text" name="engine_no" value="<?php echo $engine_no; ?>" required/>
						</div>
					  </div>


					  </div>
					  <div class="form-group ">
						<label for="gender" class="control-label col-lg-2">Gender <span class="required">*</span></label>
						  <div class="col-lg-3"> 
							<select class="form-control" id="gender" name="gender" required>
								<option value="">Select Gender</option>
								<option value="Male" <?php echo $male; ?>>Male</option>
								<option value="Female" <?php echo $female; ?>>Female</option>
							</select>
						  </div>
						  <div class="form-group">
						  <label for="bday" class="control-label col-lg-2">Birth Date <span class="required">*</span></label>
						<div class="col-lg-3">
						  <input class="form-control" type="date" id="bday" value="<?php echo $bday; ?>" name="bday" required />
					  </div>
					</div>

					  </div>
					  <div class="form-group ">
						<label for="owner" class="control-label col-lg-2">Owner <span class="required">*</span></label>
						<div class="col-lg-3">
						  <input class="form-control " id="owner" type="text" value="<?php echo $owner; ?>" name="owner" required />
						</div>
						<div class="form-group ">
						<label for="noted" class="control-label col-lg-2">Noted By:</label>
						<div class="col-lg-3">
						  <input class="form-control" type="text" value="<?php echo $noted_by; ?>" id="noted" name="noted" />
						</div>
					  </div>

					  </div>
					  <div class="form-group ">
						<label for="address" class="control-label col-lg-2">Address <span class="required">*</span> </label>
						<div class="col-lg-3">
						  <input class="form-control" id="address" value="<?php echo $address ?>" name="address" type="text" required  />
						</div>
						

					  </div>
					  	<div class="form-group ">
						<label for="violation" class="control-label col-lg-2">Violation <span class="required">*  </span>
						</label>
						<div class="col-lg-3">
						  <select class="form-control" onchange="getOffense()" id="violation" multiple="true" required>
							<option value="">Select Violation</option>

						  </select>
						</div>

						

					  </div>

						
					  
					  <div class="form-group ">
						<label for="offense_type" class="control-label col-lg-2">Offense <span class="required">* </span>
						</label>
						<div class="col-lg-3">
						  <select class="form-control" id="offense_type" name="offense_type[]" multiple="true" required>
							<option value="">Select Offense</option>

						  </select>
						</div>
					  </div>
					  </div>

					</div>
				  </div>

				  <div class="form-group" style="margin-top:5px;">
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
	function getOffense(){
		var pen_id = $("#violation").val();
		var selected_pens = [];
		<?php foreach($pen_idz as $pe_id): ?>
			selected_pens.push(<?php echo $pe_id ?>);
		<?php endforeach; ?>
		$.ajax({
			method: 'GET',
			url: 'process/get_offense.php',
			data: {pen_id:pen_id},
			success: function(e){
					if(e.length > 0) {
						var data = JSON.parse(e);
						$("#offense_type").empty();
						$.each(data, function(index, val){
							$.each(val, function(i, v) {
								if(v.violation != "") {
									$("#offense_type").append("<optgroup label="+v.violation+">");
								}

								var found = selected_pens.some(r => v['pen_id'].indexOf(r) >= 0);
								if(found) {
									$("#offense_type").append(
										"<option value='"+v['pen_id']+"' selected>"+v['offense']+"</option>"
									);
								}
								else {
									$("#offense_type").append(
										"<option value='"+v['pen_id']+"'>"+v['offense']+"</option>"
									);
								}
								if(v.violation != "") {
									$("#offense_type").append("</optgroup>");
								}
							});
						});
					} else {
						$("#offense_type").empty();
					}
					$("#offense_type").select2({
						multiple: true,
						placeholder: "Select Offense"
					});
				
			}
		});
	}

	function get_violation_penalties() {
		var selected_violations = [];
		<?php foreach($vio_ids as $vio): ?>
			selected_violations.push(<?php echo $vio ?>)
		<?php endforeach; ?>
		$.ajax({
			method: "GET",
			url: "process/get_pen_dropdown.php",
			success: function(e) {
				$("#violation").empty();
				let resp = JSON.parse(e);
				var count = 0;
				$.each(resp, function(i, v) {
					if(inArray(v.vio_id, selected_violations)) {
						$("#violation").append(
							`<option value='${v.pen_id}' id='id${v.pen_id}' selected>${v.violation}</option>`
						);
					}
					else {
						$("#violation").append(
							`<option value='${v.pen_id}' id='id${v.pen_id}'>${v.violation}</option>`
						);
					}
					count++;
				});
				$("#violation").select2({
					placeholder: "Select Violation",
				});
			}
		});
	}

	function inArray(value, array) {
		return array.indexOf(value) > -1;
	}


	  window.onload = () => {
	  	window.setTimeout(function(){
	  		get_violation_penalties();
	  	},500);
	  	
	  	$("#violation").select2({
			placeholder: "Select Violation",
		});
		window.setTimeout(function(){
			getOffense();
		}, 900);
		
		$("#offense_type").select2({
			multiple: true,
			placeholder: "Select Offense"
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
	  	// window.setTimeout(() => {

	  	// getOffense();
	  	// }, 2000);
		$(".knob").knob({
		  'draw': function() {
			$(this.i).val(this.cv + '%')
		  }
		});
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
