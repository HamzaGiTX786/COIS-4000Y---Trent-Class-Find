<?php

include 'includes/library.php';

if(!isset($_GET['nodeID'])){
    header("Location: modify");
    die();
}

$nodeID = $_GET['nodeID'];
$innode = false;

if(strstr($nodeID,"SELECT") || strstr($nodeID, "UPDATE") || strstr($nodeID,"DELETE") || strstr($nodeID,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT ID FROM Node";
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
    if(!in_array($nodeID,$c)){
        $innode = true;
    }
}

if($innode === false){
    header("Location: modify");
    die();
}

$query = "DELETE FROM Node WHERE ID =?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"s",$nodeID)){
    echo "bind failed";
}
if(!mysqli_stmt_execute($stmt)){
    echo "exec failed";
}

header("Location: admin");
}

?>