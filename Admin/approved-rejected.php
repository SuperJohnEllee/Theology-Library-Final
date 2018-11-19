<?php
	include ('../connection.php');

	/*
		Approved Rejected Requested and Reserved Books
	*/

	//Requested Books
	if (isset($_GET['approve']) && is_numeric($_GET['approve'])) {
		
		$approve = htmlspecialchars($_GET['approve']);
		$app_sql = "UPDATE book_request SET Status = 'Approved' WHERE book_requestID = '$approve'";
		$app_res = mysqli_query($conn, $app_sql);
		echo "<script>
			alert('Successfully approved a requested book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-requested-books.php'>";
	
	} elseif (isset($_GET['reject']) && is_numeric($_GET['reject'])) {
		
		$reject = htmlspecialchars($_GET['reject']);
		$rej_sql = "UPDATE book_request SET Status = 'Rejected' WHERE book_requestID = '$reject'";
		$rej_res = mysqli_query($conn, $rej_sql);
		echo "<script>
			alert('Successfully rejected a requested book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-requested-books.php'>";
	}

	//Reservation Books
	if (isset($_GET['approve_res']) && is_numeric($_GET['approve_res'])) {
	 	
	 	$approve_res = htmlspecialchars($_GET['approve_res']);
	 	$approve_res_sql = "UPDATE reservation SET Status = 'Approved', Remarks = 'Your reserved book has been approved' WHERE book_reservationID = '$approve_res'";
	 	$approve_res = mysqli_query($conn, $approve_res_sql);

		echo "<script>
			alert('Successfully approved a reserved book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-reservation.php'>";

	 } elseif (isset($_GET['reject_res']) && is_numeric($_GET['reject_res'])) {

	 	$reject_res = htmlspecialchars($_GET['reject_res']);
	 	$reject_res_sql = "UPDATE reservation SET Status = 'Rejected' WHERE book_reservationID = '$reject_res'";
	 	$reject_res = mysqli_query($conn, $reject_res_sql);

		echo "<script>
			remarksRejected();
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-reservation.php'>";	 	
	 } 
?>
<script>
	function remarksRejected(){

		var remarks = prompt('Enter Remarks: ');
		if (remarks != null && reason != "") {
			<?php
				mysqli_query($conn, "INSERT INTO reservation(Remarks) VALUES ('remarks')");
			?>
		}
	}
</script>