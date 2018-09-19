<?php
require_once '../config/config.php';
$username = $_GET['username'];
$sql = "SELECT * from admin where username != ?";
$query = $theConnection->prepare($sql);
$query->bind_param('s', $username);
$query->execute();
$query->bind_result($username, $password, $fname, $mname, $lname, $level);
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
?>