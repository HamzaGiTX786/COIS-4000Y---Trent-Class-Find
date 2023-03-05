<?php

if(!isset($_GET['start']))
{
    die();
}

include 'library.php';

$start_node = $_GET['start'];

$array = array();

$query = "SELECT Neighbours FROM Node WHERE ID = ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_bind_param($stmt,"s",$start_node);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $neighbours = mysqli_fetch_all($result); // get output for the searched item
}

foreach($neighbours as $neighbour)
{
   $neighbour[0] = str_replace('"',"",$neighbour[0]);
    $neighbours_array = explode(",",$neighbour[0]);

    foreach($neighbours_array as $na){
        $q = "SELECT ID,Name FROM Node WHERE ID = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$q))
        {
            echo "SQL prepare failed";
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$na);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $node_names = mysqli_fetch_all($result); // get output for the searched item
        }

        
        foreach($node_names as $node)
        {
            array_push($array,$node);
        }
            }
     
}

echo json_encode($array);

?>