<?php
require_once '../config/config.php';
$sql = "select * from endorser";
$query = $theConnection->prepare($sql);
$query->execute();
$result = $query->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($rows);
?>