<?php
require_once '../config/config.php';
$remarks = $_POST['remarks'];
$date_appre = $_POST['date_apprehended'];
$vf_ids = $_POST['vf_id'];
$statuses = $_POST['status'];
$date_releases = $_POST['date_released'];
$count = 0;
$status = array();
$sql = "update violator_offense set date_apprehend = ?, remarks = ?, status = ?, date_released = ? where violator_offense_id = ?";
$query = $theConnection->prepare($sql);
foreach($vf_ids as $vf_id) {
	if(empty($date_releases[$count])){
		$date_releases[$count] = null;
	}
	if(empty($date_appre[$count])){
		$date_appre[$count] = null;
	}

	$query->bind_param('ssssi', $date_appre[$count], $remarks[$count], $statuses[$count], $date_releases[$count], $vf_id);
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