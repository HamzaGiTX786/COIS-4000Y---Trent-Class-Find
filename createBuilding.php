<?php
include 'includes/library.php';

$errors = array(); //declare empty array to add errors too
$code= $_POST['code'] ?? null;
$Building_Name = $_POST['name'] ?? null;
$NumRooms = $_POST['NumRooms'] ?? null;
$geo= $_POST['geo'] ?? null;
 
if (isset($_POST['submit'])) 
{ //only do this code if the form has been submitted
    //validate user has entered a first name
     
    if (!isset($code) || strlen($code) === 0) 
    {
        $errors['code'] = true;
    }
    if (!isset($Building_Name) || strlen($Building_Name) === 0) 
    {
        $errors['name'] = true;
    }
    if (!isset($NumRooms) || strlen($NumRooms) === 0) 
    {
        $errors['NumRooms'] = true;
    }
    if (!isset($geo) || strlen($geo) === 0) 
    {
        $errors['geo'] = true;
    }
   // var_dump($errors); 
    
    if(count($errors)===0) //if no errors are encountered
    {
    $query = "INSERT INTO Buildings VALUES(?,?,?,?)"; //select the row of the table with the given username
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        echo "SQL prepare failed";
    }else{
    if(!mysqli_stmt_bind_param($stmt,"ssss",$code,$Building_Name,$NumRooms,$geo)){
        echo "bind failed"; 
    }
    echo "bind good"; 
    if(!mysqli_stmt_execute($stmt)){
        echo "exec failed";
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
    <h2>Create Building</h2>
    <form id="create" name="create" method="post" novalidate>
                    
                    <div>
                        <label for="code">Code</label>
                        <input type="text" name="code" id="code" placeholder="Enter building code" value="" required />
                         <span class="error <?=!isset($errors['code']) ? 'hidden' : "";?>">Please enter building code</span>
                    </div>
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Building Name" value="" required />
                         <span class="error <?=!isset($errors['name']) ? 'hidden' : "";?>">Please enter End Node</span>
                    </div>
                    <div>
                        <label for="NumRooms">Number of Rooms</label>
                        <input type="text" name="NumRooms" id="NumRooms" placeholder="Enter Number of Rooms" value="" required />
                         <span class="error <?=!isset($errors['NumRooms']) ? 'hidden' : "";?>">Please enter Number of Rooms</span>
                    </div>
                    <div>
                        <label for="geo">Geo-location</label>
                        <input type="text" id="geo" name="geo">
                         <span class="error <?=!isset($errors['geo']) ? 'hidden' : "";?>">Please enter Geo-location</span>
                    </div>

                    <div id="buttons">    
                    <button type="submit" name="submit">Create Building</button>
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