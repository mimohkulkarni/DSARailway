<?php
$sql_bank_chk = "SELECT `bal` FROM `bank_info`";
$sum = 0;
$result_back_chk = mysqli_query($linkId,$sql_bank_chk);
while ($row_bank_chk = mysqli_fetch_array($result_back_chk)){
    $sum = $sum + $row_bank_chk['bal'];
}
$sql_bal_chk= "SELECT `bal` FROM `bank_info`";
$sum = 0;
$result_back_chk = mysqli_query($linkId,$sql_bank_chk);
while ($row_bank_chk = mysqli_fetch_array($result_back_chk)) {
    $sum = $sum + $row_bank_chk['bal'];
}

?>