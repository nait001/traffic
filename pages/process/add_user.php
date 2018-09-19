<?php
session_start();
require_once '../config/config.php';
if(isset($_POST['username'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$con_pass = $_POST['con_pass'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mname = $_POST['mname'];
	$level = $_POST['user_level'];
	if($password == $con_pass){
		$password = hash('sha256', $password.$username);
		$sql = "insert into admin values (?,?,?,?,?,?)";
		$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
		$query->bind_param('sssssi', $username, $password, $fname, $mname, $lname, $level);
		if($query->execute()){
			$_SESSION['success'] = "Registration Successful";
		}
		else {
			$_SESSION['error'] = "Registration Failed / Username already exists";
		}
	}
	else {
		$_SESSION['error'] = "Password's do not match";
	}
	header('location: ../register_user.php');
}
?>