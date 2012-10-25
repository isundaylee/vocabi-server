<?php

$key = $_POST['key']; 

if (file_exists('keys/' . $key)) {
	echo json_encode(array('result' => TRUE)); 
} else {
	echo json_encode(array('result' => FALSE, 'error' => 'Invalid key. ')); 
}

?>