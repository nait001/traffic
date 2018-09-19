<?php
session_start();
require_once "../config/config.php";
if(isset($_POST['violation_id'])){
	$violation = $_POST['violation'];
	$offense = $_POST['offense'];
	$sql = "update violation set violation=?, no_offense=? where vio_id=?";
	$query = $theConnection->prepare($sql);
	$query->bind_param('sii', $violation, $offense, $_POST['violation_id']);
	if($query->execute()){
		$_SESSION['success'] = "Update Success!";
	}
	else {
		$_SESSION['error'] = "Update Failed!";
	}
	header('location: ../edit_violation.php?violation_id='.$_POST['violation_id']);
}
?>