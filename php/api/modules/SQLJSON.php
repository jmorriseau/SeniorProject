<?php
/*
 * SqlJson Class this class converts the sql statement  to Json
 */
class SQLJSON{
    function convertToJSON($input){
        $count = count($input[0])/2;
        $data = [];
        for($J = 0; $J<count($input);$J++){
            $current = [];
            for($js = 0;$js<$count;$js++){
                array_push($current,$input[$J][$js]);
            }

            array_push($data,$current);
        }

        return json_encode($data);
    }
}