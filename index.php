<?php

include 'includes/library.php';



?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/master.css"/>
    <script src="https://kit.fontawesome.com/e156dbae2b.js" crossorigin="anonymous"></script>
    <title>Trent Class Find</title>
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
    
    <div class="wrapper">
    <h2>How to use Trent ClassFind: </h2>
    <ol>
        <li>1. Click on Pick A Room on the side navigation panel.</li>
        <li>2. Select the building you are starting from.</li>
        <li>3. Select the room/entrance of the building you are starting from</li>
        <li>4. Select the building you are trying to reach.</li>
        <li>5. Select the room/entrance of the building you are trying to find.</li>
        <li>6. Click Search.</li>
        <li>7. Follow the provided route to your destination!</li>
    </ol>

    <div class="buttons">
        <button><a href="pickaroom.php">Go To Pick a Room</a></button></div>
    </div>
    </main>
</div>
<?php
        include 'includes/footer.php';
?>
</body>
</html>