<?php
	include ('session.php');
	include ('connection.php');
	include('function/function.php');

	$age_sql = "SELECT UsersID, (DATEDIFF(CURRENT_DATE, STR_TO_DATE(UserBirthday, '%Y-%m-%d'))/ 365) as Age FROM users WHERE UsersID = '$session_id'";
	$age_res = mysqli_query($conn, $age_sql);
	$age_row = mysqli_fetch_assoc($age_res);

	//Function for closing account
	closeAccount();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo htmlspecialchars($session_name); ?>'s Profile</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
	<style>.icon{font-size:25px;}.bg-accupdate{background: linear-gradient(to bottom, #00ffff 0%, #ffffcc 100%);}</style>
</head>
<body oncontextmenu="return false" class="cyan lighten-5">	
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top"><a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     	<!--<ul class="navbar-nav ml-auto">
     		<li class="nav-item dropdown">
     			<a class="nav-link dropdown-toggle text-white" id="navbardrop" data-toggle="dropdown" href="#"><span class="fa fa-user"></span> <?php echo $session_user; ?></a>
     			<div class="dropdown-menu">
     				<a class="dropdown-item" href="#"><span class="fa fa-edit"></span> Edit Profile</a>
     				<a class="dropdown-item" href="#"><span class="fa fa-lock"></span> Change Password</a>
     				<a class="dropdown-item" href="#"><span class="fa fa-history"></span> Request Book History</a>
     				<a class="dropdown-item" href="#"><span class="fa fa-history"></span> Reserve Book History</a>
     				<a class="dropdown-item" href="#"><span class="fa fa-close"></span> Close Account</a>
     			</div>
     		</li>
     	</ul>-->
     </div>
	</nav>
	<br><br><br>
	<h2 class="text-center">College of Theology Library</h2>
	<br>
	<div class="container">
		<div class="page-header">
		</div>
		<div class="row">	
			<div class="card mx-auto col-9 cyan lighten-4" style="width: 17rem;">
			<h3 class="text-center">User Profile</h3>
				<div class="view overlay">
					<?php
					if ($session_gender == "Male") {
					?>
				<img style="border-radius: 50%; margin-left: auto; margin-right: auto;" src="img/person/img_avatar_2.png" height="200" width="200">
				<?php	
					} else if($session_gender == "Female") {
					?>
					<img style="border-radius: 50%; margin-left: auto; margin-right: auto;" src="img/person/img_avatar.png" height="200" width="200">
				<?php	
					}
				?>	
				</div>
				<hr>
				<div class="card-body">
					<h3 class="pull-right">Username: <?php echo $session_user; ?></h3>
					<h3>Name: <?php echo $session_fullname; ?></h3>
					<h3 class="pull-right">Birthdate: <?php echo $session_birthday; ?></h3>
					<h3>Email: <?php echo $session_email; ?></h3>
					<h3 class="pull-right">Contact Number: <?php echo $session_contact_num; ?></h3>
					<h3 class=>Age: <?php echo round($age_row['Age']); ?></h3>
					<h3>Type: <?php echo $session_type; ?></h3>	
				</div>
				<div class="card-body">
					
			<div class="row">
				<div class="form-group">
					<a class="btn btn-lg btn-primary" href="edit-profile.php?edit=<?php echo $session_id; ?>"><span class="fa fa-edit"></span> Edit Profile</a>
				</div>
				<div class="form-group">
					<a href="change-password.php?<?php echo htmlspecialchars($session_user); ?>" class="btn btn-lg btn-dark"><span class="fa fa-lock"></span> Change Password</a> 
				</div>
				<!--<div class="form-group">
					<a class="btn-lg btn btn-success" href="user-request-book-history.php?name=<?php echo htmlspecialchars($session_user); ?>"><span class="fa fa-history"></span> Request Book History</a>
				</div>
				<div class="form-group">
					<a class="btn-lg btn btn-secondary" href="user-reserved-book-history.php?name=<?php echo htmlspecialchars($session_user) ?>"><span class="fa fa-history"></span> Reserved Book History</a>
				</div> -->
				<div class="form-group">
					<a class="btn btn-danger btn-lg" data-toggle="modal" data-target="#closeModal"><span class="fa fa-close"></span> Close Account</a>
				</div>
			</div>
				</div>
			</div>
 			</div>
		</div>
	</div>
</div>

	<!--Close Account Modal-->
	<div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold"> Close profile for <i class="text-warning"><?php echo $session_user; ?></i></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<p class="text-center">Close Account</p>
				<div class="modal-body mx-3">
					<form method="post">
						<div class="md-form mb-5">
							<i class="fa fa-pencil prefix"></i>
							<textarea class="form-control md-textarea" name="reason_content" rows="7" length="1000" style="resize: none;" required></textarea>
							<label>State your Reason for Closing Account</label>
						</div>
						<div class="md-form mb-4">  
                        	<button type="submit" class="btn btn-default pull-right" name="close_account" data-loading-text="Closing in.." onclick="return confirm('Are you sure you want to close your account?');"> Close Account</button>
                    	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php

	if (isset($_POST['btn_save'])) {

		$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
		$firtname = mysqli_real_escape_string($conn, $_POST['firstname']);
		$midname = mysqli_real_escape_string($conn, $_POST['midname']);

		$sql = "UPDATE users SET UserLName = '$lastname', UserFName = '$firtname', 
		UserMName = '$midname' WHERE UsersID = '$session_id'";

		if (mysqli_query($conn, $sql)) {
			echo "<script>
				alert('Update Successfully');
			</script>
			<meta http-equiv='refresh' content='0; url=profile.php'>";

				$filename = "system/update_user_profile.txt";
                 $fp = fopen($filename, 'a+');
                 fwrite($fp, " " . $session_user . " updated his/her account to " . $firtname . " | " . $midname . " | " . " | " . $lastname ." | ". date("l jS \of F Y h:i:s A"). "\n");
                 fclose($fp);
                 die();
		} else {
			echo "<script>
				alert('Failure in updating profile');
			</script>";
		}
	}
?>
<!-- JavaScript Libraries -->
<script src="js/bootstrap.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mdb.min.js"></script>

</body>
</html>