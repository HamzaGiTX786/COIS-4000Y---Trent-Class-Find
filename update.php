<?php
include 'includes/library.php';

if(!isset($_GET['ID'])){
    header("Location: modify");
    die();
}

$node_code = $_GET['ID'];
$innode = false;

if(strstr($node_code,"SELECT") || strstr($node_code, "UPDATE") || strstr($node_code,"DELETE") || strstr($node_code,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT Name,ID FROM Node ORDER BY Name ASC";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$q))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $nodes = mysqli_fetch_all($result); // get output for the searched item
}

foreach($nodes as $n){
    if($node_code == $n[1])
    {
        $innode = true;
    }
}

if($innode === false){
    header("Location: modify");
    die();
}

$query = "SELECT * FROM Node WHERE ID = ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    if(!mysqli_stmt_bind_param($stmt,"s",$node_code)){
        echo "bind failed"; 
    } 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result); // get output for the searched item
}


$oldID = $row['ID']; 
$ID = $_POST['newID'] ?? null; 
$Location = $_POST['Location'] ?? null;
$Name=$_POST['Name'] ?? null;
$Building_code=$_POST['Building_code'] ?? null;
$Neighbours=$_POST['Neighbours'] ?? null;


if(isset($_POST['submit'])){

    $NeighbourNodes = implode(",",$Neighbours);
    $json=json_encode($NeighbourNodes); 

$query = "UPDATE Node SET ID=?,Location=?,Name=?,Building_code=?,Neighbours=? WHERE ID=?"; //select the row of the table with the given username
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}else{
if(!mysqli_stmt_bind_param($stmt,"ssssss",$ID,$Location,$Name,$Building_code,$json,$oldID)){
    echo "bind failed";
}
if(!mysqli_stmt_execute($stmt)){
    echo "exec failed";
}
}
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/master.css"/>
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
    <div>
        <?php if(isset($message)) { echo $message; } ?>
    </div>
    
    <form name="updatenode" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <h2>Update Node</h2>
        <div class="start">
        <a href="modify.php">Modify List</a>    
        <a href="delete.php?nodeID=<?php echo $row['ID']; ?>">Delete Node</a>
        </div>

    <div class="start">
    <label for="newID">ID:</label>
    <input type="hidden" name="newID" class="txtField" value="<?php echo $row['ID']; ?>">
    <input type="text" name="newID"  value="<?php echo $row['ID']; ?>"> 
    </div>

    <div class="start">
    <label for="Location">Location:</label>
    <input type="text" name="Location" class="txtField" value="<?php echo $row['Location']; ?>">
    </div>

    <div class="start">
    <label for="Name">Name:</label>
    <input type="text" name="Name" class="txtField" value="<?php echo $row['Name']; ?>">
    </div>

    <div class="start">
    <label for="Building_code">Building code:</label>
    <input type="text" name="Building_code" class="txtField" value="<?php echo $row['Building_code']; ?>">
    </div>

    <div class="start">
    <label for="Neighbours">Neighbours:</label>
        <?php foreach($nodes as $node):?>
            <div id="noderesult">
                <input type="checkbox" name="Neighbours[]" id="Neighbours" placeholder="Enter Node Neighbours" value="<?=$node[1];?>" <?= !in_array($node[1], explode(",",json_decode($row['Neighbours']))) ? "" : "checked" ;?>>
                <label for="Neighbours"><?= $node[0];?></label>
            </div>
                <?php endforeach; ?>
        <span class="error <?=!isset($errors['Neighbours']) ? 'hidden' : "";?>">Please enter Node Neighbours ID</span>
    </div>

    <div id="buttons">    
    <button type="submit" name="submit">Update Node</button>
    </div>

</form>
</main>
    </div>
<?php include "includes/footer.php"; ?>
</body>
</html>