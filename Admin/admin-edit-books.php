<!DOCTYPE html>
<?php
	include ('../connection.php');
	include('../function/function.php');
	session_start();
	session_set_cookie_params(432000);

	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}

	//Update book function
	updateBooks();

	$id = htmlspecialchars($_GET['book_edit']);
	$sql = "SELECT * FROM theo_books WHERE BookID = '$id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$row_image = '../book_image/'. htmlspecialchars($row['BookImage']);
?>
<html>
<head>
	<meta name="viewport" charset="utf-8">
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="icon" href="../img/logo/COT Logo.jpg">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/app.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30"></a>
		<button class="navbar-toggler teal lighten-3" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link text-white" href="adminHome.php"><span class="fa fa-home"></span><span class="sr-only">(current)</span> Home</a>
				</li>
			</ul>
		</div>
	</nav><br><br><br>
	<div class="container">
		<div class="page-header">
			<h3><i class="fa fa-edit"></i>&nbsp;Edit Books</h3>
			<hr class="theo-footer-hr">
		</div><br>
		<div class="col-md-7">
			<form class="form-horizontal row" method="post" enctype="multipart/form-data">
					<div class="cols-sm-10">
							<input type="hidden" class="form-control" name="id" id="id" placeholder="ID" required value="<?php echo $row['BookID']; ?>">
					</div>
					<div class="form-group col-lg-5">
							<label for="call_number" class="cols-sm-2 control-label">Book Image</label>
							<img height="250" width="250" src="<?php echo htmlspecialchars($row_image); ?>">
							<div class="cols-sm-10">
									<input type="file" class="form-control" name="image" id="image" placeholder="Book Image" >
							</div>
					</div>
						<div class="form-group col-lg-6">
							<label for="call_number" class="cols-sm-2 control-label">Call Number</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="call_number" id="call_number" value="<?php echo htmlspecialchars($row['BookCallNumber']); ?>">
							</div>
						</div>
						<div class="form-group col-lg-5">
							<label for="isbn" class="cols-sm-2 control-label">ISBN</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="isbn" id="isbn" value="<?php echo htmlspecialchars($row['ISBN']); ?>">
							</div>
						</div>
						<div class="form-group col-lg-6">
							<label for="email" class="cols-sm-2 control-label">Book Title</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="book_title" id="book_title"  placeholder="Book Title" value="<?php echo htmlspecialchars($row['BookName']); ?>">
							</div>
						</div>
						<div class="form-group col-lg-6">
							<label for="username" class="cols-sm-2 control-label">Subtitle</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="book_subtitle" id="book_subtitle" 
									value="<?php echo htmlspecialchars($row['BookType']); ?>">
							</div>
						</div>

						<div class="form-group col-lg-6">
							<label for="author" class="cols-sm-2 control-label">Author</label>
							<div class="cols-sm-10">
									<input type="text" class="form-control" name="author" id="author" value="<?php echo htmlspecialchars($row['Author']); ?>">
							</div>
						</div>
						<div class="form-group col-lg-3">
							<label for="edition" class="cols-sm-2 control-label">Edition</label>
							<div class="cols-sm-10">
									<input class="form-control" type="text" name="edition" id="edition" placeholder="Edition Type" value="<?php echo htmlspecialchars($row['BookEdition']) ?>">
							</div>
						</div>
						<div class="form-group col-lg-5">
							<label for="publisher" class="cols-sm-2 control-label">Publisher</label>
							<div class="cols-sm-10">
									<input class="form-control" type="text" name="publisher" id="publisher" placeholder="Enter Publisher" value="<?php echo htmlspecialchars($row['BookPublisher']); ?>">
							</div>
						</div>
							<div class="form-group col-lg-3">
								<label for="copyright" class="cols-sm-2 control-label">Copyright</label>
								<div class="cols-sm-10">
										<input class="form-control" type="text" name="copyright" id="copyright" placeholder="Enter Copyright" value="<?php echo htmlspecialchars($row['BookCopyright']); ?>">
								</div>
							</div>
							<div class="form-group col-lg-2">
								<label for="book_shelf" class="cols-sm-2 control-label">Shelf Number</label>
								<div class="cols-sm-10">
									<input class="form-control" type="text" name="book_shelf" id="book_shelf" value="<?php echo $row['BookShelfNumber']; ?>">
								</div>
							</div>
							<div class="form-group col-lg-2">
								<label for="book_row" class="cols-sm-2 control-label">Row Number</label>
								<div class="cols-sm-10">
									<input class="form-control" type="text" name="book_row" id="book_row" value="<?php echo $row['BookRowNumber']; ?>">
								</div>
							</div>
							<div class="form-group col-lg-2">
								<label for="book_column" class="cols-sm-2 control-label">Column Number</label>
								<div class="cols-sm-10">
									<input class="form-control" type="text" name="book_column" id="book_column" value="<?php echo $row['BookColumnNumber']; ?>">
								</div>
							</div>
							<div class="form-group col-lg-2">
								<label for="book_lignt" class="cols-sm-2 control-label">Light Number</label>
								<div class="cols-sm-10">
									<input class="form-control" type="text" name="book_light" id="book_lignt" value="<?php echo $row['BookLightNumber']; ?>">
								</div>
							</div>
						<div class="form-group col-lg-6">
							<button type="submit" class="btn btn-primary btn-lg" name="btn_update" id="btn_update"><i class="fa fa-download icon"></i>&nbsp;Save</button>
						</div>
			</form>
		</div>
	</div>

<!-- JavaScript Libraries -->
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/mdb.min.js"></script>
</body>
</html>