<?php

if(!isset($_GET['newimgs']) && !isset($_GET['oldID']) && !isset($_GET['delete'])){
    header("Location: modify");
    die();
}

include 'library.php';

$newimgs = $_GET['newimgs'];
$oldID = $_GET['oldID'];
$del = $_GET['delete'];

if(strstr($newimgs,"SELECT") || strstr($newimgs, "UPDATE") || strstr($newimgs,"DELETE") || strstr($newimgs,"DROP") || strstr($oldID,"SELECT") || strstr($oldID, "UPDATE") || strstr($oldID,"DELETE") || strstr($oldID,"DROP")|| strstr($del,"SELECT") || strstr($del, "UPDATE") || strstr($del,"DELETE") || strstr($del,"DROP"))
{
    header("Location: modify");
    die();
}

$direx = explode('/', getcwd());
define('WEBROOT', "/$direx[1]/$direx[2]/$direx[3]/"); //home/username/public_html
$folder = WEBROOT."www_data/img/";

if(!unlink($folder.$del))
{
    echo "Error del";
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