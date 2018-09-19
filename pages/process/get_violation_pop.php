<?php
require_once '../config/config.php';
$pop_id = $_POST['id'];
$sql = "select v.pen_id from violator_offense as v inner join penalty as p on p.pen_id=v.pen_id inner join violation as vi on vi.vio_id=p.vio_id where vi.vio_id=?";
$query=$theConnection->prepare($sql);
$query->bind_param('i',$pop_id[0]);
$query->execute();
$query->bind_result($idzz);
$query->store_result();
echo $query->num_rows();
?>