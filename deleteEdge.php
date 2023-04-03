<?php

include 'includes/library.php';

if(!isset($_GET['ID'])){
    header("Location: modify");
    die();
}

$ID = $_GET['ID'];
$inedge = false;

if(strstr($ID,"SELECT") || strstr($ID, "UPDATE") || strstr($ID,"DELETE") || strstr($ID,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT ID FROM Edge";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$q))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $check = mysqli_fetch_all($result); // get output for the searched item
}

foreach($check as $e){
    if(!in_array($ID,$e)){
        $inedge = true;
    }
}

if($inedge === false){
    header("Location: modify");
    die();
}

$query = "DELETE FROM Edge WHERE ID =?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"s",$ID)){
    echo "bind failed";
}
if(!mysqli_stmt_execute($stmt)){
    echo "exec failed";
}

header("Location: admin");
}
?>