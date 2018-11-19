<!DOCTYPE html>
<?php
	session_start();
	if (!isset($_SESSION['admin_user'])) {
		header('location: index.php');
	}

	include ('../connection.php');
	include('../function/function.php');

	//Number of Pending Reserve Books
	$pend_sql = mysqli_query($conn ,"SELECT * FROM reservation WHERE Status = 'Pending'");
	$pend_reserve_count = mysqli_num_rows($pend_sql);

	//Number of Approved Reserve Books
	$app_sql = mysqli_query($conn, "SELECT * FROM reservation WHERE ReservationDate >= CURRENT_DATE() - INTERVAL 48 DAY_HOUR");
	$app_reserve_count = mysqli_num_rows($app_sql);

	//Number of Rejected Reserve Books
	$rej_sql = mysqli_query($conn, "SELECT * FROM reservation WHERE Status = 'Rejected'");
	$rej_reserve_count = mysqli_num_rows($rej_sql);

	$aLl_reserve_sql = mysqli_query($conn, "SELECT * FROM reservation");
	$aLl_reserve_count = mysqli_num_rows($aLl_reserve_sql);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="College of Theology Library">
	<meta name="description" content="Web Application For College of Theology with Book Locator">
	<title>College of Theology Library</title>
	<link rel="icon" href="../img/logo/cot2.jpg">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/mdb.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="cyan lighten-5">
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
		<h1 class="text-center"><span class="fa fa-book"></span> Reserve Books(<?php numberOfReservation(); ?>)</h1>
		<div class="container">
			<div class="page-header">
				<h3>List of Reserved Books</h3>
				<hr class="theo-footer-hr">
			</div>
			<br>
        <ul class="nav nav-tabs md-tabs nav-justified">
        	<li class="nav-item">
        		<a class="nav-link active" data-toggle="tab" href="#viewPendingReserve"><span class="fa fa-clock-o"></span> Pending Reserved</a>
        	</li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewApprovedReserved" role="tab"><span class="fa fa-thumbs-up"></span> Approved Reserved Books </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewRejectedReserved" role="tab"><span class="fa fa-thumbs-down"></span> Rejected Reserved Books</a>
            </li>
            <li class="nav-item">
            	<a class="nav-link" data-toggle="tab" href="#viewAllReserveBooks" role="tab"><span class="fa fa-undo"></span> All Reserved Books</a>
            </li>
        </ul>
        <br><br>
			<form class="form-horizontal" method="post">
				<div class="form-group col-lg-9">
					<div class="input-group">
						<input class="form-control" type="text" onkeyup="searchReservation()" name="reserve_search" id="reserve_search">
						<button class="btn btn-primary" name="btn_reserve_search"><span class="fa fa-search"></span> Search</button>
					</div>
				</div>
			</form>
			<!--<a class="btn btn-info" href="admin-approved-reserved-books.php"><span class="fa fa-check"></span> Approved Reserved Books</a>
			<a class="btn btn-danger" href="admin-rejected-reserved-books.php"><span class="fa fa-close"></span> Rejected Reserved Books</a> -->
	<div class="tab-content card">
		<div class="tab-pane fade in show active" id="viewPendingReserve" role="tabpanel">
			<table class="table table-hover" id="tblReserved">
				<h3 class="text-center">Pending Reserve: <?php echo $pend_reserve_count; ?></h3>
					<thead class="thead-dark">
						<tr>
							<th scope="col">Book Image</th>
							<th scope="col">Reservation ID</th>
							<th scope="col">Book Name</th>
							<th scope="col">Book Reserved By</th>
							<th scope="col">Author</th>
							<th scope="col">Status</th>
							<th scope="col">Reservation Date</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if (isset($_POST['btn_reserved_search'])) {
					$reserve_search = htmlspecialchars($_POST['reserve_search']);
					$reserve_search = mysqli_real_escape_string($conn, $reserve_search);

					$sql_search = "SELECT * FROM reservation
								WHERE book_reservationID LIKE '%$reserve_search%'
								OR BookName LIKE '%$reserve_search%'";

					$res_search = mysqli_query($conn, $sql_search);
					$count_search = mysqli_num_rows($res_search);

					if ($count_search > 0) {
						while ($row_search = mysqli_fetch_array($res_search)) {
							echo '<tr><td><img src="'.$row_search["BookImage"].'" style="width=250px; height=200px;"></td>';
							echo '<td>'.$row_search['book_reservationID'].'</td>';
							echo '<td class="font-weight-bold">'.$row_search['BookName'].'</td>';
							echo '<td>'.$row_search['Author'].'</td>';
							echo '<td>'.$row_search['Author'].'</td>';
							echo '<td>'.$row_search['Status'].'</td>';
							echo '<td>'.$row_search['ReservationDate'].'</td></tr>';
						}

						echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Reserved Books Found</h3></td></tr>";
					} else {
						echo "<tr><td colspan='11'><h3 class='alert alert-danger text-center'>
                            <span class='fa fa-close'></span> Keyword $reserve_search is not found</h3></td></tr>";
				}

				} else {

					$view_Requested = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE Status = 'Pending' ORDER BY ReservationDate";
					$result = mysqli_query($conn, $view_Requested);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)){

                    $res_name = $row['UserFName'] . " " . $row['UserLName'];
                    	?>
						<tr>
							<td><img height="250" width="200" src="<?php echo $row['BookImage'] ?>"></td>
							<td><?php echo $row['book_reservationID']?></td>
							<td class="font-weight-bold"><?php echo $row['BookName'] ?></td>
							<td class="font-weight-bold text-info"><?php echo $res_name ?></td>
							<td><?php echo $row['Author'] ?></td>
							<td class="font-weight-bold text-warning"><?php echo $row['Status'] ?></td>
							<td><?php echo $row['ReservationDate'] ?></td>
							<td><a class="btn btn-primary" onclick="return confirm('Approve this reserved book?');" href="crud_action.php?approve_res=<?php echo $row['book_reservationID'] ?>"><span class="fa fa-check"></span> Approved</a></td>
						<td><a class="btn btn-danger" onclick="return confirm('Reject this reserved book?');" href="admin-reserve-remarks.php?reject_res=<?php echo $row['book_reservationID'] ?>"><span class="fa fa-close"></span> Rejected</a></td>
					</tr>
				<?php } ?>
				<?php } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Reserved Books Found</h3></td></tr>";
				 }
			}
						?>
					</tbody>
				</table>
		</div>	
		<div class="tab-pane fade" id="viewApprovedReserved" role="tabpanel">	
			<table class="table table-hover" id="tblReserved">
				<h3 class="text-center">Approved Reserve: <?php echo $app_reserve_count;  ?></h3>
					<thead class="thead-dark">
						<tr>
							<th scope="col">Book Image</th>
							<th scope="col">Reservation ID</th>
							<th scope="col">Book Name</th>
							<th scope="col">Book Reserved By</th>
							<th scope="col">Author</th>
							<th scope="col">Status</th>
							<th scope="col">Remarks</th>
							<th scope="col">Reservation Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							adminApprovedReserveBooks();
						?>
					</tbody>
			</table>
		</div>
			<div class="tab-pane fade" id="viewRejectedReserved" role="tabpanel">
				<table class="table table-hover" id="tblReserved">
					<h3 class="text-center">Rejected Reserve: <?php echo $rej_reserve_count; ?></h3>
					<thead class="thead-dark">
						<tr>
							<th scope="col">Book Image</th>
							<th scope="col">Reservation ID</th>
							<th scope="col">Book Name</th>
							<th scope="col">Book Reserved By</th>
							<th scope="col">Author</th>
							<th scope="col">Status</th>
							<th scope="col">Remarks</th>
							<th scope="col">Reservation Date</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$view_reserved = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID)
                    		INNER JOIN users USING(UsersID) WHERE Status = 'Rejected' ORDER BY ReservationDate DESC";
							$result = mysqli_query($conn, $view_reserved);
							$count = mysqli_num_rows($result);

							if ($count > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
								$name = $row['UserFName'] . " " . $row['UserLName'];
							?>
								<tr>
									<td><img src="<?php echo $row['BookImage']; ?>" width='200' height='250' alt='Book Image''></td>
									<td><?php echo $row['book_reservationID']; ?></td>
									<td><?php echo $row['BookName']; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $row['Author']; ?></td>
									<td class="font-weight-bold text-danger"><?php echo $row['Status']; ?></td>
									<td class="font-weight-bold text-warning"><?php echo $row['Remarks']; ?></td>
									<td><?php echo $row['ReservationDate']; ?></td>
									<td><a class="btn btn-danger" onclick="return confirm('Delete this rejected reserve book?');" href="crud_action.php?reserved_del=<?php echo $row['book_reservationID'] ?>"><span class="fa fa-trash"></span> Delete</a></td>
								</tr>
							<?php	} ?>
						<?php } else {
							echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Reserved Books Found</h3></td></tr>";
						}

						 ?>
					</tbody>
				</table>
				</div>
				<div class="tab-pane fade" id="viewAllReserveBooks" role="tabpanel">
					<table class="table table-hover" id="tblReserved">
						<h3 class="text-center">All Reserved Books: <?php echo $aLl_reserve_count; ?></h3>
					<thead class="thead-dark">
						<tr>
							<th scope="col">Book Image</th>
							<th scope="col">Reservation ID</th>
							<th scope="col">Book Name</th>
							<th scope="col">Book Reserved By</th>
							<th scope="col">Author</th>
							<th scope="col">Status</th>
							<th scope="col">Reservation Date</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php adminAllReservedBooks(); ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="reserveRejectedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold"><span class="fa fa-close"></span> Rejecting Book</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<p class="text-center">State the reason for rejecting this book</p>
				<div class="modal-body mx-3">
					<form method="post">
						<div class="md-form mb-5">
							<div class="md-form">
								<input type="hidden" name="reserve_id">
							</div>
							<i class="fa fa-pencil prefix"></i>
							<textarea class="form-control md-textarea" name="remarks" rows="7" length="1000" style="resize: none;"></textarea>
							<label>Reason</label>
						</div>
						<div class="md-form mb-4">  
                        	<button type="submit" class="btn btn-danger pull-right" name="reject_reserve_book" data-loading-text="Closing in.."> Reject</button>
                    	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<script>
	function searchReservation() {
  var input, filter, table, tr, td, i, j, k;
  input = document.getElementById("reserve_search");
  filter = input.value.toUpperCase();
  table = document.getElementById("tblReserved");
  tr = table.getElementsByTagName("tr");

  	for (j = 0; j < tr.length; j++) {
    		td = tr[j].getElementsByTagName("td")[2];//Book Name
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
  <script src="../js/bootstrap.js"></script>
  <script src="../js/jquery.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/mdb.min.js"></script>
</body>
</html>