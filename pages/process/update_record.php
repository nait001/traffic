<?php
session_start();
require_once '../config/config.php';
$ctc = $_POST['ctc'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$owner = $_POST['owner'];
$address = $_POST['address'];
$bday = $_POST['bday'];
$offense_type = $_POST['offense_type'];

$endorser = $_POST['endorser'];
$impound = $_POST['impound'];
$chassis_no  = $_POST['chassis_no'];
$engine_no  = $_POST['engine_no'];

$noted = isset($_POST['noted']) ? $_POST['noted'] : '';
$id = $_POST['violator_id'];
$stats = array();
if(isset($_FILES['pic']['name']) && !empty($_FILES['pic']['name'])){
	$pic_name = $_FILES['pic']['name'];
	$pic_tmp = $_FILES['pic']['tmp_name'];
	$sql = "update violator set fname=?, mname=?, lname=?, address=?, bday=?, pic=?, ctc=?, owner=?, endorser_id=?, impound=?, chassis_no=?, engine_no=?, noted_by=?, gender=? where v_id=?";
	$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
	$query->bind_param('ssssssisisssssi', $fname, $mname, $lname, $address, $bday, $pic_name, $ctc, $owner, $endorser, $impound, $chassis_no, $engine_no, $noted, $gender, $id);
	move_uploaded_file($pic_tmp, "../imgs/".$pic_name);
}
else {
	$_SESSION['success'] = "From else";
	$sql = "update violator set fname=?, mname=?, lname=?, address=?, bday=?, ctc=?, owner=?, endorser_id=?, impound=?, chassis_no=?, engine_no=?, gender = ?, noted_by=? where v_id=?";
	$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
	$query->bind_param('sssssisisssssi', $fname, $mname, $lname, $address, $bday, $ctc, $owner, $endorser, $impound, $chassis_no, $engine_no, $gender, $noted, $id);
}
if($query->execute()){
	$sql2 = "insert into violator_offense (pen_id, v_id) values (?,?)";
	$query2 = $theConnection->prepare($sql2) or die(mysqli_error($theConnection));
	$sql = "select count(*) as cnt from violator_offense where v_id = ? and pen_id = ?";
	$query1 = $theConnection->prepare($sql);
	// $query3 = $theConnection->query("DELETE FROM violator_offense where v_id = $id");
	foreach($offense_type as $off) {
		$query1->bind_param('ii', $id, $off);
		$query1->execute();
		$query1->bind_result($cnt);
		$query1->store_result();
		$query1->fetch();
		if($cnt < 1) {
			$query2->bind_param('ii', $off, $id);
			if($query2->execute()) {
				$stats[] = "Update Successful";
			}
			else {
				$stats[] = "error";
			}
		}
	}
	
}
else {
	$stats[] = "error";
}
if(in_array("error", $stats)) {
	$_SESSION['error'] = $query->error;
}
else {
	$_SESSION['success'] = "Update Successful";
	header('location: ../edit_violator.php?violator_id='.$id);
}

?>