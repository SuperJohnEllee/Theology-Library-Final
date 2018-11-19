<?php
	/**
		This is a function php, all actions and displays are here
	**/


	//User Pending Requested Books

	function userPendingRequestBooks(){

		include('connection.php');
		$session_fullname = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];

		$viewBooks = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Pending' ORDER BY Request_Date DESC";
		$result = mysqli_query($conn, $viewBooks);
		$count = mysqli_num_rows($result);

		if ($count > 0) {

			while ($row = mysqli_fetch_array($result)) {

					echo '<td>'.$row['book_requestID'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['Edition'].'</td>';
					echo '<td>'.$row['Publisher'].'</td>';
					echo '<td>'.$row['Publish_Date'].'</td>';
					echo '<td>'.$row['Copyright'].'</td>';
					echo '<td>'.$row['Status'].'</td>';
					echo '<td>'.$row['Request_Date'].'</td>';
					echo '<td><a class="btn btn-primary"><span class="fa fa-edit"></span> Edit</a></td>';
					echo '<td><a class="btn btn-danger" href="crud_action.php?req_del='.$row['book_requestID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Requested Books Found</h3></td></tr>";
				 }
		}

		//User Approved Requested Books

	function userApprovedRequestBooks(){

		include('connection.php');
        $userid = $_SESSION['userid'];

		$viewBooks = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE UsersID = '$userid' AND Status = 'Approved' ORDER BY Request_Date DESC";
		$result = mysqli_query($conn, $viewBooks);
		$count = mysqli_num_rows($result);

		if ($count > 0) {

			while ($row = mysqli_fetch_array($result)) {

					echo '<td>'.$row['book_requestID'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['Edition'].'</td>';
					echo '<td>'.$row['Publisher'].'</td>';
					echo '<td>'.$row['Publish_Date'].'</td>';
					echo '<td>'.$row['Copyright'].'</td>';
					echo '<td>'.$row['Status'].'</td>';
					echo '<td>'.$row['Request_Date'].'</td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Requested Books Found</h3></td></tr>";
				 }
		}

	//User Rejected Request Books
	function userRejectedRequestBooks(){

		include('connection.php');
		$session_fullname = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];

		$viewBooks = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Approved' ORDER BY Request_Date DESC";
		$result = mysqli_query($conn, $viewBooks);
		$count = mysqli_num_rows($result);

		if ($count > 0) {

			while ($row = mysqli_fetch_array($result)) {

					echo '<td>'.$row['book_requestID'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['Edition'].'</td>';
					echo '<td>'.$row['Publisher'].'</td>';
					echo '<td>'.$row['Publish_Date'].'</td>';
					echo '<td>'.$row['Copyright'].'</td>';
					echo '<td>'.$row['Status'].'</td>';
					echo '<td>'.$row['Request_Date'].'</td>';
					echo '<td><a class="btn btn-primary"><span class="fa fa-edit"></span> Edit</a></td>';
					echo '<td><a class="btn btn-danger" href="user-delete.php?req_del='.$row['book_requestID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Requested Books Found</h3></td></tr>";
				 }
		}


	//Create a message
	function userCreateMessages(){

		include('connection.php');
		date_default_timezone_set('Asia/Manila');
		$session_firstname = htmlspecialchars($_SESSION['firstname']);
		$session_lastname = htmlspecialchars($_SESSION['lastname']);

		if (isset($_POST['btn_send'])) {
			
			$admin = mysqli_real_escape_string($conn, $_POST['admin']);
			$message = mysqli_real_escape_string($conn, $_POST['message']);

			$name = htmlspecialchars($session_firstname) . " " . htmlspecialchars($session_lastname);

			$message_sql = "INSERT INTO messages(Name, Message, SentBy, SentDate)
			VALUES('$admin', '$message', '$name', NOW());";
			$message_res = mysqli_query($conn, $message_sql);

			if ($message_res) {
				echo "<script>
					alert('Message sent Successfully');
				</script>";
			} else {
				echo "<script>
					alert('Failure in sending message');
				</script>";
			}
		}
	}

	//User request a book
	function userRequestBook(){

		include ('connection.php');
		date_default_timezone_set('Asia/Manila');
		$session_id = htmlspecialchars($_SESSION['userid']);

		if (isset($_POST['btn_request'])) {
			
			$book_name = mysqli_real_escape_string($conn, $_POST['book_name']);
			$author = mysqli_real_escape_string($conn, $_POST['author']);
			$edition = mysqli_real_escape_string($conn, $_POST['edition']);
			$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
			$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
			$publish_date = mysqli_real_escape_string($conn, $_POST['publish_date']);

			$check_bookname = mysqli_query($conn, "SELECT * FROM book_request WHERE BookName = '$book_name'");
			$bookname_count = mysqli_num_rows($check_bookname);
		
			if ($bookname_count > 0) {
				echo "<script>
					alert('You already requested this book');
				</script>";
			} else {	
				$sql = "INSERT INTO book_request
					(UsersID, BookName, Author, Edition, Copyright, Publish_Date, Publisher, Status, Request_Date)
					VALUES('$session_id', '$book_name', '$author','$edition', '$copyright', '$publisher', 
                    '$publish_date', 'Pending', NOW())";

					if (mysqli_query($conn, $sql)) {
					
						echo "<script>
								alert('Successfully requested a book, Please wait for the approval');
							</script>
                            <meta http-equiv='refresh' content='0; url=request.php'>";
				} else {
					echo "<script>
							alert('Failure in requesting a book');
						</script>";
					}
					mysqli_close($conn);
 				}
 			}
		}

	//User Forgot Password
	function userForgotPassword(){

		include ('connection.php');

   	 	if (isset($_POST['btn_send'])) {

       	 	require('PHPMailer/PHPMailerAutoload.php'); //require PHPMailer

        	$email = htmlspecialchars($_POST['email']); //define email var

        	//query start
        	$res = mysqli_query($conn, "SELECT * FROM users WHERE UserEmail = '$email'");
        	$count = mysqli_num_rows($res);
        	$row = mysqli_fetch_assoc($res);

        	//concatinate name
        	$name = htmlspecialchars($row['UserFName']) . " " . htmlspecialchars($row['UserLName']);

        	//check if email is valid
        	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            	echo "This $email is invalid";
        	}

        if ($count > 0 ) {
            
            $mail = new PHPMailer();

            //Configuration
            $mail->SMTPDebug = 2; //Debugging
            $mail->isSMTP(); //Set Mailer to use SMTP
            $mail->Host = "ssl://smtp.gmail.com:465"; //Host Name
            $mail->SMTPAuth = true; //if SMTP Host requires authentication to send email
            $mail->SMTPSecure = "ssl"; //set encryption system
            $mail->mailer = "smtp"; //set Email protocol
            $mail->Port = 465; // set SMTP Port
            $mail->setFrom('cputheolib@gmail.com', 'College of Theology');
            $mail->AddReplyTo('cputheolib@gmail.com', 'College of Theology');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 
                'verify_peer_name' => false, 'allow_self_signed' => true)); //start connection

            //You must have an unsecured email to perform this
            $mail->Username = "cputheolib@gmail.com"; // set email add
            $mail->Password = "theolibrary"; // set password
            $mail->FromName = 'Theology Library Administrator';
            $mail->Subject = "College of Theology Library Forgot Password";
            $mail->Body = "<h3>Hello ".$name. " <br>this is your Password --> '".$row['UserPassword']. "'</h3>";
            $mail->AltBody = "This is the plain text version of the email content";
            if (!$mail->send()) {
                ob_end_clean();
                echo "<script>
                        alert('Failure in sending a Password to email, please check your internet connection'); 
                        </script>". $mail->ErrorInfo;
            } else {
                    ob_end_clean();
                    echo "<script>
                        alert('Password sent succesfully through your email');
                    </script>
                    <meta http-equiv='refresh' content='0; url=forgot_pass.php'>";
                    return true;
            }
        
        } else {
            echo "<script>
                alert('$email is not existing in the database');
                window.open('forgot_pass.php', '_self'); 
            </script>";
        }
   	}
}
	
	//User Register

	function userRegister(){

		include('connection.php');
		if (isset($_POST['register'])) {
        	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        	$midname = mysqli_real_escape_string($conn, $_POST['midname']);
        	$type = mysqli_real_escape_string($conn, $_POST['type']);
        	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
        	$birthdate = mysqli_real_escape_string($conn, $_POST['birthday']);
        	$email = mysqli_real_escape_string($conn, $_POST['email']);
        	$contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
        	$username = mysqli_real_escape_string($conn, $_POST['username']);
        	$password = mysqli_real_escape_string($conn, $_POST['password']);
        	$confirm_pass = htmlspecialchars($_POST['confirm_pass']);


        /**$birth_year = mysqli_real_escape_string($conn, $_POST['birth_year']);
        $birth_month = mysqli_real_escape_string($conn, $_POST['birth_month']);
        $birth_day = mysqli_real_escape_string($conn, $_POST['birth_day']);
        $birthdate = htmlspecialchars($birth_month) . ' ' . htmlspecialchars($birth_day) . ', ' . htmlspecialchars($birth_year); */

        $check_user = "SELECT * FROM users WHERE Username = '$username'";
        $check_email = "SELECT * FROM users WHERE UserEmail = '$email'";
        $check_contact_num = "SELECT * FROM users WHERE UserContactNumber = '$contact_num'";

        $res_user = mysqli_query($conn, $check_user);
        $res_email = mysqli_query($conn, $check_email);
        $res_contact_num = mysqli_query($conn, $check_contact_num);

        if (mysqli_num_rows($res_user) > 0) {
            echo "<script>
            alert('This $username is already existing');
            </script>";
            exit;

        } else if (mysqli_num_rows($res_email) > 0) {
            echo "<script>
                alert('This $email is already existing');
            </script>"; 
            exit;
        } else if (mysqli_num_rows($res_contact_num) > 0) {
            echo "<script>
                alert('This $contact_num is already existing');
            </script>";
            exit;
            
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                alert('Error: $email is not a valid email address');
            </script>";
            exit;
        }  else if ($password > 6) {
            echo "<script>
                alert('Password must be 6 letters or more');
            </script>";
            exit;
        } else if ($password != $confirm_pass) {
            echo "<script>
                alert('Password do not match, try again');
            </script>";
            exit;
        } else { 

            $insert_com = "INSERT INTO users(UserLName, UserFName, UserMName, UserType, UserGender, UserBirthday, UserEmail, UserContactNumber, UserStatus, Username, UserPassword, UserRegisterDate) VALUES
            ('$lastname', '$firstname', '$midname', '$type', '$gender', '$birthdate', '$email', '$contact_num', 
            'Active', '$username', '$password', NOW())";

        if (mysqli_query($conn, $insert_com)) {
            echo "<script>
                    alert('Successfully created an account');
                </script>
                <meta http-equiv='refresh' content='0; url=index.php?remarks=success'>";
                
                //creating account logs
                $filename = "system/registered_users.txt";
                 $fp = fopen($filename, 'a+');
                 fwrite($fp, $firstname . " " . $midname . " ". $lastname . " -------- " . $username . " | " . $password . " | " . date('jS \of F Y h:i:s A') . "\n");
                 fclose($fp);
                 die();
        }  else {
            echo "<script>
                alert('Error: Failure in registering');
            </script>";
        }
    }

	}
}

	//User Login
	function userLogin(){

	session_start();
    date_default_timezone_set('Asia/Manila');
    include ('connection.php');

    if (isset($_POST['login'])) {

        //variables. Define username and password
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        //protect from MySQL Injection
        $username = stripslashes($username);
        $password = stripslashes($password);
        $password = mysqli_real_escape_string($conn, $password);
        $username = mysqli_real_escape_string($conn, $username);

        //query
        $user_check = "SELECT UsersID, UserLName, UserFName, 
        UserMName, UserType, UserEmail, UserGender, UserStatus, UserBirthday, UserContactNumber, 
        Username, UserPassword FROM users WHERE Username = '$username'";
        
        $result = mysqli_query($conn, $user_check);
        $count = mysqli_num_rows($result); //check if username is existing
        $row = mysqli_fetch_assoc($result); //fetch info of registered user

        //db variables
        $res_id = htmlspecialchars($row['UsersID']);
        $res_username = htmlspecialchars($row['Username']);
        $res_pass = htmlspecialchars($row['UserPassword']);
        $res_firstname = htmlspecialchars($row['UserFName']);
        $res_midname = htmlspecialchars($row['UserMName']);
        $res_lastname = htmlspecialchars($row['UserLName']);
        $res_type = htmlspecialchars($row['UserType']);
        $res_email = htmlspecialchars($row['UserEmail']);
        $res_contactnum = htmlspecialchars($row['UserContactNumber']);
        $res_status = htmlspecialchars($row['UserStatus']);
        $res_gender = htmlspecialchars($row['UserGender']);
        $res_birthday = htmlspecialchars($row['UserBirthday']);

        if ($count > 0) {
            if ($res_status == "Active") {
                if ($res_pass == $password) {
                    //session variables
                    $_SESSION['userid'] = $res_id;
                    $_SESSION['username'] = $res_username;
                    $_SESSION['firstname'] = $res_firstname;
                    $_SESSION['midname'] = $res_midname;
                    $_SESSION['lastname'] = $res_lastname;
                    $_SESSION['type'] = $res_type;
                    $_SESSION['email'] = $res_email;
                    $_SESSION['contact_num'] = $res_contactnum;
                    $_SESSION['status'] = $res_status;
                    $_SESSION['password'] = $res_pass;
                    $_SESSION['gender'] = $res_gender;
                    $_SESSION['birthday'] = $res_birthday;
                    header("location: home.php");

            } else {
                  echo "<script>
                        alert('Incorrect password');
                    </script>";
        }
            } else {
            echo "<script>
                    alert('Account Deactivated');
                </script>";
            } 
        
            } else {
            echo "<script>
                    alert('Invalid Username');
                </script>";
        }
        mysqli_close($conn);
    }
}

	//User Update Profile
	function userUpdateProfile(){

		include ('connection.php');	

		if (isset($_POST['save'])) {
		
			$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
			$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
			$midname = mysqli_real_escape_string($conn, $_POST['midname']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$contact_num = mysqli_real_escape_string($conn, $_POST['contact_num']);
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$id = htmlspecialchars($_POST['id']);

			$sql = "UPDATE users SET 
				UserLName = '$lastname',
				UserFName = '$firstname',
				UserMName = '$midname',
				UserEmail = '$email',
				UserContactNumber = '$contact_num',
				Username = '$username' WHERE UsersID = '$id'";
			$res = mysqli_query($conn, $sql);
		
			if ($res) {
				echo "<script>
					alert('Update profile successfully');
					</script>
					<meta http-equiv='refresh' content='0; url=profile.php?remarks=success'>";
			} else {
				echo "<script>
					alert('Error in updating profile');
				</script>";
			}
	}
}

	//User Delete Account
	function closeAccount(){

		include('connection.php');
		date_default_timezone_set('Asia/Manila');
		$session_id = htmlspecialchars($_SESSION['userid']);
		$session_name = htmlspecialchars($_SESSION['firstname']) . " " . htmlspecialchars($_SESSION['lastname']);

		if (isset($_POST['close_account'])) {
			
			$reason_content = mysqli_real_escape_string($conn, $_POST['reason_content']);

			$close_acc_sql = "INSERT INTO remarks(Name, Content, RemarksDate)
			VALUES('$session_name', '$reason_content', NOW())";
			$close_acc_res = mysqli_query($conn, $close_acc_sql);

			$delete_account = "DELETE FROM users WHERE UsersID = '$session_id'";
			$delete_account_res = mysqli_query($conn, $delete_account);

			if ($close_acc_res) {
				session_destroy();
				echo "<script>
					alert('Inserted remarks');
				</script>
				<meta http-equiv='refresh' content='0; url=index.php'>";

				if ($delete_account_res) {
					
					echo "<script>
						alert('Successfully closed account');
					</script>
					<meta http-equiv='refresh' content='0; url=index.php'>";
				} else {
					echo "<script>
						alert('Failure in closing account');
						window.open('profile.php', '_self');
					</script>";
				}

			} else {
				echo "<script>
					alert('Failure in inserting remarks');
					window.open('profile.php', '_self');
				</script>";
			} 
		}
	}

	//User reserves a book
	function userReserveBook(){

		include('connection.php');
		date_default_timezone_set('Asia/Manila');
		$session_id = htmlspecialchars($_SESSION['userid']);
		$session_name = htmlspecialchars($_SESSION['firstname']) . " " . htmlspecialchars($_SESSION['lastname']);
		
		if (isset($_POST['btn_reserved'])) {

		$bookid = htmlspecialchars($_GET['id']);

		$book_sql = mysqli_query($conn, "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) WHERE BookID = '$bookid' AND Status = 'Approved'");
		$book_row = mysqli_fetch_assoc($book_sql);
        $book_name = $book_row['BookName'];

		$check_book_count = mysqli_num_rows($book_sql);

		if ($check_book_count > 0) {  
			
			echo "<script>
				alert('Sorry, This book is already reserved');
			</script>";	
		
		} else {
			$reserve_sql = "INSERT INTO reservation
			(UsersID, BookID, Status, ReservationDate)
			VALUES ('$session_id', '$bookid', 'Pending', NOW())";
			$reserve_res = mysqli_query($conn, $reserve_sql);

			if ($reserve_res) {
				echo "<script>
					alert('Reservation successfull, Please wait for the approval');
				</script>
				<meta http-equiv='refresh' content='0; url=home.php'>";

			} else {
				echo "<script>
					alert('Failure to reserve a book');
				</script>";
			}
		}
	}
}
//End of Reservation


        //User Change Password
        function userChangePassword(){

            include('connection.php');

            $session_user = $_SESSION['username'];

            if (isset($_POST['btn_change_pass'])) {
                
                $oldpass = mysqli_real_escape_string($conn, $_POST['oldpass']);
                $newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
                $confpass = mysqli_real_escape_string($conn, $_POST['confpass']);

                $sql_user = mysqli_query($conn, "SELECT * FROM users WHERE Username = '$session_user'");
                $sql_row = mysqli_fetch_assoc($sql_user);

                if ($sql_row['UserPassword'] == $oldpass) {
                    if ($newpass == $confpass) {
                        
                        $change_pass_sql = mysqli_query($conn, "UPDATE users SET UserPassword = '$newpass' WHERE Username = '$session_user'");

                        if ($change_pass_sql) {
                             
                                echo "<script>
                                    alert('Successfully updated password');
                                </script>
                                <meta http-equiv='refresh' content='0; url=profile.php?remarks=success'>";
                        } else {
                             echo "<script>
                                    alert('Failure in updating password');
                                </script>";
                        }
                    } else {
                         echo "<script>    
                                alert('Passwords do not match');
                            </script>";   
                    }
                } else {
                        echo "<script>
                            alert('Old Password do not match');
                        </script>";
                }

            }
        }

        //End of Change Password

/*Notifications*/

	//User requested a book and notifies the admin
	function notification_user_book_request(){

		include('../connection.php');
		$user_sql = mysqli_query($conn, "SELECT * FROM users");
		$user_row = mysqli_fetch_assoc($user_sql);

		$book_req = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Pending' ORDER BY Request_Date DESC";
		$book_req_res = mysqli_query($conn, $book_req);
		$book_req_count = mysqli_num_rows($book_req_res);
		
		if ($book_req_count > 0) {
			while ($book_req_row = mysqli_fetch_assoc($book_req_res)) {
			     $name = $book_req_row['UserFName'] . " " . $book_req_row['UserLName']; 
				echo '<a class="dropdown-item">'.$name. " <br>requested a book <br><span class='font-weight-bold'>" .$book_req_row['BookName'].'</span> <br> by '.$book_req_row['Author']. " <br> " .$book_req_row['Request_Date'].'</a>
				<hr class="theo-footer-hr">';
			}
		} else {
			echo '<a class="dropdown-item"> You have no notifications as of now <br> in requisition </a>';
		}
	}

	//User reserves a book and notifies the admin
	function notification_user_reserve_book(){

		include('../connection.php');

		$book_reservation = mysqli_query($conn, "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE Status = 'Pending' ORDER BY ReservationDate DESC");
		$book_reservation_count = mysqli_num_rows($book_reservation);
		
		if ($book_reservation_count > 0) {
			while ($book_reservation_row = mysqli_fetch_assoc($book_reservation)) {

				    $name = $book_reservation_row['UserFName'] . " ". $book_reservation_row['UserLName'];
				echo '<a class="dropdown-item"><span class="font-weight-bold">'.$name. "</span> <br> reserved a book <br><span class='font-weight-bold'>" .$book_reservation_row['BookName'].'</span> <br> on ' .$book_reservation_row['ReservationDate'].'</a>
				<hr class="theo-footer-hr">';	
			}
		} else {
			echo '<a class="dropdown-item"> You have no notifications as of now <br>in reservation</a>';
		}
	}

	//Display Requested Book In Notification Page
	function notification_book_request(){

		include('../connection.php');

		$book_req = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Pending' ORDER BY Request_Date DESC";
		$book_req_res = mysqli_query($conn, $book_req);
		$book_req_count = mysqli_num_rows($book_req_res);
		if ($book_req_count > 0) {
			while ($book_req_row = mysqli_fetch_assoc($book_req_res)) {
			 
                $name = $book_req_row['UserFName'] . " " . $book_req_row['UserLName'];

				echo '<h3><span class="font-weight-bold">'.$name."</span> requested a book <span class='font-weight-bold'>" .$book_req_row['BookName'].'</span><br> by '.$book_req_row['Author']. " on <span class='font-weight-bold text-warning'>".date('F j, Y - g:i A', strtotime($book_req_row['Request_Date'])).'</span></h3>
				<hr class="theo-footer-hr">';
			}
		} else {
			echo '<h3 style="text-center"> You have no notifications as of now </h3>';
		}
	}


	//Display Reserved Book In Notification Page
	function notification_reserve_book(){

		include('../connection.php');

		$book_reservation = mysqli_query($conn,"SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE Status = 'Pending' ORDER BY ReservationDate");
		$book_reservation_count = mysqli_num_rows($book_reservation);

		if ($book_reservation_count > 0) {
			while ($book_reservation_row = mysqli_fetch_assoc($book_reservation)) {

                    $name = $book_reservation_row['UserFName'] . " ". $book_reservation_row['UserLName'];

				echo '<h3><span class="font-weight-bold">'.$name. "</span> reserved a book <span class='font-weight-bold'>" .$book_reservation_row['BookName'].'</span> <br> by '.$book_reservation_row['Author'].' on ' .date('F j, Y g:i A',strtotime($book_reservation_row['ReservationDate'])).'</a>
				<hr class="theo-footer-hr">';
			}
		} else {
			echo '<h3 style="text-center"> You have no notifications as of now in reservation</h3>';
		}
	}


	//User Notification Side

	//Admin notifies user for approved requested of books
	function notification_approved_request(){

		include('connection.php');
		$session_id = htmlspecialchars($_SESSION['userid']); //USER ID


		$approved_req = "SELECT * FROM book_request WHERE Status = 'Approved' AND UsersID = '$session_id' ORDER BY Request_Date DESC";
		$approved_req_res = mysqli_query($conn, $approved_req);
		$approved_req_count = mysqli_num_rows($approved_req_res);

		if ($approved_req_count > 0) {
			while ($approved_req_row = mysqli_fetch_assoc($approved_req_res)) {
				echo '<a class="dropdown-item"> Your requested book '.$approved_req_row['BookName'].' <br> has been approved by the Admin<br></a>';
			}
		} else {
			echo '<a class="dropdown-item"> You have no notifications as of now</a>';
		}
	}

    //Admin notifies user for approved requested of books
    function notification_rejected_request(){


        include('connection.php');
        $session_id = htmlspecialchars($_SESSION['userid']); //USER ID

        $reject_req = "SELECT * FROM book_request WHERE Status = 'Rejected' AND UsersID = '$session_id' ORDER BY Request_Date DESC";
        $reject_req_res = mysqli_query($conn, $reject_req);
        $reject_req_count = mysqli_num_rows($reject_req_res);

        if ($reject_req_count > 0) {
            while ($reject_req_row = mysqli_fetch_assoc($reject_req_res)) {
                echo '<a class="dropdown-item"> Your requested book <span class="font-weight-bold">'.$reject_req_row['BookName'].'</span><br> has been <span class="font-weight-bold text-danger">rejected</span> by the Admin<br></a>';
            }
        } else {
            echo '<a class="dropdown-item"> You have no notifications as of now</a>';
        }
    }

	//Admin notifies user for approved reserve of books
	function notification_approved_reserved(){

		include('connection.php');
		$session_id = htmlspecialchars($_SESSION['userid']);

		$approved_reserved = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE Status = 'Approved' AND UsersID = '$session_id' ORDER BY ReservationDate DESC";
		$approved_reserved_res = mysqli_query($conn, $approved_reserved);

		if (mysqli_num_rows($approved_reserved_res) > 0) {
			while ($approved_reserved_row = mysqli_fetch_assoc($approved_reserved_res)) {
				echo '<a class="dropdown-item"> Your reserved book <span class="font-weight-bold">'.$approved_reserved_row['BookName'].'</span> <br> has been approved by the Admin</br></a>';
			}
		} else {
			echo '<a class="dropdown-item"> You have no notifications as of now</a>';
		}
	}

	//Admin notifies user for rejected reserve of books
	function notification_rejected_reserved(){

		include('connection.php');
		$session_id = htmlspecialchars($_SESSION['userid']);

		$rejected_reserved_sql = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE Status = 'Rejected' AND UsersID = '$session_id' ORDER BY ReservationDate DESC";
		$rejected_reserved_res = mysqli_query($conn, $rejected_reserved_sql);

		if (mysqli_num_rows($rejected_reserved_res) > 0) {
			while ($rejected_reserved_row = mysqli_fetch_assoc($rejected_reserved_res)) {
				echo '<a class="dropdown-item"> Your reserved book '.$rejected_reserved_row['BookName'].' <br> has been rejected by the Admin due to '.$rejected_reserved_row['Remarks'].'</br></a>';
			}
		} else {
			echo '<a class="dropdown-item"> You have no notifications as of now</a>';
		}
	}

	function display_notification_requested_approved(){

		include('connection.php');
		$session_id = htmlspecialchars($_SESSION['userid']);

		$notif_requested = "SELECT * FROM book_request WHERE Status = 'Approved' AND UsersID = '$session_id' ORDER BY Request_Date DESC";
		$notif_requested_res = mysqli_query($conn, $notif_requested);

		if (mysqli_num_rows($notif_requested_res) > 0) {
			while ($notif_requested_row = mysqli_fetch_assoc($notif_requested_res)) {
				echo '<h4>Your requested book <span class="font-weight-bold">'.$notif_requested_row['BookName'].'</span> has been appproved by the Admin</h4>';
			}
		} else {
			echo '<h3 style="text-center">You have notifications</h3>';
		}
	}

	function display_notification_requested_rejected(){

		include('connection.php');
		$session_id = htmlspecialchars($_SESSION['userid']);

		$notif_req_rej = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Rejected' AND UsersID = '$session_id' ORDER BY
		Request_Date DESC";
		$notif_req_rej_res = mysqli_query($conn, $notif_req_rej);

		if (mysqli_num_rows($notif_req_rej_res) > 0) {
			while ($notif_requested_row = mysqli_fetch_assoc($notif_req_rej_res)) {

				echo '<h4>Your requested book <span class="font-weight-bold">'.$notif_requested_row['BookName'].'</span> has been rejected by the Admin due to <span class="font-weight-bold text-danger">'.$notif_requested_row['Remarks'].'</span></h4>';
			}
		} else {
			echo '<h3 style="text-center">You have notifications</h3>';
		}
	}

	function display_notification_reserve_approved(){

		include('connection.php');
		$session_id = htmlspecialchars($_SESSION['userid']);

		$notif_reserve_app = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE Status = 'Approved' AND UsersID = '$session_id' ORDER BY
		ReservationDate DESC";
		$notif_reserve_app_res = mysqli_query($conn, $notif_reserve_app);

		if (mysqli_num_rows($notif_reserve_app_res) > 0) {
			while ($notif_reserve_row = mysqli_fetch_assoc($notif_reserve_app_res)) {
				
				echo "<h4>Your requested book <span class='font-weight-bold'>".$notif_reserve_row['BookName']."</span> has been approved by the Admin</h4>";
			}
		} else {
			echo '<h3 style="text-center">You have notifications</h3>';
		}
	}

	function display_notification_reserve_rejected(){

		include('connection.php');
		$session_id = htmlspecialchars($_SESSION['userid']);

		$notif_reserve_rej = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE UsersID = '$session_id' AND Status = 'Rejected' ORDER BY ReservationDate DESC";
		$notif_reserve_rej_res = mysqli_query($conn, $notif_reserve_rej);

		if (mysqli_num_rows($notif_reserve_rej_res) > 0) {
			while ($notif_reserve_row = mysqli_fetch_assoc($notif_reserve_rej_res)) {
				
				echo "<h4>Your requested book <span class='font-weight-bold'>".$notif_reserve_row['BookName']."</span> has been rejected by the Admin due to <span class='font-weight-bold'>".$notif_reserve_row['Remarks']."</span></h4>";	
			}
		} else {
			echo '<h3 style="text-center">You have notifications</h3>';	
		}
	}

/*End Notifications*/

	//Counting all data
	
	function numberOfCloseAccounts(){

		include('../connection.php');
		$close_acc_sql = "SELECT RemarksID FROM Remarks";
		$res_close_acc = mysqli_query($conn, $close_acc_sql);
		$close_acc_count = mysqli_num_rows($res_close_acc);

		echo htmlspecialchars($close_acc_count);
	}

	function numberofFeedbacks(){
		
		include('../connection.php');
		$feedback_sql = "SELECT feedbackID FROM feedback";
		$res_feedback = mysqli_query($conn, $feedback_sql);
		$feedback_count = mysqli_num_rows($res_feedback);

		echo htmlspecialchars($feedback_count);
	}

	function numberOfUsers() {

		include('../connection.php');
		$user_sql = "SELECT UsersID FROM users";
		$res_user = mysqli_query($conn, $user_sql);
		$user_count = mysqli_num_rows($res_user);

		echo htmlspecialchars($user_count);
	}

	function numberOfBooks(){

		include('../connection.php');
		$book_sql = "SELECT BookID FROM theo_books";
		$res_book = mysqli_query($conn, $book_sql);
		$book_count = mysqli_num_rows($res_book);

		echo htmlspecialchars($book_count);
	}


	function numberOfAnnouncements(){
		
		include('../connection.php');
		$announcement_sql = "SELECT AnnouncementID FROM announcement";
		$res_annoucement = mysqli_query($conn, $announcement_sql);
		$annoucement_count = mysqli_num_rows($res_annoucement);

		echo htmlspecialchars($annoucement_count);
	}

	function numberOfAdmins(){
		
		include('../connection.php');
		$admin_sql = "SELECT AdminID FROM admin";
		$res_admin = mysqli_query($conn, $admin_sql);
		$admin_count = mysqli_num_rows($res_admin);

		echo htmlspecialchars($admin_count);
	}

	function numberOfRequest(){
		
		include('../connection.php');
		$req_sql = "SELECT book_requestID FROM book_request";
		$req_res = mysqli_query($conn, $req_sql);
		$req_count = mysqli_num_rows($req_res);

		echo htmlspecialchars($req_count);
	}

	function numberOfReservation(){
			
		include('../connection.php');
		$reserved_sql = "SELECT book_reservationID FROM reservation";
		$reserved_res = mysqli_query($conn, $reserved_sql);
		$reserved_count = mysqli_num_rows($reserved_res);

		echo htmlspecialchars($reserved_count);
	}

	function numberofApprovedReserveBooks(){

		include('../connection.php');
		$reserve_sql = "SELECT book_reservationID FROM reservation WHERE Status = 'Approved'";
		$reserve_res = mysqli_query($conn, $reserve_sql);
		$reserve_count = mysqli_num_rows($reserve_res);

		echo htmlspecialchars($reserve_count);
}


	function countActiveUsers(){
		
		include('../connection.php');
		$act_users = mysqli_query($conn, "SELECT UsersID FROM users WHERE UserStatus = 'Active'");
		$act_count = mysqli_num_rows($act_users);

		echo htmlspecialchars($act_count);
	}

	function countInactiveUsers(){

		include('../connection.php');
		$deact_users = mysqli_query($conn, "SELECT UsersID FROM users WHERE UserStatus = 'Inactive'");
		$deact_count = mysqli_num_rows($deact_users);

		echo htmlspecialchars($deact_count);
	}

	//End of Counting all data


	/*
		Admin Dashboard -->

		User Accounts -- activate, deactivate
		Book Profiling -- create, update, delete
		Reservation -- approved, rejected
		Requisition -- approved, rejected
		Announcements -- create, update, delete, hide, show
		Admin Management -- create, promote, delete, activate, deactivate
	*/

	//Admin Login

	function adminLogin(){

	session_start(); //starts session
    session_set_cookie_params(86400); //set cookie parameters
    date_default_timezone_set('Asia/Manila'); //set timezone
    include ('../connection.php');

    if (isset($_POST['login'])) {

        //define var
        $username = $_POST['admin_user'];
        $password = $_POST['admin_pass'];

        //Protection from SQL Injection
        $username = stripslashes($username);
        $password = stripslashes($password);
        $password = mysqli_real_escape_string($conn, $password);

         $admin_check = "SELECT AdminID, AdminLName, AdminFName, AdminMName, AdminType, AdminGender, AdminStatus, AdminUser, AdminPass FROM admin WHERE AdminUser = '". mysqli_real_escape_string($conn, $username) . "'";
        $result = mysqli_query($conn, $admin_check);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        $res_admin_id = htmlspecialchars($row['AdminID']);
        $res_admin_user = htmlspecialchars($row['AdminUser']);        
        $res_admin_pass = htmlspecialchars($row['AdminPass']);
        $res_admin_firstname = htmlspecialchars($row['AdminFName']);
        $res_admin_midname = htmlspecialchars($row['AdminMName']);
        $res_admin_lastname = htmlspecialchars($row['AdminLName']);
        $res_admin_type = htmlspecialchars($row['AdminType']);
        $res_admin_gender = htmlspecialchars($row['AdminGender']);
        $res_admin_status = htmlspecialchars($row['AdminStatus']);
        $res_admin_name = htmlspecialchars($row['AdminFName']) .' '. htmlspecialchars($row['AdminLName']);
        $res_admin_fullname = htmlspecialchars($row['AdminFName']) .' '. htmlspecialchars($row['AdminMName']) . ' ' . htmlspecialchars($row['AdminLName']);

        if ($count > 0) {

            if ($res_admin_status == "Active") {
                
                if ($res_admin_pass == $password) {

                	$type = $row['AdminType'];
                	$_SESSION['admin_id'] = $res_admin_id;
                	$_SESSION['admin_user'] = $res_admin_user;
                	$_SESSION['type'] = $res_admin_type;
                	$_SESSION['firstname'] = $res_admin_firstname;
                	$_SESSION['midname'] = $res_admin_midname;
                	$_SESSION['lastname'] = $res_admin_lastname;
                	$_SESSION['name'] = $res_admin_name;
                	$_SESSION['fullname'] = $res_admin_fullname;
                	$_SESSION['gender'] = $res_admin_gender;

                if ($type == 'Admin' || $type == 'Librarian' ) {
                    header("location: adminHome.php");
                } elseif ($type == 'Secretary' || $type == 'Work Student' || 
                    $type == 'Instructor' || $type == 'Secretary' || $type == 'Staff') {
                    header("location: theology-dashboard.php");
                }

            } else {

               		echo "<div class='alert alert-danger error text-center'><span class='fa fa-warning'></span>
                	Incorrect Password </div>";
                }
            
        } else {
                echo "<div class='alert alert-danger error text-center'><span class='fa fa-warning'></span>
                Account Deactivated</div>";
            }
            
    } else {
               echo "<div class='alert alert-danger error text-center'><span class='fa fa-warning'></span>
               Invalid Username</div>";
        }
}

	}
		
	//Admin Gender
	function adminGender(){
		include ('../connection.php');

		$admin_gender = mysqli_query($conn, "SELECT * FROM admin");
		$admin_row = mysqli_fetch_assoc($admin_gender);

		if ($admin_row['AdminGender'] == "Male") {
			
			echo '<img style="border-radius: 50%;" src="../img/person/img_avatar_2.png" height="200" width="200">';
		
		} elseif ($admin_row['AdminGender'] == "Female") {
			
			echo '<img style="border-radius: 50%;" src="../img/person/img_avatar.png" height="200" width="200">';
		}
	}

	//For replying feedbacks for email
	function replyFeedback(){

		include('../connection.php');

		if (isset($_POST['reply'])) {

			require('../PHPMailer/PHPMailerAutoload.php');


			$feed_id = htmlspecialchars($_GET['feed_reply']);

			$session_name = htmlspecialchars($_SESSION['name']);

			$feed_message = mysqli_real_escape_string($conn, $_POST['message']);


			$feed_reply = mysqli_query($conn, "SELECT * FROM feedback WHERE feedbackID = '$feed_id'");
			$feed_row = mysqli_fetch_assoc($feed_reply);
			$email = $feed_row['Email'];

			$mail = new PHPMailer();

			//Configuration
			$mail->SMTPDebug = 2; //Debugging
            $mail->isSMTP();
            $mail->Host = "ssl://smtp.gmail.com:465"; //Host Name
            $mail->SMTPAuth = true; //if SMTP Host requires authentication to send email
            $mail->SMTPSecure = "ssl"; //Security --> Secure Sockets Layer
            $mail->mailer = "smtp"; //Protocol Type
            $mail->Port = 465; // set port number for SMTP
            $mail->setFrom('cputheolib@gmail.com', 'College of Theology');
            $mail->AddReplyTo('cputheolib@gmail.com', 'College of Theology');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 
                'verify_peer_name' => false, 'allow_self_signed' => true));

            //Account
            $mail->Subject = "College of Theology Library Feedback";
            $mail->Username = "cputheolib@gmail.com";
            $mail->Password = "theolibrary";
            $mail->FromName = 'Theology Library Administrator';

            //Body
            $mail->Body = "<h1> Hello ".$feed_row['Name']."</h1>
            <h3>Your sent message is '".$feed_row['Message']."'<br><br> This is our message <br><br>'".$feed_message."'
            <br><br>Replied by ".$session_name.", ".$_SESSION['type']." of College of Theology Library</h3>";

            if (!$mail->send()) {
            	ob_end_clean();
            	echo "<script>
                        alert('Failure in sending a Password to email, please check your internet connection'); 
                        </script>". $mail->ErrorInfo;
            } else{

            	ob_end_clean();
                    echo "<script>
                        alert('Feedback sent succesfully');
                    </script>";
                    return true;
            	}
		}
	}
	//For Messages
	function adminCreateMessages(){

		include('../connection.php');
		date_default_timezone_set('Asia/Manila');
		$session_admin_name = htmlspecialchars($_SESSION['name']);

		if (isset($_POST['send'])) {
			
			$user = mysqli_real_escape_string($conn, $_POST['user']);
			$message = mysqli_real_escape_string($conn, $_POST['message']);

			$message_sql = "INSERT INTO messages(Name,Message, SentBy, SentDate)
			VALUES('$user', '$message', '$session_admin_name', NOW());";
			$message_res = mysqli_query($conn, $message_sql);

			if ($message_res) {
				echo "<script>
					alert('Message sent Successfully');
				</script>";
			} else {
				echo "<script>
					alert('Failure in sending a message');
				</script>";
			}
		}
	}

	//For Admin - Create
	function createAdmins(){

    include('../connection.php');
    date_default_timezone_set('Asia/Manila');
    if (isset($_POST['add_admin'])) {
            
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $midname = mysqli_real_escape_string($conn, $_POST['midname']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);

        $check_user = mysqli_query($conn, "SELECT * FROM admin WHERE AdminUser = '$username'");

        if (!empty($lastname) || !empty($firstname) || !empty($midname) || !empty($type)  || !empty($gender) || !empty($username) || !empty($password) || !empty($conf_pass)) {

             if (mysqli_num_rows($check_user) > 0) {
            
            echo "<script>
                alert('Username is already existing');
                window.open('admin-account-management.php', '_self');
            </script>";
            exit();
        
        } else if ($password != $confirm_password) {

            echo "<script>
                alert('Password do not match');
                window.open('admin-account-management.php', '_self');
            </script>";
            exit();
        
        } else {

            $insert_query = "INSERT INTO admin
            (AdminLName, AdminFName, AdminMName, 
            AdminType, AdminGender, AdminStatus, AdminUser, AdminPass) VALUES
            ('$lastname','$firstname','$midname', 
            '$type', '$gender', 'Active', '$username','$password')";
            $result = mysqli_query($conn, $insert_query);

            if ($result) {
                echo "<script>
                    alert('Successfully created an account');
                </script>
                <meta http-equiv='refresh' content='0; url=admin-account-management.php'>";
            } else {
                echo "<script>
                    alert('Failure in account submission');
                </script>";
            }
        }
    } else { 
                echo "<script>
                alert('Please input all fields');
                window.open('admin-account-management.php', '_self');
            </script>";

        }
    }
}

	//For Announcements -- Create
	function createAnnouncement(){

	include('../connection.php');
	$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	$session_name = $_SESSION['firstname'] . ' ' . $_SESSION['fullname'];
	
	if (isset($_POST['btn_post'])) {

		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		$announcement_image = mysqli_real_escape_string($conn, '../announcement_image/'.$_FILES['image']['name']);

		if (preg_match("!image!", $_FILES['image']['type'])) {
			if (copy($_FILES['image']['tmp_name'], $announcement_image)) {
				$insert_news = "INSERT INTO announcement(Image,Title, Content, Status, PostBy, PostDate) VALUES
				('$announcement_image', '$title', '$content', 'Active', '$session_name', NOW())";
				$result = mysqli_query($conn, $insert_news);
				if ($result) {
					echo "<script>
						alert('Successfully created an announcement');
					</script>
					<meta http-equiv='refresh' content='0; url=announcement.php'>";
				} else {
					echo "<script>
						alert('Error: Failure in creating an announcement');
					</script>";
				}
			} else {
				echo "<script>
					alert('Image upload failed');
				</script>";
			}
		} else {
			echo "<script>
				alert('Invalid type of file');
			</script>";
		}
		mysqli_close($conn);
	}
}

	//For Book Profiling

	function createBooks(){

		include('../connection.php');
		date_default_timezone_set('Asia/Manila');
		$session_admin_user = htmlspecialchars($_SESSION['admin_user']);
	
	if (isset($_POST['btn_add'])) {

		$isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
		$call_number = mysqli_real_escape_string($conn, $_POST['call_number']);
		$book_title = mysqli_real_escape_string($conn, $_POST['book_title']);
		$book_subtitle = mysqli_real_escape_string($conn, $_POST['book_subtitle']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);
		$edition = mysqli_real_escape_string($conn, $_POST['edition']);
		$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
		$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
		$shelf_number = mysqli_real_escape_string($conn, $_POST['shelf_number']);
		$column_number = mysqli_real_escape_string($conn, $_POST['column_number']);
		$row_number = mysqli_real_escape_string($conn, $_POST['row_number']);
		$light_number = mysqli_real_escape_string($conn, $_POST['light_number']);
		$book_image = mysqli_real_escape_string($conn, 
			'../book_image/'.$_FILES['image']['name']);

		if (preg_match("!image!", $_FILES['image']['type'])) {
				if (copy($_FILES['image']['tmp_name'], $book_image)) {

					$check_isbn = mysqli_query($conn, "SELECT * FROM theo_books WHERE ISBN = '$isbn'");
					$check_callnum = mysqli_query($conn, "SELECT * FROM theo_books WHERE BookCallNumber = '$call_number'");

					if (mysqli_num_rows($check_isbn) > 0) {
						echo "<script>
							alert('ISBN is already existing');
						</script>";
					} else if (mysqli_num_rows($check_callnum) > 0) {
						echo "<script>
							alert('Call Number is already existing');
						</script>";
					} else {

						$sql = "INSERT INTO theo_books(ISBN, BookName, BookType, Author, BookCallNumber, BookImage,BookEdition, BookPublisher, BookCopyright, BookShelfNumber, BookRowNumber, BookColumnNumber, BookLightNumber, Book BookPostDate) VALUES('$isbn', '$book_title', '$book_subtitle', '$author', '$call_number', '$book_image', '$edition', '$publisher', '$copyright', '$shelf_number', '$row_number','$column_number', '$light_number', NOW())";

						if (mysqli_query($conn, $sql)) {

							echo "<script>
							alert('Success: Successfully added a book');
							</script>
							<meta http-equiv='refresh' content='0; url=admin-view-books.php'>";	
							//Added Book Logs
                 			$filename = "../system/added_books.txt";
                 			$fp = fopen($filename, 'a+');
                 			fwrite($fp, " " . $session_admin_user . " added a book " . $book_title . " | " . date("l jS \of F Y h:i:s A"). "\n");
                 		fclose($fp);
                 		die();
						} else {
							echo "<script>
								alert('Error: Failure in book submission');
							</script>";
						}
					}
				} else {
						echo "<script>
							alert('Error: Image upload failed');
						</script>";
					}	
				} else {
					echo "<script>
						alert('Error: Invalid type of file');
					</script>";
			}
		}
	}

	//Update Admin Profile
	function adminUpdateAccount(){

	include ('../connection.php');
	if (isset($_POST['save_admin'])) {

		$lastname = mysqli_real_escape_string($conn, $_POST['admin_lname']);
		$firstname = mysqli_real_escape_string($conn, $_POST['admin_fname']);
		$midname = mysqli_real_escape_string($conn, $_POST['admin_mname']);
		$username = mysqli_real_escape_string($conn, $_POST['admin_user']);
		$id = htmlspecialchars($_POST['id']);

		$sql = "UPDATE admin SET 
		AdminLName = '$lastname',
		AdminFName = '$firstname',
		AdminMName = '$midname',
		AdminUser = '$username' WHERE AdminID = '$id'";
		$res = mysqli_query($conn, $sql);
		if ($res) {
			echo "<script>
				alert('Update profile successfully');
			</script>
			<meta http-equiv='refresh' content='0; 
			url=admin-edit-account.php'>";
		} else {
			echo "<script>
				alert('Error in updating profile');
			</script>";
		}
	}
}

    //Update Admin Password
    function adminChangePassword(){

        include('../connection.php');

        $session_admin_user = $_SESSION['admin_user'];

        if (isset($_POST['btn_change'])) {
            
            $oldpass = mysqli_real_escape_string($conn, $_POST['oldpass']);
            $newpass = mysqli_real_escape_string($conn, $_POST['newpass']);
            $conf_pass = mysqli_real_escape_string($conn, $_POST['conf_pass']);

            $sql = mysqli_query($conn, "SELECT * FROM admin WHERE AdminUser = '$session_admin_user'");
            $row = mysqli_fetch_assoc($sql);
            $res_oldpass = $row['AdminPass'];

            if ($oldpass == $res_oldpass) {
                if ($newpass == $conf_pass) {
                    $sql_change = mysqli_query($conn, "UPDATE admin SET AdminPass ='$newpass' WHERE AdminUser='$session_admin_user'");
                        echo "<script>
                                alert('Your password has been changed');
                                </script>
                                <meta http-equiv='refresh'; content='0;url=admin-account.php?remarks=success'>";
                   } else {
                        echo "<script>
                                alert('Passwords do not match');
                            </script>";
                   }   
                } else{
                    echo "<script>
                            alert('Old Password do not match');
                        </script>";
                }
            }
        }

	//Update Books
	function updateBooks(){

		include('../connection.php');
		date_default_timezone_set('Asia/Manila');
		$session_admin_user = htmlspecialchars($_SESSION['admin_user']);

		if (isset($_GET['book_edit']) && is_numeric($_GET['book_edit'])) {
			
			$book_edit = htmlspecialchars($_GET['book_edit']);
			$edit_book_sql = mysqli_query($conn, "SELECT * FROM theo_books");
		}

		if (isset($_POST['btn_update'])) {
			
			$isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
			$call_number = mysqli_real_escape_string($conn, $_POST['call_number']);
			$book_title = mysqli_real_escape_string($conn, $_POST['book_title']);
			$book_subtitle = mysqli_real_escape_string($conn, $_POST['book_subtitle']);
			$author = mysqli_real_escape_string($conn, $_POST['author']);
			$edition = mysqli_real_escape_string($conn, $_POST['edition']);
			$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
			$copyright = mysqli_real_escape_string($conn, $_POST['copyright']);
			$shelf_number = mysqli_real_escape_string($conn, $_POST['book_shelf']);
			$column_number = mysqli_real_escape_string($conn, $_POST['book_column']);
			$row_number = mysqli_real_escape_string($conn, $_POST['book_row']);
			$light_number = mysqli_real_escape_string($conn, $_POST['book_light']);

			$edit_id = $_POST['id'];

			$edit_book_sql = "UPDATE theo_books SET 
			ISBN = '$isbn', BookCallNumber = '$call_number', BookName = '$book_title', 
			BookType = '$book_subtitle', Author = '$author', BookEdition = '$edition', 
			BookPublisher = '$publisher', BookCopyright = '$copyright', 
			BookShelfNumber = '$shelf_number', BookRowNumber = '$row_number', 
			BookColumnNumber = '$column_number', BookLightNumber = '$light_number' WHERE BookID = '$edit_id'";

			$edit_book_res = mysqli_query($conn, $edit_book_sql);

			if ($edit_book_res) {
				
				echo "<script>
					alert('Successfully updated a book');
				</script>
				<meta http-equiv='refresh' content='0; url=admin-view-books.php'>";
			} else {

				echo "<script>
					alert('Failure in updating a book');
				</script>";
			}
		}
	}

	//Update Announcements

	function updateAnnouncement(){

		include('../connection.php');

		$session_name = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];

	if (isset($_GET['announce_edit']) && is_numeric($_GET['announce_edit'])) {
		
		$announcement = htmlspecialchars($_GET['announce_edit']);
		$announcement_sql = mysqli_query($conn, "SELECT * FROM announcement");
	}

		if (isset($_POST['btn_save'])) {
			$image = mysqli_real_escape_string($conn, '../announcement_image/'. $_FILES['image']['name']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$content = mysqli_real_escape_string($conn, $_POST['content']);

			$announcement = htmlspecialchars($_POST['id']);
			$sql_update = "UPDATE announcement SET Title = '$title', PostBy = '$session_name' , Content = '$content', Status = 'Active' PostDate = NOW()
			WHERE AnnouncementID = '$announcement'";
			$res = mysqli_query($conn, $sql_update);

			if ($res) {
				echo "<script>
					alert('Update announcement successfully');
				</script>
				<meta http-equiv='refresh' content='0; url=announcement.php'>";
			} else {
				echo "<script>
					alert('Error in updating announcement');
				</script>";
			}

		}
	}

	function updateContactUs(){

		include('../connection.php');

		if (isset($_POST['save_contact'])) {
			
			$address = mysqli_real_escape_string($conn, $_POST['address']);
			$contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
			$contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
			$contact_schedule = mysqli_real_escape_string($conn, $_POST['contact_schedule']);
			$contact_id = htmlspecialchars($_POST['id']);

			$contact_update = mysqli_query($conn, "UPDATE contact_us SET Address = '$address', 
				ContactNumber = '$contact_number', ContactEmail = '$contact_email', ContactSchedule = '$contact_schedule' WHERE contact_usID = '$contact_id'");

			if ($contact_update) {
				echo "<script>
					alert('successfully updated contact us information');
				</script>
				<meta http-equiv='refresh' content='0; url=admin-edit-contact.php'>";
			} else {
				echo "<script>
					alert('Failure in updating contact us information');
				</script>";
			}
		}
	}

    function rejectReserveRemarks(){

        include('../connection.php');

        if (isset($_POST['btn_remarks'])) {
            
            $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

            $reject_res = $_GET['reject_res'];

            $sql = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE book_reservationID = '$reject_res'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $user_id = $row['UsersID'];

            $update_reject = mysqli_query($conn, "UPDATE reservation SET Status = 'Rejected', 
                Remarks = '$remarks' WHERE book_reservationID = '$reject_res'");

            $insert_remarks_res = mysqli_query($conn, $update_reject);

            if ($update_reject) {
                echo "<script>
                    alert('Rejected Reserved Books');
                </script>
                <meta http-equiv='refresh' content='0; url=admin-view-reservation.php'>";
            } else {
                echo "<script>
                    alert('Failure in rejecting a book');
                </script>";
            }

        }
    }

    function rejectRequestRemarks(){

        include('../connection.php');

            if (isset($_POST['btn_remarks'])) {
                
            $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

            $reject_res = $_GET['reject_request'];

            $sql = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE book_requestID = '$reject_res'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);

            $update_reject = mysqli_query($conn, "UPDATE book_request SET Status = 'Rejected', 
                Remarks = '$remarks' WHERE book_requestID = '$reject_res'");

            $insert_remarks_res = mysqli_query($conn, $update_reject);

            if ($update_reject) {
                echo "<script>
                    alert('Rejected Requested Books');
                </script>
                <meta http-equiv='refresh' content='0; url=admin-view-requested-books.php'>";
            } else {
                echo "<script>
                    alert('Failure in rejecting a book');
                </script>";
            }
        }
    }


	/*
    
		Tables
	*/

	//Admin Inbox

	function adminInbox(){

		include('../connection.php');

		$view_messages = "SELECT * FROM messages ORDER BY SentDate DESC";
		$view_messages_res = mysqli_query($conn, $view_messages);
		$view_messages_count = mysqli_num_rows($view_messages_res);

		if ($view_messages_count > 0){
			while ($view_messages_row = mysqli_fetch_assoc($view_messages_res)) {

			}
		} else {
			echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                    <span class='fa fa-warning'></span> No Messages Found</h3></td></tr>";
		}
	}

	function adminSentMessages(){

		include('../connection.php');

		$view_messages = "SELECT * FROM messages ORDER BY SentDate DESC";
		$view_messages_res = mysqli_query($conn, $view_messages);
		$view_messages_count = mysqli_num_rows($view_messages_res);

		if ($view_messages_count > 0){
			while ($view_messages_row = mysqli_fetch_assoc($view_messages_res)) {
				echo "<tr>
					<td>".htmlspecialchars($view_messages_row['messageID'])."</td>
					<td>".htmlspecialchars($view_messages_row['Name'])."</td>
					<td>".htmlspecialchars($view_messages_row['Message'])."</td>
					<td>".htmlspecialchars($view_messages_row['SentBy'])."</td>
					<td>".htmlspecialchars($view_messages_row['SentDate'])."</td>
					<td><a class='btn btn-danger' href='crud_action.php?message_del=".$view_messages_row['messageID']."'><span class='fa fa-trash'></span> Delete</a></td>
				</tr>";

			}
		} else {
			echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                    <span class='fa fa-warning'></span> No Messages Found</h3></td></tr>";
		}
	}	

	//For Admin Information

	function viewActiveAdmin(){

		include('../connection.php');

		$view_admin = "SELECT * FROM admin WHERE AdminStatus = 'Active' ORDER BY AdminID DESC";
		$result = mysqli_query($conn, $view_admin);
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$fullname = htmlspecialchars($row['AdminLName']) . ", " . htmlspecialchars($row['AdminFName']) . " " . htmlspecialchars($row['AdminMName']);
				echo "<tr>
					  	<td>".htmlspecialchars($row['AdminID'])."</td>
					  	<td>".htmlspecialchars($fullname)."</td>
					  	<td>".htmlspecialchars($row['AdminType'])."</td>
					  	<td>".htmlspecialchars($row['AdminStatus'])."</td>
					  	<td>".htmlspecialchars($row['AdminUser'])."</td>
					  	<td><a class='btn btn-warning' href='crud_action.php?admin_deact=".$row['AdminID']."'><span class='fa fa-close' name></span>Disabled</a></td>
					</tr>";
				}
			} else {

				echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                    <span class='fa fa-warning'></span> No Admins Found</h3></td></tr>";
			}
	}

	function viewInactiveAdmin(){

		include('../connection.php');
		$view_admin = "SELECT * FROM admin WHERE AdminStatus = 'Inactive' ORDER BY AdminID DESC";
		$result = mysqli_query($conn, $view_admin);
		$count = mysqli_num_rows($result);
		if ($count > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$fullname = htmlspecialchars($row['AdminLName']) . ", " . htmlspecialchars($row['AdminFName']) . " " . htmlspecialchars($row['AdminMName']);
				echo "<tr>
					  	<td>".htmlspecialchars($row['AdminID'])."</td>
					  	<td>".htmlspecialchars($fullname)."</td>
					  	<td>".htmlspecialchars($row['AdminType'])."</td>
					  	<td>".htmlspecialchars($row['AdminStatus'])."</td>
					  	<td>".htmlspecialchars($row['AdminUser'])."</td>
					  	<td><a class='btn btn-primary' href='crud_action.php?admin_act=".$row['AdminID']."'><span class='fa fa-check' name></span>Enabled</a></td>
					  	<td><a class='btn btn-danger' href='crud_action.php?admin_del=".$row['AdminID']."'><span class='fa fa-trash'></span> Delete</a></td>
					</tr>";
				}
			} else {
				echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                    <span class='fa fa-warning'></span> No Admins Found</h3></td></tr>";
			}

		}
	//For Feedbacks
	function adminViewFeedbacks(){

		include('../connection.php');

		$fb_sql = "SELECT * FROM feedback ORDER BY DateSend DESC";
		$fb_res = mysqli_query($conn, $fb_sql);
		$fb_count = mysqli_num_rows($fb_res);

		if ($fb_count > 0) {
				
			while ($fb_row = mysqli_fetch_assoc($fb_res)) {
				echo "<tr>
					<td>".htmlspecialchars($fb_row['feedbackID'])."</td>
					<td>".htmlspecialchars($fb_row['Name'])."</td>
					<td>".htmlspecialchars($fb_row['Email'])."</td>
					<td>".htmlspecialchars($fb_row['Subject'])."</td>
					<td>".htmlspecialchars($fb_row['Message'])."</td>
					<td>".htmlspecialchars($fb_row['DateSend'])."</td>
					 <td><a class='btn btn-primary' href='admin-reply-feedback.php?feed_reply=".$fb_row['feedbackID']."'><span class='fa fa-reply'></span> Reply</a></td>      
					<td><a class='btn btn-danger' href='crud_action.php?feed_del=".$fb_row['feedbackID']."'><span class='fa fa-trash'></span> Delete</a></td>
				</tr>";
			}
		} else {
			echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                    <span class='fa fa-warning'></span> No Feedbacks Found</h3></td></tr>";
		}
	}

	//For Books Information
	function adminViewBooks(){

		$url = urlencode('192.168.1.112:15580');

		include('../connection.php');
		if (isset($_GET['btn_search'])) {

			$search = mysqli_real_escape_string($conn, $_GET['book_search']);
			$sql = "SELECT * FROM theo_books 
					WHERE BookID LIKE '%$search%' 
					OR ISBN LIKE '%$search%'
					OR BookCallNumber LIKE '%$search%'
					OR BookName LIKE '%$search%'
					OR BookType LIKE '%$search%'
					OR Author LIKE '%$search%'
					OR BookCopyright LIKE '%$search%'";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);

				if ($count > 0) {
				
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr><td><img src="../book_image/'.$row['BookImage'].'"style="width:150px;height:200px;"</td>';
						echo '<td>'.$row['ISBN'].'</td>';
						echo '<td>'.$row['BookCallNumber'].'</td>';
						echo '<td class="font-weight-bold">'.$row['BookName'].'</td>';
						echo '<td>'.$row['BookType'].'</td>';
						echo '<td>'.$row['Author'].'</td>';
						echo '<td>'.$row['BookEdition'].'</td>';
						echo '<td>'.$row['BookPublisher'].'</td>';
						echo '<td>'.$row['BookCopyright'].'</td>';
						echo '<td>'.$row['BookPostDate'].'</td>';
						echo '<td><a class="btn btn-info" href="admin-edit-books.php?id='.$row['BookID'].'"><span class="fa fa-edit"></span> Edit</a></td>';
						echo '<td><a class="btn btn-danger" href="crud_action.php?del='.$row['BookID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				}

				echo "<h3 class='alert alert-success text-center'>
    					<span class='fa fa-check'></span> ".$count." results found 
  					</h3";
			
			} else {
				echo "<tr><td colspan='11'><h3 class='alert alert-danger text-center'>
                            <span class='fa fa-warning'></span> Keyword '$search' was not found</h3></td></tr>";
			}
		} else  {

					$viewBooks = "SELECT * FROM theo_books ORDER BY BookPostDate DESC";
					$result = mysqli_query($conn, $viewBooks);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)) {

					echo '<tr><td><img src="../book_image/'.$row['BookImage'].'"style="width:150px;height:200px;"</td>';
					echo'<td>'.$row['ISBN'].'</td>';
					echo '<td>'.$row['BookCallNumber'].'</td>';
					echo '<td class="font-weight-bold">'.$row['BookName'].'</td>';
					echo '<td>'.$row['BookType'].'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['BookEdition'].'</td>';
					echo '<td>'.$row['BookPublisher'].'</td>';
					echo '<td>'.$row['BookCopyright'].'</td>';
					echo '<td>'.$row['BookPostDate'].'</td>';
					echo '<td><a class="btn btn-info" href="admin-edit-books.php?book_edit='.$row['BookID'].'"><span class="fa fa-edit"></span> Edit</a></td>';
					echo '<td><a class="btn btn-danger" href="crud_action.php?book_del='.$row['BookID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Books Found</h3></td></tr>";
				 }
			}
	}

	//For Location of Books
	function locateBooks(){

		include('../connection.php');


		$url = urlencode('192.168.1.112:15580');

		include('../connection.php');
		if (isset($_GET['btn_search'])) {

			$search = mysqli_real_escape_string($conn, $_GET['book_search']);
			$sql = "SELECT * FROM theo_books 
					WHERE BookID LIKE '%$search%' 
					OR ISBN LIKE '%$search%'
					OR BookCallNumber LIKE '%$search%'
					OR BookName LIKE '%$search%'";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);

				if ($count > 0) {
				
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr><td><img src="../book_image/'.$row['BookImage'].'"style="width:150px;height:200px;"</td>';
						echo '<td>'.$row['BookID'].'</td>';
						echo '<td>'.$row['ISBN'].'</td>';
						echo '<td>'.$row['BookCallNumber'].'</td>';
						echo '<td class="font-weight-bold">'.$row['BookName'].'</td>';
						echo '<td>'.$row['BookPostDate'].'</td>';
						echo '<td class="font-weight-bold">'.$row['BookShelfNumber'].'</td>';
						echo '<td class="font-weight-bold">'.$row['BookRowNumber'].'</td>';
						echo '<td class="font-weight-bold">'.$row['BookColumnNumber'].'</td>';
						echo '<td class="font-weight-bold text-success">'.$row['BookLightNumber'].'</td>';
						/*echo '<td><div class="switch"><label>Off<input type="checkbox">
										<span class="lever"></span>On</label></td></tr>'; */
						echo '<td><a class="btn btn-primary" onclick="window.location.reload(true);" href="http://192.168.1.112:15580/locate='.$row['BookLightNumber'].
					'=1"><span class="fa fa-power-off"></span> On</a></td>';
						echo '<td><a class="btn btn-danger" onclick="window.location.reload(true);" href="http://192.168.1.112:15580/locate='.$row['BookLightNumber'].
					'=0"><span class="fa fa-power-off"></span> Off</a></td></tr>';
				}

				echo "<h3 class='alert alert-success text-center'>
    						<span class='fa fa-check'></span> ".$count." results found 
  							</h3";
			
			} else {
				echo "<tr><td colspan='11'><h3 class='alert alert-danger text-center'>
                            <span class='fa fa-warning'></span> Keyword '$search' was not found</h3></td></tr>";
			}
		} else  {

					$viewBooks = "SELECT * FROM theo_books ORDER BY BookPostDate DESC";
					$result = mysqli_query($conn, $viewBooks);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)) {

					echo '<tr><td><img src="../book_image/'.$row['BookImage'].'"style="width:150px;height:200px;"</td>';
					echo '<td>'.$row['BookID'].'</td>';
					echo'<td>'.$row['ISBN'].'</td>';
					echo '<td>'.$row['BookCallNumber'].'</td>';
					echo '<td class="font-weight-bold">'.$row['BookName'].'</td>';
					echo '<td>'.$row['BookPostDate'].'</td>';
					echo '<td class="font-weight-bold">'.$row['BookShelfNumber'].'</td>';
					echo '<td class="font-weight-bold">'.$row['BookRowNumber'].'</td>';
					echo '<td class="font-weight-bold">'.$row['BookColumnNumber'].'</td>';
					echo '<td class="font-weight-bold">'.$row['BookLightNumber'].'</td>';						
					/*echo '<td><div class="switch">
									<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>
										<label>Off<input type="checkbox" name="switch">
											<span class="lever"></span>On</label>
									</form>
								</div>
						</td></tr>';*/
					echo '<td><a class="btn btn-primary" href="http://192.168.1.112:15580/locate='.$row['BookLightNumber'].
					'=1"><span class="fa fa-power-off"></span> On</a></td>';
					echo '<td><a class="btn btn-danger" href="http://192.168.1.112:15580/locate='.$row['BookLightNumber'].
					'=0"><span class="fa fa-power-off"></span> Off</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Books Found</h3></td></tr>";
				 }
			}
	}


	//For User Accounts --> Active Users
	function activeUsers(){

		include('../connection.php');

		if (isset($_POST['btn_search'])) {
			$search = mysqli_real_escape_string($conn, $_POST['user_search']);
			$sql = "SELECT * FROM users WHERE 
						 UserLName LIKE '%$search%'
						OR UserFName LIKE '%$search%'
						OR UserMName LIKE '%$search%'
						OR UserType LIKE '%$search%'
						OR UserEmail LIKE '%$search%'
						OR UserContactNumber LIKE '%$search%'
						OR UserStatus LIKE '%$search%'
						OR Username LIKE '%$search%'";
					$result = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($result);

				if ($count > 0) {
							
					while ($row = mysqli_fetch_assoc($result)) {

					$fullname = htmlspecialchars($row['UserFName']) . ' ' . htmlspecialchars($row['UserMName']). ' ' . htmlspecialchars($row['UserLName']);
						echo '<tr><td>'.$fullname.'</td>';
						echo '<td>'.$row['UserType'].'</td>';
						echo '<td>'.$row['UserGender'].'</td>';
						echo '<td>'.$row['UserEmail'].'</td>';
						echo '<td>'.$row['UserContactNumber'].'</td>';
						echo '<td>'.$row['UserStatus'].'</td>';
						echo '<td>'.$row['Username'].'</td>';
						echo '<td>'.$row['UserRegisterDate'].'</td>';
						echo '<td><a class="btn btn-danger" href="crud_action.php?user_deact='.htmlspecialchars($row['UsersID']).'"><span class="fa fa-close"></span> Disabled</a></td></tr>';
					}
					echo "<h3 class='alert alert-success text-center'><span class='fa fa-check'></span>
    						".$count." results found 
  							</h3>";

				} else {
					echo "<tr><td colspan='11'><h3 class='alert alert-danger text-center'>
                            <span class='fa fa-warning'></span> Keyword '$search' was not found</h3></td></tr>";
				}
			} else {

				$sql = "SELECT * FROM users WHERE UserStatus = 'Active' ORDER BY UserRegisterDate DESC";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);
				if ($count > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						$fullname = htmlspecialchars($row['UserFName']) . ' ' . htmlspecialchars($row['UserMName']). ' ' . htmlspecialchars($row['UserLName']);
						echo '<tr>
								<td>'.$fullname.'</td>
								<td>'.$row['UserGender'].'</td>
							 	<td>'.$row['UserType'].'</td>
							    <td>'.$row['UserEmail'].'</td>
							    <td>'.$row['UserContactNumber'].'</td>
							    <td>'.$row['UserStatus'].'</td>
								<td>'.$row['Username'].'</td>
								<td>'.$row['UserRegisterDate'].'</td>
								<td><a class="btn btn-danger" href="crud_action.php?user_deact='.htmlspecialchars($row['UsersID']).'"><span class="fa fa-close"></span> Disabled</a></td>
							</tr>';
						}
				} else {
					echo "<h3 class='alert alert-warning text-center'><span class='fa fa-warning'></span> No users found</h3>";
				}
			}
		}

	//For User Accounts --> Inactive Users
		function inactiveUsers(){

		include('../connection.php');

		if (isset($_POST['btn_search'])) {
			$search = mysqli_real_escape_string($conn, $_POST['user_search']);
			$sql = "SELECT * FROM users WHERE 
						UserLName LIKE '%$search%'
						OR UserFName LIKE '%$search%'
						OR UserMName LIKE '%$search%'
						OR UserType LIKE '%$search%'
						OR UserEmail LIKE '%$search%'
						OR UserContactNumber LIKE '%$search%'
						OR UserStatus LIKE '%$search%'
						OR Username LIKE '%$search%'";
					$result = mysqli_query($conn, $sql);
					$count = mysqli_num_rows($result);

				if ($count > 0) {
							
					while ($row = mysqli_fetch_assoc($result)) {

					$fullname = htmlspecialchars($row['UserFName']) . ' ' . htmlspecialchars($row['UserMName']). ' ' . htmlspecialchars($row['UserLName']);
						echo '<tr><td>'.$row['UsersID'].'</td>';
						echo '<td>'.$fullname.'</td>';
						echo '<td>'.$row['UserType'].'</td>';
						echo '<td>'.$row['UserGender'].'</td>';
						echo '<td>'.$row['UserEmail'].'</td>';
						echo '<td>'.$row['UserContactNumber'].'</td>';
						echo '<td class="font-weight-bold text-warning">'.$row['UserStatus'].'</td>';
						echo '<td>'.$row['Username'].'</td>';
						echo '<td>'.$row['UserRegisterDate'].'</td>';
						echo '<td><a class="btn btn-primary" href="crud_action.php?user_act='.htmlspecialchars($row['UsersID']).'"><span class="fa fa-check"></span>Enabled</a></td></tr>';
					}
					echo "<h3 class='alert alert-success text-center'><span class='fa fa-check'></span>
    						".$count." results found 
  							</h3>";

				} else {
					echo "<tr><td colspan='11'><h3 class='alert alert-danger text-center'>
                            <span class='fa fa-warning'></span> Keyword '$search' was not found</h3></td></tr>";
				}
			} else {

				$sql = "SELECT * FROM users WHERE UserStatus = 'Inactive' ORDER BY UserRegisterDate DESC";
				$result = mysqli_query($conn, $sql);
				$count = mysqli_num_rows($result);
				if ($count > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						$fullname = htmlspecialchars($row['UserFName']) . ' ' . htmlspecialchars($row['UserMName']). ' ' . htmlspecialchars($row['UserLName']);
						echo '<tr>
								<td>'.$fullname.'</td>
								<td>'.$row['UserGender'].'</td>
							 	<td>'.$row['UserType'].'</td>
							    <td>'.$row['UserEmail'].'</td>
							    <td>'.$row['UserContactNumber'].'</td>
							    <td class="font-weight-bold text-warning">'.$row['UserStatus'].'</td>
								<td>'.$row['Username'].'</td>
								<td>'.$row['UserRegisterDate'].'</td>
								<td><a class="btn btn-primary" href="crud_action.php?user_act='.htmlspecialchars($row['UsersID']).'"><span class="fa fa-check"></span>Enabled</a></td>
							</tr>';
						}
				} else {
					echo "<h3 class='alert alert-warning text-center'><span class='fa fa-warning'></span> No users found</h3>";
				}
			}

		}


	//For Requisition
	function adminPendingRequestBooks(){

		include('../connection.php');

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

					   echo '<tr><td>'.$row['book_requestID'].'</td>';
					   echo '<td>'.$row['BookName'].'</td>';
					   echo '<td>'.$row['Author'].'</td>';
					   echo '<td>'.$row['Edition'].'</td>';
					   echo '<td>'.$row['Copyright'].'</td>';
					   echo '<td>'.$row['Publisher'].'</td>';
					   echo '<td>'.$row['Publish_Date'].'</td>';
					   echo '<td>'.$row['Status'].'</td>';
                       echo '<td>'.$name.'</td>';
				       echo '<td>'.$row['Request_Date'].'</td>';
					   echo "<td><a class='btn btn-primary' href='crud_action.php?approve=".$row['book_requestID']."'><span class='fa fa-check' name></span> Approved</a></td>";
					   echo "<td><a class='btn btn-danger' href='admin-request-remarks.php?reject_request=".$row['book_requestID']."'><span class='fa fa-close'></span> Rejected</a></td></tr>";
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> No Requested Books Found</h3></td></tr>";
				 }
			}
		}

	function adminApprovedRequested(){

		include('../connection.php');

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

					$view_Requested = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Approved' ORDER BY Request_Date DESC";
					$result = mysqli_query($conn, $view_Requested);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)){

                       $name = $row['UserFName'] . " " . $row['UserLName']; 
					   echo '<tr><td>'.$row['book_requestID'].'</td>';
					   echo '<td>'.$row['BookName'].'</td>';
					   echo '<td>'.$row['Author'].'</td>';
					   echo '<td>'.$row['Edition'].'</td>';
					   echo '<td>'.$row['Copyright'].'</td>';
					   echo '<td>'.$row['Publisher'].'</td>';
					   echo '<td>'.$row['Publish_Date'].'</td>';
					   echo '<td>'.$row['Status'].'</td>';
                       echo '<td>'.$row['Remarks'].'</td>';
                       echo '<td>'.$name.'</td>';
					   echo '<td>'.$row['Request_Date'].'</td>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Requested Books Found</h3></td></tr>";
				 }
			}
	}

	function adminRejectedRequested(){

		include('../connection.php');

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

					$view_Requested = "SELECT * FROM book_request INNER JOIN users USING(UsersID) WHERE Status = 'Rejected' ORDER BY Request_Date DESC ";
					$result = mysqli_query($conn, $view_Requested);
					$count = mysqli_num_rows($result);

					if ($count > 0) {

					while ($row = mysqli_fetch_array($result)){

                        $name = $row['UserFName'] . " " . $row['UserLName']; 
					   echo '<tr><td>'.$row['book_requestID'].'</td>';
					   echo '<td>'.$row['BookName'].'</td>';
					   echo '<td>'.$row['Author'].'</td>';
					   echo '<td>'.$row['Edition'].'</td>';
				       echo '<td>'.$row['Copyright'].'</td>';
					   echo '<td>'.$row['Publisher'].'</td>';
					   echo '<td>'.$row['Publish_Date'].'</td>';
					   echo '<td>'.$row['Status'].'</td>';
                       echo '<td>'.$row['Remarks'].'</td>';
					   echo '<td>'.$name.'</td>';
					   echo '<td>'.$row['Request_Date'].'</td>';
					   echo '<td><a class="btn btn-danger" href="crud_action.php?rej_del='.$row['book_requestID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Requested Books Found</h3></td></tr>";
				 }
			}
	}

	//For Pending Reserve Books
	function adminPendingReserveBooks(){

		include('../connection.php');


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

					echo '<tr><td><img height="250" width="200" src="'.$row["BookImage"].'"></td>';
					echo '<td>'.$row['book_reservationID'].'</td>';
					echo '<td class="font-weight-bold">'.$row['BookName'].'</td>';
					echo '<td>'.$res_name.'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['Status'].'</td>';
					echo '<td>'.$row['ReservationDate'].'</td>';
					echo '<td><a class="btn btn-primary" href="crud_action.php?approve_res='.$row['book_reservationID'].'"><span class="fa fa-check"></span> Approved</a></td>';
					echo '<td><a class="btn btn-danger" href="admin-reserve-remarks.php?reject_res='.$row['book_reservationID'].'"><span class="fa fa-close"></span> Rejected</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Reserved Books Found</h3></td></tr>";
				 }
			}
	}

	//For Approved Reserve Books
	function adminApprovedReserveBooks(){

		include('../connection.php');
		
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
							echo '<td>'.$row_search['Status'].'</td>';
							echo '<td>'.$row_search['Request_Date'].'</td></tr>';
						}

						echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Reserved Books Found</h3></td></tr>";
					} else {
						echo "<tr><td colspan='11'><h3 class='alert alert-danger text-center'>
                            <span class='fa fa-close'></span> Keyword $reserve_search is not found</h3></td></tr>";
				}

				} else {

					$app_reservation = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) WHERE Status = 'Approved' ORDER BY ReservationDate";
					$app_reservation_res = mysqli_query($conn, $app_reservation);
					$app_reservation_count = mysqli_num_rows($app_reservation_res);

					if ($app_reservation_count > 0) {

					while ($row = mysqli_fetch_array($app_reservation_res)){

                        $name = $row['UserFName'] . " " . $row['UserLName'];

					echo '<tr><td><img src="'.$row["BookImage"].'" height=250 width=200></td>';
					echo '<td>'.$row['book_reservationID'].'</td>';
					echo '<td class="font-weight-bold">'.$row['BookName'].'</td>';
					echo '<td>'.$name.'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td class="font-weight-bold text-success">'.$row['Status'].'</td>';
                    echo '<td class="font-weight-bold text-warning">'.$row['Remarks'].'</td>';
					echo '<td>'.$row['ReservationDate'].'</td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Reserved Books Found</h3></td></tr>";
				 }
			}
	}

	//For Rejected Reserve Books
	function adminRejectedReserveBooks(){
		
        include('../connection.php');
		
				$view_reserved = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID)
                    INNER JOIN users USING(UsersID) WHERE Status = 'Rejected' ORDER BY ReservationDate DESC";
					$result = mysqli_query($conn, $view_reserved);
					$count = mysqli_num_rows($result);

					if ($count > 0) { 

					while ($row = mysqli_fetch_assoc($result)){

                    $name = $row['UserFName'] . " " . $row['UserLName']; 

					echo "<tr><td><img src='".$row['BookImage']."' width='200' height='250' alt='Book Image''></td>";
					echo '<td>'.$row['book_reservationID'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$name.'</td>';
					echo '<td>'.$row['Author'].'</td>';
					echo '<td>'.$row['Status'].'</td>';
                    echo '<td>'.$row['Remarks'].'</td>';
					echo '<td>'.$row['ReservationDate'].'</td>';
					echo '<td><a class="btn btn-danger" href="crud_action.php?reserved_del='.$row['book_reservationID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Reserved Books Found</h3></td></tr>";
				 }
			}

		//For All Reserved Books

		function adminAllReservedBooks(){

			include('../connection.php');
		if (isset($_POST['btn_request_search'])) {
				$request_search = htmlspecialchars($_POST['request_search']);
				$request_search = mysqli_real_escape_string($conn, $request_search);

				$sql_search = "SELECT * FROM reservation
								WHERE book_requestID LIKE '%$request_search%'
								OR BookName LIKE '%$request_search%'
								OR FullName LIKE '%$request_search%'";
				$res_search = mysqli_query($conn, $sql_search);
				$count_search = mysqli_num_rows($res_search);

					if ($count_search > 0) {
						while ($row_search = mysqli_fetch_array($res_search)) {
							echo '<tr><td>'.$row_search['book_reservationID'].'</td>';
							echo "<td><img src='".$row_search['BookImage']."' alt='Book Image' style='width=250px; height=200px;'></td>
									";
							echo '<td>'.$row_search['BookName'].'</td>';
							echo '<td>'.$row_search['FullName'].'</td>';
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

					$all_reserved = "SELECT * FROM reservation INNER JOIN theo_books USING(BookID) INNER JOIN users USING(UsersID) ORDER BY ReservationDate";
					$result = mysqli_query($conn, $all_reserved);
					$count = mysqli_num_rows($result);

					if ($count > 0) { 

					while ($row = mysqli_fetch_assoc($result)){

                    $name = $row['UserFName'] . " " . $row['UserLName'];
					echo "<tr><td><img src='".$row['BookImage']."' width='200' height='250' alt='Book Image''></td>";
					echo '<td>'.$row['book_reservationID'].'</td>';
					echo '<td>'.$row['BookName'].'</td>';
					echo '<td>'.$name.'</td>';
					echo '<td>'.$row['Author'].'</tD>';
					echo '<td>'.$row['Status'].'</td>';
					echo '<td>'.$row['ReservationDate'].'</td>';
					echo '<td><a class="btn btn-danger" href="crud_action.php?reserved_del='.$row['book_reservationID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				 	}
				 } else {
				 	echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-warning'></span> No Reserved Books Found</h3></td></tr>";
				 }
			}

		}


	//For Latest Announcement

	function activeAnnouncement(){
	include('../connection.php');
	//Displays Active Announcements Only
		$view_announcement = "SELECT * FROM announcement WHERE PostDate >= CURRENT_DATE() - INTERVAL 48 DAY_HOUR AND Status = 'Active' ORDER BY PostDate DESC";
		$res_announce = mysqli_query($conn, $view_announcement);
		$count = mysqli_num_rows($res_announce);

			if ($count > 0) {			
				while ($row = mysqli_fetch_array($res_announce)) {
					echo '<tr><td><img src="../announcement_page/'.$row['Image'].'" style="width:200px; height:200px;"></td>';
					echo '<td>'.htmlspecialchars($row['Title']).'</td>';
					echo '<td class="font-weight-bold">'.htmlspecialchars($row['Content']).'</td>';
					echo '<td class="font-weight-bold text-warning">'.htmlspecialchars($row['Status']).'</td>';
					echo '<td>'.htmlspecialchars($row['PostBy']).'</td>';
					echo '<td class="font-weight-bold text-secondary">'.htmlspecialchars(date('F j, Y - g:i A',(strtotime($row['PostDate'])))).'</td>';
					echo '<td><a class="btn btn-teal" href="crud_action.php?hide='.htmlspecialchars($row['AnnouncementID']).'"><span class="fa fa-eye-slash"></span> Hide </a></td>';
				}
			} else {
				echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                        <span class='fa fa-info-circle'></span> There are no Announcements Posted</h3></td></tr>";
				}
		}

	function inactiveAnnouncement(){

		include('../connection.php');
		//Displays Inactive Announcements Only
		
		$view_announcement = "SELECT * FROM announcement WHERE Status = 'Inactive' ORDER BY PostDate DESC";
		$res_announce = mysqli_query($conn, $view_announcement);
		$count = mysqli_num_rows($res_announce);

			if ($count > 0) {			
				while ($row = mysqli_fetch_array($res_announce)) {
					echo '<tr><td><img src="../announcement_page/'.$row['Image'].'" style="width:200px; height:200px;"></td>';
					echo '<td>'.htmlspecialchars($row['Title']).'</td>';
					echo '<td class="font-weight-bold">'.htmlspecialchars($row['Content']).'</td>';
					echo '<td class="font-weight-bold text-danger">'.htmlspecialchars($row['Status']).'</td>';
					echo '<td>'.htmlspecialchars($row['PostBy']).'</td>';
					echo '<td>'.htmlspecialchars(date('F j, Y - g:i A',(strtotime($row['PostDate'])))).'</td>';
					echo '<td><a class="btn btn-default" href="crud_action.php?show='.$row['AnnouncementID'].'"><span class="fa fa-eye"></span> Show</a></td></tr>';
				}
			} else {
				echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                        <span class='fa fa-info-circle'></span> There are no Announcements Posted</h3></td></tr>";
				}
	}

	function allAnnouncements(){
		include('../connection.php');
			//Displays All Announcements
			$view_announcement = "SELECT * FROM announcement ORDER BY PostDate DESC";
			$res_announce = mysqli_query($conn, $view_announcement);
			$count = mysqli_num_rows($res_announce);


			if ($count > 0) {		
				while ($row = mysqli_fetch_assoc($res_announce)) {
					echo '<tr><td><img src="../announcement_page/'.$row['Image'].'" style="width:200px; height:200px;"></td>';
					echo '<td>'.htmlspecialchars($row['Title']).'</td>';
					echo '<td class="hello font-weight-bold">'.htmlspecialchars($row['Content']).'</td>';
					echo '<td>'.htmlspecialchars($row['Status']).'</td>';
					echo '<td>'.htmlspecialchars($row['PostBy']).'</td>';
					echo '<td>'.htmlspecialchars(date('F j, Y - g:i A',(strtotime($row['PostDate'])))).'</td>';					
					echo '<td><a class="btn btn-default" href="crud_action.php?show='.$row['AnnouncementID'].'"><span class="fa fa-eye"></span> Show</a></td>';
					echo '<td><a class="btn btn-primary" href="admin-edit-announcement.php?announce_edit='.$row['AnnouncementID'].'"><span class="fa fa-edit"></span> Edit</a></td>';
					echo '<td><a class="btn btn-danger" href="crud_action.php?del_announce='.$row['AnnouncementID'].'"><span class="fa fa-trash"></span> Delete</a></td></tr>';
				}
			} else {
					echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                            <span class='fa fa-info-circle'></span> There no Announcements</h3></td></tr>";
				}
		}

	function viewCloseAccounts(){

		include('../connection.php');

		$disp_close_acc = mysqli_query($conn, "SELECT * FROM remarks ORDER BY RemarksDate ASC");

		if (mysqli_num_rows($disp_close_acc) > 0) {
			while ($row = mysqli_fetch_assoc($disp_close_acc)) {
				echo "<tr>
						<td>".$row['Name']."</td>
						<td>".$row['Content']."</td>
						<td>".$row['RemarksDate']."</td>
					</tr>";
				}
			} else {
				echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                    	<span class='fa fa-warning'></span> No Feedbacks Found</h3></td></tr>";
			}
		}
?>