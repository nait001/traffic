<?php
require_once '../config/config.php';
if(isset($_POST['violzz_idz'])){
	$violation = $_POST['violzz_idz'];
	$pen = $_POST['penz'];
	$offense = $_POST['offense'];
	$sql = "insert into penalty (vio_id,penalty,offense) values (?,?,?)";
	$query = $theConnection->prepare($sql);
	$query->bind_param('iss',$violation,$pen, $offense);
	if($query->execute()){
		header('location:../penalty.php');
	}
}
else{
	echo "haha";
}
?>