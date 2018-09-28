<?php
require_once '../config/config.php';
$del_id=$_GET['del_id'];
$sql = "delete from violator where v_id=?";
$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
$query->bind_param('i',$del_id);
if($query->execute()){
	echo "<script>alert('Record has been successfully deleted!');window.location.href='../view.php';</script>";
} else {
	echo "<script>alert('$query->error');window.location.href='../view.php';</script>";
}
?>