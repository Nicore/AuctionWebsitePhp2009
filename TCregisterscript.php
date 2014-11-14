<?php	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	//required data
	$reg_username = '';
	$reg_password = '';
	$reg_email = '';
	//personal data
	$reg_first = '';
	 $reg_last = '';
	 $reg_phone = '';
	 $reg_address1 = '';
	 $reg_address2 = '';
	 $reg_city = ''; 
	 $reg_post = '';
	//unique verification code
	$sha_user = '';
	
	//cleans the required data, stripping php, html and sql stuff
	if (isset($_POST['username'])) {
		$reg_username = strip_tags(mysql_real_escape_string($_POST['username']));
		$sha_user = substr(sha1($reg_username),0,8); //creates an 8-character long code
	}
	if (isset($_POST['password'])) {
		$reg_password = strip_tags(mysql_real_escape_string($_POST['password']));
	}
	if (isset($_POST['email'])) {
		$reg_email = strip_tags(mysql_real_escape_string($_POST['email']));
	}
	//cleans personal data
	$reg_first = strip_tags(mysql_real_escape_string($_POST['firstname']));
	$reg_last  = strip_tags(mysql_real_escape_string($_POST['lastname']));
	$reg_phone = strip_tags(mysql_real_escape_string($_POST['phone']));
	$reg_address1 = strip_tags(mysql_real_escape_string($_POST['address1']));
	$reg_address2 = strip_tags(mysql_real_escape_string($_POST['address2']));
	$reg_city = strip_tags(mysql_real_escape_string($_POST['city']));
	$reg_post = strip_tags(mysql_real_escape_string($_POST['postcode']));
	
	//inserts data into TCusers table
	$insert = "insert into TCusers (username, passhash, email, verified, admin, blocked, verstring, firstname, lastname, phone, address1, address2, city, postcode) 
		values ('$reg_username', sha('$reg_password'), '$reg_email', 0, 0, 0, '$sha_user', '$reg_first', '$reg_last', '$reg_phone', '$reg_address1', '$reg_address2', '$reg_city', '$reg_post');"; 
	
	$result = mysql_query($insert, $connection);
	
	//if the insert is successful (1) then return with a success page and send a verification email, otherwise return a fail page.
	if ($result == 1) { 
	
	//verification email goes here
	//mail(to,subject,message,headers,parameters)
	$subject = "TradeCore Registration Verification: $reg_username";
	$message = '<html>
	<head>
		<title>TradeCore Registration Verification: $reg_username</title>
		<style type="text/css">body {font-family:sans-serif; }</style>
	</head>
	<body>
		<h1>TradeCore Registration Verification</h1>
		<p>Hello ' . $reg_first . ' ' .$reg_last . '.
			<br><br>
			You have successfully registered at TradeCore, all you need to do now is verify your account by following this link:<br>
			<a href="http://web212.otago.ac.nz/~ncomer/assign2/TCverify.php">http://web212.otago.ac.nz/~ncomer/assign2/TCverify.php</a>
			<br><br>
			Oh, by the way, ' . $sha_user . ' is your verification code.
			<br><br>
			Thank you!
			<br><br><br>
			Note: Do not respond to this email, it leads to nothing.
		</p>
	</body>
	</html>
	';
	$from = "noreply@TradeCore.com";
	$headers = "From: $from";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($reg_email,$subject,$message,$headers);


	
		?> 
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Registration Success</title>
    
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>You have successfully registered on TradeCore!</h1>
            <p>A verification email has been sent to your email, please follow the instructions within it to verify your account.<br>
            By the way, the email will probably take forever to arrive.<br>
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
        	<title>TradeCore Registration Failure</title>
        
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Registration Failure.</h1>
            <p>You must enter at least a username, password and email address. <br>
            Go back and 
            <a href="TCregister.php">try again.</a><br>
            <a href="index.php">TradeCore Index</a></p>
        </body>
        </html>
		<?php }
?>