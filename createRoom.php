<?php
include 'includes/library.php';

$errors = array(); //declare empty array to add errors too
$Building_Name = $_POST['Building_Name'] ?? null;
$Name = $_POST['Room_Name'] ?? null;
$Type= $_POST['Room_Type'] ?? null;
 
if (isset($_POST['submit'])) 
{ //only do this code if the form has been submitted
    //validate user has entered a first name
     
    
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
   // var_dump($errors); 
    
    if(count($errors)===0) //if no errors are encountered
    {
        echo "made it";
    $query = "INSERT INTO Room VALUES(NULL,?,?,?,NULL)"; //select the row of the table with the given username
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        echo "SQL prepare failed";
    }else{
    if(!mysqli_stmt_bind_param($stmt,"sss",$Building_Name,$Name,$Type)){
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
        
   
    <h2>Create Room</h2>
    <form id="create" name="create" method="post" novalidate>
                   
                    <div>
                        <label for="Building_Name">Building Name</label>
                        <input type="text" name="Building_Name" id="Building_Name" placeholder="Enter Building Name" value="" required />
                         <span class="error <?=!isset($errors['Building_Name']) ? 'hidden' : "";?>">Please enter Building Name</span>
                    </div>
                    <div>
                        <label for="Room_Name">Room Name</label>
                        <input type="text" name="Room_Name" id="Room_Name" placeholder="Enter Room Name" value="" required />
                         <span class="error <?=!isset($errors['Room_Name']) ? 'hidden' : "";?>">Please enter Room Name</span>
                    </div>
                    <div>
                        <label for="Room_Type">Room Number</label>
                        <input type="number" name="Room_Type" id="Room_Type" placeholder="Enter Room Type" value="" required />
                         <span class="error <?=!isset($errors['Room_Type']) ? 'hidden' : "";?>">Please enter Room Type</span>
                    </div>
                    <div>
                        <label for="image">Image(s)</label>
                        <input type="file" id="image" name="image">
                         <span class="error <?=!isset($errors['image']) ? 'hidden' : "";?>">Please Upload Images</span>
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