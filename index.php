<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");

const MAX_FILE_SIZE = 1000000; //for image uploads

//start session to save array of imgs in index.php that can be accessed in schedView.php
session_start();
$_SESSION["post_list"] = []; //list of posts. either all or after search query

$title = 'Home';
?>
<!DOCTYPE html>
<html lang="en">


<?php include("includes/head.php");?>

<?php

global $db;

// Search fields
const SEARCH_FIELDS = [
    "by_description" => "By Description",
    "by_major" => "By Major",
    "by_minor" => "By Minor",
    "by_college" => "By College",
    "by_track" => "By Special Track"
  ];

#Get tracks from db
//Getting list of all the tracks in the database
$tracks = exec_sql_query($db, "SELECT DISTINCT track FROM tracks", NULL)->fetchAll(PDO::FETCH_COLUMN);





//------------SEARCH IMPLEMENTATION-------------
//Get all posts
if (!(isset($_POST["reg_search_button"]) and isset($_POST["post_search_button"]))){
    $sql = "SELECT posts.id FROM posts;";
    $params = array();
    $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
}


//Search by post_id
if (isset($_POST["post_search_button"]) and isset($_POST["post_search"]) and $_POST["post_search"] != ""){
    $post_search_input = filter_input(INPUT_POST, 'post_search', FILTER_SANITIZE_STRING);
    if ($post_search_input){ //post_search_input is filtered
        $sql = "SELECT posts.id FROM posts WHERE posts.id = :post_search_input;";
        $params = array(
            ':post_search_input' => $post_search_input
        );
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
    }
}

//Search regular
// var_dump($_POST["term_search"]);
if (isset($_POST["reg_search_button"]) and isset($_POST["term_search"]) and isset($_POST["year_search"])){
    $term_search_input = filter_input(INPUT_POST, 'term_search', FILTER_SANITIZE_STRING);
    // var_dump($term_search_input);
    $year_search_input = filter_input(INPUT_POST, "year_search", FILTER_SANITIZE_STRING);
    // var_dump($year_search_input);

    //all results: all terms, all years, and not set major_search, minor_search, track, college
    
    if ($term_search_input == "all_terms" and $year_search_input == "all_years" and (!(isset($_POST["search_category"]))) and $_POST["major_search"] == '' and $_POST["minor_search"] == "" and $_POST["college_search"] == null and $_POST["track_search"] == null and ((!isset($_POST["description_search"])) || $_POST["description_search"] == "")){
        $sql = "SELECT posts.id FROM posts;";
        $params = array();
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
    }

    elseif ($_POST["major_search"] != ""){ //if major isset
        
        $major_search_input = filter_input(INPUT_POST, 'major_search', FILTER_SANITIZE_STRING);


        $sql_joins = "SELECT posts.id FROM posts INNER JOIN post_majors ON posts.id = post_majors.post_id INNER JOIN majors ON majors.id = post_majors.major_id";
        $sql_wheres = "WHERE majors.major LIKE '%'||:major_search_input||'%'";
        $params = array(
            ':major_search_input' => $major_search_input
        );
        // var_dump($sql);
        if($_POST["term_search"] != "all_terms"){ //term specified
            echo("in not all years");
            // $sql .= " INNER JOIN terms ON posts.term_id = terms.id WHERE terms.term = :term_search_input";
            // $sql = "SELECT posts.id FROM posts INNER JOIN post_majors ON posts.id = post_majors.post_id INNER JOIN majors ON majors.id = post_majors.major_id INNER JOIN terms ON posts.term_id = terms.id WHERE majors.major LIKE '%'||:major_search_input||'%' and terms.term = :term_search_input;";
            $sql_joins .= " INNER JOIN terms ON posts.term_id = terms.id";
            $sql_wheres .= " and terms.term = :term_search_input";
            $params += array(':term_search_input' => $term_search_input);
        }

        if($_POST["year_search"] != "all_years"){ //year specified
            $sql_joins .= " INNER JOIN years ON posts.year_id = years.id";
            $sql_wheres .= " and years.year = :year_search_input";
            $params += array(':year_search_input' => $year_search_input);
        }
        
        $sql = $sql_joins . " " . $sql_wheres . ";";

        // var_dump($sql);
        // var_dump($params);
    
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
        // var_dump($post_ids);

    }

    elseif ($_POST["minor_search"] != ""){ //if minor isset
        
        $minor_search_input = filter_input(INPUT_POST, 'minor_search', FILTER_SANITIZE_STRING);


        $sql_joins = "SELECT posts.id FROM posts INNER JOIN post_minors ON posts.id = post_minors.post_id INNER JOIN minors ON minors.id = post_minors.minor_id";
        $sql_wheres = "WHERE minors.minor LIKE '%'||:minor_search_input||'%'";
        $params = array(
            ':minor_search_input' => $minor_search_input
        );
        // var_dump($sql);
        if($_POST["term_search"] != "all_terms"){ //term specified
            $sql_joins .= " INNER JOIN terms ON posts.term_id = terms.id";
            $sql_wheres .= " and terms.term = :term_search_input";
            $params += array(':term_search_input' => $term_search_input);
        }

        if($_POST["year_search"] != "all_years"){ //year specified
            $sql_joins .= " INNER JOIN years ON posts.year_id = years.id";
            $sql_wheres .= " and years.year = :year_search_input";
            $params += array(':year_search_input' => $year_search_input);
        }
        
        $sql = $sql_joins . " " . $sql_wheres . ";";

        // var_dump($sql);
        // var_dump($params);
    
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
        // var_dump($post_ids);

    }

    elseif ($_POST["track_search"] != ""){ //if track isset
        
        $track_search_input = filter_input(INPUT_POST, 'track_search', FILTER_SANITIZE_STRING);


        $sql_joins = "SELECT posts.id FROM posts INNER JOIN post_tracks ON posts.id = post_tracks.post_id INNER JOIN tracks ON tracks.id = post_tracks.track_id";
        $sql_wheres = "WHERE tracks.track LIKE :track_search_input";
        $params = array(
            ':track_search_input' => $track_search_input
        );
        // var_dump($sql);
        if($_POST["term_search"] != "all_terms"){ //term specified
            $sql_joins .= " INNER JOIN terms ON posts.term_id = terms.id";
            $sql_wheres .= " and terms.term = :term_search_input";
            $params += array(':term_search_input' => $term_search_input);
        }

        if($_POST["year_search"] != "all_years"){ //year specified
            $sql_joins .= " INNER JOIN years ON posts.year_id = years.id";
            $sql_wheres .= " and years.year = :year_search_input";
            $params += array(':year_search_input' => $year_search_input);
        }
        
        $sql = $sql_joins . " " . $sql_wheres . ";";

        // var_dump($sql);
        // var_dump($params);
    
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
        // var_dump($post_ids);

    }

    elseif ($_POST["college_search"] != ""){ //if college isset
        
        $college_search_input = filter_input(INPUT_POST, 'college_search', FILTER_SANITIZE_STRING);


        $sql_joins = "SELECT posts.id FROM posts INNER JOIN schools ON posts.school_id = schools.id";
        $sql_wheres = "WHERE schools.school LIKE :college_search_input";
        $params = array(
            ':college_search_input' => $college_search_input
        );
        // var_dump($sql);
        if($_POST["term_search"] != "all_terms"){ //term specified
            $sql_joins .= " INNER JOIN terms ON posts.term_id = terms.id";
            $sql_wheres .= " and terms.term = :term_search_input";
            $params += array(':term_search_input' => $term_search_input);
        }

        if($_POST["year_search"] != "all_years"){ //year specified
            $sql_joins .= " INNER JOIN years ON posts.year_id = years.id";
            $sql_wheres .= " and years.year = :year_search_input";
            $params += array(':year_search_input' => $year_search_input);
        }
        
        $sql = $sql_joins . " " . $sql_wheres . ";";

        // var_dump($sql);
        // var_dump($params);
    
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
        // var_dump($post_ids);

    }

    elseif (isset($_POST["description_search"]) and $_POST["description_search"] != ""){ //if description isset
        
        $description_search_input = filter_input(INPUT_POST, 'description_search', FILTER_SANITIZE_STRING);


        $sql_joins = "SELECT posts.id FROM posts";
        $sql_wheres = "WHERE posts.a_description LIKE '%' ||:description_search_input|| '%'";
        $params = array(
            ':description_search_input' => $description_search_input
        );
        // var_dump($sql);
        if($_POST["term_search"] != "all_terms"){ //term specified
            $sql_joins .= " INNER JOIN terms ON posts.term_id = terms.id";
            $sql_wheres .= " and terms.term = :term_search_input";
            $params += array(':term_search_input' => $term_search_input);
        }

        if($_POST["year_search"] != "all_years"){ //year specified
            $sql_joins .= " INNER JOIN years ON posts.year_id = years.id";
            $sql_wheres .= " and years.year = :year_search_input";
            $params += array(':year_search_input' => $year_search_input);
        }
        
        $sql = $sql_joins . " " . $sql_wheres . ";";

        // var_dump($sql);
        // var_dump($params);
    
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
        // var_dump($post_ids);

    }

    //only term is specified
    elseif($_POST["term_search"] != "all_terms" and $_POST["year_search"] == "all_years"){
        $sql = "SELECT posts.id FROM posts INNER JOIN terms ON posts.term_id = terms.id WHERE :term_search_input = terms.term;";
        $params = array(
            ':term_search_input' => $term_search_input
        );
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
    }

    //only year is specified
    elseif($_POST["year_search"] != "all_years"){
        $sql = "SELECT posts.id FROM posts INNER JOIN years ON posts.year_id = years.id WHERE :year_search_input = years.year;";
        $params = array(
            ':year_search_input' => $year_search_input
        );
        $post_ids = exec_sql_query($db, $sql, $params)->fetchAll();
    }



}



// var_dump($post_ids);

$_SESSION["post_list"] = $post_ids;

//----------------UPLOAD IMPLEMENTATION-----------------
if (isset($_POST["upload_button"])){
    //filter inputs
    $upload_term = filter_input(INPUT_POST, "upload_term", FILTER_SANITIZE_STRING);
    $upload_year = filter_input(INPUT_POST, "upload_year", FILTER_SANITIZE_STRING);

    $upload_majors = filter_arr_input("major_upload");
    // var_dump($upload_majors);
    // var_dump($_POST["major_upload"]);
    
    if(isset($_POST["minor_upload"])){ //minors selected
        $upload_minors = filter_arr_input("minor_upload");
    }

    $upload_college = filter_input(INPUT_POST, "college_upload", FILTER_SANITIZE_STRING);

    if(isset($_POST["track_upload"])){ //tracks selected
        $upload_tracks = filter_arr_input("track_upload");
    }

    if(isset($_POST["upload_description"]) and $_POST["upload_description"] != ""){
        $upload_description = filter_input(INPUT_POST, "upload_description", FILTER_SANITIZE_STRING);
    }

    //img filter
    $upload_img_info = $_FILES["img_file"];

    //Code adapted from Kyle J. Harms' Cornell University INFO 2300 course
      //if add is successful -> record new img in db and store img in uploads directory
  if ($upload_img_info["error"] == UPLOAD_ERR_OK){

    $add_basename = basename($_FILES["img_file"]["name"]);

    $add_ext = strtolower( pathinfo($add_basename, PATHINFO_EXTENSION) );

    //ADD IMG WITH TAGS
    $sql = "INSERT INTO images ('img_ext') VALUES (:add_ext);";

    $params = array(
      ':add_ext' => $add_ext
    );

    $result = exec_sql_query($db, $sql, $params);

    //store add img in uploads directory
    $upload_img_id = $db -> lastInsertId("id");

    $new_path = "uploads/images/" . $upload_img_id . "." . $add_ext;

    move_uploaded_file($_FILES["img_file"]["tmp_name"], $new_path);

    $upload_img_info["tmp_name"]  = $new_path;

    }



//insert into posts table
//term_id
$sql = "SELECT terms.id FROM terms WHERE terms.term = :upload_term;";
$params = array(':upload_term' => $upload_term);
$term_id = exec_sql_query($db, $sql, $params)->fetchAll();
$term_id = $term_id[0]["id"];

//year_id
$sql = "SELECT years.id FROM years WHERE years.year = :upload_year;";
$params = array(':upload_year' => $upload_year);
$year_id = exec_sql_query($db, $sql, $params)->fetchAll();
$year_id = $year_id[0]["id"];

//school_id
$sql = "SELECT schools.id FROM schools WHERE schools.school = :upload_college;";
$params = array(':upload_college' => $upload_college);
$college_id = exec_sql_query($db, $sql, $params)->fetchAll();
$college_id = $college_id[0]["id"];
// var_dump($college_id);

if(isset($upload_description)) { //description included
    $sql = "INSERT INTO posts ('term_id', 'year_id', 'school_id', 'image_id', 'a_description') VALUES (:term_id, :year_id, :school_id, :image_id, :a_description);";

    $params = array(
      ':term_id' => $term_id,
      ':year_id' => $year_id,
      ':school_id' => $college_id,
      ':image_id' => $upload_img_id,
      ':a_description' => $upload_description
    );

    $result = exec_sql_query($db, $sql, $params);

    if($result){
        $upload_successful = True;
    }
}

if(!(isset($upload_description))) { //description NOT included
    $sql = "INSERT INTO posts ('term_id', 'year_id', 'school_id', 'image_id') VALUES (:term_id, :year_id, :school_id, :image_id);";

    $params = array(
      ':term_id' => $term_id,
      ':year_id' => $year_id,
      ':school_id' => $college_id,
      ':image_id' => $upload_img_id,
    );

    $result = exec_sql_query($db, $sql, $params);

    if($result){
        $upload_successful = True;
    }
}

$upload_post_id = $db -> lastInsertId("id"); //id of new post

//add entries to relational tables
add_arr_inputs_to_db($db, $upload_majors, "majors", $upload_post_id);

if (isset($upload_minors)){
    add_arr_inputs_to_db($db, $upload_minors, "minors", $upload_post_id);
}

if (isset($upload_tracks)){
    add_arr_inputs_to_db($db, $upload_tracks, "tracks", $upload_post_id);
}


}



?>


<body id= "home_body">
  <?php include("includes/header.php");?>
<div id="home_div">
  <div id="options_div">
    <!-- confirmation message -->
   <?php if(isset($upload_successful)){ ?> 
        <div id="confirm_message">
            <p>Thank you for uploading your schedule! <strong>Your post id number is <?php echo htmlspecialchars($upload_post_id)?>.</strong> You can search for your post with this id number. View your post <?php echo "<a id='post_a' href='schedView.php?" . http_build_query(array('id' => $upload_post_id)) . "'>here.</a>" ?></p>
        </div>
   <?php } ?>
    
    <button class="home_button" id="show_reg_button">Browse Schedules</button>
    <button class="home_button" id="hide_reg_button">Collapse Browse Schedules</button>
  <div id="reg_search_option">
    <!-- <h2>What type of schedules would you like to see?</h2> -->
    <form id="reg_search_form" action="index.php" method="post">
        <fieldset>
        <legend>What type of schedules would you like to see?</legend>

        <div id="fixed_searchContainer">
        <!-- <div id="term_searchDiv"> -->
        <label for="term_search">Term: </label>
        <select name="term_search" id="term_search">
            <option value='spring'>Spring</option>
            <option value='fall'>Fall</option>
            <option value='four_year_plan'>Four Year Plan</option>
            <option value='actual_four_year_plan'>Actual Four Year Plan</option>
            <option value='all_terms' selected>All Terms</option>
        </select>
        <!-- </div> -->

        <!-- <div id="year_searchDiv"> -->
        <label for="year_search">Year: </label>
        <select name="year_search" id="year_search">
            <option value='freshman'>Freshman</option>
            <option value='sophomore'>Sophomore</option>
            <option value='junior'>Junior</option>
            <option value='senior'>Senior</option>
            <option value='alumni'>Alumni</option>
            <option value='all_years' selected>All Years</option>
        </select>
        <!-- </div> -->
        </div>
    


        <div id="changeable_searchContainer">
        <!-- <label for="search_category">Search By: </label> -->
        <div id="category_searchDiv">
        <select name="search_category" id="search_category">
          <option value="" selected="selected" disabled>Search By</option>
          <?php
            foreach(SEARCH_FIELDS as $dbname => $label) {
              ?>
              <option value="<?php echo $dbname;?>"><?php echo $label;?></option>
              <?php
            } ?>
          </select>
        </div>

          
        <div id="major_searchDiv">
        <label for="major_search">Major: </label>
        <input type="text" list="major_datalist" name="major_search" id="major_search" onkeyup="ac(this.value)"> 
        <datalist id="major_datalist">
            <?php print_options($majors) ?>
        </datalist>
        </div>

        <div id="minor_searchDiv">
        <label for="minor_search">Minor: </label>
        <input type="text" list="minor_datalist" id="minor_search" name="minor_search" onkeyup="ac(this.value)"> 
        <datalist id="minor_datalist">
            <?php print_options($minors) ?>
        </datalist>
        </div>

        <div id="college_searchDiv">
        <label for="college_search">College/School: </label>
        <select name="college_search" id="college_search">
            <option value="cals">College of Agriculture and Life Sciences</option>
            <option value="caap">College of Architecture, Art and Planning</option>
            <option value="cas">College of Arts and Sciences</option>
            <option value="sc">Cornell SC Johnson College of Business</option>
            <option value="coe">College of Engineering</option>
            <option value="humec">College of Human Ecology</option>
            <option value="ilr">School of Industrial and Labor Relations (ILR)</option>
            <option value="all_colleges" selected disabled>All Colleges/Schools</option>
        </select>
        </div>

        
        <div id="track_searchDiv">
        <label for="track_search">Special Track: </label>
        <select name="track_search" id="track_search">
            <?php print_track_options($tracks); ?>
            <option value="all_tracks" selected disabled>All Tracks</option>
        </select>
        </div>

        <div id="description_searchDiv">
        <label for="description_search">Keyword Search: </label>
        <input type="text" name="description_search" id="description_search"> 
        </div>

        </div>

        <button name="reg_search_button" type="submit">Search</button>

        </fieldset>

    </form>
</div>



<button class="home_button" id="show_post_button">Browse by Post Id#</button>
<button class="home_button" id="hide_post_button">Collapse Browse by Post Id#</button>

<div id="post_search_option">
<form id="post_search_form" action="index.php" method="post">
        <fieldset>
        <legend>Search by Post Id #</legend>
        <label for ="post_search">Post Id (ex. 5): </label>
        <input type="number" name="post_search" id="post_search" value="<?php if (isset($_POST["post_search"])) echo $_POST["post_search"]?>"/>

        

        <button name="post_search_button" type="submit">Search</button>
        </fieldset>

    </form>
</div>


<button class="home_button" id="show_upload_button">Upload a Schedule</button>
<button class="home_button" id="hide_upload_button">Collapse Upload a Schedule</button>
<div id="upload_option">
<?php if(!isset($upload_successful)){ ?>
<form id="upload_form" action="index.php" method="post" enctype="multipart/form-data">
        <fieldset>
        <legend>Upload and Share Your Schedule!</legend>
        <ul>
            <li>
                <label for="upload_term">Term: </label>
                <select name="upload_term" id="upload_term">
                    <option value='spring'>Spring</option>
                    <option value='fall'>Fall</option>
                    <option value='four_year_plan'>Four Year Plan</option>
                    <option value='actual_four_year_plan'>Actual Four Year Plan</option>
                </select>
            </li>

        <li>
            <label for="upload_year">Year: </label>
            <select name="upload_year" id="upload_year">
                <option value='freshman'>Freshman</option>
                <option value='sophomore'>Sophomore</option>
                <option value='junior'>Junior</option>
                <option value='senior'>Senior</option>
                <option value='alumni'>Alumni</option>
            </select>
        </li>

        <li>
            <label for="major_upload[]">Major(s): </label>
            <select multiple name="major_upload[]" id="major_upload[]" size="3" required>
                <?php print_options($majors) ?>
            </select>
        </li>

        <li>
            <label for="minor_upload[]">Minor(s): </label>
            <select multiple name="minor_upload[]" id="minor_upload[]" size="3">
                <?php print_options($minors) ?>
            </select>
        </li>

        <li>
            <label for="college_upload">College/School: </label>
            <select name="college_upload" id="college_upload">
                <option value="cals">College of Agriculture and Life Sciences</option>
                <option value="caap">College of Architecture, Art and Planning</option>
                <option value="cas">College of Arts and Sciences</option>
                <option value="sc">Cornell SC Johnson College of Business</option>
                <option value="coe">College of Engineering</option>
                <option value="humec">College of Human Ecology</option>
                <option value="ilr">School of Industrial and Labor Relations (ILR)</option>
            </select>
        </li>

        <li>
            <label for="track_upload[]">Special Track: </label>
            <select multiple name="track_upload[]" id="track_upload[]" size="3">
                <?php print_track_options($tracks); ?>
            </select>
        </li>
         

        <li>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>"/>
            <label for="img_file">Upload Image of Schedule: </label>
            <input id="img_file" type="file" name="img_file" required/>
        </li>

        <li>
            <label for ="upload_description">Description: </label>
            <textarea rows="4" cols="50" name="upload_description" id="upload_description"></textarea>
        </li>

        
        <li>
            <button name="upload_button" type="submit">Upload Schedule</button>
        </li>
        
    </ul>

    </fieldset>

    </form>
<?php } ?>

</div>



</div>

<div id="posts_div">


    <!-- TO DO: Display all results or search results -->

    <?php //if (isset($_POST["search_button"])){ ?>
        <!-- Display search results -->
    <?php //} ?> 

    <?php if (!(isset($_POST["reg_search_button"]) or isset($_POST["post_search_button"]))) { //no search done ?>
        <!-- Display all results -->
        <h2>All Results</h2>
        <div class="all_posts">
            <?php print_posts($post_ids, $db) ?>
            <a href="index.php">Return to All Results</a>
        </div>
    <?php } ?> 

    <?php if (isset($_POST["reg_search_button"]) or isset($_POST["post_search_button"])) { //search done ?>
        <!-- Display all results -->
        <h2>Search Results</h2>
        <div class="all_posts">
            <?php 
            if(sizeof($post_ids) == 0){
                echo("No search results found.");
            } else{
                print_posts($post_ids, $db);
            } ?>
            <a href="index.php">Return to All Results</a>
        </div>
    <?php } ?> 

</div>


</div>
  <?php include("includes/footer.php");?>
</body>
</html>