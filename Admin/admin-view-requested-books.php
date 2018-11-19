<!DOCTYPE html>
<?php
	session_start();
	session_set_cookie_params(432000);
	if (!isset($_SESSION['admin_user'])) {
		session_unset();
		header("location: index.php");
	}
	include ('../connection.php');
	include('../function/function.php');

	//Count all requested books
	$req_sql = "SELECT book_requestID FROM book_request";
	$req_res = mysqli_query($conn, $req_sql);
	$res_count = mysqli_num_rows($req_res);

	//Count all pending requested books
	$pend_sql = "SELECT book_requestID FROM book_request WHERE Status = 'Pending'";
	$pend_res = mysqli_query($conn, $pend_sql);
	$pend_count = mysqli_num_rows($pend_res);

	//Count all approved requested books
	$app_sql = "SELECT book_requestID FROM book_request WHERE Status = 'Approved'";
	$app_res = mysqli_query($conn, $app_sql);
	$app_count = mysqli_num_rows($app_res);

	//Count all rejected requested books
	$rej_sql = "SELECT book_requestID FROM book_request WHERE Status = 'Rejected'";
	$rej_res = mysqli_query($conn, $rej_sql);
	$rej_count = mysqli_num_rows($rej_res);
?>
<html>
<head>
	<meta name="author" content="College of Theology Library">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
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
		<h1 class="text-center"><i class="fa fa-book"></i>&nbsp;Requested Books(<?php echo htmlspecialchars($res_count); ?>)</h1>
		<div class="container">
			<div class="page-header">
				<h3>List of Requested Books
				<hr class="theo-footer-hr">
				</h3>
			</div>
			<ul class="nav nav-tabs md-tabs nav-justified">
				 <li class="nav-item">
                	<a class="nav-link active" data-toggle="tab" href="#adminPendingRequestBooks" role="tab"><span class="fa fa-clock-o"></span> Pending Requested Books</a>
            	 </li>
            	 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#adminApprovedRequested" role="tab"><span class="fa fa-thumbs-up"></span> Approved Requested Books</a>
            	 </li>
            	 <li class="nav-item">
                	<a class="nav-link" data-toggle="tab" href="#adminRejectedRequested" role="tab"><span class="fa fa-thumbs-down"></span> Rejected Requested Books</a>
            	 </li>
			</ul><br><br>
			<form class="form-horizontal" method="post">
					<div class="form-group col-lg-9">
						<div class="input-group">
							<input class="form-control" type="text" name="request_search" onkeyup="filterSearch()" id="request_search">
							<button class="btn btn-primary" name="btn_request_search"><span class="fa fa-search"></span> Search</button>
						</div>
					</div>
				</form>
				<a class="btn btn-info" onclick="window.print()"><span class="fa fa-print"></span> Print</a>
				<!--<a class="btn btn-info" href="admin-approved-requested-books.php"><span class="fa fa-check"></span> Approved Request Books</a>
				<a class="btn btn-danger" href="admin-rejected-requested-books.php"><span class="fa fa-close"></span> Rejected Request Books</a> -->
			<div class="tab-content card">
				<div class="tab-pane fade in show active" id="adminPendingRequestBooks" role="tabpanel">
					<h3 class="text-center">Pending Request: <?php echo $pend_count; ?></h3>
				<table id="request_table" class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Requested ID</th>
							<th scope="col">Book Name</th>
							<th scope="col">Author</th>
							<th scope="col">Edition</th>
							<th scope="col">Copyright</th>
							<th scope="col">Publication Date</th>
							<th scope="col">Publisher</th>
							<th scope="col">Status</th>
							<th scope="col">Name of User</th>
							<th scope="col">Requested Date</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if (isset($_POST['btn_request_search'])) {
					$request_search = htmlspecialchars($_POST['request_search']);
					$request_search = mysqli_real_escape_string($conn, $request_search);

					$sql_search = "SELECT * FROM book_request
								WHERE book_requestID LIKE '%$request_search%'
								OR BookName LIKE '%$request_search%' 
								OR Author LIKE '%$request_search%'
								OR Edition LIKE '%$request_search%'  
								OR Copyright LIKE '%$request_search%' 
								OR Publisher LIKE '%$request_search%'
								OR Status LIKE '%$request_search%'";

					$res_search = mysqli_query($conn, $sql_search);
					$count_search = mysqli_num_rows($res_search);

					if ($count_search > 0) {
						while ($row_search = mysqli_fetch_array($res_search)) {
							echo '<tr><td>'.$row_search['book_requestID'].'</td>';
							echo '<td>'.$row_search['BookName'].'</td>';
							echo '<td>'.$row_search['Author'].'</td>';
							echo '<td>'.$row_search['Edition'].'</td>';
							echo '<td>'.$row_search['Copyright'].'</td>';
							echo '<td>'.$row_search['Publisher'].'</td>';
							echo '<td>'.$row_search['Publish_Date'].'</td>';
							echo '<td>'.$row_search['Status'].'</td>';
							echo '<td>'.$row_search['Request_Date'].'</td></tr>';
						}

						echo "<h3 class='alert alert-success text-center'>
    						<span class='fa fa-check'></span> ".$count_search." results found 
  							</h3";
					} else {
						echo "<h3 class='alert alert-danger text-center'>
						<span class='fa fa-close'></span> Keyword '$search' was not found
					</h3>";
					}

				} else {

					$view_Requested = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Pending' ORDER BY Request_Date DESC";
					$result = mysqli_query($conn, $view_Requested);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)){
                        $name = $row['UserFName'] . " " . $row['UserLName'];
                        ?>
					  	  <tr>
					   		<td><?php echo $row['book_requestID']; ?></td>
					   		<td><?php echo $row['BookName']; ?></td>
					   		<td><?php echo $row['Author']; ?></td>
					   		<td><?php echo $row['Edition']; ?></td>
					   		<td><?php echo $row['Copyright']; ?></td>
					   		<td><?php echo $row['Publisher']; ?></td>
					   		<td><?php echo $row['Publish_Date']; ?></td>
					   		<td class="font-weight-bold text-warning"><?php echo $row['Status']; ?></td>
					   		<td class="font-weight-bold text-info"><?php echo $name; ?></td>
					   		<td><?php echo $row['Request_Date']; ?></td>
					   		<td><a class='btn btn-primary' onclick="return confirm('Accept this requested book?');" href="crud_action.php?approve=<?php echo $row['book_requestID'] ?>"><span class='fa fa-check' name></span> Approved</a></td>
					   		<td><a class='btn btn-danger' onclick="return confirm('Reject this requested book?');" href="admin-request-remarks.php?reject_request=<?php echo $row['book_requestID'] ?>"><span class='fa fa-close'></span> Reject</a></td>
					   		<td></td>
					   </tr>
			<?php	} ?>
			<?php } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Requested Books Found</h3></td></tr>";
				 }
			}
					 ?>
					</tbody>
				</table>
				</div>
				<div class="tab-pane fade" id="adminApprovedRequested" role="tabpanel">
					<br>
					<h3 class="text-center">Approved Request: <?php echo $app_count; ?></h3>
					<table id="request_table" class="table table-hover">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Requested ID</th>
							<th scope="col">Title</th>
							<th scope="col">Author</th>
							<th scope="col">Edition</th>
							<th scope="col">Copyright</th>
							<th scope="col">Publication Date</th>
							<th scope="col">Publisher</th>
							<th scope="col">Status</th>
							<th scope="col">Remarks</th>
							<th scope="col">Name of User</th>
							<th scope="col">Requested Date</th>
						</tr>
					</thead>
					<tbody>
					<?php
						adminApprovedRequested();
				 	?>
				 </tbody>
				</table>
				</div>
				<div class="tab-pane fade" id="adminRejectedRequested" role="tabpanel">
					<br>
					<h3 class="text-center">Rejected Request: <?php echo $rej_count; ?></h3>
					<table id="request_table" class="table table-hover">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Requested ID</th>
								<th scope="col">Title</th>
								<th scope="col">Author</th>
								<th scope="col">Edition</th>
								<th scope="col">Copyright</th>
								<th scope="col">Publication Date</th>
								<th scope="col">Publisher</th>
								<th scope="col">Status</th>
								<th scope="col">Remarks</th>
								<th scope="col">Name of User</th>
								<th scope="col">Requested Date</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
							//adminRejectedRequested();
		if (isset($_POST['btn_request_search'])) {
			$request_search = htmlspecialchars($_POST['request_search']);
			$request_search = mysqli_real_escape_string($conn, $request_search);

			$sql_search = "SELECT * FROM book_request
								WHERE book_requestID LIKE '%$request_search%'
								OR BookName LIKE '%$request_search%' 
								OR Author LIKE '%$request_search%'
								OR Edition LIKE '%$request_search%'  
								OR Copyright LIKE '%$request_search%' 
								OR Publisher LIKE '%$request_search%'
								OR Status LIKE '%$request_search%'
								OR FullName LIKE '%$request_search%'";

			$res_search = mysqli_query($conn, $sql_search);
			$count_search = mysqli_num_rows($res_search);

					if ($count_search > 0) {
						while ($row_search = mysqli_fetch_array($res_search)) {
							echo '<tr><td>'.$row_search['book_requestID'].'</td>';
							echo '<td>'.$row_search['BookName'].'</td>';
							echo '<td>'.$row_search['Author'].'</td>';
							echo '<td>'.$row_search['Edition'].'</td>';
							echo '<td>'.$row_search['Copyright'].'</td>';
							echo '<td>'.$row_search['Publisher'].'</td>';
							echo '<td>'.$row_search['Publish_Date'].'</td>';
							echo '<td>'.$row_search['Status'].'</td>';
							echo '<td>'.$row_search['FullName'].'</td>';
							echo '<td>'.$row_search['Request_Date'].'</td></tr>';
						}

						echo "<h3 class='alert alert-success text-center'>
    						<span class='fa fa-check'></span> ".$count_search." results found 
  							</h3";
					} else {
						echo "<h3 class='alert alert-danger text-center'>
						<span class='fa fa-close'></span> Keyword '$search' was not found
					</h3>";
					}

				} else {

					$view_Requested = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Rejected' ORDER BY Request_Date DESC";
					$result = mysqli_query($conn, $view_Requested);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)){
                        $name = $row['UserFName'] . " " . $row['UserLName']; 
					   ?>
					   <tr>
					   		<td><?php echo $row['book_requestID']; ?></td>
					   		<td><?php echo $row['BookName']; ?></td>
					   		<td><?php echo $row['Author']; ?></td>
					   		<td><?php echo $row['Edition']; ?></td>
					   		<td><?php echo $row['Copyright']; ?></td>
					   		<td><?php echo $row['Publish_Date']; ?></td>
					   		<td><?php echo $row['Publisher']; ?></td>
					   		<td class="font-weight-bold text-danger"><?php echo $row['Status']; ?></td>
					   		<td class="font-weight-bold"><?php echo $row['Remarks']; ?></td>
					   		<td><?php echo $name; ?></td>
					   		<td><?php echo $row['Request_Date']; ?></td>
					   		<td><a class="btn btn-danger" onclick="return confirm('Delete this rejected book');" href="crud_action.php?rej_del=<?php echo $row['book_requestID']; ?>"><span class="fa fa-trash"></span> Delete</a></td>
					   </tr>
				<?php 	} ?>
				<?php } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Requested Books Found</h3></td></tr>";
				 }
			}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script>
	function filterSearch() {
 	 var input, filter, table, tr, td, i, j;
  		input = document.getElementById("request_search");
  		filter = input.value.toUpperCase();
  		table = document.getElementById("request_table");
  		tr = table.getElementsByTagName("tr");

  	for (i = 0; i < tr.length; i++) {
    		td = tr[i].getElementsByTagName("td")[1];
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[i].style.display = "";
      			} else {
        		tr[i].style.display = "none";
      		}
    	}       
  	}
}

		function funcPrint() {
			window.print();
		}
	</script>
<!-- JavaScript Libraries -->
  <script src="../js/bootstrap.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/mdb.min.js"></script>
</body>
</html>