<?php
session_start();

	// Database
	include 'config.php';

  	// PROTECTION FOR DATA INJECTION
	$username = mysqli_real_escape_string($con,$_POST['username']);
	$password = mysqli_real_escape_string($con,$_POST['password']);

 if(isset($_POST['login'])) { //IF BUTTON CLICK

 	// EMPTY FIELDS 
 	if (empty($username) && empty($password)) {
 	    $_SESSION['error_message'] = "Enter Username & Password";
 	    header("Location:index.php?error=emptyfields");
 	    exit();
 	  }
 	  elseif (empty($username) && !empty($password)) {
 	    $_SESSION['error_message'] = "Forgot to enter username?";
 	    header("Location:index.php?error=emptyfields");
 	    exit();
 	  }
 	  elseif (!empty($username) && empty($password)) {
 	    $_SESSION['error_message'] = "Forgot to enter password?";
 	    header("Location:index.php?error=emptyfields");
 	    exit();
 	  }


	// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
		// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
		$stmt->bind_param('s', $username);
		$stmt->execute();
		// Store the result so we can check if the account exists in the database.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $pwd);
		$stmt->fetch();
		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		if (password_verify($password, $pwd)) { 
		//if ($_POST['password'] === $password) { //password dencryption method
			// Verification success! User has loggedin!
			// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $username;
			$_SESSION['id'] = $id;
			//echo 'Welcome ' . $_SESSION['name'] . '!';
			header('Location: home.php');
		} else {
			// echo 'Incorrect password!';
			$_SESSION['error_inc'] = "Your Password is incorrect";
	        header("Location:index.php?error=wrongpwd");
	        exit();
		}
	} else {
		// echo 'Incorrect username!';
		$_SESSION['error_inc'] = "Your Username/Password is incorrect";
		header("Location:index.php?error=wrongusername");
		exit();
	}


		$stmt->close();
	}


} else { 
  	header("Location:index.php");
  	exit();
  }
?>
