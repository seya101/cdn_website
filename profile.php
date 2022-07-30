<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

// Database
include 'config.php';

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="loggedin">
		
		<!-- NAV -->
		   <?php 
		       require "assets/template-parts/nav.php";
		   ?>

		<!-- Page Content -->
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?//=$_SESSION['id']?><?//=$password?><input type="text" id="input_user_types_in" value="****************" />
						<input type="hidden" id="value_to_post_back" name="value_to_post_back" value="<?=$password?>" /></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
<script>
	var textInput, hiddenInput;
	window.onload = function() {
	textInput = document.getElementById('input_user_types_in');
	hiddenInput = document.getElementById('value_to_post_back');
	textInput.onfocus = function() {
	this.value = hiddenInput.value;
	};
	textInput.onblur = function() {
	var i;
	hiddenInput.value = this.value;
	this.value = '';
	for (i = 0; i < hiddenInput.value.length; i++) {
	this.value = this.value + '*';
	}
	};
	};
</script>