<html>
<?php
require("dbconnect.php");
require("header.php");
?>
<head>
    <title>DSA-Accounts</title>
    <meta charset="UTF-8">
</head>
<body>
<form action="addesc.php" method="post">
    <div class="body"></div>
    <div class="heading"><div>Divisional Sport Association<br><span>Accounts Department</span></div></div>
    <div class="header">
        <table>
            <tr>
                <th colspan="2"><span>New Description Application</span></th>
            </tr>
            <tr>
                <th>Reason Type</th>
                <td>
                    <select name="select_type" id="select_type">
                        <option value="2" selected>Select</option>
                        <option value="1">Deposit</option>
                        <option value="0">Withdrawal</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Name</th>
                <td><input type="text" name="txtname" id="txtname"></td>
            </tr>
            <tr>
                <th><input type="submit" name="btnback" value="Back"></th>
                <th><input type="submit" name="btnsubmit" value="Submit"></th>
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
        background-image: url(bg2.jpg);
        background-size: cover;
        -webkit-filter: blur(5px);
        z-index: 0;
    }

    .header{
        position: absolute;
        text-align: center;
        top: 25%;
        z-index: 1;
        left: 42%;
        margin-left: -18%;
        margin-top: 15px;
        background-color: lightgrey;
        box-shadow: 10px 10px #888888;
    }

    .header table,th,td{
        text-align: center;
        border: 1px solid black;
        border-collapse: collapse;
        margin: 10px;
    }

    .header table th,td{
        width: 300px;
        height: 50px;
        padding: 5px;
    }

    .header table th,.header table td{
        color: black;
        font-size: 17px;
    }

    .header table th span{
        font-size: 25px;
    }

    .header input[type=button],input[type=submit]{
        background-color: goldenrod;
        color: black;
        padding: 12px 24px;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        transition-duration: 0.4s;
    }

    .header input[type=button]:hover,input[type=submit]:hover{
        box-shadow: 0 5px 7px 0 gray,0 7px 10px 0 gray;
    }

    .heading{
        text-align: center;
        position: absolute;
        top: 0;
        z-index: 1;
        left: 50%;
        margin-left: -18%;
        margin-top: 15px;
    }

    .heading div{
        float: left;
        color: red;
        font-size: 45px;
        font-weight: 200;
    }

    .heading div span{
        color: yellow;
        font-size: 40px;
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
<script src="jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function(){
        $('#select_medium').on('change',function(){
            var medium = $(this).val();
            if (medium === "bank") $('#trbank').show(500);
            else $('#trbank').hide(500);
        });

</script>

<?php
if (isset($_POST['btnsubmit'])){
    $stype = $_POST['select_type'];
    $txtname = $_POST['txtname'];

//    echo $stype;
//    echo  $txtname;

    //echo "<script>alert('hiii');</script>";
    if (!empty($txtname) && $stype != "2" ) {

        $type = $stype == "0" ? "w":"d";
        $sql_gid = "SELECT MAX(`id`) FROM `desc_tr` WHERE `id` LIKE '".$type."%'";
        $result_gid = mysqli_query($linkId,$sql_gid);
        $maxid = "";
        while ($row_gid = mysqli_fetch_array($result_gid)){
            $maxid = $row_gid['MAX(`id`)'];
        }

        $partid = substr($maxid,1) + 1;
        $fmaxid = $type.$partid;

        $sql_chk = "SELECT `id`, `name` FROM `desc_tr` WHERE `name` = '".$txtname."'";
        mysqli_query($linkId,$sql_chk);
        if (mysqli_affected_rows($linkId) == 0) {

            $sql_add = "INSERT INTO `desc_tr`(`id`, `name`) VALUES ('" . $fmaxid . "','" . $txtname . "')";
//        echo $sql_add;
            mysqli_query($linkId, $sql_add);
            if (mysqli_affected_rows($linkId) == 1) {
                echo "<script>alert('Entry added successfully.');</script>";
                echo "<script>window.location.href='accbal.php';</script>";
            } else echo "<script>alert('Error 1 occurred.Contact Admin ASAP');</script>";
        }else echo "<script>alert('Entry Already Exists.Make sure you dont repeat it.');</script>";
    } else echo "<script>alert('Please provide all the values');</script>";
}

if (isset($_POST['btnback'])){
//    header('location:accbal.php');
//    echo $_POST['txtdate'];
    echo "<script>window.location.href='accbal.php';</script>";
    exit();
}
?>
</html>