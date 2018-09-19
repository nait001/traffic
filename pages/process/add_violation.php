<?php
require_once '../config/config.php';
if(isset($_POST['violzz'])){
$violation = $_POST['violzz'];
$no_offense = $_POST['offense'];
$sql = "insert into violation (violation, no_offense) values (?,?)";
$query = $theConnection->prepare($sql);
$query->bind_param('si',$violation, $no_offense);
if($query->execute()){
	header('location:../violation.php');
}
}
else{
	echo "haha";
}
?>