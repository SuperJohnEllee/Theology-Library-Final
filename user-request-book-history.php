<!DOCTYPE html>
<?php
	include ('session.php');
	include ('connection.php');

	include('function/function.php');

	$req_sql = "SELECT BookName FROM book_request INNER JOIN users USING(UsersID) WHERE UsersID = '$session_id' AND Status = 'Approved'";
	$req_res = mysqli_query($conn, $req_sql);
	$req_count = mysqli_num_rows($req_res);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" charset="utf-8">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/mdb.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top"><a class="navbar-brand" href="#"><img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler grey darken-4" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item active">
     			<a class="nav-link text-white" href="home.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
</nav><br><br>
<div class="table-scrol"><br>
		<h1 class="text-center"><span class="fa fa-book"></span> Requested Books(<?php echo htmlspecialchars($req_count); ?>)</h1>
		<div class="container">
			<div class="page-header">
				<h3><span class="fa fa-remark"></span>&nbsp;List of your Requested Books 
				<hr class="theo-footer-hr">
				</h3>
			</div>
				<h5><?php echo htmlspecialchars($session_name); ?></h5>
       			<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th colspan="1">Book Request ID</th>
							<th colspan="1">Book Name</th>
							<th colspan="1">Author</th>
							<th colspan="1">Edition</th>
							<th colspan="1">Publisher</th>
							<th colspan="1">Published Date</th>
							<th colspan="1">Copyright</th>
							<th colspan="1">Status</th>
							<th colspan="2">Date Requested</th>
						</tr>
					</thead>
					<?php
				 		userApprovedRequestBooks();
				 	?>
				</table>
       		</div>
       	</div>
		</div>
	</div>
	<footer style="padding: 15px 0;" class="fixed-bottom mdb-color darken-4 text-center text-white">
		<h6>Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
	</footer>
<!--JavaScript Libraries-->
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/mdb.min.js"></script>
</body>
</html>