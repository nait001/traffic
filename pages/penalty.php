<?php session_start();
	if(isset($_SESSION['user']) && $_SESSION['level'] != 2){
		
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
				<div style="margin: 0px 0px 5px 15px">  
					<h1>Penalties</h1> 
					<a class="btn btn-primary btn-sm" data-target='#addPen' data-toggle='modal' href="" id='addzz'><i class='icon_plus_alt2'></i> Add Penalty</a>
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
				<div class="col-md-12"> 
					<div class="box">
						<div class="box body">
							<input type="text" placeholder="Search.." id="search" class="col-lg-3 pull-right" style="margin: 0px 0px 5px 0px;border-radius: 5px;height: 40px;">
							<table class="table table-striped table-advance table-hover table-responsive" id="table_pen">
								<tr>
									<th><i></i>Violation Name</th>
									<th><i></i>Penalty</th>
									<th><i></i>Offense</th>
									<th><i class="icon_cogs"></i> Action</th>
								</tr>
								<tbody id='tbodz_pen'>
								
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		<!--/.row-->

	  </section>
	  
	</section>
	<!--main content end-->
  </section>
  <!-- container section start -->
<div class="modal fade" id="addPen">
			<div class="modal-dialog modal-sm">
				<div class="modal-content" >
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<center><h1>Add Penalty</h1></center>
					</div>
					<div class="modal-body" style="height:210px">
						<form id="form_add" name="formzz" method="post" action="process/add_penalty.php">
							 <select name="violzz_idz" id="violation_id" class="form-control m-bot15" required autofocus>
								 <option value="">Select Violation</option>
								 <?php
								  $sql = "select v.* from violation as v where v.no_offense > (select count(offense) from penalty where vio_id = v.vio_id)";
								 $query = $theConnection->prepare($sql);
								 $query->execute();
								 $query->bind_result($idz,$vi,$no);
								 while($query->fetch()){
									 echo "<option value='$idz'>$vi</option>";
								 }
								 ?>
							</select>
							<select name="offense" id="offense" class="form-control m-bot15" required autofocus>
								 <option value="">Select Offense</option>
							</select>
							<input class="form-control input-lg m-bot15 te" name="penz" id='fr_vio' type="text" placeholder="Penalty" required >
							<input type="submit" class="btn btn-primary pull-left" value="Add">
						</form> 
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div> 
  <!-- javascripts -->
  <?php include "../includes/js.php"; ?>
	<script>
		$("#violation_id").on('change', function(){
			$.ajax({
				method: "GET",
				url: "process/get_offense.php",
				data: {offense: $("#violation_id").val()},
				success: function(e){
					var data = JSON.parse(e);
					$("#offense").empty();
					$("#offense").append("<option value=''>Select Offense</option>");
					var count=1;
					var offense = [];
					$.each(data['offense_type'], function(i, v){
						offense.push(v['offense']);
					});
					for(var i = 0; i<data['offense_no'];i++){
						if(offense.indexOf("Offense "+count) == -1){
							$("#offense").append(
								"<option value='Offense "+count+"'>Offense "+count+"</option>"
							);
						}  
						count++;
					}
				}
			});
		}); 
		function delete_penalty(id){
			if(confirm("Please confirm delete")){
				window.location.href="process/delete_penalty.php?penalty_id="+id;    
			}
		}
		var timeout = null;

		var search = document.getElementById("search");
		search.addEventListener('keyup', function(){
			clearTimeout(timeout);
			timeout = setTimeout(function() {
				$.ajax({
					method: "GET",
					url: "process/search_penalties.php",
					data: {search_key: search.value},
					success: function(e) {
						$("#tbodz_pen").html(e);
					}
				});
			}, 1000);
		});
	  //knob
		function get_pen(){
			$.ajax({
				method:'post',
				url:'process/get_pen.php',
				data:{},
				success:(e)=>{
					$('#tbodz_pen').html(e);
				}
			});
		}
		get_pen();
		
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
