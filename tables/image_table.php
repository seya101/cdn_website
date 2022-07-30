<?php

    $session_img_id = $_SESSION['session_img_id'];
    $img_id  = $session_img_id;

	$sql = "SELECT * FROM images WHERE id ='$img_id';";

	$results = mysqli_query($con, $sql);

	if ($row = mysqli_fetch_assoc($results)) {

		$_SESSION['id'] = $row['id'];

		$_SESSION['img_name'] = $row['name'];

		$_SESSION['image'] = $row['image'];

		$_SESSION['author'] = $row['author'];

		$_SESSION['title'] = $row['title'];

		$_SESSION['description'] = $row['description'];

		$_SESSION['dateUploaded'] = $row['dateUploaded'];

	}
?>