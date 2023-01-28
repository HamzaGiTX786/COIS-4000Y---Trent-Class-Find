<?php
include 'includes/library.php';

$errors = array(); //declare empty array to add errors too
$ID = $_POST['ID'] ?? null; 
$Location = $_POST['Location'] ?? null;
$Name = $_POST['Name'] ?? null;
$Neighbours= $_POST['Neighbours'] ?? null;
$jsonStore = json_encode($Neighbours); // encode neighbors in a JSON 
echo $jsonStore; 
if (isset($_POST['submit'])) 
{ //only do this code if the form has been submitted
    //validate user has entered a first name
     
    if (!isset($ID) || strlen($ID) === 0) 
    {
        $errors['ID'] = true;
    }
    if (!isset($Location) || strlen($Location) === 0) 
    {
        $errors['Location'] = true;
    }
    if (!isset($Name) || strlen($Name) === 0) 
    {
        $errors['Name'] = true;
    }
    if (!isset($Neighbours) || strlen($Neighbours) === 0) 
    {
        $errors['Neighbours'] = true;
    }
    var_dump($errors); 
    
    if(count($errors)===0) //if no errors are encountered
    {
        echo "made it"; 
    $query = "INSERT INTO Node VALUES(?,?,?,?)"; //select the row of the table with the given username
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        echo "SQL prepare failed";
    }else{
    if(!mysqli_stmt_bind_param($stmt,"ssss",$ID,$Location,$Name,$jsonStore)){
        echo "bind failed"; 
    }
    echo "bind good"; 
    if(!mysqli_stmt_execute($stmt)){
        echo "exec failed";
    }
    echo "exe done"; 
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

    <title>Admin Create Node:Trent Class Find</title>
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
        <h2>Create Node</h2>
    <form id="create" name="create" method="post" novalidate>  
                    <div>
                        <label for="ID">ID</label>
                        <input type="text" name="ID" id="ID" placeholder="Enter Node ID" value="" required />
                         <span class="error <?=!isset($errors['ID']) ? 'hidden' : "";?>">Please enter Node ID</span>
                    </div>
                    <div>
                        <label for="Location">Location</label>
                        <input type="text" name="Location" id="Location" placeholder="Enter Node Location" value="" required />
                         <span class="error <?=!isset($errors['Location']) ? 'hidden' : "";?>">Please enter Node Location</span>
                    </div>
                    <div>
                        <label for="Name">Name</label>
                        <input type="text" name="Name" id="Name" placeholder="Enter Node Name" value="" required />
                         <span class="error <?=!isset($errors['Name']) ? 'hidden' : "";?>">Please enter Node Name</span>
                    </div>
                    <div>
                        <label for="Neighbours">Neighbours</label>
                        <input type="text" name="Neighbours" id="Neighbours" placeholder="Enter Node Neighbours" value="" required />
                         <span class="error <?=!isset($errors['Neighbours']) ? 'hidden' : "";?>">Please enter Node Neighbours ID</span>
                    </div>
                    <div id="buttons">    
                    <button type="submit" name="submit">Create Node</button>
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