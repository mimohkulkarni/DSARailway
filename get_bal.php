<?php
require("header.php");
$cl_bal = 0;
$bank_bal = 0;
$cih_bal = 0;


$sql_ebal = "SELECT `amount`, `tr_dw_type`, `cb_type` FROM `accounts_tr` WHERE YEAR(`tr_date`) = '".date("Y")."'";
$result_ebal = mysqli_query($linkId,$sql_ebal);
$arr_bal = array();
//echo $sql_ebal;
$arr_bal = calculate($result_ebal);

$sql_bal = "SELECT * FROM `accounts_bal` WHERE `id` = '".date("Y")."'";
$result_bal = mysqli_query($linkId,$sql_bal);
if (mysqli_affected_rows($linkId) == 1){
    while ($row_bal = mysqli_fetch_array($result_bal)){
        $cl_bal = $row_bal['cl_bal'] + $arr_bal['final_bal'];
        $bank_bal = $row_bal['bank_bal'] + $arr_bal['final_bank_bal'];
        $cih_bal = $row_bal['cih'] + $arr_bal['final_cih_bal'];
    }
}
elseif (mysqli_affected_rows($linkId) == 0){
    $year = date("Y") - 1;
    $sql_lsbal = "SELECT `amount`, `tr_dw_type`, `cb_type` FROM `accounts_tr` WHERE YEAR(`tr_date`) = '".$year."'";
    $result_lsbal = mysqli_query($linkId,$sql_lsbal);
    $arr_lsbal = array();
    $arr_lsbal = calculate($result_lsbal);

    $cl_bal = 0;
    $bank_bal = 0;
    $cih_bal = 0;

    $sql_cbal = "SELECT * FROM `accounts_bal` WHERE `id` = '".$year."'";
    $result_cbal = mysqli_query($linkId,$sql_cbal);
    while ($row_bal = mysqli_fetch_array($result_cbal)){
        $cl_bal = $row_bal['cl_bal'];
        $bank_bal = $row_bal['bank_bal'];
        $cih_bal = $row_bal['cih'];
    }

    $final_cl_bal = $arr_lsbal['final_bal'] + $cl_bal;
    $final_bank_bal = $arr_lsbal['final_bank_bal'] + $bank_bal;
    $final_cih_bal = $arr_lsbal['final_cih_bal'] + $cih_bal;

    $sql_lubal = "UPDATE `accounts_bal` SET `cl_bal`='".$final_cl_bal."',`bank_bal`='".$final_bank_bal."',
                `cih`='".$final_cih_bal."' WHERE `id` = '".$year."'";
    $result_lubal = mysqli_query($linkId,$sql_lubal);

    $sql_ubal = "SELECT * FROM `accounts_bal` WHERE `id` = '".$year."'";
//    echo $sql_lubal;
    $result_ubal = mysqli_query($linkId,$sql_ubal);
    if (mysqli_affected_rows($linkId) == 1){
        while ($row_ubal = mysqli_fetch_array($result_ubal)){
            $sql_new_bal = "INSERT INTO `accounts_bal`(`id`, `cl_bal`, `bank_bal`, `cih`) VALUES ('".date("Y")."',
            '".$row_ubal['cl_bal']."','".$row_ubal['bank_bal']."','".$row_ubal['cih']."')";
            mysqli_query($linkId,$sql_new_bal);
            header("Refresh:0");
        }
    }
    else echo "<script>alert('Error/Tampering found. Contact Admin')";
}
else echo "<script>alert('Error/Tampering found. Contact Admin')";
?>