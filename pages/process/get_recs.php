<?php
require_once '../config/config.php';
session_start();
$dateN = date('Y');
$age = 0;
$violations = array();
$sql = "select v.gender, v.v_id,v.fname,v.mname,v.lname,v.address,v.bday, v.pic from violator as v";
$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
$query->execute();
$query->bind_result($gender, $idzz,$fname,$mname,$lname,$address,$bday, $pic);
$query->store_result();
while($query->fetch()){
	$bday = date('Y',strtotime($bday)); 
	$age = $dateN - $bday;
	if($_SESSION['level'] != 3) {
	$sql_1 = "select p.offense, vio.violation, vf.remarks, vf.date_apprehend, vf.status, p.penalty, vf.date_released from violator as v left join violator_offense as vf on vf.v_id=v.v_id left join penalty as p on p.pen_id = vf.pen_id left join violation as vio on vio.vio_id = p.vio_id where vf.v_id = $idzz";
	$query1 = $theConnection->prepare($sql_1);
	$query1->execute();
	$query1->bind_result($offense, $violation, $remarks, $date_apprehend, $status, $penalty, $date_released);
	$query1->store_result();
	$count = $query1->num_rows();
		echo "<tr>
				<td><a href='view_violator.php?violator_id=$idzz'>".ucfirst($fname)." ".ucfirst($mname)." ".ucfirst($lname)."</a><table>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Apprehended</th>
						<th>Violation</th>
						<th>Offense</th>
						<th>Penalty</th>
						<th>Remarks</th>
						<th>Status</th>
						<th>Date Released</th>
					</tr>
				</thead>
				";
				$count = 0;
	while($query1->fetch()) {
		$count++;
		if(!empty($date_apprehend)){
			$date_apprehend = date('F d, Y', strtotime($date_apprehend));
		}
		if(!empty($date_released)){
			$date_released = date('F d, Y', strtotime($date_released));
		}
		echo "<tr>
				<td>$count</td>
				<td>$date_apprehend</td>
				<td>$violation</td>
				<td>$offense</td>
				<td>$penalty</td>
				<td>$remarks</td>
				<td>$status</td>
				<td>$date_released</td>
			</tr>";
	}
				echo "</table></td>
				<td><div class='btn-group'> 
				<a class='btn btn-success' href='edit_violator.php?violator_id=$idzz'><i class='fa fa-edit'></i></a>
				<a class='btn btn-danger' onclick='delete_record($idzz)' href='#'><i class='icon_close_alt2'></i></a>
			  </div></td>
			</tr>";
	} else {                                                                                                         
		$sql_2 = "select p.offense, vio.violation, vf.remarks, vf.date_apprehend, vf.status, p.penalty, vf.date_released from violator as v left join violator_offense as vf on vf.v_id=v.v_id left join penalty as p on p.pen_id = vf.pen_id left join violation as vio on vio.vio_id = p.vio_id where vf.v_id = $idzz";
				$query2 = $theConnection->prepare($sql_2);
				$query2->execute();
				$query2->bind_result($offense, $violation, $remarks, $date_apprehend, $status, $penalty, $date_released);
				$query2->store_result();
				$count = $query2->num_rows();
		echo "<tr>
				<td><a href='view_violator.php?violator_id=$idzz'>".ucfirst($fname." ".$mname." ".$lname)."</a><table>
				<thead>
					<tr>
						<th>#</th>
						<th>Date Apprehended</th>
						<th>Violation</th>
						<th>Offense</th>
						<th>Penalty</th>
						<th>Remarks</th>
						<th>Status</th>
						<th>Date Released</th>
					</tr>
				</thead>";
				$count = 0;
		while($query2->fetch()) {
			$count++;
			if(!empty($date_apprehend)){
				$date_apprehend = date('F d, Y', strtotime($date_apprehend));
			}
			if(!empty($date_released)){
				$date_released = date('F d, Y', strtotime($date_released));
			}
			echo "<tr>
				<th>$count</td>
				<td>$date_apprehend</td>
				<td>$violation</td>
				<td>$offense</td>
				<td>$penalty</td>
				<td>$remarks</td>
				<td>$status</td>
				<td>$date_released</td>
			</tr>";
		}
				echo "</table></td>
			</tr>";
	}
}

?>