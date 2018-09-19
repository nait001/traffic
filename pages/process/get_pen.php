<?php
require_once '../config/config.php';
$sql = "select p.pen_id, v.violation,p.penalty, p.offense from penalty as p inner join violation as v on v.vio_id=p.vio_id";
$query = $theConnection->prepare($sql);
$query->execute();
$query->bind_result($id, $viol,$pen,$offense);
while($query->fetch()){
	echo "<tr>
			<td>$viol</td>
			<td>$pen</td>
			<td>$offense</td>
			<td><div class='btn-group'> 
			<a class='btn btn-success' href='edit_penalty.php?penalty_id=$id'><i class='fa fa-edit'></i></a>
			<a class='btn btn-danger' onclick='delete_penalty($id)' href='#'><i class='icon_close_alt2'></i></a>
		  </div></td>
		</tr>";
}

?>