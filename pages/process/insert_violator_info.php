<?php
require_once '../config/config.php';
$remarks = $_POST['remarks'];
$date_appre = $_POST['date_apprehended'];
$vf_ids = $_POST['vf_id'];
$statuses = $_POST['status'];
$date_releases = $_POST['date_released'];
$ctc = $_POST['ctc'];
$owner = $_POST['owner'];
$impound = $_POST['impound'];
$chassis = $_POST['chassis'];
$endorser = $_POST['endorser'];
$engine = $_POST['engine'];
$count = 0;
$status = array();
$sql = "update violator_offense set date_apprehend = ?, remarks = ?, status = ?, date_released = ?, ctc = ?, owner = ?, endorser_id = ?, impound = ?, chassis_no = ?, engine_no = ? where violator_offense_id = ?";
$query = $theConnection->prepare($sql);
foreach($vf_ids as $vf_id) {
	if(empty($date_releases[$count])){
		$date_releases[$count] = null;
	}
	if(empty($date_appre[$count])){
		$date_appre[$count] = null;
	}

	$query->bind_param('ssssssisssi', $date_appre[$count], $remarks[$count], $statuses[$count], $date_releases[$count], $ctc[$count], $owner[$count], $endorser[$count], $impound[$count], $chassis[$count], $engine[$count], $vf_id);
	if($query->execute()) {
		$status[] = "success";
	} else {
		$status[] = "error";
	}
	$count++;
}
if(in_array("error", $status)) {
	echo "Error updating data";
} else {
	echo "Updating data success";
}
?>