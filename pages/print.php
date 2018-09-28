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
	$ctcs = array();
	$endorsers = array();
	$owners = array();
	$impounds = array();
	$chassises = array();
	$engines = array();
	if(isset($_GET['violator_id'])){
		$violator_id = $_GET['violator_id'];
		$sql = "select v.gender, v.pic, vf.ctc, v.fname, v.mname, v.lname, v.address, vf.owner, v.bday, vio.violation, p.offense, e.fname, e.mname, e.lname, vf.impound, vf.chassis_no, vf.engine_no, v.noted_by, vf.remarks, vf.date_apprehend, vf.status, p.penalty, vf.date_released from violator as v left join violator_offense as vf on vf.v_id = v.v_id left join endorser as e on e.endorser_id=vf.endorser_id left join penalty as p on p.pen_id = vf.pen_id left join violation as vio on vio.vio_id = p.vio_id where v.v_id=? order by vf.date_released desc";
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
			$ctcs[] = $ctc;
			$endorsers[] = ucfirst($endorser_fname).' '.ucfirst($endorser_lname);
			$owners[] = ucfirst($owner);
			$impounds[] = $impound;
			$chassises[] = $chassis_no;
			$engines[] = $engine_no;
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
  <?php include "../includes/css.php" ?>


	<style media="print">
		body{
	 		margin: 0mm 0mm 0mm 0mm !important;
		}
		#headers{
			width: auto; 
			border: 0; 
			margin: 0 0 0 0 !important; 
			margin-top: 0mm !important;
			padding: 0; 
			float: none !important; 
		}
</style>
<style>
@media screen {
    header.onlyprint{
        display: none; 
    }
}
</style>
</head>

<body>
  <!-- container section start -->
  <section id="container" class="">

	
	<!--sidebar end-->

 







	<!--main content start-->
		<!-- page start-->
		
		<div id="form_print">
		<div class="row" id="violator_info">
			<div class="col-lg-12">
				<header class="onlyprint" id="headers">
				    <div class="row col-lg-12">
				        <table class='table' >
				        	<tr>
				        		<td><img src="../img/phil.png" style="height: 100px;width: 100px;"></td>
				        		<td class="text-center" style='width:90%'>Sagay Police Station<br>Philippines<br>094912839491</td>
				        		<td> <img src="../img/pnp.jpeg" style="height: 90px;width: 90px;"></td>
				        	</tr>
				        </table>
				    </div>
				</header>
			<!-- profile -->
				<div class="container">
					<div class="row">
					  	<div class="col-md-12">
					    	<div class="panel panel-default" style="width: 1450px !important">
					        	<div class="panel-body">
					           		<div class="row">
						              	<div class="col-xs-2 col-sm-2 text-center">
						                	<img src="imgs/<?php echo $pic; ?>" alt="image" class="center-block img-circle img-responsive">
						             	</div>
						              <!--/col-->
						              	<div class="col-xs-12 col-sm-10">
							                <h3><?php echo ucfirst($violator_fname." ".$violator_mname." ".$violator_lname); ?></h3>
							                <p><strong>Birthdate: </strong><?php echo date("F d, Y", strtotime($bday));  ?></p>
							                <p><strong>Age: </strong> <?php echo $age; ?> </p>
							                <p><strong>Gender: </strong> <?php echo $gender; ?> </p>
							                <p><strong>Address: </strong> <?php echo $address; ?> </p>
						              	</div>
					             	 <!--/col-->  
					           		</div>

					           		<div class="row">
					           			<div class="col-lg-12 bio-graph-info">
					           				<h1>Violator Information</h1>
					           			</div>
					           		</div>
					           		<div class="row col-lg-12 col-sm-12 col-md-12 col-xs-12">
										<div class="pull-left row col-lg-12 col-md-12 col-sm-12">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<span>Violation & Offense
				                            </span>
												<?php 
													$count = 0;
													echo "<table style='width: 1400px !important' class='table table-hover table-striped col-lg-12 col-md-12'>
																<thead style='font-weight: bolder'>
																	<tr>
																		<td>#</td>
																		<td style='width:200px !important'>Date Apprehend</td>
																		<td style='width:50px !important'>CTC</td>
																		<td style='width:150px !important'>Violation</td>
																		<td style='width:100px !important'>Owner</td>
																		<td style='width:100px !important'>Offense</td>
																		<td>Penalty</td>
																		<td style='width:50px !important'>Vehicle</td>
																		<td style='width:100px !important'>Chassis #</td>
																		<td style='width:100px !important'>Engine #</td>
																		<td style='width:120px !important'>Remarks</td>
																		<td style='width:100px !important'>Status</td>
																		<td style='width:150px !important'>Endorser</td>
																		<td style='width:170px !important'>Date Released</td>
																	</tr>
																</thead><tbody>";
													$no = 0;
													foreach($violations as $vio) {
														$no++;
														if(!empty($date_appre[$count])){
															$date_appre[$count] = date('F d, Y', strtotime($date_appre[$count]));
														}
														if(!empty($date_releases[$count])){
															$date_releases[$count] = date('F d, Y', strtotime($date_releases[$count]));
														}
														echo "
																<tr>
																	<td>$no</td>
																	<td>$date_appre[$count]</td>
																	<td>$ctcs[$count]</td>
																	<td>$vio</td>
																	<td>$owners[$count]</td>
																	<td>$offenses[$count]</td>
																	<td>$penalties[$count]</td>
																	<td>$impounds[$count]</td>
																	<td>$chassises[$count]</td>
																	<td>$engines[$count]</td>
																	<td>$remarks[$count]</td>
																	<td>$statuses[$count]</td>
																	<td>$endorsers[$count]</td>
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

										<div class="row" style="float:right !important;">
											<p><span>Noted By </span>: <?php echo $noted_by; ?></p>
										</div>

					           		</div>
					           <!--/row-->
					        	</div>
					        <!--/panel-body-->
					     	</div>
					     <!--/panel-->
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<!-- page end-->
		</section>
	
  <!-- container section start -->

  <!-- javascripts -->
  <?php include "../includes/js.php"; ?>
	<script>
		$(function() {
			print_data();
		})
		function print_data(){
         //Get the HTML of div
            var divElements = $("#for_print").html();
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            var head = document.getElementById('headers').innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + head +
              divElements + "</body>";

            //Print Page
            
            	window.print();	
            
            

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

            window.setTimeout(function() {
            	window.close();
            }, 500)
    }
	</script>

</body>

</html>
