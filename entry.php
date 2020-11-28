<html>
<head>
    <title>DSA-Accounts</title>
    <meta charset="UTF-8">
</head>
<body>
<form action="entry.php" method="post">
<div class="body"></div>
<div class="heading"><div>Divisional Sport Association<br><span>Accounts Department</span></div></div>
<div class="header">
    <table>
        <tr>
            <th colspan="2"><span>Deposit/Withdrawal Application</span></th>
        </tr>
        <tr>
            <th>Transaction Type</th>
            <td>
                <select name="select_type" id="select_type">
                    <option value="2" selected>Select</option>
                    <option value="1">Deposit</option>
                    <option value="0">Withdrawal</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Transaction Medium</th>
            <td>
                <select name="select_medium" id="select_medium">
                    <option value="0" selected>Select</option>
                    <option value="cash">Cash Transaction</option>
                    <option value="bank">Bank Transaction</option>
                </select>
            </td>
        </tr>
        <tr id="trbank" style="display: none">
            <th>Select Bank</th>
            <td>
                <select name="select_bank" id="select_bank">
                    <option value="0" selected>Select</option>
                    <?php
                        $sql_bank = "SELECT `id`,`bank_name`,`acc_no` FROM `bank_info`";
                        $result_bank = mysqli_query($linkId,$sql_bank);
                        while ($row_bank = mysqli_fetch_array($result_bank)){
                    ?><option value="<?php echo $row_bank['id'];?>"><?php echo ucwords($row_bank['bank_name']."-".$row_bank['acc_no']);?></option><?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Transaction Date</th>
            <td><input type="date" name="txtdate"></td>
        </tr>
        <tr>
            <th>Description</th>
            <th>
                <select name="select_desc" id="select_desc">
                    <option value="0" selected>Select</option>
                </select>
            </th>
        </tr>
        <tr>
            <th>Amount</th>
            <td><input type="number" id="txtamount" name="txtamount" pattern="\d*" onkeypress="return isNumberKey(this)"></td>
        </tr>
        <tr>
            <th>Remarks</th>
            <td><input type="text" name="txtcomment" id="txtcomment"></td>
        </tr>
        <tr>
            <th><input type="button" id="btnreset" value="Reset"></th>
            <th><input type="submit" name="btnsubmit" value="Submit"></th>
        </tr>
        <tr>
            <th colspan="2"><input type="submit" name="btnback" value="Back"></th>
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
        top: 20%;
        z-index: 1;
        left: 45%;
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

        $('#select_type').on('change',function(){
            $("#select_desc").val('0');
            var type = $(this).val();
            var sel = "2";
            // alert(type);
            if (type){
                $.ajax({
                    type:'POST',
                    url:'mreports1.php',
                    data:'type='+type+"&sel="+sel,
                    success:function(data){
                        // alert(data);
                        $('#select_desc').html(data);
                    }
                });
            }
        });

        $("#btnreset").click(function(){
            $("#select_desc").val('0');
            $("#select_type").val('2');
            $("#select_bank").val('0');
            $("#txtamount").val('');
            $("#txtcomment").val('');
            $("#cihtypeno")[0].checked = true;
            $("#select_desc").prop('disabled',false);
        });
    });

    function isnNumberkey(evt) {
        // var charCode = (evt.which) ? evt.which :event.keyCode;
        // return !(charCode > 3 && (charCode < 48 || charCode > 57));
        var regex = /[ ^0-9]/gi;
        input.value = input.value.replace(regex,"");

    }
</script>

<?php
require("dbconnect.php");
require("header.php");

if (isset($_POST['btnsubmit'])){
    $desc = $_POST['select_desc'];
    $type = $_POST['select_type'];
    $bank = $_POST['select_bank'];
    $medium = $_POST['select_medium'];
    $date = $_POST['txtdate'];
    $amount = $_POST['txtamount'];
    $remark = $_POST['txtcomment'];

    //echo "<script>alert('hiii');</script>";
    if (!empty($amount) && !empty($remark) && $desc != "0" && $type != "2" && $medium != "0" && !empty($date)
        && $date != "0000-00-00" && ($medium == "cash" || ($medium == "bank" && $bank != "0"))) {
        if ($medium == "cash") {
            $cih = "1";
            $bank = "0";
        } elseif ($medium == "bank") $cih = "0";

        $sql_tr = "INSERT INTO `accounts_tr`(`remarks`, `tr_timestamp`, `tr_date`, `tr_desc` , `amount`, `tr_dw_type`, `cb_type`, `bank_id`, `user`)
             VALUES ('" . $remark . "',current_timestamp(),'".$date."','".$desc."','" . $amount . "','" . $type . "','" . $cih . "','" . $bank . "','" . $upfno . "')";
//         echo $sql_tr;
        mysqli_query($linkId, $sql_tr);
        if (mysqli_affected_rows($linkId) == 1) {
            $newdate = strtotime($date);
            $month = date("F",$newdate);
            $year = date("Y",$newdate);
            $sql_bal_update = "SELECT * FROM `accounts_bal` WHERE `bal_month` = '".$month." ".$year."'";
            $result_bal_update = mysqli_query($linkId, $sql_bal_update);
            while ($row_bal_update = mysqli_fetch_array($result_bal_update)) {
                $cl_bal = $row_bal_update['cl_bal'];
                $bank_bal = $row_bal_update['bank_bal'];
                $cih_bal = $row_bal_update['cih'];
            }

            if ($medium == "bank") {
                $sql_bank_bal = "SELECT `bal` FROM `bank_info` WHERE `id` = '" . $bank . "'";
//            echo $sql_bank_bal;
                $result_bank_bal = mysqli_query($linkId, $sql_bank_bal);
                while ($row_bank_bal = mysqli_fetch_array($result_bank_bal)) {
                    $bank_info_bal = $row_bank_bal['bal'];
//                echo $bank_info_bal;
                }
            }

            if ($cih == 0 && $type == 1) {
                $bank_info_bal = $bank_info_bal + $amount;
            } elseif ($cih == 0 && $type == 0) {
                $bank_info_bal = $bank_info_bal - $amount;
            }

            if ($medium == "bank") {
                $sql_bank_info_bal_update = "UPDATE `bank_info` SET `bal`='" . $bank_info_bal . "' WHERE `id` = '" . $bank . "'";
                $result_bank_info_bal_update = mysqli_query($linkId, $sql_bank_info_bal_update);
                if (mysqli_affected_rows($linkId) == 1) {
                    echo "<script>alert('Transaction added successfully.');</script>";
//                  header("location:accbal.php");
//                   exit();
                } else{
                    $sql_id = "SELECT MAX(`tr_id`) FROM `accounts_tr`";
                    $result_id = mysqli_query($linkId,$sql_id);
                    while ($row_id = mysqli_fetch_array($result_id)){
                        $sql_delete = "DELETE FROM `accounts_tr` WHERE `tr_id` = '".$row_id['MAX(`tr_id`)']."'";
                        mysqli_query($linkId,$sql_delete);
                    }
                    echo "<script>alert('Error 1 occurred.Contact Admin ASAP');</script>";
                }
            } else {
                echo "<script>alert('Transaction added successfully.');</script>";
//              header("location:accbal.php");
//              exit();
            }
//          header("location:accbal.php");
            echo "<script>window.location.href='accbal.php';</script>";
        } else echo "<script>alert('Error 2 occurred.Contact Admin ASAP');</script>";
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