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
                <label for="startpoint">Enter Start Point:</label>
                <input type="text" name="startpoint" id="startpoint" placeholder="Enter a start point" value=""/>
            </div>
            <div class="end">
                <label for="endpoint">Enter End Point:</label>
                <input type="text" name="endpoint" id="endpoint" placeholder="Enter an end point" value="" required/> 
            </div>

            <div class="buttons">
                <button type="submit" name="submit" id="submit">Search</button>
            </div>
    </form>
    </main>
</div>
<?php
        include 'includes/footer.php';
?>
</body>
</html>