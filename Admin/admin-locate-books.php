<!DOCTYPE html>
<?php
	session_start();
	session_set_cookie_params(432000);
	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}

	include('../connection.php');
	include('../function/function.php');
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<meta name="authror" content="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/COT Logo.jpg">
</head>
<body class="cyan lighten-4">
	<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-dark">
		<a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" height="30" width="30"></a>
		<button class="navbar-toggler bg-secondary" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span>&nbsp;Home<span class="sr-only">(current)</span></a>
			</div>
		</div>
	</nav><br><br><br>
	<div class="table-scrol">
		<h1 class="text-center"><i class="fa fa-map-marker"></i> Locate Books</h1>
		<div class="container">
			<div class="page-header">
				<h3>List of Books</h3>
				<hr>
				<br>
			</div>
			<form method="get">
				<div class="form-group col-md-9">
					<div class="input-group">
						<input class="form-control" type="text" id="book_search" onkeyup="searchLocate()" name="book_search" placeholder="Search">
							<button class="btn btn-default" type="submit" name="btn_search"><span class="fa fa-search icon"></span>&nbsp;Search</button>
					</div>
				</div>
			</form>
			<br>
			<h5>Search for Book Name </h5>
				<table class="table table-hover" id="book_table">
					<thead class="thead-dark">
						<tr>
							<th colspan="1">Book Image</th>
							<th colspan="1">Book ID</th>
							<th colspan="1">ISBN</th>
							<th colspan="1">Call Number</th>
							<th colspan="1">Title</th>
							<th colspan="1">Date Posted</th>
							<th colspan="1">Shelf Number</th>
							<th colspan="1">Row Number</th>
							<th colspan="1">Column Number</th>
							<th colspan="1">Light Number</th>
							<th class="text-center" colspan="2">Locate</th>
						</tr>
					</thead>
				<tbody>
				<?php
					locateBooks();
				 ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>

<script>
	
	function searchLocate() {
  var input, filter, table, tr, td, i, j, k;
  input = document.getElementById("book_search");
  filter = input.value.toUpperCase();
  table = document.getElementById("book_table");
  tr = table.getElementsByTagName("tr");

  	for (j = 0; j < tr.length; j++) {
    		td = tr[j].getElementsByTagName("td")[4];//Book Name
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[j].style.display = "";
      			} else {
        		tr[j].style.display = "none";
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