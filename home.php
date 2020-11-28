<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>DSA- Accounts</title>

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
            background-image: url(bg1.jpg);
            background-size: cover;
            -webkit-filter: blur(5px);
            z-index: 0;
        }


        .header{
            position: absolute;
            top: calc(50% - 35px);
            left: calc(50% - 380px);
            z-index: 2;
        }

        .header div{
            float: left;
            color: red;
            font-size: 35px;
            font-weight: 200;
        }

        .header div span{
            color: #5379fa;
        }

        .login{
            position: absolute;
            top: calc(50% - 75px);
            left: calc(50% + 60px);
            height: 150px;
            width: 350px;
            padding: 10px;
            z-index: 2;
        }

        .login input[type=text]{
            text-align: center;
            width: 250px;
            height: 30px;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 2px;
            color: #fff;
            font-size: 16px;
            font-weight: 400;
            padding: 4px;
        }

        .login input[type=password]{
            text-align: center;
            width: 250px;
            height: 30px;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.6);
            border-radius: 2px;
            color: #fff;
            font-size: 16px;
            font-weight: 400;
            padding: 4px;
            margin-top: 10px;
        }

        .login input[type=submit]{
            width: 260px;
            height: 35px;
            background: darkgoldenrod;
            border: 1px solid #fff;
            cursor: pointer;
            border-radius: 2px;
            color: darkred;
            font-size: 16px;
            font-weight: 400;
            padding: 6px;
            margin-top: 10px;
        }

        .login input[type=submit]:hover{
            opacity: 0.8;
        }

        .login input[type=submit]:active{
            opacity: 0.6;
        }

        .login input[type=text]:focus{
            outline: none;
            border: 1px solid rgba(255,255,255,0.9);
        }

        .login input[type=password]:focus{
            outline: none;
            border: 1px solid rgba(255,255,255,0.9);
        }

        .login input[type=submit]:focus{
            outline: none;
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
</head>

<body>
<form action="home.php" method="post">
<div class="body"></div>
<div class="header">
    <div>Divisional<span> Sport</span> Association</div>
</div>
<br>
<div class="login">
    <input type="text" placeholder="Username" name="txtuname"><br>
    <input type="password" placeholder="Password" name="txtpass"><br>
    <input type="submit" value="Login" name="btnlogin">
</div>
    <div class="footer">
        <label>Created and developed by &emsp;</label><span style="color: #FF4646; ">Mimoh Kulkarni&emsp;</span>
    </div>
</form>
</body>

<?php
    require("dbconnect.php");
    if (isset($_POST['btnlogin'])){
        $uname = $_POST['txtuname'];
        $pass = $_POST['txtpass'];

        if (!empty($uname) && !empty($pass)){
            $sql_login = "SELECT `pfno` FROM `admininfo` WHERE `pfno`='".$uname."' AND `pass`='".$pass."'";
            echo $sql_login;
            mysqli_query($linkId,$sql_login);
            if (mysqli_affected_rows($linkId) == 1){
                session_start();
                $_SESSION["upfno"] = $uname;
                header("location:accbal.php");
            }
            else echo "<script>alert('Incorrect combination of Username and Password');</script>";
        }
        else echo "<script>alert('Please enter Username and Password');</script>";
    }
?>
?>

</html>