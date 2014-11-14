<?php require 'TCuserprotect.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="TCregister.css">

<title>TradeCore Edit User Details Page</title>

<?php include 'hidden/TCnavbar.php'; ?>
<form action="TCusereditscript.php" method="post">
<fieldset>

<legend>Edit your TradeCore details:</legend>
<!--edit personal data here-->

<label for="password">Edit a password:</label><input type="password" name="password" id="password" ><br>
<label for="email">Edit your email:</label><input type="text" name="email" id="email" ><br>

<label for="firstname">Edit your first name:</label><input type="text" name="firstname" id="firstname" ><br>
<label for="lastname">Edit your last name:</label><input type="text" name="lastname" id="lastname" ><br>
<label for="phone">Edit your phone number:</label><input type="text" name="phone" id="phone" ><br>
<label for="address1">Edit your address:</label><input type="text" name="address1" id="address1" ><br>
<label for="address2">&nbsp;</label><input type="text" name="address2" id="address2" ><br>
<label for="city">Edit the nearest city:</label><input type="text" name="city" id="city" ><br>
<label for="postcode">Edit your postcode:</label><input type="text" name="postcode" id="postcode" ><br>
<br>
<input type="submit" value="Edit Details" >

</fieldset>
</form>
<p>Leave a field blank if you do not wish to change it.</p>
</body>
</html>