<!DOCTYPE html>
<?php

	session_start();
	if (!isset($_SESSION['admin_user'])) {
		header('location: index.php');
	}

	include ('../connection.php');
	include('../function/function.php');

	$reject_res = $_GET['reject_request'];
	$sql = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE book_requestID = '$reject_res'";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);

	$name = $row['UserFName'] .  " " . $row['UserLName']; 

	//function
	rejectRequestRemarks();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="College of Theology Library">
	<meta name="description" content="Web Application For College of Theology with Book Locator">
	<title>College of Theology Library</title>
	<link rel="icon" href="../img/logo/cot2.jpg">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="cyan lighten-5">

	<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
		<a class="navbar-brand" href="#"><img src="../img/logo/cot2.jpg" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
			</div>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-close"></span> Reject Reserved Book</h1>
			<hr>
		</div>
		<h4>State the Remarks for rejecting a book for <span class="text-danger"><?php echo $row['BookName']; ?></span> requested by <span class="text-warning"><?php echo $name; ?></span></h4>
		<div class="row">
			<form class="col-md-6" method="post">
				<div class="md-form">
					<i class="fa fa-pencil prefix"></i>
					<textarea class="form-control md-textarea" rows="5" name="remarks"></textarea>
					<label>Remarks</label>
				</div>
				<div class="md-form">
					<button type="submit" class="btn btn-primary" name="btn_remarks"><span class="fa fa-paper-plane-o"></span> Submit</button>
				</div>
			</form>
		</div>
	</div>
  <script src="../js/bootstrap.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/mdb.min.js"></script>
</body>
</html>