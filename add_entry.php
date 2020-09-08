<?php include("topbit.php");

// Get Genre list from database
$genre_sql="SELECT * FROM `00_L2_games_genre` ORDER BY `00_L2_games_genre`.`Genre` ASC";
$genre_query=mysqli_query($dbconnect, $genre_sql);
$genre_rs=mysqli_fetch_assoc($genre_query);
 
// Initialise from variables

$app_name = "";
$subtitle = "";
$url = "";
$genreID = "";
$dev_name = "";
$age = "";
$rating = "";
$rate_count = "";
$cost = "";
$in_app = 1;
$description = "";

$has_errors = "no";

// Code below excutes when the form is submitted...
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get values from the form
    $app_name = mysqli_real_escape_string($dbconnect, $_POST['app_name']);
    $subtitle = mysqli_real_escape_string($dbconnect, $_POST['subtitle']);
    $url = mysqli_real_escape_string($dbconnect, $_POST['url']);
    
    $genreID = mysqli_real_escape_string($dbconnect, $_POST['genre']);
    
    // if GenreID, is not blank, get genre so that genre box does not lose its value if there is an error
    if ($genreID != "") {
        $genreitem_sql = "SELECT * FROM `genre` WHERE `GenreID` = $genreID";
        $genreitem_query=mysqli_query($dbconnect, $genreitem_sql);
        $genreitem_rsd=mysqli_fetch_assoc($genreitem_query);
        
        $genre = $genreitem_rs['Genre'];
        
    } //end genreID if
    
    $dev_name = mysqli_real_escape_string($dbconnect, $_POST['dev_name']);
    $age = mysqli_real_escape_string($dbconnect, $_POST['age']);
    $rating = mysqli_real_escape_string($dbconnect, $_POST['rating']);
    $rate_count = mysqli_real_escape_string($dbconnect, $_POST['count']);
    $cost = mysqli_real_escape_string($dbconnect, $_POST['price']);
    $in_app = mysqli_real_escape_string($dbconnect, $_POST['in_app']);
    $description = mysqli_real_escape_string($dbconnect, $_POST['description']);
    
    // error checking will go here
    
    // if there are no errors
    if ($has_errors == "no") {
    
        // Go to success page

        // get developer ID if it exists
        $dev_sql ="";
        $dev_query=mysqli_query($dbconnect, $dev_sql);
        $dev_rs=mysqli_fetch_assoc($dev_query);
        $dev_count=mysqli_num_rows($dev_query);

        // ig developer not already in developer table, add them and get the 'new' developerID

        // Add entry to database
    
    }   // end of 'no errors' if
    
    echo "You pushed the button";
    
} // end of button submitted code

?>

        <div class="box main">
            <div class="add-entry">
            <h2>Add An Entry</h2>
            
            <form method="post" enctype="multipart/form-data" 
                  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                
                <!-- App Name (Required) -->
                <input class="add-field" type="text" required name="app_name" value="<?php echo $app_name; ?>" placeholder="App Name (required) ..." />
                
                <br />
                
                <!-- Subtitle (optional) -->
                <input class="add-field" type="text" name="subtitle" value="<?php echo $subtitle; ?>" placeholder="Subtitle (optional) ..." />
                
                <br />
                
                <!-- URL (required, must start http://) -->
                <input class="add-field" type="text" required name="url" value="<?php echo $url; ?>" placeholder="URL (required) ..." />
                
                <br />
                
                <!-- Genre dropdown (required) -->
                <select class="adv" required name="genre">
                    <!-- first / selected option -->
                    
                    <?php 
                    if($genreID=="") {
                        ?>
                    <option value="" selected>Genre (Choose something)...</option>
                    
                    <?php
                        
                    }
                    
                    else {
                       ?> 
                    <option value="<?php echo $genreID; ?>" selected><?php echo $genre; ?></option>
                    <?php 
                    }
                    ?>
                    
                    <!-- get options from database -->
                    <?php
                    
                    do {
                        ?>
                    <option value="<?php echo $genre_rs['GenreID']; ?>"><?php echo $genre_rs['Genre']; ?></option>
                    
                    <?php
                    } // end genre do loop
                    while ($genre_rs=mysqli_fetch_assoc($genre_query))
                    ?>
                        
                </select>
                
                <br />
                
                <!-- Developer Name (required) -->
                <input class="add-field" type="text" required name="dev_name" value="<?php echo $dev_name; ?>" placeholder="Developer Name (required) ..." />
                
                <br />
                
                <!-- Age (set to 0 if left blank) -->
                <input class="add-field" type="text" name="age" value="<?php echo $age; ?>" placeholder="Age (0 for all) ..." />
                
                <br />
                
                <!-- Rating (Number between 0-5, 1 dp) -->
                <div>
                    <input class="add-field" type="text" required name="rating" value="<?php echo $rating; ?>" step="0.1" min="0" max="5" placeholder="Rating (0-5)" />
                </div>
                
                
                <!-- # of ratings (integer more than 0) -->
                <input class="add-field" type="text" required name="count" value="<?php echo $rate_count; ?>" placeholder="# of Ratings ..." />
                
                <br />
                
                
                <!-- Cost (Decimal 2dp, must be more than 0) -->
                <input class="add-field" type="text" required name="price" value="<?php echo $cost; ?>" placeholder="Cost (number only) ..." />
                
                <br /><br />
                
                <!-- In App Purchase box -->
                
                <div>
                
                <input class="adv-txt" type="checkbox" name="in_app" value="1">Contains In App Purchases

                </div>
                
                
                <br /> 
                                
                <!-- Description text area -->
                <textarea class="add-field <?php echo $description_field?>" name="description" placeholder="Description..." rows="6"><?php echo $description; ?></textarea>
                          
                <!-- Submit Button -->
                <p>
                    <input class="submit advanced-button" type="submit" value="Submit" />
                </p>
                
            </form>
  
            </div> <!-- / add-entry -->
        </div> <!-- / main -->
        
<?php include("bottombit.php")?>