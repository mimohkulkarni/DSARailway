<?php
require("dbconnect.php");
require("get_bal.php");
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
    <div class="hbar"></div>
    <div class="table">
        <span>
            <table>
                <tr>
                    <th>Opening Balance</th>
                    <th>Bank Balance</th>
                    <th>Cash Balance</th>
                </tr>
                <tr>
                    <th><?php echo $cl_bal;?> ₹</th>
                    <th><?php echo $bank_bal;?> ₹</th>
                    <th><?php echo $cih_bal;?> ₹</th>
                </tr>
            </table>
        </span>
    </div>
    <div class="table1">
        <table>
            <tr>
                <th>Closing Balance</th>
                <th>Bank Balance</th>
                <th>Cash Balance</th>
            </tr>
            <tr>
                <th><?php echo $cl_bal;?> ₹</th>
                <th><?php echo $bank_bal;?> ₹</th>
                <th><?php echo $cih_bal;?> ₹</th>
            </tr>
        </table>
    </div>
    <div class="home">
        <!--
        <table style="width: 100%">
            <tr  style="width: 100%">
                <th style="width: 17%">Transaction Type -</th>
                <td style="width: 18%; border-right: 2px solid black">
                    <select name="select_type">
                        <option value="2">All</option>
                        <option value="1">Deposit Transactions -</option>
                        <option value="0">Withdrawal Transactions</option>
                    </select>
                </td>
                <th style="width: 17%">Transaction Method -</th>
                <td style="width: 18%">
                    <select name="select_type">
                        <option value="2">All</option>
                        <option value="1">Deposit Transactions</option>
                        <option value="0">Withdrawal Transactions</option>
                    </select>
                </td>
                <th style="width: 17%">Bank -</th>
                <td style="width: 18%">
                    <select name="select_bank" id="select_bank">
                        <option value="0" selected>All</option>
                        <?php
                        $sql_bank = "SELECT `id`,`bank_name` FROM `bank_info`";
                        $result_bank = mysqli_query($linkId,$sql_bank);
                        while ($row_bank = mysqli_fetch_array($result_bank)){
                            ?><option value="<?php echo $row_bank['id'];?>"><?php echo ucwords($row_bank['bank_name']);?></option><?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width: 17%"></td>
                <th style="width: 17%">Start Month -</th>
                <td style="width: 17%"><input type="month" name="txtsmonth"></td>
                <th style="width: 17%">End Month -</th>
                <td style="width: 17%"><input type="month" name="txtemonth"></td>
                <td style="width: 17%"></td>
            </tr>
            <tr>
                <td colspan="3" style="border: none"><input type="button" id="btngo" value="Go"></td>
                <td colspan="3" style="border: none"><input type="submit" name="btnback" value="Back"></td>
            </tr>
        </table>
        -->
    </div>
    <div class="maindiv" id="maindiv">
        <table>
            <tr>
                <th>Type</th>
                <th>Method</th>
                <th>Bank Name</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Remarks</th>
            </tr>
            <?php
            $sql_tr = "SELECT `remarks`,`tr_date`, `amount`, `tr_dw_type`, `cb_type`, `bank_id` FROM
    `accounts_tr` WHERE MONTH(`tr_date`) BETWEEN '1' AND '".date("m")."' limit 30";
//            echo $sql_tr;
            $result_tr = mysqli_query($linkId,$sql_tr);
            while ($row_tr = mysqli_fetch_array($result_tr)){
                if ($row_tr['tr_dw_type'] == "1") $type = "Deposit";
                else $type = "Withdrawal";
                if($row_tr['cb_type'] == "0") $cih = "Bank";
                elseif ($row_tr['cb_type'] == "1") $cih = "Cash";
                else $cih = "Transfer";
                if ($row_tr['bank_id'] == "0") $bank_name = "-";
                else{
                    $sql_bank_name = "SELECT `bank_name`,`acc_no` FROM `bank_info` WHERE `id` = '".$row_tr['bank_id']."'";
                    $result_bank_name = mysqli_query($linkId,$sql_bank_name);
                    while ($row_bank_name = mysqli_fetch_array($result_bank_name)){
                        $bank_name = ucwords($row_bank_name['bank_name']."-".$row_bank_name['acc_no']);
                    }
                }

                ?><tr>
                <td><?php echo $type;?></td>
                <td><?php echo $cih;?></td>
                <td><?php echo $bank_name;?></td>
                <td><?php echo $row_tr['tr_date'];?></td>
                <td><?php echo $row_tr['amount'];?></td>
                <td><?php echo ucfirst($row_tr['remarks']);?></td>
            </tr><?php
            }
            ?>
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
        position: fixed;
        width: 100%;
        height: 100%;
        /*background-image: url(bg1.jpg);*/
        background-size: cover;
        -webkit-filter: blur(10px);
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
        top: 30%;
        width: 100%;
        color: black;
        background-color: darkgrey;
        z-index: 2;
        height: 50px;
    }

    .table{
        position: absolute;
        top: calc(30% - 50px);
        padding-left: 6%;
        z-index: 3;
        height: 50px;
        color: black;
        font-size: 18px;
        text-align: center;
        width: 94%;
    }

    .table span table{
        width: 500px;
    }

    .table th,td{
        height: 45px;
        width: 33%;
        /*border-right: 1px solid black;*/
        /*border-collapse: collapse;*/
    }

    .table1{
        position: absolute;
        top: calc(30% - 50px);
        z-index: 3;
        height: 50px;
        color: black;
        font-size: 18px;
        text-align: center;
        width: 100%;
    }

    .table1 table{
        float: right;
        width: 500px;
    }

    .table1 th,td{
        height: 45px;
        width: 33%;
        /*border-right: 1px solid black;*/
        /*border-collapse: collapse;*/
    }

    .home{
        position: absolute;
        top: calc(40%);
        left: calc(5%);
        color: black;
        z-index: 2;
        width: 90%;
        text-align: center;
    }

    .home table{
        border: 2px solid black;
        font-size: 15px;
        border-collapse: collapse;
    }

    .home table th,td{
        border: 2px solid black;
        border-collapse: collapse;
    }

    .home label{
        font-size: 15px;
        padding-left: 100px;
        padding-right: 10px;
    }

    .home table input[type=button],input[type=submit]{
        height: 40px;
        width: 100px;
        font-size: 15px;
        background: darkgoldenrod;
        color: black;
        margin-top: 5px;
        margin-bottom: 5px;
        cursor: pointer;
        opacity: 0.9;
    }

    .home table input[type=button]:hover,input[type=submit]:hover{
        opacity: 1;
        box-shadow: 0 3px #999;
    }

    .maindiv{
        position: absolute;
        top: calc(40%);
        left: calc(5%);
        color: black;
        z-index: 2;
        width: 90%;
        text-align: center;
        margin-bottom: 50px;
    }

    .maindiv table{
        border: 2px solid black;
        border-collapse: collapse;
        font-size: 15px;
        width: 100%;
    }

    .maindiv table th{
        color: darkred;
        height: 30px;
    }

    .maindiv table th,td{
        width: 15%;
        border: 2px solid black;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color:black;
        text-align: right;
        z-index: 3;
    }
</style>
<?php
if (isset($_POST['btnback'])){
//    header('location:accbal.php');
//    echo $_POST['txtdate'];

    echo "<script>window.location.href='accbal.php';</script>";
    exit();
}


if (isset($_POST['btntransfer'])){
    header("location:transfer.php");
}
if (isset($_POST['btnsumm'])){
    header("location:summery.php");
}
if (isset($_POST['btnlogout'])){
    $_SESSION['upfno'] = "";
    session_destroy();
    header("location:home.php");
}
?>



</html>