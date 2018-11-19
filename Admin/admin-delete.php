<?php
	include ('../connection.php');

	//Delete
	//Check the del variable is set in url

	//annoucements
	if (isset($_GET['del_announce']) && is_numeric($_GET['del_announce'])) {
		
		$del_announce = htmlentities($_GET['del_announce']);
		$announce_sql = "DELETE FROM announcement WHERE 
		AnnouncementID = '$del_announce'";
		$announce_res = mysqli_query($conn, $announce_sql);
		echo "<script>
			alert('Successfully deleted an announcement');
		</script>
		<meta http-equiv='refresh' content='0; url=announcement.php'>";
	
	} else if (isset($_GET['admin_del']) && is_numeric($_GET['admin_del'])) { //delete admin
		
		$admin_del = htmlspecialchars($_GET['admin_del']);
		$admin_sql = "DELETE FROM admin WHERE AdminID = '$admin_del'";
		$admin_res = mysqli_query($conn, $admin_sql);
		
		echo "<script>
			alert('Successfully deleted an admin');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-account-management.php'>";

	} else if (isset($_GET['book_del']) && is_numeric($_GET['book_del'])) { //books
		
		$book_del = htmlspecialchars($_GET['book_del']);
		$book_sql = "DELETE FROM theo_books WHERE BookID = '$book_del'";
		$book_res = mysqli_query($conn, $book_sql);
		echo "<script>
			alert('Successfully deleted a book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-books.php'>";
	
	} else if(isset($_GET['rej']) && is_numeric($_GET['rej'])){ //rejected books

		$rej = htmlspecialchars($_GET['rej']);
		$rej_sql = "DELETE FROM book_request WHERE book_requestID = '$rej'";
		$rej_res = mysqli_query($conn, $rej_sql);
		echo "<script>
			alert('Successfully deleted an rejected book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-requested-books.php'>";
	

	} else if (isset($_GET['reserved_del']) && is_numeric($_GET['reserved_del'])) { //reservation
		
		$reserved_del = htmlspecialchars($_GET['reserved_del']);
		$reserved_del_sql = "DELETE FROM reservation WHERE book_reservationID = '$reserved_del'";
		$reserved_del_res = mysqli_query($conn, $reserved_del_sql);
		
		echo "<script>
			alert('Successfully deleted an reserved book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-reservation.php'>";	
	
	} else if (isset($_GET['feed_del']) && is_numeric($_GET['feed_del'])) { //feedback
		
		$feed_del = htmlspecialchars($_GET['feed_del']);
		$feed_sql = "DELETE FROM feedback WHERE feedbackID = '$feed_del'";
		$feed_res = mysqli_query($conn, $feed_sql);

		echo "<script>
			alert('Successfully deleted a feedback');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-feedbacks.php'>";	
	
	} else if (isset($_GET['message_del']) && is_numeric($_GET['message_del'])) {
		
		$message_del = htmlspecialchars($_GET['message_del']);
		$message_sql = "DELETE FROM messages WHERE messageID = '$message_del'";
		$message_res = mysqli_query($conn, $message_sql);

		echo "<script>
			alert('Successfully deleted a message');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-manage-messages.php'>";
	}

?>