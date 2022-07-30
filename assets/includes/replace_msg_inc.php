<?php

if (isset($_SESSION['replace_success'])) { 
echo '
    <script>
    swal({
        title:"Success!",
        text: "Image had been replaced",
        icon: "success" }).then(function(){ 
           location.reload();
           }
        );
    </script>
  ';
unset($_SESSION['replace_success']);

} elseif (isset($_SESSION['replace_error'])) {
  echo '
    <script>
    swal({
        title:"Something Wrong!",
        text: "Image not uploaded",
        icon: "error" }).then(function(){ 
           location.reload();
           }
        );
    </script>
  ';
  unset($_SESSION['replace_error']);

} elseif (isset($_SESSION['replace_moving_file'])) {
  echo '
      <script>
      swal({
          title:"Moving File Error!",
          text: "Please ask for developer assistance",
          icon: "error" }).then(function(){ 
           location.reload();
           }
        );
      </script>
    ';
  unset($_SESSION['replace_moving_file']);

} elseif (isset($_SESSION['replace_not_img'])) {
  echo '
      <script>
      swal({
          title:"Opss!",
          text: "Only .jpg/jpeg, .png and gif image file allowed to upload",
          icon: "error" }).then(function(){ 
           location.reload();
           }
        );
      </script>
    ';
  unset($_SESSION['replace_not_img']);

} elseif (isset($_SESSION['replace_empty'])) {
  echo '
      <script>
      swal({
          title:"Opss!",
          text: "Please select Image",
          icon: "error" }).then(function(){ 
           location.reload();
           }
        );
      </script>
    ';
  unset($_SESSION['replace_empty']);

}