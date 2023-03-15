<?php
session_start(); 
include 'includes/library.php';

if(isset($_SESSION['id']))
{
header("Location: backend.php");
exit();
}

$user = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$remember = $_POST['remember']?? null;

$errors = array();

if (isset($_POST['submit'])) 
{
        
    $query = "SELECT * FROM Users WHERE username =?"; //select the row of the table with the given username
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$query))
    {
        echo "SQL prepare failed";
    }
    else{
    mysqli_stmt_bind_param($stmt,"s",$user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    }
        
    if($row == false) //if row is false then no row with that username exists and user is invalid
    { 
        $errors['login'] = true;
    }
    else //if the row was valid
    {
        if(password_verify($password, $row['password'])) //verify that the password is correct
        //if($password == $row['password'])
        {
            $_SESSION['user'] = $row['username']; //load session credentials
            $_SESSION['id'] = $row['userId'];
            $_SESSION['can_create_building'] = $row['can_create_building'];
            $_SESSION['can_update_delete'] = $row['can_update_delete'];
            $_SESSION['can_create_node'] = $row['can_create_node'];
            $_SESSION['can_create_users'] = $row['can_create_users'];
            $_SESSION['can_create_route'] = $row['can_create_route'];
            $_SESSION['can_create_rooms'] = $row['can_create_rooms'];


            header("Location: backend.php"); //redirect to the homepage
            
        }
        else
        {
            $errors['login'] = true;    //incorrect password
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
    <title>Admin Login:Trent Class Find</title>
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
        <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <div class="start">
                <label for="username">Enter your Username:</label>
                <input type="text" name="username" id="username" placeholder="Enter your username here" value=""/>
            </div>
            <div class="end">
                <label for="endpoint">Enter your password:</label>
                <input type="password" name="password" id="password" placeholder="Enter your password here" value="" required/> 
            </div>
            <div>
                    <span class="error <?=!isset($errors['login']) ? 'hidden' : "";?>"> Your username or password was invalid</span>
            </div>
            <div class="buttons">
                <button type="submit" name="submit" id="submit">Sign In</button>
            </form>
        </div>
        
    </main>
</div>
<?php
        include 'includes/footer.php';
?>
</body>
</html>