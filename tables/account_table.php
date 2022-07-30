<?php
	$sql = "SELECT * FROM accounts";

	$results = mysqli_query($con, $sql);
	if ($row = mysqli_fetch_assoc($results)) {
		$_SESSION['user'] = $row['username'];
	}
?>