$(document).ready(function(){


$("#search_category").change(function() {
//based on value of search_category, use a different array for autocomplete
if ($(this).val() == "by_major" ||$(this).val() == "by_minor" ){

    if ($(this).val() == "by_major") {
      $('#major_searchDiv').show();

      $('#minor_searchDiv').hide();
      $('#college_searchDiv').hide();
      $('#track_searchDiv').hide();
      $('#description_searchDiv').hide();

      var tags = ["Africana Studies", 
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
      
    //   $('#otherField').attr('required', '');
    //   $('#otherField').attr('data-error', 'This field is required.');
    var datalist = "major_datalist";
    } 

    else if ($(this).val() == "by_minor") {
        $('#minor_searchDiv').show();

        $('#major_searchDiv').hide();
        $('#college_searchDiv').hide();
        $('#track_searchDiv').hide();
        $('#description_searchDiv').hide();

        var tags = ["Aerospace Engineering", 
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
      //   $('#otherField').attr('required', '');
      //   $('#otherField').attr('data-error', 'This field is required.');
      var datalist = "minor_datalist";
      } 

    
        //Code Adapted from: Kartikaybhutani https://www.geeksforgeeks.org/javascript-auto-complete-suggestion-feature/

         //setting up autocomplete/autosuggest
         var n= tags.length; //length of datalist tags     
      
         function ac(input_val) { 
           //setting datalist empty at the start of function 
            document.getElementById(datalist).innerHTML = ''; 
               
             l=input_val.length; 
         for (var i = 0; i<n; i++) {  //iterate through datalist tags
             if(((tags[i].toLowerCase()).indexOf(input_val.toLowerCase()))>-1) //if input_val exists tags[i]
             { 
                
                 //appending tags[i] to datalist 
                 var node = document.createElement("option"); 
                 var val = document.createTextNode(tags[i]); 
                  node.appendChild(val); 
      
                   document.getElementById(datalist).appendChild(node);  
                 } 
             } 
         }
    }
    //if not autocomplete search option, just show div of form element
    else if ($(this).val() == "by_college" ||$(this).val() == "by_track" ||$(this).val() == "by_description"){ //show/hide form elems
        if ($(this).val() == "by_college") {
            $('#college_searchDiv').show();

            $('#major_searchDiv').hide();
            $('#minor_searchDiv').hide();
            $('#track_searchDiv').hide();
            $('#description_searchDiv').hide();
          }

        else if ($(this).val() == "by_track") { //by_track
            $('#track_searchDiv').show();

            $('#major_searchDiv').hide();
            $('#minor_searchDiv').hide();
            $('#college_searchDiv').hide();
            $('#description_searchDiv').hide();
        }

        else { //by_description
            $('#description_searchDiv').show();

            $('#major_searchDiv').hide();
            $('#minor_searchDiv').hide();
            $('#college_searchDiv').hide();
            $('#track_searchDiv').hide();
        }

    }
    



    
    else { //category not selected
      $('#major_searchDiv').hide();
      $('#minor_searchDiv').hide();
      $('#college_searchDiv').hide();
      $('#track_searchDiv').hide();
      $('#description_searchDiv').hide();
    }
  });
  $("#search_category").trigger("change");


});
