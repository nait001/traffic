<?php
session_start();
require_once '../config/config.php';
if(isset($_GET['penalty_id'])){
	$sql = "delete from penalty where pen_id=?";
	$query = $theConnection->prepare($sql);
	$query->bind_param('i', $_GET['penalty_id']);
	if($query->execute()){
		$_SESSION['success'] = "Delete Success";
	}
	else {
		$_SESSION['error'] = "Delete Failed";
	}
	header('location: ../penalty.php');
}
?>