<?php
require_once '../config/config.php';
$violator_id = $_GET['violator_id'];
$sql = "select vf.violator_offense_id, v.violation, p.offense, vf.remarks, vf.date_apprehend, vf.status, vf.date_released, p.penalty from violator_offense as vf inner join penalty as p on p.pen_id = vf.pen_id inner join violation as v on v.vio_id=p.vio_id where vf.v_id = ?";
$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
$query->bind_param('i', $violator_id);
$query->execute();
$result = $query->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($rows);
?>