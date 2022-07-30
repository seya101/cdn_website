<?php	
	// Search

	if(isset($_POST["query"]) || isset($_POST["limit"], $_POST["start"])) {

		// Database

		include 'config.php';

		$search = mysqli_real_escape_string($con, $_POST["query"]);

		$query = "SELECT name FROM images WHERE name LIKE '".$search."%'";

		$result = mysqli_query($con, $query);
		
			if(mysqli_num_rows($result) > 0) {

				while($row = mysqli_fetch_array($result)) {

					echo "<div class='cdnImage'>";

					echo "<img src='images/".$row['name']."'";

					echo "<p class='truncate'>".$row['name']."</p>";

					echo "<button class='btn-url' data-clipboard-text='http://hub-10.net/cdn/images/".$row['name']."'><i class='far fa-copy'></i>&nbsp;Copy URL</button>";

					echo "</div>";

				}

			} else {

			echo '<h1 style="margin:60px 0px 60px 0px;font-size:50px;text-align:center;color:#2f3947;">No Results</h1>';

			}
	}
?>