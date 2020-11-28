<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Divisional Sports Association - Reports</title>
</head>

<body>
<form action="reports.php" method="post">
<?php
$linkId = mysqli_connect("localhost","root","","dsa");
//mysql_select_db("dsa",$linkId);
?>

<div align="center" id="divfirst">
	<h1 align="center" style="font-size:45px; margin:10px; padding:10px; margin-bottom:30px;" id="h1dsa">Divisional Sports Association - Reports</h1>
		
	<table align="center" id="hideshow1">
		<tr align="center">
			<th colspan="1" width="50%">Select Sport</th>
			<td colspan="1" width="50%">
				<select name="selectsport" id="selectsport">
					<option value="cricket" selected="selected">Cricket</option>
					<option value="vollyball">Vollyball</option>
					<option value="chess">Chess</option>
					<option value="handball">Handball</option>
				</select>
			</td>
		</tr>
		<tr align="center">
			<th colspan="1">Select Gender</th>
			<td colspan="1">
				<select name="selectgender" id="selectgender">
					<option value="male" selected="selected">Male</option>
					<option value="female">Female</option>
					<option value="other">Other</option>
				</select>
			</td>
		</tr>
		<tr align="center">
			<th colspan="1">Select Employee Group</th>
			<td colspan="1">
				<select name="selectgrp" id="selectgrp">
					<option value="A">Group A</option>
					<option value="B">Group B</option>
					<option value="C" selected="selected">Group C</option>
				</select>
			</td>						
		</tr>
		<tr align="center">
			<th colspan="1">Select Age Group</th>
			<td colspan="1">
				<input type="text" onkeypress="return isNumberKey(event)" maxlength="2" name="minage" id="minage" size="3px" />
				<label>To</label>
				<input type="text" onkeypress="return isNumberKey(event)" maxlength="2" name="maxage" id="maxage" size="3px" />
			</td>						
		</tr>
		<tr align="center">
			<td colspan="1"><button type="button" name="btnexit" id="btnexit">Exit</button></td>
			<td colspan="1"><button type="submit" name="btnsubmit" id="btnsubmit">Submit</button></td>
		</tr>
	</table>
</div>
		
<div align="center" style="margin-top:40px" id="abc">
		<?php
		
			if(isset($_POST['btnsubmit'])){
//			    if(!empty($_POST['selectgender']) && !empty($_POST['selectsport']) && !empty($_POST['selectgrp']) && (!empty($_POST['minage']) || $_POST['minage'] == "0") && !empty($_POST['maxage'])) {
//                    echo $_POST['maxage'];
//                }
				if(!empty($_POST['selectgender']) && !empty($_POST['selectsport']) && !empty($_POST['selectgrp']) && (!empty($_POST['minage']) || $_POST['minage'] == "0") && !empty($_POST['maxage'])){
				
					$sport = $_POST['selectsport'];
					$gender = $_POST['selectgender'];
					$group = $_POST['selectgrp'];
					$minage = $_POST['minage'];
					$maxage = $_POST['maxage'];
					
					$sql_report = "SELECT `contestantinfo`.`name`,`contestantinfo`.`gender`, `contestantinfo`.`age`, `contestantinfo`.`sport`, `contestantinfo`.`relation`,`contestantinfo`.`achivements`, `logininfo`.`EMPNAME`,`logininfo`.`GROUP` FROM `contestantinfo` INNER JOIN `logininfo` ON `contestantinfo`.`pfno` = `logininfo`.`EMPNO` WHERE `contestantinfo`.`gender` = '".$gender."' AND `contestantinfo`.`sport` = '"."shortput"."' AND `logininfo`.`GROUP` = '".$group."' AND `contestantinfo`.`age` >= '".$minage."' AND `contestantinfo`.`age` <= '".$maxage."'";

					
					//echo $sql_report;
					
					$result_report = mysqli_query($linkId,$sql_report);
					$srno = 1;
					if(mysqli_num_rows($result_report) > 0){
						?>
						<table style="margin-top:40px;" id="tblprint">
							<tr align="center">
								<th style="width:10%">Sr. No.</th>
								<th style="width:30%">Player Name</th>
								<th style="width:30%">Employee Name</th>
								<th style="width:10%">Relation</th>
								<th style="width:10%">Age</th>
								<th style="width:10%">Achivements</th>
							</tr>
						<caption style="font-size:22px; padding-bottom:10px;"><?php echo "Report of ".ucfirst($gender)." ".ucwords($sport)." players with age group ".$minage."-".$maxage." and Employee group '".$group."'"; ?></caption>
						<?php
						while($row_report = mysqli_fetch_array($result_report)){
							?>
								<tr align="center">
								<td style="width:10%"><?php echo $srno; ?></td>
								<td style="width:30%"><?php echo ucwords($row_report['name']); ?></td>
								<td style="width:30%"><?php echo ucwords($row_report['EMPNAME']); ?></td>
								<td style="width:10%"><?php echo ucwords($row_report['relation']); ?></td>
								<td style="width:10%"><?php echo $row_report['age']; ?></td>
								<td style="width:10%"><?php echo ucwords($row_report['achivements']); ?></td>
								</tr><?php
								$srno++;
						}
						
						?>
						<tr align="center" id="trprint">
							<td colspan="6"><input type="button" name="btnprint" id="btnprint" value="Print" /></td>
						</tr>	
						</table>
						<?php
					}
					else{
						?><label style="margin-top:40px; font-size:30px; padding-top:30px">Sorry! No players found</label>
						<?php
					}
				}
				else echo "<script>alert('please provide all valid entries');</script>";
			}
		
		?>
</div>
<div class="footer">
	  <label>Created and developed by </label><font color="#FF4646">Mimoh Kulkarni&emsp;</font>
	</div>
		
<script src="jquery-3.4.1.min.js"></script> 
<script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    return !(charCode > 31 && (charCode < 48 || charCode > 57));

}

$(document).ready(function(){
	$('#btnexit').on('click',function(){
		//location.reload();
		window.location.href='http://localhost/dsa/login.php';
    });
	
	$('#btnprint').on('click',function(){
        $("#trprint").hide();
		var printContents = document.getElementById("abc").innerHTML;
		var originalContents = document.body.innerHTML;
	
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
    });
});

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>


<style>
#btnsubmit,#btnexit,#btnadd,#btncontinue,#btnexit1,#btnotp{
	background-color:#4caf50;
	color:black;
	padding: 12px 20px;
	margin:8px 0;
	cursor:pointer;
	width:50%;
}

#btnexit.hover{
	opacity: 0.8;
}

table,th,td{
	border:3px solid #FF9D9D;
	border-collapse:collapse;
	
}

th,td{
	text-align:center;
	padding:10px;
	padding-left:20px;
	padding-right:20px;
}

#reporttable{
margin-top:50px;
width:50%;
}


.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color:#97CBFF;
   color: white;
   text-align: right;
}
</style>

</form>
</body>
</html>
