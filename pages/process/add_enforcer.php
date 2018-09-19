<?php
require_once "../config/config.php";
session_start();
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$contact = $_POST['contact'];
$id = "";
$sql = "INSERT into endorser values (?,?,?,?,?)";
$query = $theConnection->prepare($sql);
$query->bind_param('issss', $id, $fname, $mname, $lname, $contact);
if($query->execute()){
	$_SESSION['success'] = "Successfuly Added";
}
else {
	$_SESSION['error'] = "Adding Failed";
}
header('location: ../endorser.php');
?>