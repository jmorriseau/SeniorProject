<?php
/*
 * This file allows you auto load classes
 * without having to include them on the page.
 * include must be the name of the folder the classes are in
 */
function load_lib($class) {
    include 'api/modules/'.$class . '.php';
    include 'api/'.$class . '.php';
};
spl_autoload_register('load_lib');
session_start();
$_SESSION['logged_in'] = false;
$db = new DAO();
$tools = new SQLJSON();
