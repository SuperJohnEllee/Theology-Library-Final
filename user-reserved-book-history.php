<!DOCTYPE html>
<?php
	include ('session.php');
	include ('connection.php');

	$req_sql = "SELECT BookName FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE UsersID = '$session_id' AND Status = 'Approved'";
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
		<h1 class="text-center"><span class="fa fa-book"></span> Reserved Books(<?php echo htmlspecialchars($req_count); ?>)</h1>
		<div class="container">
			<div class="page-header">
				<h3><span class="fa fa-remark"></span>&nbsp;List of your Reserved Books 
				<hr class="theo-footer-hr">
				</h3>
				<h5><?php echo htmlspecialchars($session_name); ?></h5>
				<br>
				<table class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th colspan="1">Book Image</th>
							<th colspan="1">Book Reserved ID</th>
							<th colspan="1">Book Name</th>
							<th colspan="1">Author</th>
							<th colspan="1">Status</th>
							<th colspan="2">Date Reserved</th>
							<th colspan="2">Action</th>
						</tr>
					</thead>
			<?php
					$viewBooks = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE UsersID = '$session_id' AND Status = 'Approved'";
					$result = mysqli_query($conn, $viewBooks);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)) {

					echo '<tr><td><img src="book_image/'.$row["BookImage"].'" height="250" width=200></td>';
					echo '<td>'.$row['book_reservationID'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['Status'].'</td>';
					echo '<td>'.$row['ReservationDate'].'</td>';
					echo '<td><a class="btn btn-primary"><span class="fa fa-edit"></span> Edit</a></td>';
					echo '<td><a class="btn btn-danger" href="user-delete.php?res_del='.$row['book_reservationID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Reserved Books Found</h3></td></tr>";
				 }
				 ?>
				</table>
			</div>
		</div>
	</div>
	<footer style="padding: 15px 0;" class="fixed-bottom mdb-color darken-4 text-center text-white">
		<h6>Develop by Ellee Solutions &copy 2018. All Rights Reserved</h6>
	</footer>
<!--JavaScript Libraries-->
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="js/mdb.min.js"></script>
</body>
</html>