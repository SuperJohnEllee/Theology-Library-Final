<!DOCTYPE html>
<?php
	include('../connection.php');
	include('../function/function.php');
	
	session_start();
	session_set_cookie_params(432000);
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);

	if (!isset($_SESSION['admin_user'])) {
		session_unset();
		session_destroy();
		header("location: index.php");
	} 

	$id = htmlspecialchars($_GET['feed_reply']);
	$feed_reply = mysqli_query($conn, "SELECT * FROM feedback WHERE feedbackID = '$id'");
	$feed_row = mysqli_fetch_assoc($feed_reply);

	//function reply feedback to users
	replyFeedback();
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="College of Theology Library">
    <title>College of Theology Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mdb.min.css">
    <link rel="stylesheet" href="../css/design.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/logo/cot2.jpg">
</head>
<body class="cyan lighten-4">
	 <nav class="navbar navbar-expand-lg navbar-light text-white mdb-color darken-4 fixed-top">
	<a class="navbar-brand" href="#"><img src="../img/logo/cot2.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler cyan lighten-2" type="button" data-toggle="collapse" data-target="#navbar" 
	aria-controls="navbar aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i> Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h1 class="text-center"><span class="fa fa-reply"></span> REPLY FEEDBACK</h1>
			<hr>
			<h3>Reply to <span class="text-warning"><?php echo $feed_row['Name']; ?></span></h3>
		</div>
		<div class="mt-5">
			<h5>Subject is <span class="text-warning"><?php echo $feed_row['Subject']; ?></span><br>The Message is <span class="text-warning"><?php echo $feed_row['Message']; ?></span></h5>
		</div>
		<form method="post">
			<div class="md-form mb-5">
                <i class="fa fa-pencil prefix text-dark"></i>
                <textarea type="text" name="message" id="message" class="md-textarea form-control" rows="5" required></textarea>
                <label class="text-dark" data-error="wrong" data-success="right" for="message">Your message</label>
            </div>
            <div class="md-form mb-4">
                <button type="submit" class="btn btn-success pull-right" id="btn_post" name="reply"><span class="fa fa-paper-plane-o"></span> Send</button>
            </div>
		</form>
	</div>

<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/mdb.min.js"></script>
</body>
</html>