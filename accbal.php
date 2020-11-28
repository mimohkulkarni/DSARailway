<?php
require("dbconnect.php");
include("get_bal.php");

$sql_pf = "SELECT * FROM admininfo WHERE pfno = '".$upfno."'";
$result_pf = mysqli_query($linkId,$sql_pf);
while($row_pf = mysqli_fetch_array($result_pf)){
    $uname = $row_pf['name'];
}

if (isset($_POST['btnadd'])){
    header("location:entry.php");
}
if (isset($_POST['btntransfer'])){
    header("location:transfer.php");
}
if (isset($_POST['btntransfertype'])){
    header("location:addesc.php");
}
if (isset($_POST['btnsumm'])){
    header("location:summery.php");
}
if (isset($_POST['btnmreports'])){
    header("location:mreports.php");
}
if (isset($_POST['btnlogout'])){
    $_SESSION['upfno'] = "";
    session_destroy();
    header("location:home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>DSA-Accounts</title>
    <meta charset="UTF-8">
</head>
<body>
<form action="accbal.php" method="post">
    <div class="body"></div>
    <div class="header"><div>Divisional Sport Association<br><span>Accounts Department</span></div></div>
    <div class="hbar">
        <span>Welcome &emsp;<?php echo $uname; ?></span>
        <div><input type="submit" value="Logout" name="btnlogout"></div>
    </div>
    <div class="home">
        <input type="submit" value="Add Transaction" name="btnadd"><br>
        <input type="submit" value="Transfer Money" name="btntransfer"><br>
        <input type="submit" value="Add Transfer Type" name="btntransfertype"><br>
        <input type="submit" value="View Summery" name="btnsumm"><br>
        <input type="submit" value="Monthly Report" name="btnmreports">
    </div>
    <div class="sumtable">
        <table>
            <tr>
                <th>Current Balance</th>
                <td><?php echo $cl_bal;?>₹</td>
            </tr>
            <tr>
                <th>Bank Balance</th>
                <td><?php echo $bank_bal;?>₹</td>
            </tr>
            <tr>
                <th>Cash in Hand</th>
                <td><?php echo $cih_bal;?>₹</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <label>Created and developed by &emsp;</label><span style="color: #FF4646; ">Mimoh Kulkarni&emsp;</span>
    </div>
</form>
</body>
<style>
    body{
        margin: 0;
        padding: 0;
        background: #fff;
        color: #fff;
        font-size: 12px;
    }

    .body{
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: url(bg6.jpg);
        background-size: cover;
        -webkit-filter: blur(5px);
        z-index: 0;
    }
    .header{
        text-align: center;
        position: absolute;
        top: 0;
        z-index: 1;
        left: 50%;
        margin-left: -18%;
        margin-top: 15px;
    }

    .header div{
        float: left;
        color: red;
        font-size: 45px;
        font-weight: 200;
    }

    .header div span{
        color: yellow;
        font-size: 40px;
    }

    .hbar{
        position: absolute;
        top: 22%;
        width: 100%;
        color: black;
        background-color: yellowgreen;
        z-index: 2;
        height: 25px;
    }

    .hbar span{
        color: black;
        padding-left: 10%;
        font-size: 20px;
    }

    .hbar div{
        float: right;
        margin-right: 3%;
        background-color: royalblue;
        height: 100%;
    }

    .hbar div input[type=submit]{
        height: 100%;
        background: royalblue;
        border: 1px solid royalblue;
        cursor: pointer;
        color: black;
    }

    .hbar div input[type=submit]:hover{
        opacity: 0.6;
    }

    .home{
        position: absolute;
        top: calc(30%);
        left: calc(25%);
        width: auto;
        color: black;
        z-index: 2;
    }

    .home input[type=submit]{
        height: 60px;
        width: 220px;
        font-size: 18px;
        background: darkgoldenrod;
        color: black;
        margin-top: 20px;
        cursor: pointer;
        opacity: 0.9;
        box-shadow: 0 6px #999;
    }

    .home input[type=submit]:hover{
        opacity: 1;
        box-shadow: 0 3px #999;
    }

    .sumtable{
        position: absolute;
        top: calc(40% + 20px);
        left: calc(55%);
        width: auto;
        color: black;
        z-index: 2;
        font-size: 20px;
    }

    .sumtable table,th,td{
        border: 2px solid black;
        border-collapse: collapse;
        border-spacing: 20px;
        text-align: center;
        width: 350px;
    }
    .sumtable th,td{
        height: 50px;
        width: 50%;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color:black;
        text-align: right;
    }
</style>
</html>