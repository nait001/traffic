<?php
require_once '../config/config.php';
$search = "%".$_GET['search_key']."%";
$sql = "select * from endorser where fname like ? or mname like ? or lname like ?";
$query = $theConnection->prepare($sql);
$query->bind_param('sss', $search, $search, $search);
$query->execute();
$query->store_result();
$query->bind_result($endorser_id, $fname, $mname, $lname, $contact);
if($query->num_rows() > 0) {
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
}
else {
	echo "<tr><td>No Results Found</td></tr>";
}

?>