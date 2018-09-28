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
	
	<?php include "../includes/js.php"; ?>
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
					<h1>All Records</h1>  
					<div class="col-md-12"> 
					<div class="box">
						<div class="box body">
							<select id="search_settle" class="col-lg-3 pull-right" style="margin: 0px 0px 5px 10px;border-radius: 5px;height: 40px;">
								<option value=''>Please Select</option>
								<option value="Settled">Settled</option>
								<option value="Not Settled">Not Settled</option>
							</select>
							<input type="text" placeholder="Search.." id="search" class="col-lg-3 pull-right" style="margin: 0px 10px 5px 0px;border-radius: 5px;height: 40px;">
							<table class="table table-striped table-hover" id="table_vio">
								<tr>
									<th><i class="icon_profile"></i> Driver</th>
									<?php if($_SESSION['level'] != 3): ?>
										<th><i class="icon_cogs"></i> Action</th>
									<?php endif; ?>
								</tr>

								<tbody id='tbodz_rec'>
									
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
		<script>
			//knob
		function delete_record(id){
				if(confirm("Please Confirm delete")){
					window.location.href="process/delete_record.php?del_id="+id;
				}
		}
		function get_recs(){
			$.ajax({
				method:'post',
				url:'process/get_recs.php',
				data:{},
				success:(e)=>{
					$("#tbodz_rec").empty();
					$('#tbodz_rec').html(e);
					
				}
			});
		}
		$(function() {
			get_recs();
		});
		var timeout = null;

		var search = document.getElementById("search");
		var combo = document.getElementById("search_settle");

		search.addEventListener('keyup', function(){
			clearTimeout(timeout);
			combo.value = "";
			timeout = setTimeout(function() {
				if(search.value.length > 0){
					$.ajax({
						method: "GET",
						url: "process/search_records.php",
						data: {search_key: search.value},
						success: function(e) {
							$("#tbodz_rec").html(e);
						}
					});
				} 
				else {
					get_recs();
				}
			}, 1000);
		});

		combo.addEventListener('change', function() {
			search.value = "";
			if(combo.value.length > 0) {
				$.ajax({
					method: "GET",
					url: "process/search_combo_settle.php",
					data: {combo:combo.value},
					success: function(e) {
						$("#tbodz_rec").html(e);
					}
				});
			}
			else {
				get_recs();
			}
			
		});
		</script>

</body>

</html>
