<?php

header('Content-type: text/json; '); 

ini_set('display_errors', '0');

$key = $_POST['key']; 

if (trim($key) != '' && file_exists('keys/' . $key)) {
	echo json_encode(array('result' => TRUE)); 
} else {
	echo json_encode(array('result' => FALSE, 'error' => 'Invalid key. ')); 
}

?>