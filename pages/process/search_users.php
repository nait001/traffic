<?php
require_once '../config/config.php';
$username = $_GET['username'];
$search = "%".$_GET['search_key']."%";
$sql = "SELECT * from admin where (fname like ? or mname like ? or lname like ?) and username <> ?";
$query = $theConnection->prepare($sql);
$query->bind_param('ssss', $search, $search, $search, $username);
$query->execute();
$query->store_result();
$query->bind_result($username, $password, $fname, $mname, $lname, $level);

if($query->num_rows() > 0){
	while($query->fetch()){
		switch($level){
			case 1:
				$level = "Admin";
				break;
			case 2:
				$level = "Traffic Enforcer";
				break;
			case 3:
				$level = "Polic Officer";
				break;
		}
		echo "<tr>
				<td>$username</td>
				<td>".ucfirst($fname." ".$mname." ".$lname)."</td>
				<td>$level</td>
				<td><a class='btn btn-success' href='edit_user.php?username=$username'><i class='fa fa-edit'></i></a></td>
			</tr>";
	}
}
else {
	echo "<tr><td>No Results Found</td></tr>";
}
?>