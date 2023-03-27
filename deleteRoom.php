<?php

include 'includes/library.php';

if(!isset($_GET['room_ID'])){
    header("Location: modify");
    die();
}

$roomID = $_GET['room_ID'];
$inroom = false;

if(strstr($roomID,"SELECT") || strstr($roomID, "UPDATE") || strstr($roomID,"DELETE") || strstr($roomID,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT RoomCode FROM Room";
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
    if(in_array($roomID,$c)){
        $inroom = true;
    }
}

if($inroom === false){
    header("Location: modify");
    die();
}

$query = "DELETE FROM Room WHERE RoomCode =?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"s",$roomID)){
    echo "bind failed";
}
if(!mysqli_stmt_execute($stmt)){
    echo "exec failed";
}

header("Location: admin");
}

?>