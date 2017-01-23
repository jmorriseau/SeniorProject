<?php
/**
 *
 * @author Mike
 */
//require_once '.../autoload.php';
interface iRestModel {
    //put your code here
// Each resource page must have the following functions with Sql Statements
    function getAll();
    function get($id);
    function post ($data);
    function put($id,$data);
    function delete($id);

}
