<?php
require_once "../config/config.php";

$sql = "select vio_id from violation";
$query = $theConnection->prepare($sql);
$query->execute();
$query->bind_result($vio_id);
$query->store_result();
$sql1 = "select count(*), vio.violation from violator_offense as vf inner join penalty as p on p.pen_id = vf.pen_id inner join violation as vio on vio.vio_id = p.vio_id where vio.vio_id = ?";
$query1 = $theConnection->prepare($sql1) or die(mysqli_error($theConnection));
$sql2 = "select count(*) from violator_offense as vf inner join penalty as p on p.pen_id = vf.pen_id inner join violation as vio on vio.vio_id = p.vio_id inner join violator as v on v.v_id = vf.v_id where vio.vio_id = ? and v.gender='Male'";
$query2 = $theConnection->prepare($sql2) or die(mysqli_error($theConnection));
$sql3 = "select count(*) from violator_offense as vf inner join penalty as p on p.pen_id = vf.pen_id inner join violation as vio on vio.vio_id = p.vio_id inner join violator as v on v.v_id = vf.v_id where vio.vio_id = ? and v.gender='Female'";
$query3 = $theConnection->prepare($sql3) or die(mysqli_error($theConnection));
$count_same = array();
$violations = array();
$count_m = array();
$count_f = array();
while($query->fetch()) {
	$query1->bind_param('i', $vio_id);
	$query1->execute();
	$query1->bind_result($cnt_same, $violation);
	while($query1->fetch()) {
		$count_same[] = $cnt_same;
		$violations[] = $violation;
	}
	$query2->bind_param('i', $vio_id);
	$query2->execute();
	$query2->bind_result($cnt_m);
	while($query2->fetch()) {
		$count_m[] = $cnt_m;
	}
	$query3->bind_param('i', $vio_id);
	$query3->execute();
	$query3->bind_result($cnt_f);
	while($query3->fetch()) {
		$count_f[] = $cnt_f;
	}
}
$c = 0;
$data = array();
foreach($violations as $vio) {
	$data[] = array(
		"x" => $vio,
		"b" => $count_same[$c],
		"c" => $count_m[$c],
		"d" => $count_f[$c]
	);
	$c++;
}
echo json_encode($data);
?>