<?php $connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$ver_username = '';
	$ver_password = '';
	
	if (isset($_POST['username'])) {
		$ver_username = mysql_real_escape_string($_POST['username']);
		
	}
	
	if (isset($_POST['password'])) {
		$ver_password = mysql_real_escape_string($_POST['password']);
	
	}
	if (isset($_POST['verstring'])) {
		$ver_string = mysql_real_escape_string($_POST['verstring']);// makes sure that string is all fine and dandy
	
	}
	
	$query = "UPDATE TCusers SET verified = 1
		WHERE username = '$ver_username' AND passhash = sha('$ver_password') AND verstring = '$ver_string';"; //updated for new verification string
	
	$result = mysql_query($query, $connection);
	
	if ($result == 1) { ?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Verification Success</title>
     
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>You have been successfully verified on TradeCore!</h1>
            <p>Now that you've verified your account, you can log in!<br>
            <a href="TCloginform.php">Log in to TradeCore</a><br>
            <a href="index.php">TradeCore Index</a></p>
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
        	<title>TradeCore Verification Failure</title>
       
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Verification Failure.</h1>
            <p>You must enter your username, password and verification string. <br>
            Go back and try again.<br>
            <a href="TCverify.php">Try Again</a><br>
            <a href="index.php">TradeCore Index</a></p>
        </body>
        </html>
<?php } 
?>