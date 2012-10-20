<?php 

header('Content-type: text/json; '); 

ini_set('display_errors', '0');

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

if (!validatePasscode($passcode)) {
	echo json_encode(array('passcode' => $passcode, 'result' => FALSE, 'error' => 'Invalid passcode. ')); 
	exit(); 
}

$path = 'notesync/' . $passcode; 

if (!file_exists($path)) {
	echo json_encode(array('passcode' => $passcode, 'result' => FALSE, 'error' => 'No synced notebook associated with the given passcode. ')); 
} else {
	$content = file_get_contents($path); 
	echo json_encode(array('passcode' => $passcode, 'result' => TRUE, 'content' => $content)); 
}
	
?>