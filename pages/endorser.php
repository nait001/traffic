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
  <style>
	  body{
		color: black;
	  }
	  input {
		font-weight: bold;
		color: black !important;
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
		<!--overview start-->
		  <div class="row">
				<div style="margin: 0px 0px 5px 15px">  
					<h1>Traffic Enforcers</h1> 
					<a class="btn btn-primary btn-sm" data-target='#endorser_modal' data-toggle='modal' href="" id='addzz'><i class='icon_plus_alt2'></i> Add Enforcer</a>
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
							<table class="table table-striped table-advance table-hover table-responsive" id="endorser_table">
								<tr>
									<th><i></i>Full Name</th>
									<th><i></i>Contact</th>
									<th><i class="icon_cogs"></i> Action</th>
								</tr>
								<tbody id='endorser_body'>
								
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
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="endorser_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Add Enforcer Form</h4>
			</div>
			<div class="modal-body">

				<form class="form-horizontal" role="form" action="process/add_enforcer.php" method="post">
					<div class="form-group">
						<label for="fname" class="col-lg-3 control-label">First Name: <span style="color:red;">*</span></label>
						<div class="col-lg-8">
							<input type="text" name="fname" class="form-control" id="fname" placeholder="First Name" required>
						</div>
					</div>
					<div class="form-group">
						<label for="mname" class="col-lg-3 control-label">Middle Name: </label>
						<div class="col-lg-8">
							<input type="text" name="mname" class="form-control" id="mname" placeholder="Middle Name">
						</div>
					</div>
					<div class="form-group">
						<label for="lname" class="col-lg-3 control-label">Last Name: <span style="color:red;">*</span></label>
						<div class="col-lg-8">
							<input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
						</div>
					</div>
					<div class="form-group">
						<label for="contact" class="col-lg-3 control-label">Contact No. : <span style="color:red;">*</span></label>
						<div class="col-lg-8">
							<input type="text" name="contact" class="form-control" id="contact" placeholder="Contact" required>
						</div>
					</div>
					<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button type="submit" class="btn btn-info">Add</button>
						<button type="reset" class="btn btn-default">Reset</button>
					</div>
					</div>
				</form>

			</div>

		</div>
	</div>
</div> 
  <!-- javascripts -->
  <?php include "../includes/js.php"; ?>
	<script>
	  function delete_endorser(id){
		if(confirm("Please confirm delete")){
		  window.location.href="process/delete_endorser.php?del_id="+id;
		}
	  }
		function get_endorsers(){
			$.ajax({
				method: 'GET',
				url: 'process/get_endorsers.php',
				success: function(e){
					$("#endorser_body").html(e);
				}
			});
		}
	  $(function() {
		get_endorsers();
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
	  var timeout = null;

		var search = document.getElementById("search");
		search.addEventListener('keyup', function(){
			clearTimeout(timeout);
			timeout = setTimeout(function() {
				$.ajax({
					method: "GET",
					url: "process/search_endorser.php",
					data: {search_key: search.value},
					success: function(e) {
						$("#endorser_body").html(e);
					}
				});
			}, 1000);
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
