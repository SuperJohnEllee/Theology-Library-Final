<?php
	include ('session.php');
	include('connection.php');
	include('function/function.php');

	//function for update profile
	userUpdateProfile();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
	<style>.icon{font-size:25px;}</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top"><a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br><br>
	<div class="container">
		<h1>
			Edit Profile 
			<small>for profile <i class="text text-warning"><?php echo $session_user; ?></i></small>
		</h1>
		<hr class="divider">
		<form class="form-horizontal" role="form" method="post">
			<div class="row">
				<div class="md-form">
					<input class="form-control" type="hidden" name="id" value="<?php echo $session_id;?>">
				</div>
				<div class="md-form col-md-6">
					<i class="fa fa-user prefix text-dark"></i>
					<input class="form-control" type="text" name="lastname" value="<?php echo $session_lastname; ?>">
					<label>Last Name</label>
				</div>
				<div class="md-form col-md-6">
					<i class="fa fa-user prefix text-dark"></i>
					<input class="form-control" type="text" name="firstname" value="<?php echo $session_firstname;?>">
					<label>First Name</label>
				</div>
				<div class="md-form col-md-6">
					<i class="fa fa-user prefix text-dark"></i>
					<input class="form-control" type="text" name="midname" value="<?php echo $session_midname;?>">
					<label>Middle Name</label>
				</div>
				<div class="md-form col-md-6">
					<i class="fa fa-envelope prefix text-dark"></i>
					<input class="form-control" type="email" name="email" value="<?php echo $session_email;?>">
					<label>Email</label>
				</div>
				<div class="md-form col-md-6">
					<i class="fa fa-phone prefix text-dark"></i>
					<input class="form-control" type="text" name="contact_num" maxlength="11" value="<?php echo $session_contact_num; ?>">
					<label>Contact Number</label>
				</div>
				<div class="md-form col-md-6">
					<i class="fa fa-user prefix text-dark"></i>
					<input class="form-control" type="text" name="username" value="<?php echo $session_user; ?>">
					<label>Username</label>
				</div>
				<div class="md-form mx-auto">
					<button type="submit" class="btn btn-primary" name="save"><span class="fa fa-save"></span> Save</button>
				</div>
			</form>
		</div>
	</div>

<!-- JavaScript Libraries-->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/mdb.min.js"></script>
</body>
</html>