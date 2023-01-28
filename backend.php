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

    <ul>
        <li><a href="createNode.php">Create Node</a></li>
        <li><a href="createRoute.php">Create Route</a></li>
        <li><a href="createRoom.php">Create Room</a></li>
        <li><a href="createBuilding.php">Create Building</a></li>
    </ul>

    
        <button onclick="location.href='createNode.php'" type="button">Create Node</button>
        <button onclick="location.href='createRoute.php'" type="button">Create Route</button>
        <button onclick="location.href='createRoom.php'" type="button">Create Room</button>
        <button onclick="location.href='createBuilding.php'" type="button">Create Building</button>
       

    </main>
    </div>
    <footer>
        <?php
    include 'includes/footer.php';
    ?>
    </footer> 
    </body>

</html>