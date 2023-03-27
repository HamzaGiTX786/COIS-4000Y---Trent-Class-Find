<?php
include 'includes/library.php';

$q = "SELECT Name,Code FROM Buildings ORDER BY Name ASC";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt,$q))
{
    echo "SQL prepare failed";
}
else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $build = mysqli_fetch_all($result); // get output for the searched item
}

$errors = array(); //declare empty array to add errors too

$Building_Name = $_POST['Building_Name'] ?? null;
$RoomCode = $_POST['Room_Code'] ?? null;
$Name = $_POST['Room_Name'] ?? null;
$Type= $_POST['Room_Type'] ?? null;
 
if (isset($_POST['submit'])) 
{ //only do this code if the form has been submitted

    if (!isset($Building_Name) || strlen($Building_Name) === 0) 
    {
        $errors['Building_Name'] = true;
    }
    if (!isset($Name) || strlen($Name) === 0) 
    {
        $errors['Room_Name'] = true;
    }
    if (!isset($Type) || strlen($Type) === 0) 
    {
        $errors['Room_Type'] = true;
    }
    if (!isset($RoomCode) || strlen($RoomCode) === 0) 
    {
        $errors['Room_Type'] = true;
    }
    if(sizeof($_FILES) <= 0){
        $errors['image'] = true;
    }

    if(count($errors)===0) //if no errors are encountered
    {

    $tempname =array();
    $filename = array();

    $direx = explode('/', getcwd());
    define('WEBROOT', "/$direx[1]/$direx[2]/$direx[3]/"); //home/username/public_html
    $folder = WEBROOT."www_data/img/";


    for($i =0; $i<sizeof($_FILES['roomimage']['name']); $i++)
    {
        array_push($tempname, $_FILES['roomimage']['tmp_name'][$i]);
        array_push($filename,$_FILES['roomimage']['name'][$i]);

        for($j=0;$j<sizeof($filename);$j++)
        {
        $exts = explode(".", $filename[$j]); // split based on period
        $ext = $exts[count($exts)-1]; //take the last split (contents after last period)
    
        $filename[$j]= substr($tempname[$j], strrpos($tempname[$j], '/') + 1).".".$ext;
        }

    }

        $roomimages = implode(",",$filename);
   
    $query = "INSERT INTO Room VALUES(?,?,?,?,?)"; //select the row of the table with the given username
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        echo "SQL prepare failed";
    }else{
    if(!mysqli_stmt_bind_param($stmt,"sssss",$RoomCode,$Name,$Building_Name,$Type,$roomimages)){
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

           header("Location: admin");

    }
}
 

}

?> 

<!DOCTYPE html>
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
    <a href="index.html"><?php
        include 'includes/header.php';
    ?></a>
    <div class="navmain">
    <?php
        include 'includes/nav.php';
    ?>
    
    <main>
        
   
    <form id="create" name="create" method="post" enctype="multipart/form-data" novalidate>
    <h2>Create Room</h2>
    
                    <div class="start">
                        <label for="Building_Name">Building Name</label>
                        <select name="Building_Name" id="Building_Name">
                        <option value="">Pick a Building the room belongs to</option>
                        <?php foreach($build as $build_info): ?>
                            <option value="<?=$build_info[1]?>"><?=$build_info[0]?></option>
                        <?php endforeach; ?>
                        </select>
                         <span class="error <?=!isset($errors['Building_Name']) ? 'hidden' : "";?>">Please select the Building the room belongs to </span>
                    </div>

                    <div class="start">
                        <label for="Room_Code">Room Code</label>
                        <input type="text" name="Room_Code" id="Room_Code" placeholder="Enter the room code" value="" required/>
                        <span class="error <?=!isset($errors['Room_Name']) ? 'hidden' : "";?>">Please enter Room Code</span>
                    </div>
                    
                    <div class="start">
                        <label for="Room_Name">Room Name</label>
                        <input type="text" name="Room_Name" id="Room_Name" placeholder="Enter Room Name" value="" required />
                         <span class="error <?=!isset($errors['Room_Name']) ? 'hidden' : "";?>">Please enter Room Name</span>
                    </div>

                    <div class="start">
                        <label for="Room_Type">Type of room</label>
                        <select name="Room_Type" id="Room_Type">
                            <option value="">Please select the type of room</option>
                            <option value="Seminar">Seminar Room</option>
                            <option value="Lecture">Lecture Hall</option>
                            <option value="Study">Individual Study Room</option>
                            <option value="Group">Group Study Room</option>
                            <option value="Commons">College Commons</option>
                        </select>
                         <span class="error <?=!isset($errors['Room_Type']) ? 'hidden' : "";?>">Please select a Type for the room</span>
                    </div>

                    <div class="start">
                    <label for="roomimage">Image(s)</label>
                        <input type="file" id="roomimage" name="roomimage[]" multiple>
                         <span class="error <?=!isset($errors['roomimage']) ? 'hidden' : "";?>">Please Upload Images</span>
                    </div>

                    <div id="buttons">    
                    <button type="submit" name="submit">Create Room</button>
                    </div>
    </form> 

    </main>
    </div>
    <footer>
        <?php
    include 'includes/footer.php';
    ?>
    </footer> 
    </body>

</html>