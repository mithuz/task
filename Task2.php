<?php
/*
 * This file is used to retrieve data from the tables
 */

function __autoload($class_name) {
    include $class_name . '.php';
}
$objTask  = new TaskClass();
$result   = $objTask->getResults();

?>
