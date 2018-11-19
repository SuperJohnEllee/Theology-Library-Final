<!DOCTYPE html>
<?php
	session_start();
	session_set_cookie_params(432000);
	if (!isset($_SESSION['admin_user'])) {
		header("location: index.php");
	}

	include ('../connection.php');
	include('../function/function.php');
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="IE=edge">
	<meta name="author" content="College of Theology Library">
	<title>College of Theology Library</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="icon" href="../img/logo/cot2.jpg">
</head>
<body class="cyan lighten-4">
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
		<div class="table-scrol">
		<h1 class="text-center"><i class="fa fa-book"></i> Approved Reserved Books(<?php numberOfApprovedReserveBooks(); ?>)</h1>
		<div class="container">
			<div class="page-header">
				<h3>List of Approve Reserved Books
				<hr class="theo-footer-hr">
				</h3>
				<br>
				<form class="form-horizontal" method="post">
					<div class="form-group col-lg-9">
						<div class="input-group">
							<input class="form-control" type="text" name="reserve_search" onkeyup="filterSearch()" id="request_search">
							<button class="btn btn-primary" name="btn_reserved_search"><span class="fa fa-search"></span> Search</button>
						</div>
					</div>
				</form>
				<h5>Search for Title</h5>
				<table id="reserve_table" class="table table-hover">
					<thead class="thead-inverse">
						<tr>
							<th scope="col">Book Image</th>
							<th scope="col">Reserve ID</th>
							<th scope="col">Book Name</th>
							<th scope="col">Name of User</th>
							<th scope="col">Author</th>
							<th scope="col">Status</th>
							<th scope="col">Requested Date</th>
						</tr>
					</thead>
				<?php
					adminApprovedReserveBooks();
				 ?>
				</table>
			</div>
		</div>
	</div>
<script>
	function filterSearch() {
  		var input, filter, table, tr, td, i, j, k;
  		input = document.getElementById("reserve_search");
  		filter = input.value.toUpperCase();
  		table = document.getElementById("reserve_table");
 		tr = table.getElementsByTagName("tr");

  	for (j = 0; j < tr.length; j++) {
    		td = tr[j].getElementsByTagName("td")[1];//Book Name
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
</body>
</html>