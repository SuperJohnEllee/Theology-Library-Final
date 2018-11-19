<?php
	include ('session.php');
	include('function/function.php');
	$session_firstname = htmlspecialchars($_SESSION['firstname']);
    $session_midname = htmlspecialchars($_SESSION['midname']);
    $session_lastname = htmlspecialchars($_SESSION['lastname']);
    $session_id = htmlspecialchars($_SESSION['userid']);

    userRequestBook();
?>

<!DOCTYPE html>
<html>
<head>
	<meta content="College of Theology Library">
	<meta name="viewport" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0" charset="utf-8">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
  	<link rel="stylesheet" href="css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
  	<link rel="stylesheet" href="css/style.css">
  	<link rel="stylesheet" href="css/mdb.min.css">
</head>
<body class="cyan lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#">
			<img src="img/logo/cot2.jpg" align="logo" height="30" width="30">
		</a>
		<button class="navbar-toggler teal lighten-3" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto"> 
				<li class="nav-item">
					<a class="nav-link text-white" href="home.php"><span class="fa fa-home"></span><span class="sr-only">(current)</span> Home</a>
				</li>
			</ul>
		</div>
	</nav><br><br><br>
	<div class="text-center">
		<h2>College of Theology Library</h2>
		<h3>University Libraries</h3>
		<h4>Iloilo City, Philippines</h4>
	</div>
	<br>
	<div class="container">
		<h5>Library Purchase Request</h5>
		<hr class="divider">
		<h3><?php echo htmlspecialchars($session_name); ?></h3>
		<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<div class="form-row">
				<div class="col-md-6">
					<div class="md-form mb-5">
						<i class="fa fa-book prefix"></i>
						<input class="form-control" type="text" name="book_name">
						<label>Book Title</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="md-form mb-5">
						<i class="fa fa-user prefix"></i>
						<input class="form-control" type="text" name="author">
						<label>Author<small>(If known):</small></label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="md-form mb-5">
						<i class="fa fa-user prefix"></i>
						<input class="form-control" type="text" name="edition">
						<label>Edition</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="md-form mb-5">
						<i class="fa fa-copyright prefix"></i>
						<input class="form-control" type="text" name="copyright">
						<label>Copyright</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="md-form mb-5">
						<i class="fa fa-user prefix"></i>
						<input class="form-control" type="text" name="publisher">
						<label>Publisher</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="md-form mb-5">
						<i class="fa fa-calendar prefix"></i>
						<input class="form-control" type="text" name="publish_date">
						<label>Publication Date</label>
					</div>
				</div>
					<div class="md-form">
						<button type="submit" class="btn btn-success" name="btn_request"><span class="fa fa-chevron-circle-right"></span> Submit</button>
					</div>
				</div>	
			</form>
		</div>
<!--JavaScript Libraries-->
  	<script src="js/bootstrap.js"></script>
  	<script src="js/jquery.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/popper.min.js"></script>
  	<script src="js/mdb.min.js"></script>
</body>
</html>