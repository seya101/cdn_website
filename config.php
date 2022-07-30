<?php

$DATABASE_HOST = "localhost";    
$DATABASE_USER = "root";           
$DATABASE_PASS = "";        
$DATABASE_NAME = "gif";

// $DATABASE_HOST = 'localhost';
// $DATABASE_USER = 'hub10_pat';
// $DATABASE_PASS = '1ujhuqQUGahx';
// $DATABASE_NAME = 'hub10_cdn';


// Create connection
// $con = mysqli_connect($host, $user, $password,$dbname);
ini_set('memory_limit', '-1'); // or you could use 1G
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

