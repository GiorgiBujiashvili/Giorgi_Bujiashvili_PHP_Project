<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpproject";

$connection = mysqli_connect($servername, $username, $password, $dbname);


if(!$connection){
    die ("Connection Error");
 }