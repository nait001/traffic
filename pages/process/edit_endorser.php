<?php
require_once '../config/config.php';
session_start();
$id = $_POST['endorser_id'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$contact = $_POST['contact'];
$sql = "update endorser set fname =?, mname =? , lname = ?, contact=? where endorser_id=?";
$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
$query->bind_param('ssssi', $fname, $mname, $lname, $contact, $id);
if($query->execute()){
	$_SESSION['success'] = "Update Successful";
}
else {
	$_SESSION['error'] = $query->error;
}
header('location: ../edit_endorser.php?endorser_id='.$id);
?>