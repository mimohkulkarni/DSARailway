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
<form action="transfer.php" method="post">
    <div class="body"></div>
    <div class="heading"><div>Divisional Sport Association<br><span>Accounts Department</span></div></div>
    <div class="header">
        <table>
            <tr>
                <th colspan="2"><span>Money Transfer</span></th>
            </tr>
            <tr>
                <th>Transaction Type</th>
                <td>
                    <select name="select_type" id="select_type">
                        <option value="0" selected>Select</option>
                        <option value="ctb">Deposit to Bank</option>
                        <option value="btc">Withdrawal From Bank</option>
                    </select>
                </td>
            </tr>
            <tr id="trbank">
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

    .header table th{
        color: black;
        font-size: 17px;
    }

    .header table td{
        font-size: 17px;
        color: black;
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
        $('#select_type').on('change',function(){
            var type = $(this).val();
            // if ((type == "btc")) $("#trbank").show(500);
            // else $("#trbank").hide(500);
        });

        $("#btnreset").click(function(){

            $("#txtcomment").val('');
            $("#cihtypeno")[0].checked = true;
            $("#select_desc").prop('disabled',false);
        });
    });

    function isnNumberkey(evt) {
        // var charCode = (evt.which) ? evt.which :event.keyCode;
        // return !(charCode > 3 && (charCode < 48 || charCode > 57));
        var regex = /[^0-9]/gi;
        input.value = input.value.replace(regex,"");

    }
</script>

<?php
if (isset($_POST['btnsubmit'])){
    $type = $_POST['select_type'];
    $bank = $_POST['select_bank'];
    $date = $_POST['txtdate'];
    $amount = $_POST['txtamount'];
    $remark = $_POST['txtcomment'];

    if ($type <> "0" && $bank <> "0" && !empty($amount) && !empty($remark) && !empty($date) && $date <> "0000-00-00"){
        $type1 = 2;
        if ($type == "btc") $cih = 0;
        elseif($type == "ctb") $cih = 1;

        $sql_bal_update = "SELECT `bank_bal`,`cih` FROM `accounts_bal`";
        $result_bal_update = mysqli_query($linkId, $sql_bal_update);
        while ($row_bal_update = mysqli_fetch_array($result_bal_update)) {
            $bank_bal = $row_bal_update['bank_bal'];
            $cih_bal = $row_bal_update['cih'];
        }

        $sql_bank_bal = "SELECT `bal` FROM `bank_info` WHERE `id` = '".$bank."'";
//            echo $sql_bank_bal;
        $result_bank_bal = mysqli_query($linkId, $sql_bank_bal);
        while ($row_bank_bal = mysqli_fetch_array($result_bank_bal)) {
            $bank_info_bal = $row_bank_bal['bal'];
//              echo $bank_info_bal;
        }

        if (($cih == 0 && ($bank_info_bal >= $amount)) || ($cih == 1 && ($cih_bal >= $amount))) {

            $sql_transfer = "INSERT INTO `accounts_tr`(`remarks`, `tr_timestamp`, `tr_date`, `amount`, `tr_dw_type`, `cb_type`, `bank_id`, `user`)
             VALUES ('" . $remark . "',NOW(),'".$date."','" . $amount . "','" . $cih . "','" . $type1 . "','" . $bank . "','" . $uname . "')";

            mysqli_query($linkId, $sql_transfer);

            if (mysqli_affected_rows($linkId) == 1) {

                if ($cih == 0) {
                    $bank_info_bal = $bank_info_bal - $amount;
                } elseif ($cih == 1) {
                    $bank_info_bal = $bank_info_bal + $amount;
                } else echo "<script>alert('Error 0 occurred.Contact Admin ASAP');</script>";

                $sql_bank_info_bal_update = "UPDATE `bank_info` SET `bal`='".$bank_info_bal."' WHERE `id` = '".$bank."'";
                $result_bank_info_bal_update = mysqli_query($linkId, $sql_bank_info_bal_update);

                if (mysqli_affected_rows($linkId) == 1) {
                    echo "<script>alert('Transfer successful.');</script>";
                }
                else{
                    $sql_id = "SELECT MAX(`tr_id`) FROM `accounts_tr`";
                    $result_id = mysqli_query($linkId,$sql_id);
                    while ($row_id = mysqli_fetch_array($result_id)){
                        $sql_delete = "DELETE FROM `accounts_tr` WHERE `tr_id` = '".$row_id['MAX(`tr_id`)']."'";
                        mysqli_query($linkId,$sql_delete);
                    }
                    echo "<script>alert('Error 1 occurred.Contact Admin ASAP');</script>";
                }

            } else echo "<script>alert('Error 2 occurred.Contact Admin ASAP');</script>";
        }

    } else echo "<script>alert('Please provide all the values');</script>";

}

if (isset($_POST['btnback'])){
//    header('location:accbal.php');
    echo "<script>window.location.href='accbal.php';</script>";
    exit();
}
?>

</html>