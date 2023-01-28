<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/master.css"/>
    <script src="https://kit.fontawesome.com/e156dbae2b.js" crossorigin="anonymous"></script>
    <title>Pick A Room: Trent Class Find</title>
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
            <h2>Pick a building for the start point then pick a room below, and repeat the same for the end point</h2>
            <div class="buildingselector">
            <div class="start">
                <select name="startpoint" id="startpoint">
                    <option value="">Pick a Building for the Start point</option>
                    <option value="">Champlain College</option>
                    <option value="">Lady Eaton College</option>
                    <option value="">Otonabee College</option>
                    <option value="">Peter Gzowski College</option>
                    <option value="">Faryon Bridge</option>
                    <option value="">Athletic Centre</option>
                    <option value="">Trent Central Student Association Building</option>
                    <option value="">Blackburn Hall</option>
                    <option value="">Science Complex</option>
                </select>

                <p>Pick a room (or Landmark) for the <span class="imp">starting point</span></p>
                <select name="" id="">
                 <option value="">Pick a Room for the Start point</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>   
                </select>

                
            </div>

            <div class="end">
                <select name="endpoint" id="endpoint">
                    <option value="">Pick a Building for the Start point</option>
                    <option value="">Champlain College</option>
                    <option value="">Lady Eaton College</option>
                    <option value="">Otonabee College</option>
                    <option value="">Peter Gzowski College</option>
                    <option value="">Faryon Bridge</option>
                    <option value="">Athletic Centre</option>
                    <option value="">Trent Central Student Association Building</option>
                    <option value="">Blackburn Hall</option>
                    <option value="">Science Complex</option>
                    <option value="">Chemical </option>
                </select>

                <p>Pick a room (or Landmark) for the <span class="imp">ending point</span></p>
                <select name="" id="">
                 <option value="">Pick a Room for the Start point</option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>   
                </select>
            </div>
        </div>

            <div class="buttons">
                <button type="submit" name="submit" id="submit">Search</button>
            </div>
        </div>
    </main>
</div>
<?php
        include 'includes/footer.php';
?>
</body>
</html>
