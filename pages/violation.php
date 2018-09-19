<?php session_start();
	if(isset($_SESSION['user']) && $_SESSION['level'] != 2){
		
	}
	else{
		header('location:index.php');
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
				<div style="margin:0px 0px 5px 15px;">
					<h1>Violation</h1> 
					<a class="btn btn-primary btn-sm" data-target='#addVio' data-toggle='modal' href="" id='addzz'><i class='icon_plus_alt2'></i> Add Violation</a>
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
							<table class="table table-striped table-advance table-hover table-responsive" id="table_vio">
								<tr>
									<th></i>Violation Name</th>
									<td><i class=''></i>Number of Violators</td>
									<td><i class=''></i>Number of Offense</td>
									<th><i class="icon_cogs"></i> Action</th>
								</tr>
								<tbody id='tbodz_vio'>
								
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
	
	<!--- MODAL --->
		 
	   <div class="modal fade" id="addVio">
			<div class="modal-dialog modal-sm">
				<div class="modal-content" >
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<center><h1>Add Violation</h1></center>
					</div>
					<div class="modal-body" style="height:200px">
						<form id="form_add" name="formzz" method="post" action="process/add_violation.php">
							<input class="form-control input-lg m-bot15 te" name="violzz" id='fr_vio' type="text" placeholder="Violation" required autofocus>
							<input type="number" placeholder="No. of offense" name="offense" class="form-control input-lg m-bot-15 te">
							<input style="margin-top:10px;" type="submit" class="btn btn-primary pull-left" value="Add">
						</form>	
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div> 
	
  <!-- container section start -->

  <!-- javascripts -->
  <?php include "../includes/js.php"; ?>
	<script>
	  //knob
		function delete_violation(id, violation=""){ 
			if(confirm("Please confirm delete")){ 
				window.location.href='process/delete_violation.php?violation_id='+id+'&violation='+violation;
			}
		}
		function get_viol(){
			$.ajax({
				method:'post',
				url:'process/get_viol.php',
				data:{},
				success:(e)=>{
					$('#tbodz_vio').html(e);
					get_pop();
				}
			});
		}


		var timeout = null;

		var search = document.getElementById("search");
		search.addEventListener('keyup', function(){
			clearTimeout(timeout);
			timeout = setTimeout(function() {
				$.ajax({
					method: "GET",
					url: "process/search_violations.php",
					data: {search_key: search.value},
					success: function(e) {
						$("#tbodz_vio").html(e);
					}
				});
			}, 1000);
		});

		function get_pop(){
			var idz=[];
			for(var i =0;i<tbodz_vio.getElementsByTagName('tr').length;i++){
				idz[i]=[tbodz_vio.getElementsByTagName('tr')[i].getAttribute('name')]; 
			}
			idz.forEach((el)=>{ 
				$.post('process/get_violation_pop.php',{id:el},(e)=>{
					document.getElementById("pop"+el).innerHTML=e;
				});
			});
		}
		window.onload = get_viol();
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
