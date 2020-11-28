<?php
require("dbconnect.php");
session_start();
$upfno = "";
if (empty($_SESSION['upfno'])){
    session_destroy();
    header("location:home.php");
}
else $upfno = $_SESSION['upfno'];

function calculate($result_bal){
    $final_bal = 0;
    $final_bank_bal = 0;
    $final_cih_bal = 0;
    while ($row_bal = mysqli_fetch_array($result_bal)) {
        if ($row_bal['tr_dw_type'] == "1") {
            if ($row_bal['cb_type'] == "1") {
                $final_bal = $final_bal + $row_bal['amount'];
                $final_cih_bal = $final_cih_bal + $row_bal['amount'];
            }
            elseif ($row_bal['cb_type'] == "0"){
                $final_bal = $final_bal + $row_bal['amount'];
                $final_bank_bal = $final_bank_bal + $row_bal['amount'];
            }
            else{
                $final_cih_bal = $final_cih_bal - $row_bal['amount'];
                $final_bank_bal = $final_bank_bal + $row_bal['amount'];
            }
        }
        else{
            if ($row_bal['cb_type'] == "1") {
                $final_bal = $final_bal - $row_bal['amount'];
                $final_cih_bal = $final_cih_bal - $row_bal['amount'];
            }
            elseif ($row_bal['cb_type'] == "0"){
                $final_bal = $final_bal - $row_bal['amount'];
                $final_bank_bal = $final_bank_bal - $row_bal['amount'];
            }
            else{
                $final_cih_bal = $final_cih_bal + $row_bal['amount'];
                $final_bank_bal = $final_bank_bal - $row_bal['amount'];
            }
        }
    }
    return array('final_bal'=>$final_bal,'final_bank_bal'=>$final_bank_bal,'final_cih_bal'=>$final_cih_bal);
}
?>
