<?php
	/*
		Delete anything
	*/
	include('connection.php'); // include connection

	if (isset($_GET['req_del']) && is_numeric($_GET['req_del'])) {
		
		$id = htmlspecialchars($_GET['req_del']);
		$sql = "DELETE FROM book_request WHERE book_requestID = '$id'";
		$result = mysqli_query($conn, $sql);
		echo "<script>
			alert('Successfully deleted a book request');
		</script>
		<meta http-equiv='refresh' content='0; url=user-request-book-history.php'>";
	}

	if (isset($_GET['res_del']) && is_numeric($_GET['res_del'])) {
		
		$res_del = htmlspecialchars($_GET['res_del']);
		$res_del_sql = "DELETE FROM reservation WHERE book_reservationID = '$res_del'";
		$res_del_res = mysqli_query($conn, $res_del_sql);

		echo "<script>
			alert('Successfully deleted a book reserved');
		</script>
		<meta http-equiv='refresh' content='0; url=user-reserved-book-history.php'>";
	}
?>