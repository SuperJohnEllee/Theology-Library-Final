<!DOCTYPE html>
<?php
	include ('session.php');
	include('connection.php');
	include('function/function.php');

	//function for
	userChangePassword();
?>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>College of Theology Library</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-5" oncontextmenu="return false" role="document">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top"><a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a></nav>
	<br><br>
	<div class="container"><br>
		<div class="page-header">
			<h1>
				Change Password
				<small> for account <i class="text-warning"><?php echo $session_user; ?></i></small>
			</h1>
			<hr class="theo-footer-hr">
		</div>
		<div class='row'>
			<div class='col-lg-7'>
				<form method='post'>
					<!--Current Password-->
				<div class='md-form mb-5'>
					<i class='fa fa-lock prefix'></i>
					<input class='form-control' type='password' name='oldpass' maxlength='50' id='oldpassword' required>
					<label>Current Password</label>
				</div>

					<!-- New Password -->
				<div class='md-form mb-5'>
					<i class='fa fa-lock prefix'></i>
					<input class='form-control' type='password' name='newpass' maxlength='50' id='newpass' required>
					<label>New Password</label>
				</div>

					<!-- Retype Password-->
				<div class='md-form mb-5'>
					<i class='fa fa-lock prefix'></i>
					<input class='form-control' type='password' name='confpass' maxlength='50' id='conf_pass' required>
					<label>Retype Password</label>
				</div>
				<div class='form-group'>
					<!--<a class="btn btn-primary btn-lg" onclick="showPass()"><span class="fa fa-eye"></span> Show</a>-->
					<button type='submit' name='btn_change_pass' class='btn btn-success btn-lg'><span class='fa fa-download'></span> Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- JavaScript Libraries -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/mdb.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/style.js"></script>
</body>
</html>