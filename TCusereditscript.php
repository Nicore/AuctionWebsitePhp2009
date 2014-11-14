<?php require 'TCuserprotect.php';
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	//required data
	$edit_username = '';
	$edit_password = '';
	$edit_email = '';
	//personal data
	 $edit_first = '';
	 $edit_last = '';
	 $edit_phone = '';
	 $edit_address1 = '';
	 $edit_address2 = '';
	 $edit_city = ''; 
	 $edit_post = '';
	$edit_usertable = '';
	
	//builds the SET part of the edit details query, also cleans all the data
	if ($_POST['password'] != '') {
		$edit_password = strip_tags(mysql_real_escape_string($_POST['password']));
		$edit_usertable .= "  passhash = sha('$edit_password')";
	}
	if ($_POST['email'] != '') {
		$edit_email = strip_tags(mysql_real_escape_string($_POST['email']));
		$edit_usertable .= ", email = '$edit_email'";
	}
	if ($_POST['firstname'] != '') {
		$edit_first = strip_tags(mysql_real_escape_string($_POST['firstname']));
		$edit_usertable .= ", firstname = '$edit_first'";
	}
	if ($_POST['lastname'] != '') {
		$edit_last  = strip_tags(mysql_real_escape_string($_POST['lastname']));
		$edit_usertable .= ", lastname = '$edit_last'";
	}
	if ($_POST['phone'] != '') {
		$edit_phone = strip_tags(mysql_real_escape_string($_POST['phone']));
		$edit_usertable .= ", phone = '$edit_phone'";
	}
	if ($_POST['address1'] != '') {
		$edit_address1 = strip_tags(mysql_real_escape_string($_POST['address1']));
		$edit_usertable .= ", address1 = '$edit_address1'";
	}
	if ($_POST['address2'] != '') {
		$edit_address2 = strip_tags(mysql_real_escape_string($_POST['address2']));
		$edit_usertable .= ", address2 = '$edit_address2'";
	}
	if ($_POST['city'] != '') {
		$edit_city = strip_tags(mysql_real_escape_string($_POST['city']));
		$edit_usertable .= ", city = '$edit_city'";
	}
	if ($_POST['postcode'] != '') {
		$edit_post = strip_tags(mysql_real_escape_string($_POST['postcode']));
		$edit_usertable .= ", postcode = '$edit_post'";
	}
	//removes potential ', ''s from $edit_usertable
	$edit_usertable = substr($edit_usertable, 1);
	//updates data in TCusers table
	$update = "UPDATE TCusers SET $edit_usertable WHERE username = '".$_SESSION['TCusername']."'";
	
	
	$result = mysql_query($update, $connection);
	
	//if the insert is successful (1) then return with a success page and send a verification email, otherwise return a fail page.
	if ($result == 1) { 
		?> 
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Detail Edit Success</title>
   
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>You have successfully editted your details!</h1>
            <p><br>
            <a href="TCuserpage.php">User Page</a></p>
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
        	<title>TradeCore Detail Edit Failure</title>
 
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Details Edit Failure.</h1>
            <p>Go back and 
            <a href="TCuseredit.php">try again.</a><br>
            <a href="TCuserpage.php">User Page</a></p>
        </body>
        </html>
		<?php }
?>