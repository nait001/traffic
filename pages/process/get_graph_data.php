<?php
require_once "../config/config.php";
$months = array(
	"01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"
);
$month_words = array(
	"Jan", "Feb", "March", "April", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"
);

$count_month = array();
$data = array();
$sql = "select count(*) as per_month from violator_offense where extract(month from date_apprehend) = ?";
$query = $theConnection->prepare($sql);
foreach($months as $month) {
	$query->bind_param('s', $month);
	$query->execute();
	$query->bind_result($per_month);
	while($query->fetch()) {
		$count_month[] = $per_month;
	}
}
$query->close();

$c = 0;
foreach($months as $month){
	$data[] = array(
		"x" => $month_words[$c],
		"a" => $count_month[$c]
	);
	$c++;
}
echo json_encode($data);
?>