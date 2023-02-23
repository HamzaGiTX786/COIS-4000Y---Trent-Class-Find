<?php
include 'includes/library.php';

$errors = array(); //declare empty array to add errors too
$Start_Node = $_POST['Start_Node'] ?? null;
$End_Node = $_POST['End_Node'] ?? null;
$Distance= $_POST['Distance'] ?? null;
 
if (isset($_POST['submit'])) 
{ //only do this code if the form has been submitted
    //validate user has entered a first name
     
    $tempname = $_FILES['image']['tmp_name'];
    // hamza file uplaod 
    $direx = explode('/', getcwd());
    define('WEBROOT', "/$direx[1]/$direx[2]/$direx[3]/"); //home/username/public_html
    $folder = WEBROOT."www_data/img/";
    var_dump($direx); 
    echo "    ||   "; 
    echo $folder; 
    $filename = $_FILES['image']['name'];
    $exts = explode(".", $filename); // split based on period
    $ext = $exts[count($exts)-1]; //take the last split (contents after last period)

    $filename= substr($tempname, strrpos($tempname, '/') + 1).".".$ext;
    echo $filename;
   // move_uploaded_file($_FILES['image']['tmp_name'],'../'.$folder);
    $jsonStore = json_encode($filename); // encode filename in a JSON 
    
    if (!isset($Start_Node) || strlen($Start_Node) === 0) 
    {
        $errors['Start_Node'] = true;
    }
    if (!isset($End_Node) || strlen($End_Node) === 0) 
    {
        $errors['End_Node'] = true;
    }
    if (!isset($Distnace) || strlen($Distnace) === 0) 
    {
        $errors['Distnace'] = true;
    }
   // var_dump($errors); 
    
    if(count($errors)===0) //if no errors are encountered
    {
        echo "made it";
    $query = "INSERT INTO Edge VALUES(NULL,?,?,?,NULL)"; //select the row of the table with the given username
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        echo "SQL prepare failed";
    }else{
    if(!mysqli_stmt_bind_param($stmt,"sss",$Start_Node,$End_Node,$Distance)){
        echo "bind failed"; 
    }
    echo "bind good"; 
    if(!mysqli_stmt_execute($stmt)){
        echo "exec failed";
    }
    if(move_uploaded_file($tempname,$folder.$filename))
    {
       header("Location: index"); 
        exit();
    }
    else{
        echo "Image upload error";
        die();
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
       
    <h2>Create Route</h2>
    <form id="create" name="create" method="post" novalidate>
                    
                    <div>
                        <label for="Start_Node">Start Node</label>
                        <input type="text" name="Start_Node" id="Start_Node" placeholder="Enter Start Node" value="" required />
                         <span class="error <?=!isset($errors['Start_Node']) ? 'hidden' : "";?>">Please enter Start Node</span>
                    </div>
                    <div>
                        <label for="End_Node">End Node</label>
                        <input type="text" name="End_Node" id="End_Node" placeholder="Enter End Node" value="" required />
                         <span class="error <?=!isset($errors['End_Node']) ? 'hidden' : "";?>">Please enter End Node</span>
                    </div>
                    <div>
                        <label for="Distance">Distance</label>
                        <input type="number" name="Distance" id="Distance" placeholder="Enter Nodes Distance" value="" required />
                         <span class="error <?=!isset($errors['Distance']) ? 'hidden' : "";?>">Please enter Nodes Distance</span>
                    </div>

                    <div>
                        <label for="image">Image(s)</label>
                        <input type="file" id="image" name="image" multiple>
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