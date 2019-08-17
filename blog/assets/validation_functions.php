
<?php

function validateEmail($email){
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	else
		return false;
}

function validatePassword($password){
	if (preg_match("/^[a-zA-Z0-9]+$/",$password)) {
		return true;
	}
	else
		return false;
}

function validateName($name){
    if (preg_match("/^[a-zA-Z]+$/",$name)) {
		return true;
	}
	else
		return false;
}
function validateImg($filename){
    $size = getimagesize($filename);
    $fp = fopen($filename, "rb");
    if ($size && $fp) {
        header("Content-type: {$size['mime']}");
        fpassthru($fp);
        exit;
    } else {
        return false;
    }
}
?>
