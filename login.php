<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Divisional Sports Association - Application Form</title>
</head>

<body>
<form action="login.php" method="post">

<div class="slider">
	<div class="load">
	</div>
	<div class="content">
			<h1 align="center" style="font-size:45px; margin:10px; padding:10px;">Divisional Sports Association</h1>
		<div class="principal" align="center">
			
<!--  PART 1 -->
			<div align="center">
				<div class="login" align="center" style="display:block" id="hideshow1">
					<label for="txtpfno"><b>PF No.-</b></label>
					<input type="text" id="txtpfno" name="txtpfno" title="Enter PF Number" maxlength="11" placeholder="Enter 11 digit PF No."/>
					<label for="txtpfno"><b>Mobile No.-</b></label>
					<input type="text" id="txtmobileno" name="txtmobileno" title="Enter Mobile Number" maxlength="10" placeholder="Enter 10 digit Mobile No."/>
					<label style="font-size:10px">*OTP will be sent to this mobile number</label><br />
					<input type="button" value="Login" name="btnlogin" id="btnlogin" align="absmiddle"/><br />
					<label id="lblwait" style="display:none">Please Wait...</label>
				</div>
				<div align="center" style="display:block; width:100%" id="hideshow4">
					<table align="center">
						<tr align="center">
							<td>1,For children only two groups.<br />
									(a) 10yrs to 14yrs<br />
									(b) 15yrs to 18yrs<br />
								2, Minimum 6 (Six) participants required in each event will not be conducted.<br />
								3, Umpires decision will be final.<br />
								4, Last date of Entry is 6th Jan 2020.<br />
								5, Date & Time message will be given, participants should be on ground before 1/2 Hrs.
						</tr>
					</table>
				</div>
				
				
<!--  PART 2 -->
				<div id="hideshow2" style="display:none">
					<label>Registered Players</label>
					<div align="center" id="pftable">
					</div>
					<input type='button' value='Continue' name='btncontinue' id='btncontinue' align='absmiddle' style="width:25%"/>
					<input type='button' value='Logout' name='btnexit1' id='btnexit1' align='absmiddle' style="display:none; width:25%"/>
				</div>
		
<!-- PART 3 -->				
			<table align="center" style="display:none" id="hideshow3">
				<caption style="border:none">Entry Form</caption>
					<tr align="center">
						<td colspan="4"><label id="pfname"></label></td>
					</tr>
					<tr align="center">
						<th colspan="2">Sport</th>
						<td colspan="2">
							<select name="selectsport" id="selectsport">
								<option value="0">Select</option>
								<option value="cricket">Cricket</option>
								<option value="vollyball">Vollyball</option>
								<option value="chess">Chess</option>
								<option value="handball">Handball</option>
							</select>
						</td>
					</tr>
					<tr align="center">
						<th colspan="2">Name</th>
						<td colspan="2"><input type="text" name="txtname" id="txtname" class="txtclass" /></td>
					</tr>
					<tr align="center">
						<th colspan="1">Birthdate</th>
						<td colspan="1"><input type="date" name="bday" id="bday" /></td>
						<th colspan="1">Gender</th>
						<td colspan="1">
							<select name="selectgender" id="selectgender">
								<option value="0">Select</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Other">Other</option>
							</select>
						</td>
					</tr>
					<tr align="center">
						<th colspan="2">Relation with Employee</th>
						<td colspan="2">
							<select name="selectrel" id="selectrel">
								<option value="0">Select</option>
								<option value="self">Self</option>
								<option value="son">Son</option>
								<option value="daughter">Daughter</option>
								<option value="wife">Wife</option>
							</select>
						</td>
					</tr>
					<tr align="center">
						<th colspan="2">Achivements</th>
						<td colspan="2">
							<select name="selectach" id="selectach">
								<option value="none">None</option>
								<option value="disctrict">Disctrict</option>
								<option value="state">State</option>
								<option value="national">National</option>
								<option value="international">International</option>
							</select>
						</td>						
					</tr>
					<tr align="center">
						<td colspan="2"><button type="button" name="btnadd" id="btnadd">Submit</button></td>
						<td colspan="2"><button type="button" name="btnexit" id="btnexit">Exit</button></td>
					</tr>					
				</table>
	
		</div>
	</div>
	
	<div class="footer">
	  <label>Created and developed by </label><font color="#FF4646">Mimoh Kulkarni&emsp;</font>
	</div>
	

</div>
</div>
	
</form>
</body>


<style>
#txtpfno,#txtmobileno{
	width:100%;
	border:1px solid #ccc; 
	padding: 12px 20px;
	margin:8px 0;
	display:inline-block;
	box-sizing:border-box;
}

#txtotp{
	width:20%;
	border:1px solid #ccc; 
	padding: 12px 20px;
	margin:8px 0;
	display:inline-block;
	box-sizing:border-box;
	text-align:center;
	font-size:16px;
}

#btnlogin,#btnexit,#btnadd,#btncontinue,#btnexit1{
	background-color:#4caf50;
	color:black;
	padding: 12px 20px;
	margin:8px 0;
	cursor:pointer;
	width:50%;
}

#btnlogin.hover{
	opacity: 0.8;
}

caption{
	font-size:24px;
}

.login{
	border:3px solid green;
	margin:50px;
	width:50%;
	padding:20px;
}

table,th,td{
	border:3px solid #FF9D9D;
	border-collapse:collapse;
	
}

th,td{
	width:100%;
	text-align:center;
	padding:10px;
	padding-left:20px;
	padding-right:20px;
}

.load{
animation:slide 2s;
}

.slider{
background-repeat:no-repeat;
background-size:cover;
background-position:center;
width:100%;
height:100vh;
animation:slide 40s infinite;
}

.content{
color:#FFFFFF;
width:100%;
height:100vh;
background-color:rgba(0,0,0,0.5);
}

.principal{
left:50%;
top:50%;
transform:translate(-50%,-50%);
position:absolute;
letter-spacing:5px;
text-align:center;
}

.principal h1{
font-size:50px;
margin-bottom:20px;
}

@keyframes slide{
	0%{
		background-image:url(bg1.jpg)
	}
	16%{
		background-image:url(bg1.jpg);
	}
	16.01%{
		background-image:url(bg2.jpg);
	}
	32%{
		background-image:url(bg2.jpg);
	}
	32.01%{
		background-image:url(bg3.jpg);
	}
	50%{
		background-image:url(bg3.jpg);
	}
	50.01%{
		background-image:url(bg4.jpg);
	}
	66%{
		background-image:url(bg4.jpg);
	}
	66.01%{
		background-image:url(bg5.png);
	}
	82%{
		background-image:url(bg5.png);
	}
	82.01%{
		background-image:url(bg6.jpg);
	}
	100%{
		background-image:url(bg6.jpg);
	}
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
<script src="jquery-3.4.1.min.js"></script>
<script>

$(document).ready(function(){
    $('#btnlogin').on('click',function(){
        var sel='1';
		var pfno = $('#txtpfno').val();
		var mbno = $('#txtmobileno').val();
		$('#btnlogin').attr('disabled',true);
		
		if(pfno && mbno){
			$("#lblwait").show(500);
			
			$.ajax({
				type:'POST',
				url:'login1.php',
				data:'pfno='+pfno +"&sel="+sel,
				success:function(html){
					//alert(html);
					if(html == "oops"){
						alert("PF No does not exists.");
						$("#lblwait").hide(500);
					}
					else{
						$("#pfname").text("Welcome "+html);
						
						var sel='2';
						$.ajax({
							type:'POST',
							url:'login1.php',
							data:'pfno='+pfno +"&sel="+sel,
							success:function(html){
								$("#lblwait").hide(500);
								if(html == "oops"){
									$("#hideshow3").show(500);
									$("#hideshow2").hide(500);
									$("#hideshow1").hide(500);
									$("#hideshow4").hide(500);
								}
								else{
									//alert(html);
									$("#hideshow2").show(500);
									$("#hideshow1").hide(500);	
									$("#hideshow4").hide(500);
									
									$('#pftable').html(html);
								}
							}
						});
					}
				}
			});
		}
		else alert("Please provide valid values.");
		$('#btnlogin').attr('disabled',false);
    });
	
	$('#btncontinue').on('click',function(){
	
		$("#hideshow3").show(500);
		$("#hideshow2").hide(500);
		$("#hideshow1").hide(500);
		$("#hideshow4").hide(500);
    });
	
	$('#btnexit').on('click',function(){
		/*$("#hideshow1").show(500);
		$("#hideshow2").hide(500);
		$("#hideshow3").hide(500);
		var pfno = document.getElementById("txtpfno");
		var mbno = document.getElementById("txtmobileno");
		pfno.value = "";
		mbno.value = "";*/
		location.reload();
    });
	
	$('#btnexit1').on('click',function(){
		location.reload();
    });
	
	$('#btnadd').on('click',function(){
		var name = $('#txtname').val();
		var sport = $('#selectsport').val();
		var gender = $('#selectgender').val();
		var rel = $('#selectrel').val();
		var ach = $('#selectach').val();
		var bday = $('#bday').val();
		var pfno = $('#txtpfno').val();
		var sel = "3";
		var mobileno = $('#txtmobileno').val();
		//alert("1");
		
		if(name && pfno && bday && mobileno && (gender != "0") && (rel != "0") && (ach != "0") && (sport != "0")){
			var bdaydate = new Date(bday);
			var today = new Date();
			var age = Math.floor((today-bdaydate) /31536000000);
			//alert("2");
			$("#lblwait1").show(500);
			
			$.ajax({
				type:'POST',
				url:'login1.php',
				data:'pfno='+pfno +"&name="+name +"&sport="+sport +"&gender="+gender +"&mobileno="+mobileno +"&rel="+rel +"&ach="+ach +"&bday="+bday +"&age="+age+"&sel="+sel,
				success:function(html){
					//alert(html);
					//alert("3");
					if(html == "ok"){
						alert("Contestant added successfully!");
						var sel='2';
						$.ajax({
							type:'POST',
							url:'login1.php',
							data:'pfno='+pfno +"&sel="+sel,
							success:function(html){
								//alert(html);
								//alert("4");
								$("#hideshow2").show(500);
								$("#hideshow3").hide(500);
								$("#hideshow4").hide(500);
								$("#hideshow1").hide(500);
									
								$("#btncontinue").hide(500);
								$("#btnexit1").show(500);
									
								$('#pftable').html(html);
								$("#lblwait1").hide(500);
							}
						});
					}
				}
			});
		}
    });
	
});
</script>
</html>