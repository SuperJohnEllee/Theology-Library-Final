<?php
	include ('../connection.php');
	/*
		All CRUD Actions are here

	*/	 
	session_start();
	$session_admin = htmlspecialchars($_SESSION['admin_user']);
	$session_name = htmlspecialchars($_SESSION['firstname']) . ' ' . htmlspecialchars($_SESSION['lastname']);
	date_default_timezone_set('Asia/Manila');

	/*
		Approved Rejected Requested and Reserved Books
	*/
	//Requested Books
	if (isset($_GET['approve'])) {
		
		$approve = htmlspecialchars($_GET['approve']);
		$app_sql = "UPDATE book_request SET Status = 'Approved', Remarks = 'Available' WHERE book_requestID = '$approve'";
		$app_res = mysqli_query($conn, $app_sql);
		echo "<script>
			alert('Successfully approved a requested book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-requested-books.php'>";
	
	} elseif (isset($_GET['reject'])) {
		
		$reject = htmlspecialchars($_GET['reject']);
		$rej_sql = "UPDATE book_request SET Status = 'Rejected' WHERE book_requestID = '$reject'";
		$rej_res = mysqli_query($conn, $rej_sql);


		echo "<script>
			alert('Successfully rejected a requested book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-requested-books.php'>";
	}

	//Reservation Books
	if (isset($_GET['approve_res'])) {
	 	
	 	$approve_res = htmlspecialchars($_GET['approve_res']);
	 	$approve_res_sql = "UPDATE reservation SET Status = 'Approved', Remarks = 'Available' WHERE book_reservationID = '$approve_res'";
	 	$approve_res = mysqli_query($conn, $approve_res_sql);

		echo "<script>
			alert('Successfully approved a reserved book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-reservation.php'>";

	 } elseif (isset($_GET['reject_res'])) {

	 	$reject_res = htmlspecialchars($_GET['reject_res']);
	 	$reject_res_sql = "UPDATE reservation SET Status = 'Rejected' WHERE book_reservationID = '$reject_res'";
	 	$reject_res = mysqli_query($conn, $reject_res_sql);


		echo "<script>
			alert('Successfully rejected a reserved book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-reservation.php'>";	 	
	 } 

	//For the Admin
	if (isset($_GET['admin_act'])) {
		
		$act = htmlspecialchars($_GET['admin_act']);
		$act_sql = "UPDATE admin SET AdminStatus = 'Active' WHERE AdminID = '$act'";
		$act_res = mysqli_query($conn, $act_sql);
		header("location: admin-account-management.php");
	
	} else if(isset($_GET['admin_deact'])){

		$deact = htmlspecialchars($_GET['admin_deact']);
		$deact_sql = "UPDATE admin SET AdminStatus = 'Inactive' WHERE AdminID = '$deact'";
		$deact_res = mysqli_query($conn, $deact_sql);
		header("location: admin-account-management.php");
	}

	//For the Users
	if (isset($_GET['user_act'])) {
			
			$user_act = htmlspecialchars($_GET['user_act']);
			$user_act_sql = "UPDATE users SET UserStatus = 'Active' WHERE UsersID = '$user_act'";
			$user_act_res = mysqli_query($conn, $user_act_sql);

		echo "<script>
			alert('Successfully activated a user');
		</script>
		<meta http-equiv='refresh' content='0; url=view_users.php'>";
	
	} else if (isset($_GET['user_deact'])) {
		
		$user_deact = htmlspecialchars($_GET['user_deact']);
		$user_deact_sql = "UPDATE users SET UserStatus = 'Inactive' WHERE UsersID = '$user_deact'";
		$user_deact_res = mysqli_query($conn, $user_deact_sql);
		
		echo "<script>
			alert('Successfully deactivated a user');
		</script>
		<meta http-equiv='refresh' content='0; url=view_users.php'>";
	}

	//For Announcements

	if (isset($_GET['show'])) {
		
		$show = htmlspecialchars($_GET['show']);
		$show_sql = "UPDATE announcement SET Status = 'Active', PostBy = '$session_name', PostDate = NOW() WHERE AnnouncementID = '$show'";
		$show_res = mysqli_query($conn, $show_sql);
		
		echo "<script>
			alert('Successfully showed an announcement');
		</script>
		<meta http-equiv='refresh' content='0; url=announcement.php'>";
	
	}else if (isset($_GET['hide'])) {
		
		$hide = htmlspecialchars($_GET['hide']);
		$hide_sql = "UPDATE announcement SET Status = 'Inactive' WHERE AnnouncementID = '$hide'";
		$hide_res = mysqli_query($conn, $hide_sql);

		echo "<script>
			alert('Successfully hide an announcement');
		</script>
		<meta http-equiv='refresh' content='0; url=announcement.php'>";
	}

	//Delete
	//Check the del variable is set in url

	//annoucements
	if (isset($_GET['del_announce'])) {
		
		$del_announce = htmlentities($_GET['del_announce']);
		$announce_sql = "DELETE FROM announcement WHERE 
		AnnouncementID = '$del_announce'";
		$announce_res = mysqli_query($conn, $announce_sql);
		echo "<script>
			alert('Successfully deleted an announcement');
		</script>
		<meta http-equiv='refresh' content='0; url=announcement.php'>";
	
	} else if (isset($_GET['admin_del'])) { //delete admin
		
		$admin_del = htmlspecialchars($_GET['admin_del']);
		$admin_sql = "DELETE FROM admin WHERE AdminID = '$admin_del'";
		$admin_res = mysqli_query($conn, $admin_sql);
		
		echo "<script>
			alert('Successfully deleted an admin');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-account-management.php'>";

	} else if (isset($_GET['book_del'])) { //books
		
		$book_del = htmlspecialchars($_GET['book_del']);
		$book_sql = "DELETE FROM theo_books WHERE BookID = '$book_del'";
		$book_res = mysqli_query($conn, $book_sql);
		echo "<script>
			alert('Successfully deleted a book');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-view-books.php'>";
	
	} else if(isset($_GET['rej_del']) && is_numeric($_GET['rej_del'])){ //rejected books

		$rej_del = htmlspecialchars($_GET['rej_del']);
		$rej_sql = "DELETE FROM book_request WHERE book_requestID = '$rej_del'";
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
	
	} else if (isset($_GET['close_acc_del'])) {
		
		$close_acc_del = htmlspecialchars($_GET['close_acc_del']);
		$close_acc_del_sql = "DELETE FROM remarks WHERE RemarksID = '$close_acc_del'";
		$close_acc_del_res = mysqli_query($conn, $close_acc_del_sql);

		echo "<script>
			alert('Successfully deleted a close account');
		</script>
		<meta http-equiv='refresh' content='0; url=admin-manage-close-accounts.php'>";
	}

?>