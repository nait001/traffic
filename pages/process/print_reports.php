<?php
require_once "../config/config.php";
$type = $_GET['type'];
$min_year = 2010;
$max_year = date('Y');
$reports = array();
if($type == 'yearly') {
	$sql = 'select count(*) from violator_offense where extract(year from date_apprehend) = ?';
	$query = $theConnection->prepare($sql);
	while($min_year <= $max_year) {
		$query->bind_param('i', $min_year) or die(mysqli_error($theConnection));
		$query->execute();
		$query->bind_result($count_years);
		$query->fetch();
		$reports += array($min_year => $count_years);
		$min_year++;
	}
}
if($type == 'monthly') {
	$c=0;
	$months = array(
	"01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"
	);
	$month_words = array(
		"Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"
	);
	$sql = "select count(*) as per_month from violator_offense where extract(month from date_apprehend) = ?";
	$query = $theConnection->prepare($sql);
	foreach($months as $month) {
		$query->bind_param('s', $month);
		$query->execute();
		$query->bind_result($per_month);
		while($query->fetch()) {
			$reports[$month_words[$c]] = $per_month;
		}
		$c++;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print Reports</title>
	<link href="../../bootstrap3/bootstrap.min.css" rel="stylesheet" type="text/css" media="print">
		<link href="../../bootstrap3/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<header class="onlyprint" id="headers" style="margin-left:10%;">
    <div class="row">
		<div class="col-lg-12">
	    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	    		<img src="../../img/phil.png" style="height: 100px;width: 100px;">
	    	</div>
	    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-left:15%">
	    		Sagay Police Station<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspPhilippines<br>
	    		&nbsp&nbsp&nbsp&nbsp&nbsp094912839491
	    	</div>
	    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
	    		<img src="../../img/pnp.jpeg" style="height: 100px;width: 100px;">
	    	</div>
	    </div>
    </div>
</header>

<div class="row" style="margin:20px 10% 0 10%;">
	<div class="col-lg-12">
		<table class="table">
			<thead>
				<?php if($type=='yearly'): ?>
					<th>Year</th>
				<?php endif; ?>
				<?php if($type=='monthly'): ?>
					<th>Month</th>
				<?php endif; ?>
				<th>Count</th>
			</thead>
			<tbody>
				<?php foreach($reports as $index => $val): ?>
					<tr>
						<td><?php echo $index ?></td>
						<td><?php echo $val ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
</body>
<script src="../../bootstrap3/jquery-2.2.3.min.js"></script>
<script src="../../bootstrap3/bootstrap.min.js"></script>
<script>
	
	$(function() {
		window.print();
		window.setTimeout(() => {
			window.close();
		}, 500)
	});
</script>
</html>