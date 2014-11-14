<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="TCverify.css">

<title>TradeCore Verification Form</title>



<?php include 'hidden/TCnavbar.php'; ?>
<form action="TCverificationscript.php" method="post">
  <fieldset>
  <legend>Verify your TradeCore account:</legend>
  <label for="username">Enter username:</label><input type="text" name="username" id="username" ><br>
  <label for="password">Enter password:</label><input type="password" name="password" id="password" ><br>
  <label for="verstring">Enter verification code: </label><input type="text" name="verstring" id="verstring" ><br>
  <br>
  <input type="submit" value="Verify" >
    
    
  </fieldset>
</form>



</body>

</html>
