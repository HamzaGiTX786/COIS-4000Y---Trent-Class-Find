<?php
include 'includes/library.php';

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


$errors = array(); //declare empty array to add errors too
$Start_Node = $_POST['Start_Node'] ?? null;
$End_Node = $_POST['End_Node'] ?? null;
$Description= $_POST['Description'] ?? null;
$Distance= $_POST['Distance'] ?? null;

$tempname = array();
$filename = array();

$direx = explode('/', getcwd());
define('WEBROOT', "/$direx[1]/$direx[2]/$direx[3]/"); //home/username/public_html
$folder = WEBROOT."www_data/img/";

if (isset($_POST['submit']))
{

    if (!isset($Start_Node) || strlen($Start_Node) === 0)
    {
        $errors['Start_Node'] = true;
    }
    if (!isset($End_Node) || strlen($End_Node) === 0)
    {
        $errors['End_Node'] = true;
    }
    if($End_Node == $Start_Node)
    {
        $errors['same'] = true;
    }
    if (!isset($Distance) || strlen($Distance) === 0)
    {
        $errors['Distance'] = true;
    }
    if (!isset($Description) || strlen($Description) === 0)
    {
        $errors['Description'] = true;
    }


    if(count($errors)===0) //if no errors are encountered
    {
        for($i =0; $i<sizeof($_FILES['image']['name']); $i++)
        {
            array_push($tempname, $_FILES['image']['tmp_name'][$i]);
            array_push($filename,$_FILES['image']['name'][$i]);
   
            for($j=0;$j<sizeof($filename);$j++)
            {
            $exts = explode(".", $filename[$j]); // split based on period
            $ext = $exts[count($exts)-1]; //take the last split (contents after last period)
        
            $filename[$j]= substr($tempname[$j], strrpos($tempname[$j], '/') + 1).".".$ext;
            }
   
        }

    $images = implode(",",$filename);

    $query = "INSERT INTO Edge VALUES(NULL,?,?,?,?,?)"; //select the row of the table with the given username
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        echo "SQL prepare failed";
    }else{
    if(!mysqli_stmt_bind_param($stmt,"sssss",$Start_Node,$End_Node,$Description,$Distance,$images)){
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
    <script src="scripts/master.js" crossorigin="anonymous"></script>
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

  
    <form id="create" name="create" method="post"  enctype="multipart/form-data" novalidate>
    <h2>Create Route</h2>
                    <div class="start">
                        <label for="Start_Node">Start Node</label>
                        <select name="Start_Node" id="Start_Node" required>
                            <option value="">Select a Node as the start point</option>
                            <?php foreach($nodes as $node):?>
                                <option value="<?= $node[1];?>"><?= $node[0];?></option>
                            <?php endforeach; ?>
                        </select>
                         <span class="error <?=!isset($errors['Start_Node']) ? 'hidden' : "";?>">Please enter Start Node</span>
                    </div>
                    <div class="end">
                        <label for="End_Node">End Node</label>
                        <select name="End_Node" id="End_Node" required>
                        <option value="">Select a Node as the end point</option>
                        </select>
                         <span class="error <?=!isset($errors['End_Node']) ? 'hidden' : "";?>">Please enter End Node</span> 
                    </div>
                    <div class="start">
                        <label for="Distance">Distance</label>
                        <input type="number" min="0" name="Distance" id="Distance" placeholder="Enter Nodes Distance" value="" required />
                         <span class="error <?=!isset($errors['Distance']) ? 'hidden' : "";?>">Please enter Nodes Distance</span>
                    </div>

                    <div class="start">
                        <label for="Description">Description</label>
                        <textarea name="Description" id="Description" placeholder="Enter the description here" rows="5" cols="33" value="" required></textarea>
                         <span class="error <?=!isset($errors['Description']) ? 'hidden' : "";?>">Please enter a description</span>
                    </div>

                    <div class="start">
                        <label for="image">Image(s)</label>
                        <input type="file" id="image" name="image[]" multiple>
                         <span class="error <?=!isset($errors['image']) ? 'hidden' : "";?>">Please Upload Images</span>

                    </div>

                    <div id="buttons">
                    <button type="submit" name="submit">Create Route</button>
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