<?php

header('Content-type: text/json; '); 

ini_set('display_errors', '0');

function getRandomString($length = 6) {
    $validCharacters = "0123456789ABCDEF";
    $validCharNumber = strlen($validCharacters);
 
    $result = "";
 
    for ($i = 0; $i < $length; $i++) {
        $index = mt_rand(0, $validCharNumber - 1);
        $result .= $validCharacters[$index];
    }
 
    return $result;
}

function validatePasscode($passcode) {
	if (strlen($passcode) != 8) return FALSE; 
	for ($i=0; $i<strlen($passcode); $i++) {
		if ($passcode[i] >= 'A' && $passcode[i] <= 'Z') continue; 
		if ($passcode[i] >= '0' && $passcode[i] <= '9') continue; 
		return FALSE; 
	}
	return TRUE; 
}

$passcode = $_POST['passcode']; 
$content = $_POST['content']; 
$entity = $_POST['entity']; 

if (trim($passcode) == '') $passcode = getRandomString(8); 

if (!validatePasscode($passcode)) {
	echo json_encode(array('passcode' => $passcode, 'result' => FALSE, 'error' => 'Invalid passcode. ')); 
	exit(); 
}

$f = fopen('notesync/' . $passcode . '_' . $entity, 'w'); 

if (!$f) {
	echo json_encode(array('passcode' => $passcode, 'result' => FALSE, 'error' => 'Server side error. Please contact application developer. ')); 
}
else {
	fwrite($f, $content); 
	fclose($f); 
	echo json_encode(array('passcode' => $passcode, 'result' => TRUE)); 
}

?>