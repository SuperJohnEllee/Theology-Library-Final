<!DOCTYPE html>
<?php
	include('../connection.php');
	include('../function/function.php');
	session_start();
	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}

	$sql = "SELECT * FROM contact_us";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);

	updateContactUs();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<meta name="author" content="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/cot2.jpg">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-lablled="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>   
		<div class="collapse navbar-collapse" id="navbar">
     	<div class="navbar-nav">
     		<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a>
     	</div>
     </div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-address-book"></span> Update Contact Us Information</h1>
		</div>
		<hr class="divider">
		<div class="col-md-9 personal-info">
			<form class="form-horizontal" role="form" method="post">
				<div class="md-form">
					<input class="form-control" type="hidden" name="id" value="<?php echo $row['contact_usID'];  ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-map-marker prefix"></i>
					<input class="form-control" type="text" name="address" value="<?php echo $row['Address'];  ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-phone prefix"></i>
					<input class="form-control" type="text" name="contact_number" value="<?php echo $row['ContactNumber']; ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-envelope prefix"></i>
					<input class="form-control" type="text" name="contact_email" value="<?php echo $row['ContactEmail']; ?>">
				</div>
				<div class="md-form">
					<i class="fa fa-calendar prefix"></i>
					<input class="form-control" type="text" name="contact_schedule" value="<?php echo $row['ContactSchedule']; ?>">
				</div>
				<div class="md-form">
						<button class="btn btn-primary" type="submit" name="save_contact"><span class="fa fa-save"></span> Save Changes</button>
				</div>
				</div>
			</form>
		</div>
	</div>
<!--JavaScript Libraries-->
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="..js/mdb.min.js"></script>
</body>
</html>