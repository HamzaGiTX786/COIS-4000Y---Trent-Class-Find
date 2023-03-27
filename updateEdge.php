<?php
include 'includes/library.php';

if(!isset($_POST['submit'])){
    
if(!isset($_GET['start_node']) || !isset($_GET['end_node'])){
    header("Location: modify");
    die();
}

$Start_Node = $_GET['start_node'];
$End_Node = $_GET['end_node'];
$inedge = false;

if(strstr($Start_Node,"SELECT") || strstr($Start_Node, "UPDATE") || strstr($Start_Node,"DELETE") || strstr($Start_Node,"DROP") || strstr($End_Node,"SELECT") || strstr($End_Node, "UPDATE") || strstr($End_Node,"DELETE") || strstr($End_Node,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT Start_Node,End_Node FROM Edge";
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
    if($Start_Node == $c[0] && $End_Node == $c[1])
    {
        $inedge = true;
    }
}

if($inedge === false){
    header("Location: modify");
    die();
}

$query = "SELECT * FROM Edge WHERE Start_Node = ? AND End_Node = ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    if(!mysqli_stmt_bind_param($stmt,"ss",$Start_Node,$End_Node)){
        echo "bind failed"; 
    } 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result); // get output for the searched item
}
}
else{

$oldID = $_POST['oldID'];
$ID = $_POST['newID'] ?? null; 
$Start_Node = $_POST['Start_Node'] ?? null;
$End_Node = $_POST['End_Node'] ?? null;
$Description= $_POST['Description'] ?? null;
$Distance= $_POST['Distance'] ?? null; 


$tempname = array();
$filename = array();

$direx = explode('/', getcwd());
define('WEBROOT', "/$direx[1]/$direx[2]/$direx[3]/"); //home/username/public_html
$folder = WEBROOT."www_data/img/";

    for($i =0; $i<sizeof($_FILES['updateimage']['name']); $i++)
        {
            array_push($tempname, $_FILES['updateimage']['tmp_name'][$i]);
            array_push($filename,$_FILES['updateimage']['name'][$i]);
   
            for($j=0;$j<sizeof($filename);$j++)
            {
            $exts = explode(".", $filename[$j]); // split based on period
            $ext = $exts[count($exts)-1]; //take the last split (contents after last period)
        
            $filename[$j]= substr($tempname[$j], strrpos($tempname[$j], '/') + 1).".".$ext;
            }
   
        }

    $images = implode(",",$filename);

    $q = "SELECT Image FROM Edge WHERE ID=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$q))
    {
        echo "SQL prepare failed";
    }
    else{
        if(!mysqli_stmt_bind_param($stmt,"s",$oldID)){
            echo "bind failed"; 
        } 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $img = mysqli_fetch_assoc($result); // get output for the searched item
    }

   $img['Image'] = str_replace(" ",$images,$img['Image']);


    $query = "UPDATE Edge SET ID=?,Start_Node=?,End_Node=?,Description=?,Distance=?,Image=? WHERE ID=?"; //select the row of the table with the given username
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$query))
    {
        echo "SQL prepare failed";
    }else{
    if(!mysqli_stmt_bind_param($stmt,"sssssss",$ID,$Start_Node,$End_Node,$Description,$Distance,$img['Image'],$oldID)){
        echo "bind failed";
    }
    if(!mysqli_stmt_execute($stmt)){
        echo "exec failed";
    }

    for($k = 0; $k<sizeof($tempname);$k++){

        if(move_uploaded_file($tempname[$k],$folder.$filename[$k]))
       {
          //do nothing
       }
       else{
           echo "Image upload error";
           die();
       }
    }
    
    header("Location: modify");
    }

}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/master.css"/>
    <script src="scripts/master.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e156dbae2b.js" crossorigin="anonymous"></script>

    <title>Admin Backend:Trent Class Find</title>
</head>
<body>
<a href="index.php"><?php
        include 'includes/header.php';
    ?></a>
<div class="navmain">
    <?php
        include 'includes/nav.php';
    ?>
    <main>
    <form name="updateEdge" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>">

    <div>
        <?php if(isset($message)) { echo $message; } ?>
    </div>

    <div class="start">
    <a href="modify.php">Modify List</a>    
    <a href="deleteEdge.php?userid=<?php echo $row['ID'] ?>">Delete</a>
    </div>

    <div class="start">
    <label for="newID">New ID:</label>
    <input type="text" name="newID"  value="<?php echo $row['ID']; ?>">
    <input type="text" class="hidden" name="oldID"  value="<?= $row['ID']; ?>">
    </div>


    <div class="start">
    <label for="Start_Node">Start Node:</label>
    <input type="text" name="Start_Node" value="<?php echo $row['Start_Node']; ?>">
    </div>


    <div class="start">
    <label for="End_Node">End Node:</label>
    <input type="text" name="End_Node" value="<?php echo $row['End_Node']; ?>">
    </div>


    <div class="start">
    <label for="">Description:</label>
    <textarea name="Description" ><?php echo $row['Description'];?></textarea>
    </div>


    <div class="start">
    <label for="Distance">Distance:</label>
    <input type="number" name="Distance" value="<?php echo $row['Distance']; //try jsondecode the row first ?>">
    </div>

    <div class="start">
        <label for="image">Images:</label>
        <?php $images = explode(",", $row['Image']);?>
        <ol>
         <?php foreach($images as $i): ?> 
            <li>
                <div>
                    <?= $i;?>
                </div>
                <div class="trash">
                    <i class="fa-solid fa-trash"></i>
                </div>
            </li>
        <?php endforeach; ?>
        </ol>
    </div>

    <div id="buttons">    
        <button type="submit" name="submit">Update Edge</button>
    </div>

    </form>
    </main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>