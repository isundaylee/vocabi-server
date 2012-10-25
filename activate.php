<?php

$key = $_POST['key']; 

if (file_exists('keys/' . $key)) {
	echo json_encode({'result': TRUE}); 
} else {
	echo json_encode({'result': FALSE, 'error': 'Invalid key. '}); 
}

?>