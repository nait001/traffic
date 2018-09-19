<?php
require_once '../config/config.php';
$sql = "select * from endorser";
$query = $theConnection->prepare($sql);
$query->execute();
$query->bind_result($endorser_id, $fname, $mname, $lname, $contact);
while($query->fetch()){
	echo "<tr>
			<td>".ucfirst($fname." ".$mname." ".$lname)."</td>
			<td>".$contact."</td>
			<td>
				<div class='btn-group'> 
					<a class='btn btn-success' href='edit_endorser.php?endorser_id=$endorser_id'><i class='fa fa-edit'></i></a>
					<a class='btn btn-danger' onclick='delete_endorser($endorser_id)' href='#'><i class='icon_close_alt2'></i></a>
			  	</div>
		  	</td>
		</tr>";
}
?>