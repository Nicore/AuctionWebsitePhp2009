<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="TCregister.css">
<title>TradeCore Registration</title>

<?php include 'hidden/TCnavbar.php'; ?>
<form action="TCregisterscript.php" method="post">
<fieldset>

<legend>Register for TradeCore:</legend>
<!--Enter the required details here-->
<label for="username">Enter a username:</label><input type="text" name="username" id="username" ><br>
<label for="password">Enter a password:</label><input type="password" name="password" id="password" ><br>
<label for="email">Enter your email:</label><input type="text" name="email" id="email" ><br>
<!--enter personal data here-->
<label for="firstname">Enter your first name:</label><input type="text" name="firstname" id="firstname" ><br>
<label for="lastname">Enter your last name:</label><input type="text" name="lastname" id="lastname" ><br>
<label for="phone">Enter your phone number:</label><input type="text" name="phone" id="phone" ><br>
<label for="address1">Enter your address:</label><input type="text" name="address1" id="address1" ><br>
<label for="address2">&nbsp;</label><input type="text" name="address2" id="address2" ><br>
<label for="city">Enter the nearest city:</label><input type="text" name="city" id="city" ><br>
<label for="postcode">Enter your postcode:</label><input type="text" name="postcode" id="postcode" ><br>
<br>
<input type="submit" value="Register" >

</fieldset>
</form>

</body>


</html>
