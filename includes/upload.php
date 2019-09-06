<?php const MAX_FILE_SIZE = 1000000; //Max file size is 10MB ?>

<div id="upload_div">
    
    <form id="upload_form" action="index.php" method="post" enctype="multipart/form-data">
        <fieldset>
        <legend>Upload and Share Your Schedule!</legend>
        <ul>
            <li>
                <label>Term: </label>
                <select name="upload_term">
                    <option value='spring'>Spring</option>
                    <option value='fall'>Fall</option>
                    <option value='four_year_plan'>Four Year Plan</option>
                    <option value='actual_four_year_plan'>Actual Four Year Plan</option>
                </select>
            </li>

        <li>
            <label>Year: </label>
            <select name="upload_year">
                <option value='freshman'>Freshman</option>
                <option value='sophomore'>Sophomore</option>
                <option value='junior'>Junior</option>
                <option value='senior'>Senior</option>
                <option value='alumni'>Alumni</option>
            </select>
        </li>

        <li>
            <label>Major(s): </label>
            <select multiple name="major_upload[]" size="3">
                <?php print_options($majors) ?>
            </select>
        </li>

        <li>
            <label>Minor(s): </label>
            <select multiple name="minor_upload[]" size="3">
                <?php print_options($minors) ?>
            </select>
        </li>

        <li>
            <label>College/School: </label>
            <select name="college_upload">
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
            <label>Special Track: </label>
            <select multiple name="track_upload[]">
                <?php print_track_options($tracks); ?>
            </select>
        </li>
         
        <li>
            <label for ="add_track">Can't find a special track? Add yours here: </label>
            <input type="text" name="add_track" id="add_track"/>
        </li>

        <li>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>"/>
            <label for="img_file">Upload Image of Schedule: </label>
            <input id="img_file" type="file" name="img_file"/>
        </li>

        <li>
            <label for ="upload_description">Description: </label>
            <input type="textarea" name="upload_description" id="upload_description"/>
        </li>

        
        <li>
            <button name="upload_button" type="submit">Upload Schedule</button>
        </li>
        
    </ul>

    </fieldset>

    </form>
</div>