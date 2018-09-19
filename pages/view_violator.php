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
  <?php include "../includes/css.php" ?>
  <!-- =======================================================
	Theme Name: NiceAdmin
	Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
	Author: BootstrapMade
	Author URL: https://bootstrapmade.com
  ======================================================= -->
	<style>
		.bio-row{
			color: black !important;
		}
		.inputs {
			width: auto;
			height: 30px;
			border-radius: 5px;
		}
		@media screen and (min-width: 768px) {
		  .modal-lg{
		      width:1200px;
		  }

		  .modal-sm{
		      width:300px;
		  }
		}
	</style>
</head>

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
		<!-- page start-->
		<div class="row" id="not_print">
			<div class="col-lg-12">
				<a class="btn btn-primary" style="margin-bottom:5px;" href="view.php"><i class="fa fa-reply"></i> Back</a>
				<a class="btn btn-default pull-right" href="print.php?violator_id=<?php echo $violator_id ?>" target="_blank" style="margin-bottom:5px;"><i class="fa fa-print"></i> Print</a>
                <input type="hidden" id="violator_id" value="<?php echo $violator_id; ?>">
			</div>
		</div>
		<div class="row" id="violator_info">
			<div class="col-lg-12">
			<!-- profile -->
				<div class="container">
					<div class="row">
					  	<div class="col-md-12">
					    	<div class="panel panel-default">
					        	<div class="panel-body">
					           		<div class="row">
						              	<div class="col-xs-12 col-sm-2 text-center">
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
											<span>Violation & Offense
				                             <button class="btn btn-sm btn-primary fa fa-edit" id="violation_info"></button>
				                            </span>
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

		<!-- page end-->
		</section>
	</section>
	<!--main content end-->
  </section>
	
	<!--- MODAL --->
		<div class="modal fade" id="vio_inf" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<form class="form-validate" id="violation_form">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span></button>
	                    	<center><h1>Violation Info</h1></center>
						</div>
						<div class="modal-body" id="violation_form_body">
							<div class="row">
								<div class="form-horizontal">
									<div class="col-lg-2" style='width: auto'>
										<label>Date Apprehend</label>
										<input class='form-control' type="date">
									</div>
									<div class="col-lg-1" style='width: 12%'>
										<label>Offense</label>
										<input class='form-control' type="text">
									</div>
									<div class="col-lg-1" style='width: 12%'>
										<label>Violation</label>
										<input class='form-control' type="text">
									</div>
									<div class="col-lg-2" style='width: 12%'>
										<label>Penalty</label>
										<input class='form-control' type="text">
									</div>
									<div class='col-lg-2' style='width:14%'>
										<label>Status</label>
										<select class='form-control'>
											<option value=''>Please Select</option>
										</select>
									</div>
									<div class='col-lg-2' style='width:14%'>
										<label>Remarks</label><br>
										<select class='form-control'>
											<option value=''>Please Select</option>
										</select>
									</div>
									
									<div class='col-lg-2'>
										<label>Date Released</label>
										<input class='form-control' type="date">
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
	                        <button type="submit" class="btn btn-primary pull-left">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	
  <!-- container section start -->

  <!-- javascripts -->
  <?php include "../includes/js.php"; ?>
	<script>
	  //knob
		function printz() {
			
			window.print();
			
		}
	  $(function() {
		$(".knob").knob({
		  'draw': function() {
			$(this.i).val(this.cv + '%')
		  }
		});
        populate_form();
	  });

    function populate_form() {
        var violator_id = $("#violator_id").val();
        
        $.ajax({
            type: "GET",
            url: "process/populate_violator_info_form.php",
            data:{violator_id:violator_id},
            success: function(e) {
            	var c =0;
                var res = JSON.parse(e);
                $("#violation_form_body").empty();
                $.each(res, function(i, v) {
                	rem_select(v.remarks, 'rem_selects'+c);
                	status_select(v.status, 'status_selects'+c);
                    $("#violation_form_body").append(
                        `<input type='hidden' name='vf_id[]' value='${v.violator_offense_id}'>
                        <div class='row'>
	                    	<div class='form-horizontal'>

	                    		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	                                <label>Date Apprehended:</label>
	                                <input class='form-control'  type="date" value='${v.date_apprehend}' name="date_apprehended[]"  />
	                            </div>

	                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style='width: 12%'>
	                                <label>Violation:</label>
	                                <input class='form-control'  type="text" value='${v.violation}' readonly/>
	                            </div>

	                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style='width: 12%'>
	                                <label>Offense:</label>
	                                <input class='form-control'  type="text" value='${v.offense}' readonly/>
	                            </div>

	                            <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2' style='width: 12%'>
	                            	<label>Penalty:</label>
	                            	<input class='form-control' type='text' value='${v.penalty}' readonly />
	                            </div>

	                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style='width: 14%'>
	                                <label>Remarks:</label><br>
	                                <select class='form-control'  name='remarks[]' id='rem_selects${c}'>
	                                	<option value='' >Select Remark</option>
	                                	<option value='Released'>Released</option>
	                                	<option value='Not Released'>Not Released</option>
	                                </select>
	                            </div>

	                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style='width: 14%'>
	                                <label>Status:</label><br>
	                                <select class='form-control'  name="status[]" id='status_selects${c}'>
	                                	<option value=''>Select Status</option>
										<option value="Settled">Settled</option>
										<option value="Not Settled">Not Settled</option>
	                                </select>
	                            </div>

	                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
	                                <label>Date Released:</label><br>
	                                <input class='form-control' type="date" value='${v.date_released}' name="date_released[]"  />
	                            </div>

	                        </div>
	                     </div>`
                    );
                    c++;
                });
            }
        });
    }

    function rem_select(remark, i) {
    	window.setTimeout(function(){
    		$("#"+i).val(remark);
    	}, 500);
    	
    }

    function status_select(status, i) {
    	window.setTimeout(function() {
    		$("#"+i).val(status);
    	}, 500);
    }

	$("#violation_info").on('click', function(){
		$("#vio_inf").modal('show');
        
	});
	$("#violation_form").on('submit', function(e) {
		e.preventDefault();
		var data = $("#violation_form");
        var form = new FormData(data[0]);
        $.ajax({
            type: "POST",
            url: "process/insert_violator_info.php",
            data: form,
            processData:false,
            contentType:false,
            cache:false,
            success:function(e){
            	$("#vio_inf").modal('hide');
                alert(e);
                window.location.reload();
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
