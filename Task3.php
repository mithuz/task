<?php
/*
 * This file is used to finds all files whose names consist of numbers and letters of the Latin alphabet, have the extension ixt and displays the names of these files, ordered by name
 */

$files = glob('files/*.ixt');
$newFiles = array();
for($i=0;$i<count($files);$i++){
    $fileExt = explode('/',$files[$i]);
    if(preg_match('/^[a-z0-9]+\.ixt/i', $fileExt[1])== 1){
        $newFiles[] = $fileExt[1];
    }
}
asort($newFiles);
echo "<pre>"; print_r($newFiles); exit;
?>
