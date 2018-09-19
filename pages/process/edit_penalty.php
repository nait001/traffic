<?php
session_start();
require_once '../config/config.php';
if(isset($_POST['penalty_id'])){
	$penalty_id = $_POST['penalty_id'];
	$violation_id = $_POST['violzz_idz'];
	$offense = $_POST['offense'];
	$penalty = $_POST['penz'];
	$sql = "UPDATE penalty set vio_id=?, penalty=?, offense=? where pen_id=?";
	$query = $theConnection->prepare($sql);
	$query->bind_param('issi', $violation_id, $penalty, $offense, $penalty_id);
	if($query->execute()){
		$_SESSION['success'] = "Update Success";
	}
	else {
		$_SESSION['error'] = "Update Failed";
	}
	header('location: ../edit_penalty.php?penalty_id='.$penalty_id);
}
?>