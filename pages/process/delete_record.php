<?php
require_once '../config/config.php';
$del_id=$_GET['del_id'];
$sql = "delete from violator where v_id=?";
$query = $theConnection->prepare($sql);
$query->bind_param('i',$del_id);
if($query->execute()){
	echo "<script>alert('Record has been successfully deleted!');window.location.href='../view.php';</script>";
}
?>