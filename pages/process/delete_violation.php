<?php
session_start();
require_once '../config/config.php';
if(isset($_GET['violation_id'])){
	$sql = "delete from violation where vio_id = ?";
	$query = $theConnection->prepare($sql);
	$query->bind_param('i', $_GET['violation_id']);
	if($query->execute()){
		$_SESSION['success'] = "Delete Success!";
	}
	else {
		$_SESSION['error'] = "This ".$_GET['violation'].' has a violator recorded';
	}
	header('location: ../violation.php');
}
?>