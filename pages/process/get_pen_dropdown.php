<?php
require_once '../config/config.php';
$sql = "select p.pen_id,v.violation, p.vio_id from penalty as p inner join violation as v on v.vio_id=p.vio_id group by p.vio_id";
$query = $theConnection->prepare($sql);
$query->execute();
$result = $query->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($rows);
?>