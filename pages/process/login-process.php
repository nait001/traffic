<?php session_start();
require_once '../config/config.php';
$user = $_POST['username'];
$password = $_POST['password'];
$sql = "select * from admin where username=?";
$query = $theConnection->prepare($sql);
$query->bind_param('s',$user);
$query->execute();
$query->bind_result($us,$ps,$fname,$mname,$lname,$level);
$query->store_result();
if($query->num_rows()>0){
	$query->fetch();
	$password = hash('sha256', $password.$user);  
	if($ps==$password){
		$_SESSION['user'] = $user;
		$_SESSION['level'] = $level;
		$_SESSION['fname'] = $fname;
		$_SESSION['mname'] = $mname;
		$_SESSION['lname'] = $lname;
		$_SESSION['password'] = $ps;
		header('location:../home.php');
	}
	else{
		$_SESSION['error']="error";
		header('location:../');
	}
}
else{
		$_SESSION['error']="error";
		header('location:../');
	}
?>