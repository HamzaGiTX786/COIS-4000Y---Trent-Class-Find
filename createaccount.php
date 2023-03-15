<?php
include 'includes/library.php';

$errors = array(); //declare empty array to add errors too

//get name from post or set to NULL if doesn't exist
$fname = $_POST['fname'] ?? null;
$lname = $_POST['lname'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$passwordre = $_POST['passwordre'] ?? null;
$username = $_POST['username'] ?? null; 
$canchangebuilding = $_POST['canchangebuilding']??null;
$updateimage = $_POST['updateimage']??null;
$can_create_node = $_POST['can_create_node']??null;

if (isset($_POST['submit'])) 
{ //only do this code if the form has been submitted
    
    //validate user has entered a first name
    if (!isset($fname) || strlen($fname) === 0) 
    {
        $errors['fname'] = true;
    }
    
    //validate user has entered a last name
    if (!isset($lname) || strlen($lname) === 0) 
    {
        $errors['lname'] = true;
    }
    
    //validate and sanitize email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = true;
    }
    
    if (!isset($username) || strlen($username) === 0) // make sure a username was entered
    {
        $errors['username'] = true;
    }
    
    if(!isset($password) || strlen($password) < 8) //make sure a password was given and is 8 char long
    {
        $errors['password'] = true;
    }
    
    if(!isset($passwordre) || strlen($passwordre) === 0 || $password !== $passwordre) //make sure password was re-entered and is the same as the original
    {
        $errors['passwordre'] = true;
    }

    if (!isset($canchangebuilding) || strlen($canchangebuilding) === 0) 
    {
        $errors['canchangebuilding'] = true;
    }

    if (!isset($updateimage) || strlen($updateimage) === 0) 
    {
        $errors['updateimage'] = true;
    }

    if (!isset($can_create_node) || strlen($can_create_node) === 0) 
    {
        $errors['can_create_node'] = true;
    }
    
    if(count($errors)===0) //if no errors are encountered
    {
        $querycheck = "SELECT * FROM Users";
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement,$querycheck))
        {
            echo "SQL prepare failed";
        }
        else{
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            $accounts = mysqli_fetch_all($result);
        }

        foreach($accounts as $row) //check through all existing accounts
        {
            if ($username == $row[1]) //if the given username is the same as one already in the database
            {
                $errors['uniqueUser'] = true; //username is already in use
            }
            if ($email == $row[3])
            {
                $errors['uniqueEmail'] = true; //email is already in use
            }
        }

        if(count($errors)===0) //check if there are still no errors
        {
            $query = "INSERT INTO Users values (NULL,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
            echo "SQL prepare failed";
        }
        else{
            mysqli_stmt_bind_param($stmt,"ssssssss",$username, password_hash($password, PASSWORD_BCRYPT) , $email, $fname, $lname,$canchangebuilding,$updateimage,$can_create_node);
            mysqli_stmt_execute($stmt);

            header("Location: admin");
            exit();
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
    <script src="https://kit.fontawesome.com/e156dbae2b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/master.css"/>
    <title>Create Admin Account: Trent ClassFind</title>
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
    <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <div class="start">
                <label for="fname">Enter the First name :</label>
                <input type="text" name="fname" id="fname" placeholder="Enter first name" value=""/>
                <span class="error <?=!isset($errors['fname']) ? 'hidden' : "";?>">Please enter your admin user First name</span>
            </div>

            <div class="end">
                <label for="lname">Enter the Last name:</label>
                <input type="text" name="lname" id="lname" placeholder="Enter last name" value="" required/> 
                <span class="error <?=!isset($errors['lname']) ? 'hidden' : "";?>">Please enter your admin user Last name</span>
            </div>

            <div class="end">
                <label for="email">Enter the email of the user:</label>
                <input type="text" name="email" id="email" placeholder="Enter the email of the user" value="" required/> 
                <span class="error <?=!isset($errors['email']) ? 'hidden' : "";?>">Please enter your admin user email</span>
            </div>

            <div class="end">
                <label for="username">Enter the username of the user:</label>
                <input type="text" name="username" id="username" placeholder="Enter the email of the user" value="" required/> 
                <span class="error <?=!isset($errors['username']) ? 'hidden' : "";?>">Please enter a username for your admin user</span>
            </div>

            <div class="end">
                <label for="password">Enter a password:</label>
                <input type="password" name="password" id="password" placeholder="Enter a password" value="" required/> 
                <span class="error <?=!isset($errors['password']) ? 'hidden' : "";?>">Please enter a password for your admin user that is 8 characters long</span>
            </div>

            <div class="end">
                <label for="passwordre">Enter the password once again:</label>
                <input type="password" name="passwordre" id="passwordre" placeholder="Enter the re-entered" value="" required/> 
                <span class="error <?=!isset($errors['passswordre']) ? 'hidden' : "";?>">Please enter re-enter your password</span>
            </div>

            <div class="end">
                <label for="canchangebuilding">Can the Admin user create new buildings?</label>
                <select name="canchangebuilding" id="canchangebuilding">
                <option value="">Select an option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <span class="error <?=!isset($errors['canchangebuilding']) ? 'hidden' : "";?>">Please select an option!</span>
            </div>

            <div class="end">
                <label for="updateimage">Can the Admin user update/update images and description?</label>
                <select name="updateimage" id="updateimage">
                    <option value="">Select an option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <span class="error <?=!isset($errors['updateimage']) ? 'hidden' : "";?>">Please select an option!</span>
            </div>

            <div class="end">
                <label for="can_create_node">Can the Admin user create new nodes?</label>
                <select name="can_create_node" id="can_create_node">
                <option value="">Select an option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <span class="error <?=!isset($errors['can_create_node']) ? 'hidden' : "";?>">Please select an option!</span>
            </div>

            <div class="buttons">
                <button type="submit" name="submit" id="submit">Submit</button>
            </div>
    </form>
    </main>
</div>

    <?php
        include 'includes/footer.php';
?>
</body>
</html>