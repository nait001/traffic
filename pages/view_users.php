<?php session_start();
	if(isset($_SESSION['user'])){
		
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
<style>
	body {
		color: black;   
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
					<h1>User Records</h1>  
				<div class="col-md-12"> 
					<div class="box">
						<div class="box body">
							<input type="text" placeholder="Search.." id="search" class="col-lg-3 pull-right" style="margin: 0px 0px 5px 0px;border-radius: 5px;height: 40px;">
							<input type="hidden" id ="userz" value = "<?php echo $_SESSION['user'] ?>" />
							<table class="table table-striped table-advance table-hover table-responsive" id="user_tbl">
								<tr>
									<th><i class="icon_profile"></i> Username</th>
									<th><i class="fa fa-user"></i> Full name</th>
									<th><i class="fa fa-user"></i> User Level</th>
									<th><i class="icon_cogs"></i> Action</th>
								</tr>
								<tbody id='user_body'>
								
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
  <!-- javascripts -->
  <?php include "../includes/js.php"; ?>
	<script>
	  //knob
		function delete_record(id){
			if(confirm("Please Confirm delete")){
				window.location.href="process/delete_record.php?del_id="+id;
			}   
		}
		function get_recs(){
			var data = {
				username: '<?php echo $_SESSION["user"] ?>'
			}; 
			$.ajax({   
				url:'process/get_users.php?username='+data['username'], 
				success:(e)=>{
					$('#user_body').html(e);
				}
			});
		}
		var dataz = "";
		get_recs();
		$(function() {
		$(".knob").knob({
		  'draw': function() {
			$(this.i).val(this.cv + '%')
		  }
		})
		dataz ='<?php echo $_SESSION["user"] ?>'; 
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
				dataz = document.getElementById('userz').value;
				$.ajax({
					method: "GET",
					url: "process/search_users.php",
					data: {search_key: search.value, username: dataz},
					success: function(e) {
						$("#user_body").html(e);
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
