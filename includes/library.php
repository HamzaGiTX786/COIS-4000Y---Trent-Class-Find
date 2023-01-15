<?php
$servername = "localhost";
$database = "classfind";
$username = "classfind";
$pass = "Classfind@Group8";
// Create connection
$conn = mysqli_connect($servername, $username, $pass, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>