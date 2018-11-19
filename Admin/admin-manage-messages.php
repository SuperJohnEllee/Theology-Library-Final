<!DOCTYPE html>
<?php
	session_start();

	$session_admin = htmlspecialchars($_SESSION['admin_user']);

	if (!$session_admin) {
		header("location: index.php");
	}

	include('../connection.php');
	include('../function/function.php');

	adminCreateMessages(); // creating a message
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<meta name="author" charset="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/cot2.jpg">
</head>
<body class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg mdb-color darken-4 fixed-top">
		<a href=""><img src="../img/logo/cot.jpg" height="30" width="30"></a>
	<button class="navbar-toggler cyan lighten-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon text-dark"></span>
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
			<h1 class="text-center">Messages</h1>
		</div>
		<ul class="nav nav-tabs md-tabs nav-justified">
    		<li class="nav-item">
        		<a class="nav-link active" data-toggle="tab" href="#create_message" role="tab"><span class="fa fa-pencil"></span> Create Message</a>
    		</li>
    		<li class="nav-item">
        		<a class="nav-link" data-toggle="tab" href="#inbox" role="tab"><span class="fa fa-envelope"></span> Inbox</a>
    		</li>
    		<li class="nav-item">
        		<a class="nav-link" data-toggle="tab" href="#sent_message" role="tab"><span class="fa fa-paper-plane-o"></span> Sent Messages</a>
    		</li>
		</ul>
		<div class="tab-content card">
    		<div class="tab-pane fade in show active" id="create_message" role="tabpanel">
        	<br>
        		<form method="post">
        			<div class="col-md-8">
        				<div class="md-form">
        					<i class="fa fa-user prefix"></i>
        					<input class="form-control" type="text" name="user">
        					<label for="user">User</label>
        				</div>
                		<div class="md-form">
                    		<i class="fa fa-pencil prefix text-dark"></i>
                    		<textarea type="text" name="message" id="message" class="md-textarea form-control" rows="4"></textarea>
                    		<label for="message">Your message</label>
                		</div>
            			<div class="md-form d-flex justify-content-center">
                			<button type="submit" name="send" class="btn btn-success"><i class="fa fa-paper-plane-o ml-1"></i> Send</button>
            			</div>
        			</div>
        		</form>
   			</div>
    		<div class="tab-pane fade" id="inbox" role="tabpanel">
        	<br>
        		<table class="table table-hover" id="inboxTable">
        			<thead class="thead-inverse">
        				<tr>
        					<th>ID</th>
        					<th>User</th>
        					<th>Message</th>
        					<th>Sent By</th>
        					<th>Date Sent</th>
        					<th>Action</th>
        				</tr>
        			</thead>
        			<tbody>
        				<?php adminInbox(); ?>
        			</tbody>
        		</table>
    		</div>
    		<div class="tab-pane fade" id="sent_message" role="tabpanel">
        	<br>
        		<table class="table table-hover" id="inboxTable">
        			<thead class="thead-inverse">
        				<tr>
        					<th>ID</th>
        					<th>Admin</th>
        					<th>Message</th>
        					<th>Sent By</th>
        					<th>Date Sent</th>
        					<th>Action</th>
        				</tr>
        			</thead>
        			<tbody>
        				<?php adminSentMessages(); ?>
        			</tbody>
        		</table>
    		</div>
	</div>
</div>
<!--JavaScript Libraries-->
<script src="../js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/mdb.min.js"></script>
</body>
</html>