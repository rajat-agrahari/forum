<?php
// To connect database

$servername = "localhost";
$username = "root";
$password ="";
$database = "idiscuss";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Fail to connect:" . mysqli_connect_error());
}
?>