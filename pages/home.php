<?php session_start();
	require_once 'config/config.php';
	if(isset($_SESSION['user'])){
		
	}
	else{
		header('location:index.php');
	}
	$sql = "select count(*) as vio_cnt from violation";
	$query = $theConnection->prepare($sql);
	$query->execute();
	$result = $query->get_result();
	$row_v = $result->fetch_all(MYSQLI_ASSOC);
	$row_v = array_shift($row_v);
	$query->close();
	$sql = "select count(*) violator_cnt from violator";
	$query = $theConnection->prepare($sql);
	$query->execute();
	$result = $query->get_result();
	$row_viol = $result->fetch_all(MYSQLI_ASSOC);
	$row_viol = array_shift($row_viol);
	$query->close();
	$sql = "select count(*) pen_cnt from penalty";
	$query = $theConnection->prepare($sql);
	$query->execute();
	$result = $query->get_result();
	$row_pen = $result->fetch_all(MYSQLI_ASSOC);
	$row_pen = array_shift($row_pen);
	$query->close();
?>
<!DOCTYPE html>
<html lang="en">

<head> 
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
		  <div class="col-lg-12">
			<h3 class="page-header"><i class="fa fa-home"></i> Dashboard</h3>
		  </div>
		</div>

		<div class="row">
		  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		  	<a href="view.php">
			<div class="info-box blue-bg">
			  <i class="fa fa-user"></i>
			  <div class="count"><?php echo $row_viol['violator_cnt'] ?></div>
			  <div class="title">Violators</div>
			</div>
			</a>
			<!--/.info-box-->
		  </div>
		  <!--/.col-->

		  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		  	<a href="violation.php">
			<div class="info-box brown-bg">
			  <i class="fa fa-exclamation-triangle"></i>
			  <div class="count"><?php echo $row_v['vio_cnt'] ?></div>
			  <div class="title">Violations</div>
			</div>
		</a>
			<!--/.info-box-->
		  </div>
		  <!--/.col-->

		  <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
		  	<a href="penalty.php">
			<div class="info-box dark-bg">
			  <i class="fa fa-rouble"></i>
			  <div class="count"><?php echo $row_pen['pen_cnt'] ?></div>
			  <div class="title">Penalties</div>
			</div>
		</a>
			<!--/.info-box-->
		  </div>
		  <!--/.col-->

		 
		  <!--/.col-->

		</div>
		<div class="row">
			<div class="col-lg-12">
				<strong>Violators Per Month</strong>
			</div>
			<div class="col-lg-12" id="legend" ></div>
		  <div class="col-lg-12">
			<div id="morris_chart" style="height: 300px;"></div>
		  </div>
		  
		</div>

		<div class="row">

			
			 
		  <div class="col-lg-12"  style="margin-top: 50px !important;">
		  	<div class="col-lg-12">
				<strong>Violators with the same violations</strong>
			</div>
			<div class="col-lg-12" id="legend1" ></div>
			<div id="morris_chart1" style="height: 300px;"></div>
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
	  $(function() {
		data = {
			"male_total" : 5,
			"male_validated" : 10,
			"female_total" : 15,
			"female_validated" : 20
		};

		$.ajax({
			method: "GET",
			url: "process/get_graph_data.php",
			success: function(e) {
				var data = JSON.parse(e);
				the_chart(data);
			}
		});

		$.ajax({
			method: "GET",
			url: "process/get_same_violations.php",
			success: function(e) {
				var data = JSON.parse(e);
				the_chart1(data);
			}
		});
		
	  });


	function the_chart(chart_data) {
        $("#morris_chart").empty();
        console.log();
        config = {
            data: chart_data,
            xkey: 'x',
            ykeys: ['a'],
            labels: ['Violators'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red'],
            barColors: ['blue']
        };
        config.element = 'morris_chart';
        config.labels.forEach(function(label, i) {
        var legendItem = $('<span></span>').text( config.labels[i] ).prepend('<span>&nbsp;</span>');
            legendItem.find('span')
              .css('backgroundColor', config.barColors[i])
              .css('width', '10px')
              .css('display', 'inline-block')
              .css('margin', '5px')
              .css('font-size', '11px');
            $('#legend').append(legendItem)
          });
        Morris.Bar(config);
    }

    function the_chart1(chart_data) {
        $("#morris_chart1").empty();
        config = {
            data: chart_data,
            xkey: 'x',
            ykeys: ['b', 'c', 'd'],
            labels: ['Total Violators', "Male", "Female"],
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red'],
            barColors: ['gray', 'red', 'violet']
        };
        config.element = 'morris_chart1';
        config.labels.forEach(function(label, i) {
        var legendItem = $('<span></span>').text( config.labels[i] ).prepend('<span>&nbsp;</span>');
            legendItem.find('span')
              .css('backgroundColor', config.barColors[i])
              .css('width', '10px')
              .css('display', 'inline-block')
              .css('margin', '5px')
              .css('font-size', '11px');
            $('#legend1').append(legendItem)
          });
        Morris.Bar(config);
    }
	</script>

</body>

</html>
