<?php require 'TCadminprotect.php';
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$add_username = '';
	$add = '';
	
	if (isset($_POST['username'])) {
		$add_username = mysql_real_escape_string($_POST['username']);
	}
	//gets an array of all the users and their admin statuses
	$query = "SELECT username, admin FROM TCusers WHERE username = '$add_username';";
	$queryresult = mysql_fetch_array(mysql_query($query, $connection));
	
	//if the user isnt an admin then they will be banned/unbanned accordingly
	if (($queryresult['admin'] == 0) and ($queryresult['username'] == $add_username)) {
		$add = "UPDATE TCusers SET admin = 1 WHERE username = '$add_username';"; 
	}
	
	
	$result = mysql_query($add, $connection);
	
	if (($result == 1)) { ?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Promote Success</title>
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Promote Success!</h1>
            <p>You have successfully promoted: <?php echo $add_username; ?>.<br>
            <a href="TCaddadmin.php">Promote Another</a><br>
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
        	<title>TradeCore Admin Promote Failure</title>
       
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Promote Failure.</h1>
            <p>You must enter a valid non-admin user. <br>
            Go back and 
            <a href="TCaddadmin.php">try again.</a><br>
            <a href="TCadminpage.php">Admin Page</a></p>
        </body>
        </html>
<?php } 
?>