<?php
include 'includes/library.php';

if(!isset($_POST['submit'])){

if(!isset($_GET['Room_Code'])){
    header("Location: modify");
    die();
}

$room_code = $_GET['Room_Code'];
$inroom = false;

if(strstr($room_code,"SELECT") || strstr($room_code, "UPDATE") || strstr($room_code,"DELETE") || strstr($room_code,"DROP"))
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
    $rooms = mysqli_fetch_all($result); // get output for the searched item
}

foreach($rooms as $r){
    if($room_code == $r[0])
    {
        $inroom = true;
    }
}

if($inroom === false){
    header("Location: modify");
    die();
}

$query= "SELECT Code,Name FROM Buildings";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_execute($stmt);
    $result_build = mysqli_stmt_get_result($stmt);
    $buildings = mysqli_fetch_all($result_build); // get output for the searched item
}

$query = "SELECT * FROM Room WHERE RoomCode= ?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$query))
{
    echo "SQL prepare failed";
}
else{
    if(!mysqli_stmt_bind_param($stmt,"s",$room_code)){
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
$Building_code = $_POST['Building_code'] ?? null;
$Name = $_POST['Name'] ?? null;
$Type= $_POST['Type'] ?? null;

if (!isset($oldID) || strlen($oldID) === 0) // make sure a username was entered
{
    header("Location: modify");
    die();
}

if (!isset($ID) || strlen($ID) === 0) // make sure a username was entered
{
    $errors['ID'] = true;
}

if (!isset($Building_code) || strlen($Building_code) === 0) // make sure a username was entered
{
    $errors['Building_code'] = true;
}

if (!isset($Name) || strlen($Name) === 0) // make sure a username was entered
{
    $errors['Name'] = true;
}

if (!isset($Type) || strlen($Type) === 0) // make sure a username was entered
{
    $errors['Type'] = true;
}

if(isset($_FILES["updateroomimage"]) && count($errors) === 0 ){

        $tempname = array();
        $filename = array();

        $direx = explode('/', getcwd());
        define('WEBROOT', "/$direx[1]/$direx[2]/$direx[3]/"); //home/username/public_html
        $folder = WEBROOT."www_data/img/";

            for($i =0; $i<sizeof($_FILES['updateroomimage']['name']); $i++)
                {
                    array_push($tempname, $_FILES['updateroomimage']['tmp_name'][$i]);
                    array_push($filename,$_FILES['updateroomimage']['name'][$i]);
        
                    for($j=0;$j<sizeof($filename);$j++)
                    {
                    $exts = explode(".", $filename[$j]); // split based on period
                    $ext = $exts[count($exts)-1]; //take the last split (contents after last period)
                
                    $filename[$j]= substr($tempname[$j], strrpos($tempname[$j], '/') + 1).".".$ext;
                    }
        
                }

            $images = implode(",",$filename);

            $q = "SELECT Image FROM Room WHERE RoomCode=?";
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

        $query = "UPDATE Room SET RoomCode=?,Building_code=?,Name=?,Type=?,Image=? WHERE RoomCode=?"; //select the row of the table with the given username
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$query))
        {
            echo "SQL prepare failed";
        }else{
        if(!mysqli_stmt_bind_param($stmt,"ssssss",$ID,$Building_code,$Name,$Type,$img['Image'],$oldID)){
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

else if(count($errors) === 0){
        $query = "UPDATE Room SET RoomCode=?,Building_code=?,Name=?,Type=? WHERE RoomCode=?"; //select the row of the table with the given username
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$query))
        {
            echo "SQL prepare failed";
        }else{
        if(!mysqli_stmt_bind_param($stmt,"sssss",$ID,$Building_code,$Name,$Type,$oldID)){
            echo "bind failed";
        }
        if(!mysqli_stmt_execute($stmt)){
            echo "exec failed";
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
    <script src="scripts/update_room_script.js" crossorigin="anonymous"></script>
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
<form name="updateroom" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']?>">
<h2>Update Room</h2>
        <div>
            <?php if(isset($message)) { echo $message; } ?> 
        </div>

        <div>
        <a href="modify.php">Modify List</a>    
        <a href="deleteRoom.php?room_ID=<?php echo  $row['RoomCode']; ?>">Delete</a>
        </div>

        <div class="start">
        <label for="newID">Room Code:</label>
        <input type="text" name="newID"  value="<?php echo $row['RoomCode']; ?>">
        <input type="text" class="hidden" name="oldID"  value="<?= $row['RoomCode']; ?>">
        </div>


        <div class="start">
        <label for="Building_code">Building_code:</label>
        <select name="Building_code" id="Building_code" value="<?= $row['Building_code'];?>" required>
            <option value="<?=$row['Building_code']?>"><?php foreach($buildings as $build){if(in_array($row['Building_code'],$build)){ echo $build[1];}}?></option>
            <?php foreach($buildings as $build): ?>
            <option value="<?=$build[0]?>"><?=$build[1]?></option>
        <?php endforeach; ?>
        </select>
        </div>


        <div class="start">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?php echo $row['Name']; ?>">
        </div>


        <div class="start">
        <label for="Type">Type:</label>
        <select name="Type" id="Type">
            <option value="<?= $row['Type']?>"><?php switch($row['Type']){case "Seminar": echo "Seminar Room"; break; case "Lecture": echo "Lecture Hall"; break; case "Study": echo "Individual Study Room"; break; case "Group": echo "Group Study Room"; break; case "Commons": echo "College Commons"; break;} ?></option>
            <option value="Seminar">Seminar Room</option>
            <option value="Lecture">Lecture Hall</option>
            <option value="Study">Individual Study Room</option>
            <option value="Group">Group Study Room</option>
            <option value="Commons">College Commons</option>
        </select>
        </div>

        <div class="start">
            <label for="room_images">Image(s)</label>
            <?php $images = explode(",", $row['Image']);?>
        <ol>
         <?php foreach($images as $i):    
             if($i != " "):?> 
            <li>
                <div>
                    <?= $i;?>
                </div>
                <div class="trash">
                    <i class="fa-solid fa-trash"></i>
                </div>
            </li>
            <?php else: ?>
                <li>
                    <div id="add">
                    <i class="fa-solid fa-square-plus"></i>
                    </div>
                </li>
            <?php endif;
                endforeach; ?>
        </ol>
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