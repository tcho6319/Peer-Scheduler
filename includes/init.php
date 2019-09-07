<?php
// vvv DO NOT MODIFY/REMOVE vvv

// Resource from Kyle J. Harms Cornell University INFO 2300 Course
function check_php_version()
{
  if (version_compare(phpversion(), '7.0', '<')) {
    define(VERSION_MESSAGE, "PHP version 7.0 or higher is required for 2300. Make sure you have installed PHP 7 on your computer and have set the correct PHP path in VS Code.");
    echo VERSION_MESSAGE;
    throw VERSION_MESSAGE;
  }
}
check_php_version();

function config_php_errors()
{
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 0);
  error_reporting(E_ALL);
}
config_php_errors();

// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename)
{
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (file_exists($init_sql_filename)) {
      $db_init_sql = file_get_contents($init_sql_filename);
      // var_dump($db_init_sql);
      try {
        $result = $db->exec($db_init_sql);
        // var_dump($result);
        // var_dump($db);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        // If we had an error, then the DB did not initialize properly,
        // so let's delete it!
        unlink($db_filename);
        throw $exception;
      }
    } else {
      unlink($db_filename);
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return null;
}

function exec_sql_query($db, $sql, $params = array())
{
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return null;
}
$db = open_or_init_sqlite_db('secure/posts.sqlite', 'secure/init1.sql');


//Variables to use throughout site
#majors_array
$majors = ["Africana Studies", 
"Agricultural Sciences", 
"American Studies", 
"Animal Science", 
"Anthropology", 
"Applied Economics and Management", 
"Archaeology", 
"Architecture", 
"Asian Studies", 
"Astronomy", 
"Atmospheric Science", 
"Biological Engineering", 
"Biological Sciences", 
"Biology and Society", 
"Biomedical Engineering", 
"Biometry and Statistics", 
"Chemical Engineering", 
"Chemistry and Chemical Biology", 
"China and Asia-Pacific Studies", 
"Civil Engineering", 
"Classics (Classics, Classical Civ., Greek, Latin)", 
"College Scholar Program", 
"Communication", 
"Comparative Literature", 
"Computer Science", 
"Design and Environmental Analysis", 
"Development Sociology", 
"Earth and Atmospheric Sciences", 
"Economics", 
"Electrical and Computer Engineering", 
"Engineering Physics", 
"English", 
"Entomology", 
"Environmental and Sustainability Sciences", 
"Environmental Engineering", 
"Feminist Gender & Sexuality Studies", 
"Fiber Science and Apparel Design", 
"Fine Arts", 
"Food Science", 
"French", 
"German Studies", 
"Global & Public Health Sciences", 
"Government", 
"History", 
"History of Architecture (transfer students only)", 
"History of Art", 
"Hotel Administration", 
"Human Biology", "Health and Society", 
"Human Development", 
"Independent Major—Arts and Sciences", 
"Independent Major—Engineering", 
"Industrial and Labor Relations", 
"Information Science", 
"Information Science, Systems, and Technology", 
"Interdisciplinary Studies", 
"International Agriculture and Rural Development", 
"Italian", 
"Landscape Architecture", 
"Linguistics", 
"Materials Science and Engineering", 
"Mathematics", 
"Mechanical Engineering", 
"Music", 
"Near Eastern Studies", 
"Nutritional Sciences", 
"Operations Research and Engineering", 
"Performing and Media Arts", 
"Philosophy", 
"Physics", 
"Plant Sciences", 
"Policy Analysis and Management", 
"Psychology", 
"Religious Studies", 
"Science and Technology Studies", 
"Sociology", 
"Spanish", 
"Statistical Science", 
"Urban and Regional Studies", 
"Viticulture and Enology"];

$minors = ["Aerospace Engineering", 
"Africana Studies", 
"Agribusiness Management", 
"American Indian and Indigenous Studies", 
"American Studies", 
"Animal Science", 
"Anthropology", 
"Applied Economics", 
"Applied Exercise Science", 
"Applied Mathematics", 
"Arabic", 
"Archaeology", 
"Architecture", 
"Asian American Studies", 
"Astronomy", 
"Atmospheric Science", 
"Biological Engineering", 
"Biological Sciences", 
"Biomedical Engineering", 
"Biomedical Sciences", 
"Biometry and Statistics", 
"Business", 
"Business for Engineering Students", 
"China and Asia-Pacific Studies", 
"Civil Infrastructure", 
"Classical Civilization", 
"Classics", 
"Climate Change", 
"Cognitive Science", 
"Communication", 
"Comparative Literature", 
"Computer Science", 
"Computing in the Arts", 
"Creative Writing", 
"Crime, Prisons, Education, and Justice", 
"Crop Management", 
"Dance", 
"Demography", 
"Design & Environmental Analysis", 
"Development Sociology", 
"Earth and Atmospheric Sciences", 
"East Asian Studies", 
"English", 
"Education", 
"Electrical and Computer Engineering", 
"Engineering Entrepreneurship", 
"Engineering Management", 
"Engineering Statistics", 
"Entomology", 
"Environmental Energy & Resource Economics", 
"Environmental Engineering", 
"Environmental and Sustainability Sciences", 
"European Studies", 
"Feminist, Gender & Sexuality Studies", 
"Fiber Science", 
"Film", 
"Fine Arts", 
"Food Science", 
"French", 
"Fungal Biology", 
"Game Design", 
"German Studies", 
"Gerontology", 
"Global Health", 
"Globalization, Ethnicity & Development", 
"Health Policy", 
"History", 
"History of Art", 
"History of Capitalism", 
"Horticulture", 
"Human Development", 
"Industrial Systems & Information Technology", 
"Inequality Studies", 
"Infectious Disease Biology", 
"Information Science", 
"International Relations", 
"International Development Studies", 
"International Trade & Development", 
"Italian Studies", 
"Jewish Studies", 
"Landscape Studies", 
"Latin American Studies", 
"Latina/o Studies", 
"Law and Regulation", 
"Law and Society", 
"Leadership", 
"Lesbian, Gay, Bisexual & Transgender Studies", 
"Linguistics", 
"Marine Biology", 
"Materials Science and Engineering", 
"Mathematics", 
"Mechanical Engineering", 
"Medieval Studies", 
"Minority, Indigenous and Third World Studies", 
"Music", 
"Near Eastern Studies", 
"Nutrition & Health", 
"Operations Research & Management Science", 
"Performing and Media Arts", 
"Philosophy", 
"Physics", 
"Plant Breeding", 
"Plant Sciences", 
"Policy Analysis and Management", 
"Portuguese and Brazilian Studies", 
"Psychology", 
"Public Policy", 
"Real Estate", 
"Religious Studies", 
"Robotics", 
"Russian", 
"Sanskrit Studies", 
"Science & Technology Studies", 
"Soil Science", 
"South Asian Studies", 
"Southeast Asian Studies", 
"Spanish", 
"Sustainable Energy Systems", 
"Theatre", 
"University-Wide Business Minor", 
"Urban and Regional Studies", 
"Viking Studies", 
"Visual Studies", 
"Viticulture and Enology"];

//Associative array to store actual school name => schools.school in db 

$schools_dict = array(
  "cals" => "College of Agriculture & Life Sciences",
  "caap" => "College of Architecture, Art, & Planning",
  "cas" => "College of Arts & Sciences",
  "sc" => "SC Johnson College of Business",
  "coe" => "College of Engineering",
  "humec" => "College of Human Ecology",
  "ilr" => "School of Industrial & Labor Relations"
);



//Function to print out multiple select options
//Based on given array
function print_options($options){
    foreach($options as $option){
        echo "<option value='" . strtolower(htmlspecialchars($option)) . "'>".htmlspecialchars($option)."</option>";
        
    }
}

//Function to insert image
function insert_img($id, $db, $isSmall = False){
     //sql query to get img details
     $sql = "SELECT * FROM images INNER JOIN posts ON images.id = posts.image_id WHERE posts.id= :post_id;";
     $params = array(':post_id' => $id);
     $img_array = exec_sql_query($db, $sql, $params)->fetchAll();
     
     $img = $img_array[0];

     $img_id = htmlspecialchars($img["id"]);
     $img_citation = htmlspecialchars($img["citation"]);

     $img_citation = "schedule or four year plan of: " . htmlspecialchars($img_citation);
     $img_ext = htmlspecialchars($img["img_ext"]);

     $img_path = "uploads/images/".$img_id.".".$img_ext;

     if($isSmall){ //thumbnail ver of img
      echo "<img class='small_post_img' src='" . $img_path . "' alt='" . $img_citation . "'>";
     }
     else {
       echo "<img class='post_img' src='" . $img_path . "' alt='" . $img_citation . "'>";
      }


}

function print_track_options($tracks){
  foreach($tracks as $track){
      echo "<option value='" . htmlspecialchars($track) . "'>".ucfirst(htmlspecialchars($track))."</option>";
  }
}


//load all the posts and through post_majors get major_id, through post_tracks, 
//get track_id, get term_id, get year_id, get a_description
function load_post($post_id, $db){
  //Loads post

  //majors
  $sql = "SELECT majors.major FROM majors INNER JOIN post_majors ON majors.id = post_majors.major_id WHERE post_majors.post_id = :post_id;";
  $params = array(':post_id' => $post_id);
  $post_majors = exec_sql_query($db, $sql, $params)->fetchAll();
  //var_dump($post_majors);

  //minors
  $sql = "SELECT minors.minor FROM minors INNER JOIN post_minors ON minors.id = post_minors.minor_id WHERE post_minors.post_id = :post_id;";
  $params = array(':post_id' => $post_id);
  $post_minors = exec_sql_query($db, $sql, $params)->fetchAll();

  //tracks
  $sql = "SELECT tracks.track FROM tracks INNER JOIN post_tracks ON tracks.id = post_tracks.track_id WHERE post_tracks.post_id = :post_id;";
  $params = array(':post_id' => $post_id);
  $tracks = exec_sql_query($db, $sql, $params)->fetchAll();
  //var_dump($tracks);

  //term
  $sql = "SELECT terms.term FROM posts INNER JOIN terms ON terms.id = posts.term_id WHERE posts.id = :post_id;";
  $params = array(':post_id' => $post_id);
  $term = exec_sql_query($db, $sql, $params)->fetchAll();
  $term = $term[0];
  //var_dump($term["term"]);

  //year
  $sql = "SELECT years.year FROM posts INNER JOIN years ON years.id = posts.year_id WHERE posts.id = :post_id;";
  $params = array(':post_id' => $post_id);
  $year = exec_sql_query($db, $sql, $params)->fetchAll();
  $year = $year[0];
  //var_dump($year["year"]);

  //description
  $sql = "SELECT posts.a_description FROM posts WHERE posts.id = :post_id;";
  $params = array(':post_id' => $post_id);
  $a_description = exec_sql_query($db, $sql, $params)->fetchAll();
  $a_description = $a_description[0]["a_description"];
  //var_dump($a_description["a_description"]);

  print_post($post_id, $post_majors, $post_minors, $tracks, $term, $year, $a_description, $db);


}
  
function print_post($post_id, $majors, $minors, $tracks, $term, $year, $a_description, $db){
  //Prints div and details for one post

  //getting majors printable
  $print_majors = "Major(s): ";
  $major_count = 0;
  foreach($majors as $major){
      $major = ucwords($major["major"]);

      if($major_count == 0){ //first major
          $print_majors = $print_majors . $major;
      }
      else{
          $print_majors = $print_majors . ", " . $major;
      }
      $major_count = $major_count + 1;
      
  }

  //getting minors printable
  if(sizeof($minors) > 0){
    $print_minors = "Minor(s): ";
    $minor_count = 0;
    foreach($minors as $minor){
    $minor = ucwords($minor["minor"]);

    if($minor_count == 0){ //first minor
        $print_minors = $print_minors . $minor;
    }
    else{
        $print_minors = $print_minors . ", " . $minor;
    }
    $minor_count = $minor_count +1;
    
}
}
else{
    $print_tracks = "";
}

  //making tracks printable
  if(sizeof($tracks) > 0){
      $print_tracks = "Track(s): ";
      $track_count = 0;
      foreach($tracks as $track){
      $track = ucfirst($track["track"]);

      if($track_count == 0){ //first track
          $print_tracks = $print_tracks . $track;
      }
      else{
          $print_tracks = $print_tracks . ", " . $track;
      }
      $track_count = $track_count +1;
      
  }
  }
  else{
      $print_tracks = "";
  }

  //term printable
  $term = str_replace("_", " ", $term["term"]);
  $term = ucwords($term);
  $print_term = "Term: " . $term;

  //year printable
  $year = ucfirst($year["year"]);
  $print_year = "Year: " . $year;


  //post_id printable
  $print_post_id = "#" . htmlspecialchars($post_id);

  //post heading
  if (sizeof($minors) > 0){
    $heading = $print_term . " &#9830; " . $print_year . " &#9830; " . $print_majors . " &#9830; " . $print_minors;
  }

  if (sizeof($minors) <= 0){
    $heading = $print_term . " &#9830; " . $print_year . " &#9830; " . $print_majors;
  }

  if(sizeof($tracks) > 0){
      $heading .= " &#9830; " . $print_tracks;
  }



  //a_description  printable
  if(sizeof($a_description) <= 0){
      $a_description = "";
  }

  //truncate a_description in post preview
  if(strlen($a_description) > 180){
    $a_description .= "...";
  }

  // echo "<a class='post_a' href='schedView.php?" . http_build_query(array('id' => $post_id)) . "'><div class='post'><h3><span class='post_id'>" . htmlspecialchars($print_post_id) . "</span>" . $heading . "</h3><p>" . htmlspecialchars($a_description) . "</p></div></a>";
  echo "<a href='schedView.php?" . http_build_query(array('id' => $post_id)) . "'><div class='entire_post'><div class='post_img_div'>"; 
  insert_img($post_id, $db, True);
  echo "</div><div class='post_text_div'><div class='post'><h3><span class='post_id'>" . htmlspecialchars($print_post_id) . "</span>" . $heading . "</h3><p>" . htmlspecialchars($a_description) . "</p></div></div></div></a>";
}




//function to print multiple blurbs
function print_posts($post_ids, $db){
  foreach($post_ids as $post_id){
      load_post((int)$post_id["id"], $db);
  }      
}

//function to return a filtered input array of strings for upload form
function filter_arr_input($elem_name){
  $arr_filtered = array(); 
  foreach($_POST[$elem_name] as $option_unfilt){
    $arr_filtered[] = filter_var($option_unfilt, FILTER_SANITIZE_STRING);
  }

  return $arr_filtered;
}

//function to add input array items into db. Like major, minor, tracks
//table_type is either majors, minors, tracks
function add_arr_inputs_to_db($db, $arr_input, $table_type, $upload_post_id){
 //get list of ids of each item in arr_input (like id of major in upload_majors)
 $arr_input_ids = array(); 
 foreach($arr_input as $input_elem){
  if($table_type == "majors"){
    $sql = "SELECT majors.id FROM majors WHERE majors.major = :input_elem;";
  }

  if($table_type == "minors"){
    $sql = "SELECT minors.id FROM minors WHERE minors.minor = :input_elem;";
  }

  if($table_type == "tracks"){
    $sql = "SELECT tracks.id FROM tracks WHERE tracks.track = :input_elem;";
  }
  $params = array(':input_elem' => $input_elem);
  $input_id = exec_sql_query($db, $sql, $params)->fetchAll();
  $input_id = $input_id[0]["id"];

  $arr_input_ids[] = $input_id;

}
  //for each id, insert into the appropriate relational table  
  foreach($arr_input_ids as $input_id){
    if($table_type == "majors"){
      $sql = "INSERT INTO post_majors ('post_id', 'major_id') VALUES (:upload_post_id, :input_id);";
    }

    if($table_type == "minors"){
      $sql = "INSERT INTO post_minors ('post_id', 'minor_id') VALUES (:upload_post_id, :input_id);";
    }

    if($table_type == "tracks"){
      $sql = "INSERT INTO post_tracks ('post_id', 'track_id') VALUES (:upload_post_id, :input_id);";
    }

    $params = array(
      ':upload_post_id' => $upload_post_id,
      ':input_id' => $input_id
    );
    $result = exec_sql_query($db, $sql, $params);
  }
}


?>