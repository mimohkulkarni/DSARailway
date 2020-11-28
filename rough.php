<tr>
    <td colspan="2">Does this transaction include deposit/withdrawal from Cash in Hand?&emsp;<input type="radio" id="cihtypeyes" name="cihtype" value="yes">
        <label for="yes">Yes</label>&emsp;
        <input type="radio" name="cihtype" id="cihtypeno" value="no" checked>
        <label for="no">No</label>
    </td>
</tr>
<tr id="trhide" style="display: none">
    <td colspan="2">
        <input type="radio" id="ccd" name="cihcc" value="cc">
        <label for="cc">Cash Deposit</label>&emsp;
        <input type="radio" name="cihcd" id="ccd" value="cd">
        <label for="cd">Cash Withdrawal</label>
    </td>
</tr>



$('input[type="radio"]').click(function(){
var cih =$(this).attr("value");
//alert(cih);
if (cih === "yes"){
$("#trhide").show(500);
$("#select_desc").val('transfer');
$("#select_desc").prop('disabled',true);
}
else{
$("#select_desc").val('0');
$("#select_desc").prop('disabled',false);
}
});





SELECT tr_id FROM `accounts_tr` WHERE MONTH(`tr_date`) BETWEEN '02' and '04'



SELECT `amount`, `tr_dw_type`, `cb_type` FROM `accounts_tr` WHERE YEAR(`tr_date`) = '2020'001000200020002000100000000
Divisional Sport Association
Accounts DepartmentWelcome Mimoh Kulkarni


Current Balance	302500₹
Bank Balance	202500₹
Cash in Hand	0₹
Created and developed by  Mimoh Kulkarni 
