<?php

if(!isset($_GET['oldID'])){
    header("Location: modify");
    die();
}

include 'library.php';


$oldID = $_GET['oldID'];

if(strstr($oldID,"SELECT") || strstr($oldID, "UPDATE") || strstr($oldID,"DELETE") || strstr($oldID,"DROP"))
{
    header("Location: modify");
    die();
}

$query = "SELECT Image FROM Room WHERE RoomCode = ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    if(!mysqli_stmt_bind_param($stmt,"s",$oldID)){
        echo "bind failed"; 
    } 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $images = mysqli_fetch_assoc($result); // get output for the searched item
}

$images = json_encode($images);

echo $images;

?>