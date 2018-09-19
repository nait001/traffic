<?php
session_start();
require_once '../config/config.php';
if(isset($_GET['del_id'])){
	$sql = "delete from endorser where endorser_id=?";
	$query = $theConnection->prepare($sql);
	$query->bind_param('i', $_GET['del_id']);
	if($query->execute()){
		$_SESSION['success'] = "Delete Success";
	}
	else {
		$_SESSION['error'] = "Delete Failed";
	}
	header('location: ../endorser.php');
}
?>