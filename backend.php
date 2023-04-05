<?php

session_start();


if(!isset($_SESSION['id']))
{
header("Location: admin.php");
exit();
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

    <title>Admin Backend:Trent Class Find - Backend</title>
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

    <ol class="wrapper">
<h2>Backend Access</h2>
        <?php if($_SESSION['can_create_users'] == 1): ?>
        <li><a href="createaccount"><i class="fa-sharp fa-solid fa-users"></i>Add an Admin User</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_create_node'] == 1): ?>
        <li><a href="createNode.php"><i class="fa-solid fa-share-nodes"></i>Create Node</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_create_route'] == 1): ?>
        <li><a href="createRoute.php"><i class="fa-solid fa-route"></i>Create Route</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_create_rooms'] == 1): ?>
        <li><a href="createRoom.php"><i class="fa-solid fa-door-open"></i>Create Room</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_create_building'] == 1): ?>
        <li><a href="createBuilding.php"><i class="fa-solid fa-building"></i>Create Building</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_update_delete'] == 1): ?>
        <li><a href="modify.php"><i class="fa-solid fa-pen-to-square"></i>Modify/Delete</a></li>
        <?php endif; ?>

        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>

    </ol>
       

    </main>
    </div>
        <?php
    include 'includes/footer.php';
    ?>
    </body>

</html>