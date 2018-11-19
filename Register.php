<!DOCTYPE html>
<?php
    include ('connection.php');
    include('function/function.php');
    $sql = "SELECT UsersID FROM users";
    $user_res = mysqli_query($conn, $sql);
    $user_count = mysqli_num_rows($user_res);

    userRegister();

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" style="background-color: #b2ebf2;">
    
<!-- Registration form here -->
<?php include ('library/forms/register_form.php'); ?>
    <!-- JavaScript Libraries -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
</body>
</html>

