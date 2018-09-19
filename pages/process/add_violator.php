<?php
session_start();
require_once '../config/config.php';
$pic_name = $_FILES['pic']['name'];
$pic_tmp = $_FILES['pic']['tmp_name'];
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
$id = "";
$stats = array();
$sql = "insert into violator values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
$query->bind_param('issssssisisssss', $id, $fname, $mname, $lname, $address, $bday, $pic_name, $ctc, $owner, $endorser, $impound, $chassis_no, $engine_no, $noted, $gender);
$error = "";
if($query->execute()){
	move_uploaded_file($pic_tmp, "../imgs/".$pic_name);
	$query->close();
	$query = $theConnection->query("select v_id from violator where ctc = ".$ctc);
	$v_id = mysqli_fetch_all($query, MYSQLI_ASSOC);
	$query->close();
	$sql = "insert into violator_offense (v_id, pen_id) values (?, ?)";
	$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
	foreach($offense_type as $ot) {

		$query->bind_param('ii', $v_id[0]['v_id'], $ot);
		if($query->execute()) {
			$stats[] = "success";
		} else {
			$stats[] = "error";
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
	$_SESSION['success'] = "Data Added";
}

header('location: ../violator.php');
?>