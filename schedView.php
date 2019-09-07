<?php
 // INCLUDE ON EVERY TOP-LEVEL PAGE!
include("includes/init.php");
$title = 'Schedule Viewer';
session_start();
$post_list = $_SESSION["post_list"];

$id = $_GET['id'];



if (isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
     //majors
     $sql = "SELECT majors.major FROM majors INNER JOIN post_majors ON majors.id = post_majors.major_id WHERE post_majors.post_id = :post_id;";
     $params = array(':post_id' => $id);
     $post_majors = exec_sql_query($db, $sql, $params)->fetchAll();
     //var_dump($post_majors);
 
     //minors
     $sql = "SELECT minors.minor FROM minors INNER JOIN post_minors ON minors.id = post_minors.minor_id WHERE post_minors.post_id = :post_id;";
     $params = array(':post_id' => $id);
     $post_minors = exec_sql_query($db, $sql, $params)->fetchAll();

     //tracks
     $sql = "SELECT tracks.track FROM tracks INNER JOIN post_tracks ON tracks.id = post_tracks.track_id WHERE post_tracks.post_id = :post_id;";
     $params = array(':post_id' => $id);
     $tracks = exec_sql_query($db, $sql, $params)->fetchAll();
     //var_dump($tracks);
 
     //term
     $sql = "SELECT terms.term FROM posts INNER JOIN terms ON terms.id = posts.term_id WHERE posts.id = :post_id;";
     $params = array(':post_id' => $id);
     $term = exec_sql_query($db, $sql, $params)->fetchAll();
     $term = $term[0];
     //var_dump($term["term"]);
 
     //year
     $sql = "SELECT years.year FROM posts INNER JOIN years ON years.id = posts.year_id WHERE posts.id = :post_id;";
     $params = array(':post_id' => $id);
     $year = exec_sql_query($db, $sql, $params)->fetchAll();
     $year = $year[0];
     //var_dump($year["year"]);

     //school
     $sql = "SELECT schools.school FROM posts INNER JOIN schools ON schools.id = posts.school_id WHERE posts.id = :post_id;";
     $params = array(':post_id' => $id);
     $school = exec_sql_query($db, $sql, $params)->fetchAll();
     $school = $school[0]["school"];
     $school = $schools_dict[$school];
     
 
     //description
     $sql = "SELECT posts.a_description FROM posts WHERE posts.id = :post_id;";
     $params = array(':post_id' => $id);
     $a_description = exec_sql_query($db, $sql, $params)->fetchAll();
     $a_description = $a_description[0]["a_description"];
     //var_dump($a_description["a_description"]);
 

     //Prints heading
     //getting majors printable
     $print_majors = "Major(s): ";
     $major_count = 0;
     foreach($post_majors as $major){
         $major = ucwords($major["major"]);
 
         if($major_count == 0){ //first major
             $print_majors = $print_majors . $major;
         }
         else{
             $print_majors = $print_majors . ", " . $major;
         }
         $major_count = $major_count + 1;
         
     }

     if(sizeof($post_minors) > 0){ //1+ minors recorded
        //getting majors printable
     $print_minors = "Minor(s): ";
     $minor_count = 0;
     foreach($post_minors as $minor){
         $minor = ucwords($minor["minor"]);
 
         if($minor_count == 0){ //first minor
             $print_minors = $print_minors . $minor;
         }
         else{
             $print_minors = $print_minors . ", " . $minor;
         }
         $minor_count = $minor_count + 1;
         
     }
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
         $track_count = $track_count + 1;
         
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
     $print_post_id = "#" . htmlspecialchars($id);
 
     //post heading
     if(sizeof($tracks) > 0 and sizeof($post_minors) > 0){ //minors and tracks included
         $heading = htmlspecialchars($print_term) . " &#9830; " . htmlspecialchars($print_year) . " &#9830; " . htmlspecialchars($print_majors) . " &#9830; " . htmlspecialchars($print_minors) . " &#9830; " . htmlspecialchars($print_tracks);
     }
 
     elseif (sizeof($tracks) <= 0 and sizeof($post_minors) > 0){ //minors not tracks included
        $heading = htmlspecialchars($print_term) . " &#9830; " . htmlspecialchars($print_year) . " &#9830; " . htmlspecialchars($print_majors) . " &#9830; " . htmlspecialchars($print_minors);
     }

     elseif (sizeof($tracks) > 0 and sizeof($post_minors) <= 0){ //tracks not minors included
        $heading = htmlspecialchars($print_term) . " &#9830; " . htmlspecialchars($print_year) . " &#9830; " . htmlspecialchars($print_majors) . " &#9830; " . htmlspecialchars($print_tracks);
     }

     else{ //tracks and minors NOT included
        $heading = htmlspecialchars($print_term) . " &#9830; " . htmlspecialchars($print_year) . " &#9830; " . htmlspecialchars($print_majors);
     }


     $a_description_exists = True; //in case no description for post
     if ($a_description == ""){
         $a_description_exists = False;
     }
  
  //-------------COMMENTS------------

  

 
 //Adding comments into db
if (isset($_POST["comment_button"])){
    if (isset($_POST["comment_input"]) and $_POST["comment_input"] != "" and filter_input(INPUT_POST, 'comment_input', FILTER_SANITIZE_STRING) != ""){
        $comment_inputIsValid = True;
        $comment_input = filter_input(INPUT_POST, 'comment_input', FILTER_SANITIZE_STRING);


        //add comment into db
        $sql1 = "INSERT INTO comments (comment) VALUES (:comment);";
        $params1 = array(':comment' => $comment_input);
        $result1 = exec_sql_query($db, $sql1, $params1);


        $newCommentId = $db->lastInsertId("id");
        $sql2 = "INSERT INTO post_comments (post_id, comment_id) VALUES (:post_id, :comment_id);";
        $params2 = array(
            ':post_id' => $id,
            ':comment_id' => $newCommentId
        );
        $result2 = exec_sql_query($db, $sql2, $params2);

    } 
}

//to display comments
$sql = "SELECT comments.comment FROM comments INNER JOIN post_comments ON comments.id = post_comments.comment_id WHERE post_comments.post_id = :post_id;";
$params = array(':post_id' => $id);
$post_comments = exec_sql_query($db, $sql, $params)->fetchAll();

//function to print comment divs
function print_comments($post_comments){
    if (count($post_comments) > 0){ //there are comments to print
      foreach($post_comments as $post_comment){
          $comment = html_entity_decode($post_comment["comment"], ENT_QUOTES);
        //   var_dump($comment);
          $comment = htmlspecialchars($comment, ENT_NOQUOTES);
        //   var_dump($comment);
          echo("<div class='comment'><p>" . $comment . "</p></div>");
      }
    } 
}


}



?>
<!DOCTYPE html>
<html lang="en">

<?php include("includes/head.php");?>

<body>
<?php include("includes/header.php");?>
<div id="entire_schedView">
    <div id="search_results_schedView">
        <div id="search_results_schedView_wrapper">
        <h2>Search Results</h2>
        <?php print_posts($post_list, $db) ?>
        </div>
    </div>
    <div id="current_schedView">
        <h2><?php echo $heading ?></h2>
            <h3><?php echo htmlspecialchars($school)?></h3>
            <h3 id="post_id_schedView"><?php echo htmlspecialchars($print_post_id) ?></h3>
            <div id="current_img"><?php insert_img($id, $db) ?></div>


        
        <?php if($a_description_exists){?>
            <h3>Description</h3>
                <p><?php echo htmlspecialchars($a_description)?></p>
        <?php } ?>
    
<hr>
    <div id="comments_div">
        <h3 id="comments">Comments</h3>
        <form id="comment_form" action="<?php echo 'schedView.php?' . http_build_query( array( "id" => $id ) ); ?>" method="post">
                <textarea rows="4" cols="50" name="comment_input" id="comment_input" placeholder="Add a comment here..." required></textarea>

                <button name="comment_button" type="submit">Comment</button>
        </form>
    
        <!-- TO DO: Display all comments -->
        <?php print_comments($post_comments) ?>
    </div>
    <a href="index.php">Return to All Results</a>
</div>
</div>

    <?php include("includes/footer.php");?>
</body>



</html>