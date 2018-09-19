<?php
session_start();
require_once '../config/config.php'; 
if(isset($_POST['username']) && isset($_POST['old_password'])){
	$new_password = $_POST['new_pass'];
	$old_password = $_POST['old_password']; 
	$username = $_POST['username'];
	$fname = $_POST['u_fname'];
	$lname = $_POST['u_lname'];
	$mname = $_POST['u_mname'];
	$sql = "SELECT password from admin WHERE username = ?";
	$query = $theConnection->prepare($sql);
	$query->bind_param('s', $username);
	$query->execute();
	$query->bind_result($db_password);
	$query->fetch();
	$query->close();
	if(empty($_POST['new_password']) && !isset($_POST['new_password']) && empty($_POST['old_password']) && !isset($_POST['old_password'])){
		$old_password = $_POST['pass'];
		$new_pass = $_POST['pass'];
	}
	else {
		$old_password = hash("sha256", $old_password.$username);
		$new_pass = hash('sha256', $new_password.$username);
	} 
	if($db_password == $old_password){ 
		$sql = "UPDATE admin set password = ?, fname = ?, mname = ?, lname = ? where username = ?";
		$query = $theConnection->prepare($sql);
		$query->bind_param('sssss', $new_pass, $fname, $mname, $lname, $username);
		if($query->execute()){
			$_SESSION['fname'] = $fname;
			$_SESSION['mname'] = $mname;
			$_SESSION['lname'] = $lname;
			$_SESSION['password'] = $new_pass;
			echo "<script>alert('Credentials Changed');
					window.location.href='../home.php';
				</script>";
		}
		else {
			echo "<script>alert('Failed to change Credentials');
					window.location.href='../home.php';
				</script>";
		} 
	}
	else {
		echo "<script>alert('Please confirm your old password')
				window.location.href='../home.php';
			</script>";
	}
}
else if(isset($_POST['user_level'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$con_pass = $_POST['con_pass'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$mname = $_POST['mname'];
	$level = $_POST['user_level'];
	if($password == $con_pass){
		$password = hash('sha256', $password.$username);
		$sql = "UPDATE admin set fname=?, lname=?, mname=?, level=?, password=? WHERE username=?";
		$query = $theConnection->prepare($sql);
		$query->bind_param('ssssss', $fname, $lname, $mname, $level, $password, $username);
		if($query->execute()){
			$_SESSION['success'] = "User Updated";
		}
		else {
			$_SESSION['error'] = "Failed to Update User";
		}
	}
	else {
		$_SESSION['error'] = "Password's do not match";
	}
	header('location: ../edit_user.php?username='.$username);
}
?>