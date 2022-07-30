<?php
session_start();

$get_img_id = $_POST['image_id'];

$_SESSION['session_img_id'] = $get_img_id;

$session_img_id = $_SESSION['session_img_id'];

header("Location:../../edit_img.php");
?>