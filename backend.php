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

    <ul class="wrapper">

        <?php if($_SESSION['can_create_users'] == 1): ?>
        <li><a href="createaccount">Add an Admin User</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_create_node'] == 1): ?>
        <li><a href="createNode.php">Create Node</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_create_route'] == 1): ?>
        <li><a href="createRoute.php">Create Route</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_create_rooms'] == 1): ?>
        <li><a href="createRoom.php">Create Room</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_create_building'] == 1): ?>
        <li><a href="createBuilding.php">Create Building</a></li>
        <?php endif; ?>

        <?php if($_SESSION['can_update_delete'] == 1): ?>
        <li><a href="modify.php">Modify/Delete</a></li>
        <?php endif; ?>

    </ul>
       

    </main>
    </div>
        <?php
    include 'includes/footer.php';
    ?>
    </body>

</html>