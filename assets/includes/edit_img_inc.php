<?php

ob_start();

    // If button is submit
    if(isset($_POST['edit_upload'])) { 

      $img_title = $_POST["title"];
      $img_description = $_POST["description"];

        $query = "UPDATE images SET title = '$img_title' , description = '$img_description' WHERE id ='$img_id';";

        mysqli_query($con,$query) or die(mysqli_error($con));  

        echo '
            <script>
            swal({
                title:"Success!",
                text: "Image information has been updated",
                icon: "success" });
            </script>
          ';

    } //END FOR BUTTON IS SUBMIT
?>