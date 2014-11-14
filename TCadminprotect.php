<?php session_name('TCSESSION');
	session_set_cookie_params(0, '/~user/');
	session_start();
	//if the session isnt set, or if their session variable isnt set to 'admin' then the get thrown to login
	if (!isset($_SESSION['authorisation']) or $_SESSION['authorisation'] != 'admin') {
		header("Location: TCloginform.php");
		exit;
		}
		
?>