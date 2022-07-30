<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8">

        <!-- Bootstrap CDN-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css">

        <link href="css/style.css" rel="stylesheet" type="text/css">

        <script src="js/jquery.js"></script>

        <style type="text/css">
        	img:hover {
				opacity: 0.5;
				cursor: pointer;
			}
			
        </style>

    </head>
    <body>

<?php

if(isset($_POST["limit"], $_POST["start"])) {



	// Database

 	include 'config.php';

 	$query = "SELECT * FROM images ORDER BY id DESC LIMIT ".$_POST["start"].", ".$_POST["limit"]."";

 	$result = mysqli_query($con, $query);

 		if(mysqli_num_rows($result) > 0) {

			while($row = mysqli_fetch_array($result))

			{

				echo '<div class="cdnImage">';

				echo '<form action="assets/includes/session_img_id.php" method="POST">';

				echo "<button role='button' type='submit' style='border: none;background: none;width:100%;heigth:auto;'>";

				echo "<img src='images/".$row['name']."'>";

				echo "<input type='hidden' value=".$row['id']." name='image_id'>";

				echo "<input type='hidden' value=".$row['name']." name='image_name'>";

				echo '</button>';

				echo "<p class='truncate'>".$row['name']."</p>";

				

				echo "</form>";
				
				echo "<button class='btn-url' data-clipboard-text='https://hub-10.net/cdn/images/".$row['name']."'><i class='far fa-copy'></i>&nbsp;Copy URL</button>";

				echo '</div>'; 

			}

		} 

} else {

			echo '<h1 class="text-danger text-center" style="margin:60px 0px 60px 0px;font-size:50px;text-align:center;">No Results</h1>';

		}

?>

<!-- BOOTSTRAP & JQUERY JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>
