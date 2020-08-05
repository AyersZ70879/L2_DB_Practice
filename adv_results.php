<?php include("topbit.php");

    $app_name = mysqli_real_escape_string($dbconnect, $_POST['Name']);
    $developer = mysqli_real_escape_string($dbconnect, $_POST['DevName']);
    $genre = mysqli_real_escape_string($dbconnect, $_POST['Genre']);
    $cost = mysqli_real_escape_string($dbconnect, $_POST['Price']);

    if (isset($POST['In_App'])) {
        $in_app = 0;
    }
    
    else {
        $in_app = 1;
    }

    $find_sql = "SELECT * FROM `00_L2_games`
    JOIN 00_L2_games_genre ON (00_L2_games.GenreID = 00_L2_games_genre.GenreID)
    JOIN 00_L2_games_developer ON (00_L2_games.DeveloperID = 00_L2_games_developer.DeveloperID)
    WHERE `Name` LIKE '%$app_name%'
    WHERE `DevName` LIKE '%$developer%'
    AND `Genre` LIKE '%$genre%'
    AND `Price` <= '$cost'
    AND (`In App` = $in_app OR `In App` = 0)
    
    ";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);
    

?>

        <div class="box main">
            <h2>Advanced Search Results</h2>
            
            
            <?php
            include("results.php"); 
            ?>
            

            
        </div> <!-- / main -->
        
<?php include("bottombit.php")?>
