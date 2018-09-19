<?php
require_once '../config/config.php';
$search = "%".$_GET['search_key']."%";
$sql = "select p.pen_id, v.violation,p.penalty, p.offense from penalty as p inner join violation as v on v.vio_id=p.vio_id where v.violation like ? or p.penalty like ?";
$query = $theConnection->prepare($sql);
$query->bind_param('ss', $search, $search);
$query->execute();
$query->store_result();
$query->bind_result($id, $viol,$pen,$offense);
if($query->num_rows() > 0){
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
}
else {
	echo "<tr><td>No Results Found</td></tr>";
}
?>