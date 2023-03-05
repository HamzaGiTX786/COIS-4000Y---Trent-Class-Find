<?php

if(!isset($_GET['build_code'])){
    die();
}

include 'includes/library.php';

$sql = "SELECT ID,Name FROM Room WHERE Building_code =?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$sql))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_bind_param($stmt,"s",$_GET['build_code']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rooms = mysqli_fetch_all($result); // get output for the searched item
}

echo json_encode($rooms);

?>