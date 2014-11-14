<?php session_name('TCSESSION');
	session_set_cookie_params(0, '/~user/');
	session_start();	
	
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$log_username = '';
	$log_password = '';
	
	if (isset($_POST['username'])) {
		$log_username = mysql_real_escape_string($_POST['username']);
	}
	
	if (isset($_POST['password'])) {
		$log_password = mysql_real_escape_string($_POST['password']);
	}
	
	
	$query = "select * from TCusers
		where username = '$log_username' and passhash = sha('$log_password')"; 
	
	$result = mysql_query($query, $connection);
	
	
	/*so this checks first to see if the login query resulted in only 1 row,
		next it checks to make sure the user is verified and not blocked, if so
		the user will be checked to see if they are an administrator, if they are,
		they're logged in as such, otherwise logged as a regular user.
		If one of the security checks (row count, blocked or verified) renders false
		then the person is thrown back to the login page*/
	if (mysql_num_rows($result) == 1) {
		$log_array = mysql_fetch_array($result);
		if (($log_array['verified'] == 1) and $log_array['blocked'] == 0) {
			if ($log_array['admin'] == 1) {
				$_SESSION['authorisation'] = 'admin';
				$_SESSION['TCusername'] = $log_array['username'];
				header("Location: TCadminpage.php");
				exit;
			} elseif ($log_array['admin'] == 0 ){
				$_SESSION['authorisation'] = 'user';
				$_SESSION['TCusername'] = $log_array['username'];
				header("Location: TCuserpage.php");
				exit;
			}
			//also set some session vars to some other data to show logged in status
			
		}
		$_SESSION['authorisation'] = 'unknownuser';
		header("Location: TCloginform.php");
		exit;
	} else {
		$_SESSION['authorisation'] = 'unknownuser';
		header("Location: TCloginform.php");
		exit;
		}	
		

?>