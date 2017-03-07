<?php
//if program id is passed set it to a php variable
if(isset($_GET['cid'])){
    $curriculum_id = $_GET['cid'];
}
//if degree id is passed set it to a php variable
if(isset($_GET['did'])){
    $degree_id = $_GET['did'];
}


include('./autoload.php');

 $db = new DAO();

if (isset($curriculum_id)){
    $curriculums = $db->sql("SELECT * FROM Courses WHERE course_id in (SELECT course_id FROM Curriculum_Course_Relation WHERE curriculum_id = '" .$curriculum_id ."')");
    //var_dump($curriculums);

    if(count($curriculums) > 0){   

        //associate level 
            if($degree_id == "1"){
                echo '<h3>Quarter 1</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "1"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                }
                echo '</ul>';

                echo '<h3>Quarter 2</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "2"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';

                echo '<h3>Quarter 3</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "3"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';

                echo '<h3>Quarter 4</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "4"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';

                echo '<h3>Quarter 5</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "5"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';

                echo '<h3>Quarter 6</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "6"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';
            }

            //bachelor level
            if($degree_id == "2"){
                echo '<h3>Quarter 7</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "7"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                }
                echo '</ul>';

                echo '<h3>Quarter 8</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "8"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';

                echo '<h3>Quarter 9</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "9"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';

                echo '<h3>Quarter 10</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "10"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';

                echo '<h3>Quarter 11</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "11"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';

                echo '<h3>Quarter 12</h3>';
                echo '<ul>';
                foreach($curriculums as $c){
                    if($c[semester_number] == "12"){
                        echo '<li class="curriculum-from-db" data-courseid="' .$c[course_id]. '">'. $c[course_name] . '</li>';
                    }
                } 
                echo '</ul>';
            }
        
    }
    else if(count($curriculums) < 1) {
        echo 'No results returned.';
    }   
}
 ?>