<?php
include 'includes/library.php';
include 'includes/Routing.php';

        $query = "SELECT Name,Code FROM Buildings ORDER BY Name ASC";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$query))
        {
            echo "SQL prepare failed";
        }
        else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $names = mysqli_fetch_all($result); // get output for the searched item
        }

$startpoint = $_POST['startpoint'] ?? null;
$endpoint = $_POST['endpoint'] ?? null;

$errors = array();
$show = array();

if(isset($_POST['submit'])){

    if (!isset($startpoint) || strlen($startpoint) === 0) 
    {
        $errors['startpoint'] = true;
    }

    if (!isset($endpoint) || strlen($endpoint) === 0) 
    {
        $errors['endpoint'] = true;
    }
    
    if(count($errors)===0){ //if no errors are encountered

        $show['route'] = true;
        
        $startpointnode = $Map->GetNode($startpoint);
        $endpointnode = $Map->GetNode($endpoint);

        $tmp_path = $Map->FastestRoute($startpointnode,$endpointnode);
        
        for($i = 0; $i < sizeof($tmp_path) - 1; $i++){
             
        
            $queryimage = "SELECT Image FROM Edge WHERE Start_Node = ? AND End_Node = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$queryimage))
             {
                echo "SQL prepare failed";
             }
            else{
              mysqli_stmt_bind_param($stmt,"ss",$tmp_path[$i]->name, $tmp_path[$i + 1]->name);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              $image = mysqli_fetch_assoc($result); // get output for the searched item

              
              $image['Image'] = str_replace('"',"",$image['Image']);


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
    <link rel="stylesheet" href="styles/master.css"/>
    <script src="https://kit.fontawesome.com/e156dbae2b.js" crossorigin="anonymous"></script>
    <script src="scripts/master.js" crossorigin="anonymous"></script>
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
    <form id="search" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
            <h2>Pick a building for the start point then pick a room below, and repeat the same for the end point</h2>
            <div class="buildingselector">
            <div class="start">
                <select name="startpoint" id="startpoint" value="<?= $_POST['startpoint'] ?>">
                    <option value="">Pick a Building for the Start point</option>
                 <?php foreach($names as $build_info): ?>
                    <option value="<?=$build_info[1]?>"><?=$build_info[0]?></option>
                <?php endforeach; ?>
                </select>
                <span class="error <?=!isset($errors['startpoint']) ? 'hidden' : "";?>">Please select a building as your starting point</span>

                <p class="hidden">Pick a room (or Landmark) for the <span class="imp">starting point</span></p>
                <select name="startroom" id="startroom" class="hidden">
                 <option value="">Pick a Room for the Start point</option>  
                </select>
                <span class="error <?=!isset($errors['startroom']) ? 'hidden' : "";?>">Please select a room as your starting point</span>

                
            </div>

            <div class="end">
                <select name="endpoint" id="endpoint" value="<?= $_POST['endpoint'] ?>">
                <option value="">Pick a Room for the End point</option>
                <?php foreach($names as $build_info): ?>
                    <option value="<?=$build_info[1]?>"><?=$build_info[0]?></option>
                <?php endforeach; ?>
                </select>
                <span class="error <?=!isset($errors['endpoint']) ? 'hidden' : "";?>">Please select a building as your end point</span>

                <p class="hidden">Pick a room (or Landmark) for the <span class="imp">ending point</span></p>
                <select name="endroom" id="endroom" class="hidden">
                 <option value="">Pick a Room for the Start point</option>  
                </select>
                <span class="error <?=!isset($errors['endroom']) ? 'hidden' : "";?>">Please select a room as your end point</span>
            </div>
        </div>

            <div class="buttons">
                <button type="submit" name="submit" id="submit">Search</button>
            </div>
    </form>

    <div class=" route <?=!isset($show['route']) ? 'hidden' : "" ;?>">
        <ol>
            <li>
                <img src="http://loki.trentu.ca/~classfind/www_data/img/<?= $image['Image']?>" alt="Image of route">
            </li>
        </ol>
    </div>
    </main>
</div>
<?php
        include 'includes/footer.php';
?>
</body>
</html>
