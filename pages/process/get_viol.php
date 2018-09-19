<?php
require_once '../config/config.php';
$sql = "select * from violation";
$query = $theConnection->prepare($sql);
$query->execute();
$query->bind_result($id, $vio, $offense);
while($query->fetch()){
	echo "<tr name='$id'>
		<td>$vio</td>
		<td id='pop$id'></td>
		<td>$offense</td>
		<td><div class='btn-group'> 
			<a class='btn btn-success' href='edit_violation.php?violation_id=$id'><i class='fa fa-edit'></i></a>
			<a class='btn btn-danger' onclick='delete_violation($id, \"$vio\")'><i class='icon_close_alt2'></i></a>
		  </div>
		</td>
		</tr>";
}
?>