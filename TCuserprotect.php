<?php session_name('TCSESSION');
	session_set_cookie_params(0, '/~ncomer/');
	session_start();
	// if the session var isnt set or if the session var is neither 'admin' or 'user' then throw to login
	if (!isset($_SESSION['authorisation']) or (($_SESSION['authorisation'] != 'admin') and ($_SESSION['authorisation'] != 'user'))) {
		header("Location: TCloginform.php");
		exit;
		}
		
?>