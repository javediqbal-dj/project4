<?php
$servername = "localhost";
$username = "root";
$password = "9090";
$database = "users";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("error". mysqli_connect_error());
}

?>