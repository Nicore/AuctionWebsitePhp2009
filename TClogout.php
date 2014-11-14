<?php session_name('TCSESSION');
	session_set_cookie_params(0, '/~ncomer/');
	session_start();

	$_SESSION = array();
	session_destroy();
	//set cookie lifetime to be in the past.
	//Note: Must have same path specified!
	setcookie('TCSESSION', "", time() - 3600, '/~ncomer/');
	header("Location: TCloginform.php");
		exit;

?>