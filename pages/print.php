<?php session_start();
	if(isset($_SESSION['user'])){
		
	}
	else{
		header('location:index.php');
	}
	require_once 'config/config.php';
	$offenses = array();
	$violations = array();
	$remarks = array();
	$date_appre = array();
	$statuses = array();
	$penalties = array();
	$date_releases = array();
	if(isset($_GET['violator_id'])){
		$violator_id = $_GET['violator_id'];
		$sql = "select v.gender, v.pic, v.ctc, v.fname, v.mname, v.lname, v.address, v.owner, v.bday, vio.violation, p.offense, e.fname, e.mname, e.lname, v.impound, v.chassis_no, v.engine_no, v.noted_by, vf.remarks, vf.date_apprehend, vf.status, p.penalty, vf.date_released from violator as v inner join endorser as e on e.endorser_id=v.endorser_id left join violator_offense as vf on vf.v_id = v.v_id left join penalty as p on p.pen_id = vf.pen_id left join violation as vio on vio.vio_id = p.vio_id where v.v_id=? order by vf.date_released asc";
		$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
		$query->bind_param('i', $violator_id);
		$query->execute();
		$query->bind_result($gender, $pic, $ctc, $violator_fname, $violator_mname, $violator_lname, $address, $owner, $bday, $violation, $offense, $endorser_fname, $endorser_mname, $endorser_lname, $impound, $chassis_no, $engine_no, $noted_by, $remark, $date_apprehend, $status, $penalty, $date_release);
		while($query->fetch()) {
			$offenses[] = $offense;
			$violations[] =  $violation;
			$remarks[] = $remark;
			$date_appre[] = $date_apprehend;
			$statuses[] = $status;
			$penalties[] = $penalty;
			$date_releases[] = $date_release;
		}
		$query->close();
		$dateN = date('Y');
		$bdayYear = date('Y',strtotime($bday)); 
		$age = $dateN - $bdayYear;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Traffic Management System</title>
  	<style>
        .no_margin{
        	margin:0px;
        }
       
		@media print {
		 	
 			@page {
	            size: auto;   
	            margin:0mm !important;  
	        }
	        body {
	            background-color: white !important;
				border: transparent !important;
				margin:0px !important;
	       }
	       .bio-row{
				color: black !important;
			}
			.panel-body {
				border: transparent !important;
			}
			.pr {
				float:right !important;
			}
		}
	</style>
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="print">
	<link href="../css/bootstrap-theme.css" rel="stylesheet" media="print">
	<link href="../css/elegant-icons-style.css" rel="stylesheet" media="print">
	<link href="../css/font-awesome.min.css" rel="stylesheet" media="print">
	<!-- owl carousel -->
	<link rel="stylesheet" href="../css/owl.carousel.css" type="text/css" media="print">
	<link href="../css/style.css" rel="stylesheet" media="print">
	<link href="../css/style-responsive.css" rel="stylesheet" media="print">

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/bootstrap-theme.css" rel="stylesheet">
	<link href="../css/elegant-icons-style.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<!-- owl carousel -->
	<link rel="stylesheet" href="../css/owl.carousel.css" type="text/css">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/style-responsive.css" rel="stylesheet">

</head>
<body>

		<!-- page start-->
		<div class="row" style="top:0px !important;">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<img src="../img/phil.png" style="margin:auto;height:90px;width: 90px;" class="center-block img-circle img-responsive">
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<p class='text-center' style="margin:0px">Republic of the Philippines</p>
				<p class='text-center' style="margin:0px">Sagay National Police</p>
				<p class='text-center' style="margin:0px">Sagay City Negros Occidental</p>
				<p class='text-center' style="margin:0px">422-95872</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<img src="../img/pnp.jpeg" style="margin:auto;height:90px;width: 90px;" class="center-block img-circle img-responsive">
			</div>
		</div>
		<div class="row" id="violator_info" style="margin-left: 60px !important;">
			<div class="col-lg-12">
			<!-- profile -->
				<div class="container" style="position: sticky !important;">
					
					<div class="row">
					  	<div class="col-md-12">
					    	<div class="panel">
					        	<div class="panel-body">
					           		<div class="row">
						              	<div class="col-xs-2 col-sm-2 text-center">
						                	<img src="imgs/<?php echo $pic; ?>" alt="image" class="center-block img-circle img-responsive">
						             	</div>
						              <!--/col-->
						              	<div class="col-xs-10 col-sm-10">
							                <h3 class='no_margin'><?php echo ucfirst($violator_fname." ".$violator_mname." ".$violator_lname); ?></h3>
							                <p class='no_margin'><strong>Birthdate: </strong><?php echo date("F d, Y", strtotime($bday));  ?></p>
							                <p class='no_margin'><strong>Age: </strong> <?php echo $age; ?> </p>
							                <p class='no_margin'><strong>Gender: </strong> <?php echo $gender; ?> </p>
							                <p class='no_margin'><strong>Address: </strong> <?php echo $address; ?> </p>
						              	</div>
					             	 <!--/col-->  
					           		</div>

					           		<div class="row">
					           			<div class="col-lg-12 bio-graph-info">
					           				<h1>Violator Information</h1>
					           			</div>
					           		</div>
					           		<div class="row col-lg-12 col-sm-12 col-md-12 col-xs-12">
					           			<div class="bio-row">
											<p><span>Owner </span>: <?php echo $owner; ?></p>
										</div>
										<div class="bio-row">
											<p><span>Endorser </span>: <?php echo ucfirst($endorser_fname." ".$endorser_mname." ".$endorser_lname); ?></p>
										</div>
										<div class="bio-row">
											<p><span>Impounded Vehicle </span>: <?php echo $impound; ?></p>
										</div>
										<div class="bio-row">
											<p><span>C.R No. / Chassis No. </span>: <?php echo $chassis_no; ?></p>
										</div>
										<div class="bio-row">
											<p><span>O.R No. / Engine No. </span>: <?php echo $engine_no; ?></p>
										</div>

										<div class="pull-left row col-lg-12 col-md-12 col-sm-12">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<span>Violation & Offense</span>
												<?php 
													$count = 0;
													echo "<table class='table table-hover table-striped col-lg-12 col-md-12'>
																<thead style='font-weight: bolder'>
																	<tr>
																		<td>Date Apprehend</td>
																		<td>Violation</td>
																		<td>Offense</td>
																		<td>Penalty</td>
																		<td>Remarks</td>
																		<td>Status</td>
																		<td>Date Released</td>
																	</tr>
																</thead><tbody>";
													foreach($violations as $vio) {
														if(!empty($date_appre[$count])){
															$date_appre[$count] = date('F d, Y', strtotime($date_appre[$count]));
														}
														if(!empty($date_releases[$count])){
															$date_releases[$count] = date('F d, Y', strtotime($date_releases[$count]));
														}
														echo "
																<tr>
																	<td>$date_appre[$count]</td>
																	<td>$vio</td>
																	<td>$offenses[$count]</td>
																	<td>$penalties[$count]</td>
																	<td>$remarks[$count]</td>
																	<td>$statuses[$count]</td>
																	<td>$date_releases[$count]</td>
																</tr>
															";
														$count++;
													}
													echo "</tbody>
															</table>";
												?>
											</div>
										</div>


					           		</div>
					           		<div class="row pr col-lg-12">
										<p><span>Noted By </span>: <?php echo $noted_by; ?></p>
									</div>
					           <!--/row-->
					        	</div>
					        <!--/panel-body-->
					     	</div>
					     <!--/panel-->
					  	</div>
					</div>
				<!-- </div> -->
			</div>
		</div>

		<!-- page end-->

</body>
  <?php include "../includes/js.php"; ?>
  <script>
  	
  	$(function(){
  		window.print();
  		window.setTimeout(function(){
  			window.close();
  		}, 500);
  	});
  </script>
</html
