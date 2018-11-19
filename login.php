<!DOCTYPE html>
<?php
    include('function/function.php');

    //User Login Function
    userLogin();
?>
<html>
<head>
    <title> College of Theology Library</title>
    <meta name="author" content="College of Theology Library">
    <meta http-equiv="Content-Type" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8"> 
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-4">
<!-- Login Form here-->
<?php include ('library/forms/login_form.php'); ?>
<!--JavaScript Libraries-->
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/mdb.min.js"></script>
<script>

function show() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("show_pass").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
        }
    }, false);
</script>
</body>
</html>