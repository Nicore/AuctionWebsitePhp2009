<?php require 'TCadminprotect.php';
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$ban_username = '';
	$block = '';
	
	if (isset($_POST['username'])) {
		$ban_username = mysql_real_escape_string($_POST['username']);
	}
	//gets an array of all the users and their admin statuses
	$query = "SELECT username, admin FROM TCusers WHERE username = '$ban_username';";
	$queryresult = mysql_fetch_array(mysql_query($query, $connection));
	
	//if the user isnt an admin then they will be banned/unbanned accordingly
	if (($_POST['block'] == 'Ban') and ($queryresult['admin'] == 0) and ($queryresult['username'] == $ban_username)) {
		$block = "UPDATE TCusers SET blocked = 1 WHERE username = '$ban_username';"; 
	} elseif (($_POST['block'] == 'Un-Ban') and ($queryresult['admin'] == 0) and ($queryresult['username'] == $ban_username)) {
		$block = "UPDATE TCusers SET blocked = 0 WHERE username = '$ban_username';";
	}
	
	
	$result = mysql_query($block, $connection);
	
	if (($result == 1) and ($_POST['block'] == 'Ban')) { ?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Block Success</title>
     
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Block Success!</h1>
            <p>You have successfully banned: <?php echo $ban_username; ?>.<br>
            <a href="TCbanuser.php">Block Another</a><br>
            <a href="TCadminpage.php">Admin Page</a></p>
        </body>
        </html>
		<?php
	} elseif (($result == 1) and ($_POST['block'] == 'Un-Ban')) { ?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Un-Block Success</title>
     
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Un-Block Success!</h1>
            <p>You have successfully un-banned <?php echo $ban_username; ?>.<br>
            <a href="TCbanuser.php">Un-Block Another</a><br>
            <a href="TCadminpage.php">Admin Page</a></p>
        </body>
        </html>
		<?php 
		} else { 
		?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Block Failure</title>
       
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Block Failure.</h1>
            <p>You must enter a valid non-admin user. <br>
            Go back and 
            <a href="TCbanuser.php">try again.</a><br>
            <a href="TCadminpage.php">Admin Page</a></p>
        </body>
        </html>
<?php } 
?>