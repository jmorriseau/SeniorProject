<?php
//if program id is passed set it to a php variable
if(isset($_GET['cid'])){
    $curriculum_id = $_GET['cid'];
}
//if degree id is passed set it to a php variable
if(isset($GET['did'])){
    $degree_id = $_GET['did'];
}


include('./autoload.php');

 $db = new DAO();

if (isset($curriculum_id)){
    $curriculums = $db->sql("SELECT * FROM Courses WHERE course_id in (SELECT course_id FROM Curriculum_Course_Relation WHERE curriculum_id = '" .$curriculum_id ."')");
    //var_dump($curriculums);

    if(count($curriculums) > 0){       
        
            foreach($curriculums as $c){
                if($c[semester_number] == "1"){
                    echo '<h3>Quarter 1</h3>';
                    echo '<ul>';
                    echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    echo '</ul>';
                }
                //echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
            
            
            
            
            
            
            
            }
        
    }
    else if(count($curriculums) < 1) {
        echo 'No results returned.';
    }   
}
 ?>