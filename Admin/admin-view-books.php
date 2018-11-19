<?php
	session_start();
	session_set_cookie_params(432000);
	$session_user = $_SESSION['admin_user'];

	if (!$session_user) {
		header("location: index.php");
	}

	include ('../connection.php');
	include('../function/function.php');

	createBooks();

	$add_sql = "SELECT BookID FROM theo_books";
	$add_res = mysqli_query($conn, $add_sql);
	$add_count = mysqli_num_rows($add_res);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale-1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<meta name="author" content="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body oncontextmenu="return false" class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" align="logo" height="30" width="30">
		</a>
	<button class="navbar-toggler cyan lighten-2" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
      	<span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbar">
     	<ul class="navbar-nav mr-auto">
     		<li class="nav-item">
     			<a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
     		</li>
     	</ul>
     </div>
	</nav><br><br>
	<div class="table-scrol"><br>
		<h1 class="text-center"><i class="fa fa-book"></i>&nbsp;Book Information(<?php numberOfBooks(); ?>)</h1>
			<div class="page-header">
				<hr class="theo-footer-hr">
				<!--<a class="btn btn-primary" href="admin-create-books.php"><span class="fa fa-plus"></span>&nbsp;Add Books</a>
				<a style="float: right;" class="btn btn-primary" href="admin-book-search.php"><span class="fa fa-search"></span>&nbsp;Search Books</a> -->
			<!--<a class="ml-3 btn btn-primary" href="admin-locate-books.php"><span class="fa fa-map-marker"></span> Locate Books</a> -->
				<br>
			</div>
			<ul class="nav nav-tabs md-tabs nav-justified">
				 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#addBooks" role="tab"><span class="fa fa-plus"></span> Add Books</a>
            	 </li>
            	 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#viewBooks" role="tab"><span class="fa fa-eye"></span> View  Books</a>
            	 </li>
            	 <!--<li class="nav-item">
            	 	<a class="nav-link" data-toggle="tab" href="#locateBooks" role="tab"><span class="fa fa-map-marker"></span> Locate Books</a>
            	 </li> -->
			</ul>
			<div class="tab-content card">
				<div class="tab-pane fade in show active" id="addBooks" role="tabpanel">
					<br>
		<div class="row main">
			<div class="text-dark ml-5">
				<h1 class="text-center">Add Books</h1>
				<h4 class="text-center">You uploaded <?php echo htmlspecialchars($add_count); ?> books</h4>
				<br>
					<form class="form-horizontal" method="post" enctype="multipart/form-data">
					<div class="row">	
						<div class="md-form col-md-6">
							<i class="fa fa-image prefix"></i>
							<input type="file" class="form-control" name="image" id="image" required>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-book prefix"></i>
							<input type="text" class="form-control" name="call_number" id="call_number" required>
							<label>Call Number</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-book prefix"></i>
							<input type="text" class="form-control" name="isbn" id="isbn" required>
							<label>ISBN</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-book prefix"></i>
							<input type="text" class="form-control" name="book_title" id="book_title" required />
							<label>Book Title</label>
						</div>

						<div class="md-form col-md-6">
							<i class="fa fa-book prefix"></i>
							<input type="text" class="form-control" name="book_subtitle" id="book_subtitle" required />
							<label>Subtitle</label>
						</div>

						<div class="md-form col-md-6">
							<i class="fa fa-user prefix"></i>
							<input type="text" class="form-control" name="author" id="author"  required />
							<label>Author</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-book prefix"></i>
							<input class="form-control" type="text" name="edition" id="edition" required>
							<label>Edition</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-user prefix"></i>
							<input class="form-control" type="text" name="publisher" id="publisher" required>
							<label>Publisher</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-copyright prefix"></i>
							<input class="form-control" type="text" name="copyright" id="copyright" required>
							<label>Copyright</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-book prefix"></i>
							<input class="form-control" type="text" name="shelf_number" id="shelf_number" required>
							<label>Shelf Number</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-book prefix"></i>
							<input class="form-control" type="text" name="column_number" id="column_number" required>
							<label>Column Number</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-book prefix"></i>
							<input class="form-control" type="text" name="row_number" id="row_number">
							<label>Row Number</label>
						</div>
						<div class="md-form col-md-6">
							<i class="fa fa-lightbulb-o prefix"></i>
							<input class="form-control" type="text" name="light_number" id="light_number">
							<label>Light Number</label>
						</div>
						<div class="md-form col-md-6">
							<button class="btn green accent-4 btn-lg" name="btn_add" id="btn_add"><i class="fa fa-plus icon"></i>&nbsp;Add Books</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="viewBooks" role="tabpanel">
			<form method="get">
				<div class="form-group col-md-9">
					<div class="input-group">
						<input class="form-control" type="search" id="myInput" onkeyup="myFunction()" name="book_search" placeholder="Search">
							<button class="btn btn-default" type="submit" name="btn_search"><span class="fa fa-search icon"></span> Search</button>
					</div>
				</div>
			</form>
			<br>
			<h5>Search for Title of the Book</h5>
				<table class="table table-hover" id="myTable">
					<thead class="thead-dark">
						<tr>
							<th colspan="1">Book Image</th>
							<th colspan="1">ISBN</th>
							<th colspan="1">Call Number</th>
							<th colspan="1">Title</th>
							<th colspan="1">Subtitle</th>
							<th colspan="1">Author</th>
							<th colspan="1">Edition</th>
							<th colspan="1">Publisher</th>
							<th colspan="1">Copyright</th>
							<th colspan="1">Date Posted</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
				<tbody>
				<?php
					adminViewBooks();
				 ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
<script>
	function myFunction() {
  var input, filter, table, tr, td, i, j, k;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  	for (j = 0; j < tr.length; j++) {
    		td = tr[j].getElementsByTagName("td")[3];//Book Name
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[j].style.display = "";
      			} else {
        		tr[j].style.display = "none";
      		}
    	}       
  	}

  	for (k = 0; k < tr.length; k++) {
    		td = tr[k].getElementsByTagName("td")[3]; //Call Number
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[k].style.display = "";
      			} else {
        		tr[k].style.display = "none";
      		}
    	}       
  	}
}
</script>
<!-- JavaScript Libraries -->
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/mdb.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>