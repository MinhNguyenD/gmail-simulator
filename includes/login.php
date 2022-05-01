<?php
/*
This code contains code re-used from examples provided by Prof. Sampangi in this course. 
This code is used with Prof. Raghav Sampangi's permission. This code is used as a starting point for my solution for A4.
*/
?>

<?php
	session_start();

	require_once "includes/db.php";
	// Process login form submission
	if (isset($_REQUEST['submit-login'])) {
			// (1) Verify if token is valid
		if ($_REQUEST['token-input'] == $_SESSION['token']) {
			
			// (2) Verify user name and password
			$userEmail= sanitizeData($_REQUEST['email-login']);
			$userPassword = sanitizeData($_REQUEST['password-login']);
			$sql = "SELECT * FROM je_login WHERE je_login_email = '$userEmail' AND je_login_password = '$userPassword' ";
			$result = $db->query($sql);
			$row = $result->fetch_assoc();
			
			
			$userID = $row['je_login_id'];
			$count = mysqli_num_rows($result);
			
			$sql2= "SELECT * FROM je_users WHERE je_user_id = '$userID'";
			$result2 = $db->query($sql2);
			$row2 = $result2->fetch_assoc();

			if($count == 1){
				// (3) If user name and password combination is correct and valid, regenerate session ID.
				session_regenerate_id();
				$_SESSION['token'] = ""; 
				// (4) Update session variable
				$_SESSION['useremail'] = $row['je_login_email']; 
				$_SESSION['username'] = $row2['je_user_firstname']." ".$row2['je_user_lastname'];
				$_SESSION['password'] = sanitizeData($_REQUEST['password-login']);
				$_SESSION['userid'] = $row['je_login_id'];

				header("Location: index.php?loginsuccess");
			}
			else{
				header("Location: index.php?loginerror=1");
			}
		}
		else{
			header("Location: index.php?loginerror=1");
		}

	}

	ob_end_flush(); 
	
?>