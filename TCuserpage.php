<?php require 'TCuserprotect.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>TradeCore User Page</title>

<?php include 'hidden/TCnavbar.php'; ?>
<p>You've reached the user's page.</p>

<p><a href="TCcreateauction.php">Create an auction</a><br>
<a href="TCviewauctions.php">View all current auctions</a><br></p>

<h2>Your Details:</h2>
<?php /*basically go to the database and get everything from the TCusers table where
	it's relevant to the user's data*/
	$connection = mysql_connect("sapphire.otago.ac.nz", "ncomer", "h3llr34p3r");
	mysql_select_db('ncomer_prod', $connection);
	
	$query = "SELECT * FROM TCusers WHERE username = '".$_SESSION['TCusername']."'"; 
	
	$result = mysql_query($query, $connection);
	
	$row = mysql_fetch_array($result);
	echo "<dl>";
	  echo "<dt>Username:</dt><dd>" . $row['username'] . "<dd>";
	  echo "<dt>First Name:</dt><dd>" . $row['firstname'] . "<dd>";
	  echo "<dt>Last Name:</dt><dd>" . $row['lastname'] . "<dd>";
	  echo "<dt>Email:</dt><dd>" . $row['email'] . "<dd>";
	  echo "<dt>Phone#:</dt><dd>" . $row['phone'] . "<dd>";
	  echo "<dt>Address:</dt><dd>" . $row['address1'] . "<dd>";
	  echo "<dd>" . $row['address2'] . "<dd>";
	  echo "<dt>City:</dt><dd>" . $row['city'] . "<dd>";
	  echo "<dt>Postcode:</dt><dd>" . $row['postcode'] . "<dd>";

	echo "</dl>"; 
	?>

</body>
</html>