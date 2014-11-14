<?php require 'TCuserprotect.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="TCcreateauction.css">
<title>TradeCore Auction Creation</title>

<?php include 'hidden/TCnavbar.php'; ?>
<form action="TCcreateauctionscript.php" enctype="multipart/form-data" method="post">
<fieldset>

<legend>Create an Auction:</legend>
<!--Basics-->
<label for="itemname">Enter an item name:</label><input name="itemname" type="text" id="itemname" maxlength="32" ><br>
<label for="initprice">Enter a starting price:</label><input name="initprice" type="text" id="initprice" value="1.00" maxlength="9" ><br> 
<!-- +0.00 then abs(num)-->
<label for="buyout">Set a buyout (optional):</label><input name="buyout" type="text" id="buyout" maxlength="9" ><br>
<br>
<label for="expiretime">List for how long?:</label><input name="expiretime" type="text" id="expiretime" value="5" maxlength="4" ><br> 
<!-- +0 to cast to int -->
	<input name="expirerange" type="radio" id="radbtn" value="MINUTE" checked> Minutes<br>
    <input type="radio" name="expirerange" id="radbtn" value="HOUR"> Hours<br>
    <input type="radio" name="expirerange" id="radbtn" value="DAY"> Days<br>
<br>
<!--Extras-->
<label for="itemdesc">Enter a description (recommended):</label><input name="itemdesc" type="text" id="itemdesc" maxlength="255" ><br>
<br>
<label for="upload">Post an image (optional):</label><input type="file" name="incoming" id="upload"><br>
Note: Images must be .jpg files under 100,000 bytes
<br>
<br>
<input type="submit" value="Create" >

</fieldset>
</form>

</body>


</html>
