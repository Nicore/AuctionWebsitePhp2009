<?php require 'TCadminprotect.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>TradeCore Admin Ban Page</title>
<link rel="stylesheet" type="text/css" href="TCbanadmin.css">

<?php include 'hidden/TCnavbar.php'; ?>
<form action="TCbanadminscript.php" method="post">
  <fieldset>
  <legend>Ban an Admin:</legend>
  <label for="username">Enter target admin username:</label><input type="text" name="username" id="username"><br>
  <label for="masterpass">Enter the master password:</label><input type="password" name="masterpass" id="masterpass">
  <br>
  <input type="radio" name="block" value="Ban"> Ban
	<br>
  <input type="radio" name="block" value="Un-Ban"> Un-Ban
  <br>
  <input type="submit" value="Execute">
  </fieldset>
</form>

<p>Oh, by the way, for testing, master password is: 'adminban'</p>
<h2>Admin List:</h2>
<p>Note: 1 = True, 0 = False.</p>
<?php /*Go find all the admin users in the site*/
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$query = "select * from TCusers where admin = 1;"; 
	
	$result = mysql_query($query, $connection);
	
	echo "<table border='1'>
	<tr>
	<th>Username</th>
	<th>Blocked</th>
	</tr>";
	
	while($row = mysql_fetch_array($result)){
	  echo "<tr>";
	  echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['blocked'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	?>
</body>
</html>