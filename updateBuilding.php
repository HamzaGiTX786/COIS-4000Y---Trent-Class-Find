<?php
include 'includes/library.php';

if(!isset($_POST['submit'])){

if(!isset($_GET['ID'])){
    header("Location: modify");
    die();
}

$building_code = $_GET['ID'];
$inbuild = false;

if(strstr($building_code,"SELECT") || strstr($building_code, "UPDATE") || strstr($building_code,"DELETE") || strstr($building_code,"DROP"))
{
    header("Location: modify");
    die();
}

$q = "SELECT Code FROM Buildings ORDER BY Name ASC";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$q))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $build_code = mysqli_fetch_all($result); // get output for the searched item
}

foreach($build_code as $b){
    if($building_code == $b[0])
    {
        $inbuild = true;
    }
}

if($inbuild === false){
    header("Location: modify");
    die();
}

$query = "SELECT * FROM Buildings WHERE Code = ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    if(!mysqli_stmt_bind_param($stmt,"s",$building_code)){
        echo "bind failed"; 
    } 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result); // get output for the searched item
}
}
else{
$errors  = array();
$oldID = $row['Code']; 
$ID = $_POST['new_code'] ?? null; 
$Name = $_POST['Name'] ?? null;
$numroom = $_POST['No_of_rooms'] ?? null;
$geo= $_POST['Geo-location'] ?? null;

    if (!isset($oldID) || strlen($oldID) === 0) // make sure a username was entered
    {
        $errors['oldID'] = true;
    }

    if (!isset($ID) || strlen($ID) === 0) // make sure a username was entered
    {
        $errors['ID'] = true;
    }

    if (!isset($Name) || strlen($Name) === 0) // make sure a username was entered
    {
        $errors['Name'] = true;
    }

    if (!isset($numroom) || strlen($numroom) === 0 || $numroom < 0) // make sure a username was entered
    {
        $errors['numroom'] = true;
    }

    if (!isset($geo) || strlen($geo) === 0) // make sure a username was entered
    {
        $errors['geo'] = true;
    }

    if(count($errors) === 0){

        $query = "UPDATE Buildings SET Code=?,Name=?,No_of_rooms=?,Geo_location=? WHERE Code=?"; //select the row of the table with the given username
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
            echo "SQL prepare failed";
        }else{
        if(!mysqli_stmt_bind_param($stmt,"sssss",$ID,$Name,$numroom,$geo,$oldID)){
            echo "bind failed";
        }
        if(!mysqli_stmt_execute($stmt)){
            echo "exec failed";
        }else{
            header("Location: modify");
            }
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

        <form name="updatebuilding" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        
        <h2>Update Building</h2>

        <div class="action start">
        <a href="modify.php"><i class="fa-solid fa-pen-to-square"></i>Modify List</a>    
        <a href="deleteBuilding.php?build_ID=<?php echo $row['Code']; ?>"><i class="fa-solid fa-eraser"></i>Delete</a>
        </div>

        <div class="start">
        <label for="new_code">Code:</label>
        <input type="text" name="new_code" id="new_code" value="<?php echo $row['Code']; ?>">
        <span class="error <?=!isset($errors['ID']) ? 'hidden' : "";?>">Please a code for the building</span>
        </div>

        <div class="start">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo $row['Name']; ?>">
        <span class="error <?=!isset($errors['Name']) ? 'hidden' : "";?>">Please a name for the building</span>
        </div>

        <div class="start">
        <label for="No_of_rooms">Number of Rooms:</label>
        <input type="number" name="No_of_rooms" value="<?php echo $row['No_of_rooms']; ?>">
        <span class="error <?=!isset($errors['numroom']) ? 'hidden' : "";?>">Please enter a number greater than 0 for the number of rooms for the bulding contains.</span>
        </div>

        <div class="start">
        <label for="Geo-location">Geo-location:</label>
        <input type="text" name="Geo-location" value="<?php echo ($row['Geo_location']); ?>">
        <span class="error <?=!isset($errors['geo']) ? 'hidden' : "";?>">Please a Geo-Location for the building</span>
        </div>

        <div id="buttons">    
        <button type="submit" name="submit">Update Building</button>
        </div>

        </form>

    </main>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>