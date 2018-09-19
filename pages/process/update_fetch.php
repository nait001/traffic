<?php
require_once '../config/config.php';
if(isset($_GET['idzz'])){
$id = $_GET['idzz'];
$sql = "select * from violator where v_id=?";
$query = $theConnection->prepare($sql);
$query->bind_param('i',$id);
$query->execute();
$query->bind_result($id,$fname,$mname,$lname,$address,$bday,$pen_id);
$query->fetch();
 
echo "<input type='text' class='hidden ups' name='rec_id' value='$id' /><div class='form-group '>
	  <label for='fname' class='control-label col-lg-2'>First Name <span class='required'>*</span>	</label>
	  <div class='col-lg-10'>
		  <input class='form-control ups' value='$fname' id='fname' name='fname' minlength='5' type='text' required autofocus/>
	  </div>
  </div>
  <div class='form-group '>
	  <label for='mname' class='control-label col-lg-2'>Middle Name <span class='required'>*</span></label>
	  <div class='col-lg-10'>
		  <input class='form-control ups' value='$mname' id='mname' type='text' name='mname' required />
	  </div>
  </div>
  <div class='form-group '>
	  <label for='lname' class='control-label col-lg-2'>Last Name <span class='required'>*</span></label>
	  <div class='col-lg-10'>
		  <input class='form-control ups' value='$lname' id='lname' type='text' name='lname' required/>
	  </div>
  </div>
  <div class='form-group '>
	  <label for='address' class='control-label col-lg-2'>Address <span class='required'>*</span>	</label>
	  <div class='col-lg-10'>
		  <input class='form-control ups'  value='$address' id='address' name='address' minlength='5' type='text' required 	/>
	  </div>
  </div>
  <div class='form-group '>
	  <label for='bday' class='control-label col-lg-2'>Birth Date <span class='required'>*</span></label>
	  <div class='col-lg-10'>
		  <input class='form-control ups' value='$bday' type='date' id='bday' name='bday' required />
	  </div>
  </div>
  <div class='form-group '>
	  <label for='violation' class='control-label col-lg-2'>Violation <span class='required'>*	</span>
	  </label>
	  <div class='col-lg-10'>
		  <select class='form-control ups' id='violation' name='violationz' required>
			  <option value=''>Select Violation</option>";
				$query->close();
			  $sql = "select p.pen_id,v.violation from penalty as p inner join violation as v on v.vio_id=p.vio_id";
			  $query = $theConnection->prepare($sql);
			  $query->execute();
			  $query->bind_result($idz,$violaton);
			  while($query->fetch()){
				  if($pen_id==$idz){
					echo "<option value='$idz' selected>$violaton</option>";
				  }
				  else{
					  echo "<option value='$idz'>$violaton</option>";
				  }
			  }

		echo "</select>
	  </div>
  </div> ";
}
?>