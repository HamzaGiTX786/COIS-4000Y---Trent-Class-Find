<?php
include 'includes/library.php';

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

$result = mysqli_query($conn,"SELECT * FROM Buildings WHERE Code='" . $_GET['ID'] . "'");
$row= mysqli_fetch_array($result);

$oldID = $row['Code']; 
$ID = $_POST['new_code'] ?? null; 
$Name = $_POST['Name'] ?? null;
$numroom = $_POST['No_of_rooms'] ?? null;
$geo= $_POST['Geo-location'] ?? null;


if(isset($_POST['submit'])){
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

        <form name="updatebuilding" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">

        <div class="start">
        <a href="modify.php">Modify List</a>    
        <a href="deleteBuilding.php?userid=<?php echo $_GET['ID']; ?>">Delete</a>
        </div>

        <div class="start">
        <label for="new_code">Code:</label>
        <input type="text" name="new_code" id="new_code" value="<?php echo $row['Code']; ?>">
        </div>

        <div class="start">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo $row['Name']; ?>">
        </div>

        <div class="start">
        <label for="No_of_rooms">Number of Rooms:</label>
        <input type="number" name="No_of_rooms" value="<?php echo $row['No_of_rooms']; ?>">
        </div>

        <div class="start">
        <label for="Geo-location">Geo-location:</label>
        <input type="text" name="Geo-location" value="<?php echo ($row['Geo_location']); ?>">
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