<?php
$linkId = mysqli_connect("localhost","root","","dsa");
//mysqli_select_db($abc,$linkId);


if($_POST["sel"] == "1"){
	if(!empty($_POST["pfno"])){
		$sql_login = "SELECT `EMPNAME`,`DESIG`,`DEPT` from `logininfo` WHERE `EMPNO` = '".$_POST["pfno"]."'";
		$result_login = mysqli_query($linkId,$sql_login);
		//echo mysql_affected_rows();
		if(mysqli_num_rows($result_login) == 1){
			$pfname = "User";
			while($row_pfname = mysqli_fetch_array($result_login)){
				$pfname = $row_pfname["EMPNAME"]."(".$row_pfname["DESIG"].", ".$row_pfname["DEPT"].")";
			}
			echo $pfname;
		}
		else echo "oops";
	}
}

elseif($_POST["sel"] == "2"){
	if(!empty($_POST["pfno"])){
		$sql_pfcheck = "SELECT `name`, `gender`, `birthdate`, `age`, `sport`, `relation`, `achivements` FROM `contestantinfo` WHERE `pfno` = '".$_POST['pfno']."' ";
		$sql_pfname = "SELECT `EMPNAME`,`DESIG`,`DEPT` from `logininfo` WHERE `EMPNO` = '".$_POST["pfno"]."'";
		$result_pfname = mysqli_query($linkId,$sql_pfname);
		$pfname = "User";
		while($row_pfname = mysqli_fetch_array($result_pfname)){
			$pfname = $row_pfname["EMPNAME"]."(".$row_pfname["DESIG"].", ".$row_pfname["DEPT"].")";
		}
		$result_pfcheck = mysqli_query($linkId,$sql_pfcheck);
		if(mysqli_num_rows($result_pfcheck) > 0){
			echo "<table>
					<tr align='center'>
					<td colspan='7'>Welcome ".ucwords($pfname)."</td>
					</tr>
					<tr align='center'>
					<th>Name</th>
					<th>Gender</th>
					<th>Birthdate</th>
					<th>Age</th>
					<th>Sport</th>
					<th>Relation</th>
					<th>Achivements</th>
					</tr>";
			while($row_pfcheck = mysqli_fetch_array($result_pfcheck)){
				echo "<tr>
						<td>".ucwords($row_pfcheck['name'])."</td>
						<td>".ucwords($row_pfcheck['gender'])."</td>
						<td>".date_format(date_create($row_pfcheck['birthdate']),'d/m/Y')."</td>
						<td>".$row_pfcheck['age']."</td>
						<td>".ucwords($row_pfcheck['sport'])."</td>
						<td>".ucwords($row_pfcheck['relation'])."</td>
						<td>".ucwords($row_pfcheck['achivements'])."</td>
						</tr>";
			}
			echo "</table>";
		}
		else echo "oops";
	}
	else echo "<script>alert('Error! Contact Admin');</script>";
}

elseif($_POST["sel"] == "3"){
	if(!empty($_POST["name"]) && !empty($_POST["pfno"]) && !empty($_POST["bday"]) && ($_POST["gender"] != "0") && ($_POST["rel"] != "0") && ($_POST["ach"] != "0") && ($_POST["sport"] != "0") && !empty($_POST["age"]) && !empty($_POST["mobileno"])){
		
		$sql_add = "INSERT INTO `contestantinfo`(`name`, `pfno`, `mobileno`, `gender`, `birthdate`, `age`, `sport`, `relation`, `achivements`) VALUES ('".strtolower($_POST["name"])."','".$_POST["pfno"]."','".$_POST["mobileno"]."','".strtolower($_POST["gender"])."','".$_POST["bday"]."','".$_POST["age"]."','".strtolower($_POST["sport"])."','".strtolower($_POST["rel"])."','".strtolower($_POST["ach"])."')";
		//echo "<script>alert(".$sql_add."')
		
		$result_add = mysqli_query($linkId,$sql_add);
		if(mysqli_affected_rows() == 1){
			echo "ok";
			//echo "<script>alert('Contestant added successfully!');
		}
		else echo "<script>alert('Error! Operation failed! Contatct Admin');</script>";
	}
	else echo "<script>alert('Please provide all valid values.');</script>";
}

?>