<?php
require("dbconnect.php");
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
    <div class="header"><div>Divisonal Sport Association<br><span>Accounts Department</span></div></div>
    <div class="input">
        <table>
            <tr>
                <td align="right"><label>Start Period - &emsp;</label></td>
                <td><input type="month" name="smonth" id="smonth" value="<?=date('Y-01')?>"></td>
                <td align="right"><label>End Period - &emsp;</label></td>
                <td><input type="month" name="emonth" id="emonth" value="<?=date('Y-m')?>"></td>
                <td align="center"><input type="button" value="Submit" id="btnsubmit"></td>
                <td align="center"><input type="button" value="Back" id="btnback"></td>
                <td align="center" id="tdprint" style="display: none"><input type="button" value="Print" id="btnprint"></td>
            </tr>
        </table>
    </div>
    <div id="abc" style="display: none">
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
                        <th id="scl_bal">₹</th>
                        <th id="sbank_bal">₹</th>
                        <th id="scih_bal">₹</th>
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
                    <th id="ecl_bal">₹</th>
                    <th id="ebank_bal">₹</th>
                    <th id="ecih_bal">₹</th>
                </tr>
            </table>
        </div>
        <div class="printdiv">
            <table class="reptable" id="reptable"></table>
        </div>
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

    .input{
        position: absolute;
        top: 20%;
        width: 100%;
        color: black;
        z-index: 2;
        height: 50px;
    }

    .input table{
        width: 100%;
        padding-left: 15%;
        padding-right: 15%;
        border: none;
    }

    .input table td{
        font-size: 15px;
        width: 15%;
    }

    .hbar{
        position: absolute;
        top: 35%;
        width: 100%;
        color: black;
        background-color: darkgrey;
        z-index: 2;
        height: 50px;
    }

    .table{
        position: absolute;
        top: calc(35% - 50px);
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

    .table th,.table td{
        height: 45px;
        width: 33%;
        /*border-right: 1px solid black;*/
        /*border-collapse: collapse;*/
    }

    .table1{
        position: absolute;
        top: calc(35% - 50px);
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

    .table1 th,.table1 td{
        height: 45px;
        width: 33%;
    }

    .reptable{
        position: absolute;
        top: calc(52% - 50px);
        z-index: 3;
        height: 50px;
        color: black;
        font-size: 18px;
        text-align: center;
        alignment: center;
        width: 90%;
        border-collapse: collapse;
        left: 5%;
        background-color: lightgrey;
        box-shadow: 10px 10px #888888;
        padding-right: 100px;
        margin-bottom: 50px;
    }

    .reptable th,.reptable td{
        height: 45px;
        width: 25%;
        border: 1px solid black;
        margin: 15px;
    }

    input[type=button]{
        height: 30px;
        width: 80px;
        font-size: 15px;
        background: darkgoldenrod;
        color: black;
        margin-top: 5px;
        margin-bottom: 5px;
        cursor: pointer;
        opacity: 0.9;
    }

    input[type=button]:hover{
        opacity: 1;
        box-shadow: 0 3px #999;
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

<script src="jquery-3.4.1.min.js"></script>
<script src="jquery.PrintArea.js"></script>
<script>

    $(document).ready(function(){
        $('#btnsubmit').on('click',function(){
            var smonth = new Date($('#smonth').val()).getMonth() + 1;
            var syear = new Date($('#smonth').val()).getFullYear();
            var emonth = new Date($('#emonth').val()).getMonth() + 1;
            var eyear = new Date($('#emonth').val()).getFullYear();
            // alert(smonth);
            var sel = "1";
            var date = new Date();

            if (smonth && syear && emonth && eyear){
                if (date.getFullYear() === syear && date.getFullYear() === eyear) {
                    $.ajax({
                        type: 'POST',
                        url: 'mreports1.php',
                        data: 'smonth=' + smonth + "&syear=" + syear + "&emonth=" + emonth + "&eyear=" + eyear + "&sel=" + sel,
                        dataType: 'json',
                        success: function (data) {
                            if (data) {
                                $("#tdprint").hide();
                                $("#abc").hide();
                                $("#tdprint").show(2000);
                                $("#abc").show(2000);
                                // $('#reptable').html(data);
                                // $('#reptable').append("<tr><td colspan='4' style='border: none; height: 80px'>" +
                                //     "<input type='button' style='height: 40px;width: 110px; font-size: 18px' value='Print' id='btnprint'>" +
                                //     "</td></tr>");
                                $('#scl_bal').html(data.final_sbal);
                                $('#sbank_bal').html(data.final_sbank_bal);
                                $('#scih_bal').html(data.final_scih_bal);
                                $('#ecl_bal').html(data.final_bal);
                                $('#ebank_bal').html(data.final_bank_bal);
                                $('#ecih_bal').html(data.final_cih_bal);
                                $('#reptable').html(data.reptable);
                                // alert(data);
                            }
                        }
                    });
                }
                else alert("Only current year is allowed");
            }
            else alert("Please provide all values")

        });

        $('#btnprint').on('click',function(){
            // var mode = 'iframe';
            // var close=mode=="popup";
            // var options ={mode:mode,popClose:close};
            // $("div.abc").printArea(options);

            // alert("hii");
            var printContents = document.getElementById("abc");
            var wme = window.open("","","width=900,height=700");
            wme.document.write(printContents.outerHTML);
            wme.document.close();
            wme.focus();
            wme.print();
            // wme.close();

            // var originalContents = document.body.innerHTML;
            //
            // document.body.innerHTML = printContents;
            // window.print();
            // document.body.innerHTML = originalContents;
        });

        $('#btnback').on('click',function(){
            window.location.href='accbal.php';
        });

    });
</script>


</html>
