<?php

include 'includes/library.php';

if(!isset($_GET['build_ID'])){
    header("Location: modify");
    die();
}

$buildID = $_GET['build_ID'];
$inbuild = false;

if(strstr($buildID,"SELECT") || strstr($buildID, "UPDATE") || strstr($buildID,"DELETE") || strstr($buildID,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT Code FROM Buildings";
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

foreach($check as $c){
    if(!in_array($buildID,$c)){
        $inbuild = true;
    }
}

if($inbuild === false){
    header("Location: modify");
    die();
}

$query = "DELETE FROM Buildings WHERE Code =?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"s",$buildID)){
    echo "bind failed";
}
if(!mysqli_stmt_execute($stmt)){
    echo "exec failed";
}

header("Location: admin");
}

?>