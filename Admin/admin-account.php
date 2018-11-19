<?php
	session_start();
	session_set_cookie_params(432000);
	$session_admin_id = htmlspecialchars($_SESSION['admin_id']);
	$session_admin_lastname = htmlspecialchars($_SESSION['lastname']);
	$session_admin_firstname = htmlspecialchars($_SESSION['firstname']);
	$session_admin_midname = htmlspecialchars($_SESSION['midname']);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	$session_admin_fullname = htmlspecialchars($_SESSION['fullname']);
	$session_admin_type = htmlspecialchars($_SESSION['type']);
	$session_admin_gender = htmlspecialchars($_SESSION['gender']);
	if (!$session_admin_user) {
		header("location: index.php");
	}

	include ('../connection.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>College of Theology Administration</title>
	<meta http-equiv="Content-Type" charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
		<a class="navbar-brand" href=""><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
     	<div class="navbar-nav">
     		<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
     	</div>
     </div>
	</nav><br><br>
	<div class="container"><br>
		<h1><i class="fa fa-user"></i>&nbsp;<?php echo htmlspecialchars($session_admin_type); ?>'s Profile</h1>
		<hr class="divider">
		<div class="col-md-9 personal-info">
			<div class="form-group">
				<?php
					if ($_SESSION['gender'] == "Male") {
				?>
				<img style="border-radius: 50%;" src="../img/person/img_avatar_2.png" height="200" width="200">
				<?php	
					} else if($_SESSION['gender'] == "Female") {
					?>
					<img style="border-radius: 50%;" src="../img/person/img_avatar.png" height="200" width="200">
				<?php	
					}
				?>
			</div>
			<div class="form-group">
				<h4>Username:&nbsp;<?php echo  htmlspecialchars($session_admin_user); ?></h4>
			</div>
			<div class="form-group">
				<h4>Name:&nbsp;<?php echo htmlspecialchars($session_admin_fullname); ?></h4>
			</div>
			<div class="form-group">
				<h4>Type:&nbsp;<?php echo htmlspecialchars($session_admin_type); ?></h4>
			</div>
			<div class="form-group">
				<h4>Gende: <?php  echo htmlspecialchars($session_admin_gender); ?></h4>
			</div>
			<div class="row">	
				<div class="form-group">
					<a class="btn btn-primary btn-lg" href="admin-edit-account.php?edit=<?php echo $session_admin_id; ?>"><span class="fa fa-edit"></span>&nbsp;Edit Profile</a>
				</div>
				<div class="form-group">
					<a class="btn btn-dark btn-lg" href="admin-change-password.php?<?php echo htmlspecialchars($session_admin_user); ?>"><span class="fa fa-lock"></span>&nbsp;Change Password</a>
				</div>
			</div>
		</div>
	</div>
	<?php

		if (isset($_POST['btn_save'])) {

			$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
			$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
			$midname = mysqli_real_escape_string($conn, $_POST['midname']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);

			$sql = "UPDATE admin SET 
			AdminLName = '$lastname',
			AdminFName = '$firstname',
			AdminMName = '$midname',
			AdminUser = '$username' WHERE AdminID = '$session_admin_id'";

			$result = mysqli_query($conn, $sql);

			if ($result) {
				echo "<script>
					alert('Successfully updated an account');
				</script>";
			} else {
				echo "<script>
					alert('Failure in account updating');
				</script>";
			}
		}
	?>
	<!--JavaScript Libraries-->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/mdb.min.js"></script>

</body>
</html>