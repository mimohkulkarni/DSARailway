<?php
require("dbconnect.php");
require("header.php");

if ($_POST['sel'] == "1"){
    if (!empty($_POST['smonth']) && !empty($_POST['syear']) && !empty($_POST['emonth']) && !empty($_POST['eyear'])){
        $sql_bal = "SELECT * FROM `accounts_bal` WHERE `id` = '".date("Y")."'";
        $result_bal = mysqli_query($linkId,$sql_bal);
        if (mysqli_affected_rows($linkId) == 1){
            while ($row_bal = mysqli_fetch_array($result_bal)){
                $cl_bal = $row_bal['cl_bal'];
                $bank_bal = $row_bal['bank_bal'];
                $cih_bal = $row_bal['cih'];
            }
        }

        $sfinal_bal = 0;
        $sfinal_bank_bal = 0;
        $sfinal_cih_bal = 0;
        $efinal_bal = 0;
        $efinal_bank_bal = 0;
        $efinal_cih_bal = 0;
        $arr_ddesc = array();
        $arr_wdesc = array();
        $start_bal = 0;

        $sql_sbal = "SELECT `amount`, `tr_dw_type`, `cb_type` FROM `accounts_tr` WHERE
                MONTH(`tr_date`) < '".$_POST['smonth']."' AND YEAR(`tr_date`) = '".$_POST['syear']."'";
        $result_sbal = mysqli_query($linkId,$sql_sbal);
        $arr_sbal = array();
        $arr_sbal = calculate($result_sbal);


        $sql_ebal = "SELECT `accounts_tr`.`tr_desc`, `desc_tr`.`name`, `accounts_tr`.`amount`, `accounts_tr`.`tr_dw_type`,
        `accounts_tr`.`cb_type` FROM `accounts_tr` INNER JOIN `desc_tr` ON `accounts_tr`.`tr_desc` = `desc_tr`.`id`
         WHERE MONTH(`tr_date`) >= '".$_POST['smonth']."' AND MONTH(`tr_date`) <= '".$_POST['emonth']."' 
         AND YEAR(`tr_date`) = '".$_POST['eyear']."'";
        $result_ebal = mysqli_query($linkId,$sql_ebal);
        $arr_ebal = array();
        $arr_ebal = calculate($result_ebal);

        $result_ebal = mysqli_query($linkId,$sql_ebal);

        while ($row_ebal = mysqli_fetch_array($result_ebal)) {

            if (substr($row_ebal['tr_desc'],0,1) == "d") {
                if (array_key_exists($row_ebal['name'], $arr_ddesc)) {
                    $arr_ddesc[$row_ebal['name']] = $arr_ddesc[$row_ebal['name']] + $row_ebal['amount'];
                } else {
                    $arr_ddesc[$row_ebal['name']] = $row_ebal['amount'];
                }
            }
            else{
                if (array_key_exists($row_ebal['name'], $arr_wdesc)) {
                    $arr_wdesc[$row_ebal['name']] = $arr_wdesc[$row_ebal['name']] + $row_ebal['amount'];
                } else {
                    $arr_wdesc[$row_ebal['name']] = $row_ebal['amount'];
                }
            }
//            $len = sizeof($arr_ddesc)>sizeof($arr_wdesc) ? sizeof($arr_ddesc):sizeof($arr_wdesc);
        }



        $reptable = "<thead><tr>
                     <th colspan='2' >Receipts</th>
                     <th colspan='2'>Payments</th>
                     </tr></thead>";
//        echo print_r($arr_ddesc)."<br>";
//        echo print_r($arr_wdesc)."<br>"."<br>";

        $reptable.="<tbody>";

//        array_map(function ($v1,$v2) use (&$reptable, $arr_wdesc, $arr_ddesc) {
//            $reptable .= "<tr>";
//            if (!empty($v1))
//                $reptable .= "<td>".array_search($v1,$arr_ddesc)."</td>"."<td>".$v1."</td>";
//            else
//                $reptable .= "<td style='border: none'>".array_search($v1,$arr_ddesc)."</td>"."<td style='border: none'>".$v1."</td>";
//            if (!empty($v2))
//                $reptable .= "<td>".array_search($v2,$arr_wdesc)."</td>"."<td>".$v2."</td>";
//            else
//                $reptable .= "<td style='border: none'>".array_search($v2,$arr_wdesc)."</td>"."<td style='border: none'>".$v2."</td>";
//            $reptable .= "</tr>";
//        },$arr_ddesc,$arr_wdesc);

//        array_map(function ($v1,$v2) use ($arr_ddesc, $arr_wdesc) {
//           echo array_search($v1,$arr_ddesc)."-".$v1." ,";
//           echo array_search($v2,$arr_wdesc)."-".$v2."<br>";
//        },$arr_ddesc,$arr_wdesc);

        array_map(function ($a, $b, $c, $d) use (&$reptable) {
//            echo $a, $b, $c, $d;
            $reptable .= "<tr>";
            if (!empty($a))
                $reptable .= "<td>".$a."</td>"."<td>".$b."</td>";
            else
                $reptable .= "<td style='border: none'>".$a."</td>"."<td style='border: none'>".$b."</td>";
            if (!empty($c))
                $reptable .= "<td>".$c."</td>"."<td>".$d."</td>";
            else
                $reptable .= "<td style='border: none'>".$c."</td>"."<td style='border: none'>".$d."</td>";

            $reptable .= "</tr>";
            },array_keys($arr_ddesc), $arr_ddesc,array_keys($arr_wdesc),$arr_wdesc);

        $reptable .= "</tbody>";

//        $reptable .= "<tr id='trprint'>
//                        <td colspan='4' style='border: none; height: 80px'>
//                            <input style='height: 40px;width: 110px; font-size: 18px' type='button' name='btnprint' value='Print' id='btnprint'>
//                        </td>
//                      </tr>";

//        echo print_r($arr_ddesc);
//        echo print_r($arr_wdesc);
//        echo $sql_ebal;
//        echo $reptable;


        $final_bal = $cl_bal + $arr_sbal['final_bal'] + $arr_ebal['final_bal'];
        $final_bank_bal = $bank_bal + $arr_sbal['final_bank_bal'] + $arr_ebal['final_bank_bal'];
        $final_cih_bal = $cih_bal + $arr_sbal['final_cih_bal'] + $arr_ebal['final_cih_bal'];

        echo json_encode(array('final_sbal'=>$arr_sbal['final_bal'] + $cl_bal,'final_sbank_bal'=>$arr_sbal['final_bank_bal'] + $bank_bal,
            'final_scih_bal'=>$arr_sbal['final_cih_bal'] + $cih_bal,'final_bal'=>$final_bal,'final_bank_bal'=>$final_bank_bal,
            'final_cih_bal'=>$final_cih_bal,'reptable'=>$reptable));
    }
}

elseif ($_POST['sel'] == "2"){
    if ($_POST['type'] == "0" || $_POST['type'] == "1"){
        $type = $_POST['type'] == "0" ? "w":"d";

        $sql_desc = "SELECT DISTINCT `id` ,`name` FROM `desc_tr` WHERE `id` LIKE '".$type."%' AND `id` != '".$type."101'";
        $result_desc = mysqli_query($linkId,$sql_desc);
        $desc = "<option value='0'>Select</option>";
        while ($row_desc = mysqli_fetch_array($result_desc)){
            $desc .= "<option value='". $row_desc['id']."'>". ucWords($row_desc['name'])."</option>";
        }
        echo $desc;
    }
    else echo "<option value='0'>Select</option>";
}
?>