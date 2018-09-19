<?php
require_once '../config/config.php';
$search = "%".$_GET['search_key']."%";
$sql = "select *, count(*) as cnt from violation where violation like ?";
$query = $theConnection->prepare($sql);
$query->bind_param('s', $search);
$query->execute();
$query->store_result();
$query->bind_result($id, $vio, $offense, $cnt);
if($query->num_rows() > 0) {
	while($query->fetch()){
		echo "<tr name='$id'>
			<td>$vio</td>
			<td id='pop$id'>$cnt</td>
			<td>$offense</td>
			<td><div class='btn-group'> 
				<a class='btn btn-success' href='edit_violation.php?violation_id=$id'><i class='fa fa-edit'></i></a>
				<a class='btn btn-danger' onclick='delete_violation($id, \"$vio\")'><i class='icon_close_alt2'></i></a>
			  </div>
			</td>
			</tr>";
	}
}
else {
	echo "<tr><td>No Results Found</td></tr>";
}
?>