<?php
	include ('session.php');
	include ('connection.php');
	include('function/function.php');

	$session_firstname = htmlspecialchars($_SESSION['firstname']);
    $session_lastname = htmlspecialchars($_SESSION['lastname']);
    $session_id = htmlspecialchars($_SESSION['userid']);

    //function for Reservation
    userReserveBook();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
  <meta name="author" content="College of Theology">
  <meta name="description" content="Web Application for College of Theology with Book Locator">
  <title>College of Theology Library</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/mdb.min.css">
  <link rel="icon" href="img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light mdb-color darken-4 fixed-top">
		<a class="navbar-brand" href="#">
			<img src="img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
		<button class="navbar-toggler cyan lighten-3" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto"> 
				<li class="nav-item">
					<a class="nav-link text-white" href="home.php"><span class="fa fa-home"></span><span class="sr-only">(current)</span> Home</a>
				</li>
			</ul>
		</div>
	</nav>
	<br>
	<!--<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header teal lighten-3 text-center">
					<h4 class="modal-title w-100 font-weight-bold">Book Reservation</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="close">
						<span aria-label="true">&times;</span>
					</button>
				</div>
					<p class="text-center">Note: You can only reserved 1 book for 2 days</p>
            	<div class="modal-body mx-3">
			    <form method="post">
                    <div class="form-group mb-5">		
                    	<label for="date_reserved">Date of Reservation</label>
						<input type="date" name="date_reserved" id="date_reserved" class="form-control">
                    </div>
                    <div class="md-form mb-4">
                        <button type="submit" class="btn btn-default" name="btn_reserved" data-loading-text="Reserving in.."><span class="fa fa-chevron-circle-right"></span> Reserved</button>
                    </div>
                </form>
            	</div>
			</div>
		</div>
	</div>-->
	<div class="container">
		<div class="page-header"><br><br>
			<h3>Book Information</h3>
		</div>
		<div class="container-fluid well span6">
			<hr class="theo-footer-hr">
			<?php
				$bookid = htmlspecialchars($_GET['id']);
				$sql = "SELECT * FROM theo_books WHERE BookID = '$bookid'";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);
				$res_bookimage = "book_image/" . htmlspecialchars($row['BookImage']);
			?>
			 <div class="row">
			 	<div class="span2">
					<h4>Book Image</h4>
					<img src="<?php echo htmlspecialchars($res_bookimage); ?>" alt="image" height="400px" width="300px">
				</div>
				<div class="span8" style="margin-left: 330px; margin-top: -370px;">
					<h3>Book ID:&nbsp; <?php echo htmlspecialchars($row['BookID']); ?> </h3>
					<h3>Book Title:&nbsp; <?php echo htmlspecialchars($row['BookName']); ?> </h3>
					<h3>Book Subtitle:&nbsp; <?php echo htmlspecialchars($row['BookType']); ?> </h3>
					<h3>Book ISBN:&nbsp; <?php echo htmlspecialchars($row['ISBN']); ?></h3>
					<h3>Author:&nbsp; <?php echo htmlspecialchars($row['Author']); ?> </h3>
					<h3>Date Posted:&nbsp; <?php echo htmlspecialchars(date('F j, Y - g:i A', strtotime($row['BookPostDate']))); ?> </h3>
					<!--<?php
						if ($reserve_day_res) {
					?>
						<h3 class="font-weight-bold">This book already reserve by <?php echo $session_name; ?></h3>
					<?php
						} else {
							?>
							<h3 class="font-weight-bold">This book is available to reserve</h3>
					<?php }
					?> -->
					<form method="post">
						<button class="btn btn-primary" type="submit" name="btn_reserved" onclick="return confirm('Reserve this book?');">Reserved This  Book</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- JavaScript Libraries -->
  <script src="js/bootstrap.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/mdb.min.js"></script>
  <script> $('.datepicker').pickadate(); </script>
</body>
</html>
