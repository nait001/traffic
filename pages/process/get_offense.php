<?php
require_once '../config/config.php';
if(isset($_GET['offense'])){
	$id = $_GET['offense'];
	$sql = "select no_offense from violation where vio_id = ?";
	$query = $theConnection->prepare($sql);
	$query->bind_param('i', $id);
	$query->execute();
	$query->bind_result($offense_no);
	$query->fetch();
	$query->close();
	$sql = "select offense from penalty where vio_id = $id order by offense";
	$query = mysqli_query($theConnection, $sql);
	$offense = mysqli_fetch_all($query, MYSQLI_ASSOC);
	$data = array(
		"offense_no" => $offense_no,
		"offense_type" => $offense
	);
	echo json_encode($data);
	$query->close();
}
else if(isset($_GET['pen_id'])){
	$pen_ids = $_GET['pen_id'];
	$sql = "select vio_id from penalty where pen_id = ?";
	$query = $theConnection->prepare($sql) or die(mysqli_error($theConnection));
	$offs = array();
	$ffs = array();
	if(!empty($pen_ids)){
		foreach($pen_ids as $pen_id) {

			$query->bind_param('i', $pen_id);
			$query->execute();
			$query->bind_result($violation_id);
			$query->store_result();
			$query->fetch();
			$query->free_result();
			$sql = "select f.pen_id, f.offense, vi.violation from penalty as f inner join violation as vi on vi.vio_id = f.vio_id where f.vio_id =".$violation_id;
			$query1 = mysqli_query($theConnection, $sql) or die(mysqli_error($theConnection));
			$offenses = mysqli_fetch_all($query1, MYSQLI_ASSOC);
			array_push($offs, $offenses);
		}
		$prev = "";
		foreach($offs as $key => $values) {
			foreach($values as $k => $v) {
				if($offs[$key][$k]['violation'] == $prev) {
					$offs[$key][$k]['violation'] = "";
				} 
				$prev = $v['violation'];
			}
		}
		echo json_encode($offs);
		$query1->close();
	}

}
?>