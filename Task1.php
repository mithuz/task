<?php
/*
 * This file is used to return the datas of the table 'test' with normal and success values on 'result' field
 */

function __autoload($class_name) {
    include $class_name . '.php';
}

$objTask  = new TaskClass();
$result = $objTask->get('normal');

echo "******************Datas with the 'result' value 'normal'******************";
echo "<br/>";
$html   = "";
for($i=0;$i<count($result);$i++){
    $html .= "Script Name :". $result[$i]['script_name']."<br/>";
    $html .= "Start Time :". date('Y-m-d H:i:s',$result[$i]['start_time'])."<br/>";
    $html .= "End Time :". date('Y-m-d H:i:s',$result[$i]['end_time'])."<br/>";
    $html .= "Result :". $result[$i]['result']."<br/>";
    $html .= "<br/><br/>";
    echo $html;
}
echo "*****************************End******************************************";


$successResults  =  $objTask->get('success');
echo "******************Datas with the 'result' value 'success'******************";
echo "<br/>";
$html1   = "";
for($i=0;$i<count($successResults);$i++){
    $html1 .= "Script Name :". $successResults[$i]['script_name']."<br/>";
    $html1 .= "Start Time :". date('Y-m-d H:i:s',$successResults[$i]['start_time'])."<br/>";
    $html1 .= "End Time :". date('Y-m-d H:i:s',$successResults[$i]['end_time'])."<br/>";
    $html1 .= "Result :". $successResults[$i]['result']."<br/>";
    $html1 .= "<br/><br/>";
    echo $html1;
}
echo "*****************************End******************************************";

?>
