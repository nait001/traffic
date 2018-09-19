<?php session_start();
require_once '../config/config.php';
$combo = $_GET['combo'];
$sql = "select distinct v.ctc, v.fname, v.lname, v.mname, v.owner, e.fname, e.lname, e.mname, v.v_id from violator as v left join endorser as e on e.endorser_id = v.endorser_id left join violator_offense as vf on vf.v_id = v.v_id where vf.status = ?";
$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
$query->bind_param('s', $combo);
$query->execute();
$query->store_result();
$query->bind_result($ctc, $d_fname, $d_lname, $d_mname, $owner, $e_fname, $e_lname, $e_mname, $v_id);
if($query->num_rows() > 0) {
	while($query->fetch()){
		if($_SESSION['level'] != 3) {
			$sql_1 = "select p.offense, vio.violation, vf.remarks, vf.date_apprehend, vf.status, p.penalty, vf.date_released from violator as v left join violator_offense as vf on vf.v_id=v.v_id left join penalty as p on p.pen_id = vf.pen_id left join violation as vio on vio.vio_id = p.vio_id where vf.v_id = $v_id and vf.status = '$combo'";
			$query1 = $theConnection->prepare($sql_1) or die(mysqli_error($theConnection));
			$query1->execute();
			$query1->bind_result($offense, $violation, $remarks, $date_apprehend, $status, $penalty, $date_released);
			$query1->store_result();
			$count = $query1->num_rows();
				echo "<tr>
						<td>$ctc</td>
						<td><a href='view_violator.php?violator_id=$v_id'>".ucfirst($d_fname)." ".ucfirst($d_mname)." ".ucfirst($d_lname)."</a><table>
							<thead>
								<tr>
									<th>Date Apprehended</th>
									<th>Violation</th>
									<th>Offense</th>
									<th>Penalty</th>
									<th>Remarks</th>
									<th>Date Released</th>
								</tr>
							</thead>
						";
			while($query1->fetch()) {
				if(!empty($date_apprehend)){
					$date_apprehend = date('F d, Y', strtotime($date_apprehend));
				}
				if(!empty($date_released)){
					$date_released = date('F d, Y', strtotime($date_released));
				}
				echo "<tr>
						<td>$date_apprehend</td>
						<td>$violation</td>
						<td>$offense</td>
						<td>$penalty</td>
						<td>$remarks</td>
						<td>$date_released</td>
					</tr>";
			}
			echo "</table>
					</td>
			<td>".ucfirst($owner)."</td>
			<td>".ucfirst($e_fname)." ".ucfirst($e_mname)." ".ucfirst($e_lname)."</td>
			<td>
				<div class='btn-group'> 
					<a class='btn btn-success' href='edit_violator.php?violator_id=$v_id'><i class='fa fa-edit'></i></a>
					<a class='btn btn-danger' onclick='delete_record($v_id)' href='#'><i class='icon_close_alt2'></i></a>
			  	</div>
		  	</td>
		</tr>";
		} else {
			$sql_2 = "select p.offense, vio.violation, vf.remarks, vf.date_apprehend, vf.status, p.penalty, vf.date_released from violator as v left join violator_offense as vf on vf.v_id=v.v_id left join penalty as p on p.pen_id = vf.pen_id left join violation as vio on vio.vio_id = p.vio_id where vf.v_id = $v_id";
						$query2 = $theConnection->prepare($sql_2);
						$query2->execute();
						$query2->bind_result($offense, $violation, $remarks, $date_apprehend, $status, $penalty, $date_released);
						$query2->store_result();
						$count = $query2->num_rows();
				echo "<tr>
						<td>$ctc</td>
						<td><a href='view_violator.php?violator_id=$v_id'>".ucfirst($d_fname." ".$d_fname." ".$d_fname)."</a><table>
						<thead>
							<tr>
								<th>Date Apprehended</th>
								<th>Violation</th>
								<th>Offense</th>
								<th>Penalty</th>
								<th>Remarks</th>
								<th>Date Released</th>
							</tr>
						</thead>";
				while($query2->fetch()) {
					if(!empty($date_apprehend)){
						$date_apprehend = date('F d, Y', strtotime($date_apprehend));
					}
					if(!empty($date_released)){
						$date_released = date('F d, Y', strtotime($date_released));
					}
					echo "<tr>
							<td>$date_apprehend</td>
							<td>$violation</td>
							<td>$offense</td>
							<td>$penalty</td>
							<td>$remarks</td>
							<td>$date_released</td>
						</tr>";
				}
						echo "</table></td>
						<td>".ucfirst($owner)."</td>
						<td>".ucfirst($e_fname." ".$e_fname." ".$e_fname)."</td>
					</tr>";
		}
	}
} else {
	echo "<tr><td colspan = '10' class='text-center'>No Results Found</td></tr>";
}
?>