<?php
$servername = "localhost";
$database = "classfind";
$username = "classfind";
$pass = "Group8@Classfind";
// Create connection
$conn = mysqli_connect($servername, $username, $pass, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>