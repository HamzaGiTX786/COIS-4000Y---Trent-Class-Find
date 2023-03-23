<?php

if(!isset($_GET['newimgs']) && !isset($_GET['oldID'])){
    header("Location: modify");
    die();
}

include 'library.php';

$newimgs = $_GET['newimgs'];
$oldID = $_GET['oldID'];

if(strstr($newimgs,"SELECT") || strstr($newimgs, "UPDATE") || strstr($newimgs,"DELETE") || strstr($newimgs,"DROP") || strstr($oldID,"SELECT") || strstr($oldID, "UPDATE") || strstr($oldID,"DELETE") || strstr($oldID,"DROP"))
{
    header("Location: modify");
    die();
}

$query = "UPDATE Edge SET Image=? WHERE ID=?"; //select the row of the table with the given username
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"ss",$newimgs,$oldID)){
    echo "bind failed";
}
if(!mysqli_stmt_execute($stmt)){
    echo "exec failed";
}
}

echo "Update Sucessfull";
?>