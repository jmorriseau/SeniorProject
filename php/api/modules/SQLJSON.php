<?php
/*
 * SqlJson Class this class converts the sql statement  to Json
 */
class SQLJSON{
    function convertToJSON($json){

        $count = count($json[0])/2;
        $data = [];
        for($J = 0; $J<count($json);$J++){
            //$array = json_decode($json, true);
            $current = [];
            for($js = 0;$js<$count;$js++){
                array_push($current,$json[$J][$js]);
            }

            array_push($data,$current);
        }

        return json_encode($data,JSON_PRETTY_PRINT);
    }
}
/**
 * Indents a flat JSON string to make it more human-readable.
 *
 * @param string $json The original JSON string to process.
 *
 * @return string Indented version of the original JSON string.
 */
//function indent($json) {
//
//    $result      = '';
//    $pos         = 0;
//    $strLen      = strlen($json);
//    $indentStr   = '  ';
//    $newLine     = "\n";
//    $prevChar    = '';
//    $outOfQuotes = true;
//
//    for ($i=0; $i<=$strLen; $i++) {
//
//        // Grab the next character in the string.
//        $char = substr($json, $i, 1);
//
//        // Are we inside a quoted string?
//        if ($char == '"' && $prevChar != '\\') {
//            $outOfQuotes = !$outOfQuotes;
//
//            // If this character is the end of an element,
//            // output a new line and indent the next line.
//        } else if(($char == '}' || $char == ']') && $outOfQuotes) {
//            $result .= $newLine;
//            $pos --;
//            for ($j=0; $j<$pos; $j++) {
//                $result .= $indentStr;
//            }
//        }
//
//        // Add the character to the result string.
//        $result .= $char;
//
//        // If the last character was the beginning of an element,
//        // output a new line and indent the next line.
//        if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
//            $result .= $newLine;
//            if ($char == '{' || $char == '[') {
//                $pos ++;
//            }
//
//            for ($j = 0; $j < $pos; $j++) {
//                $result .= $indentStr;
//            }
//        }
//
//        $prevChar = $char;
//    }
//
//    return $result;
//}
//
////$json = json_decode($string);
//echo json_encode($json, JSON_PRETTY_PRINT);