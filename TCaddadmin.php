<?php require 'TCadminprotect.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>TradeCore Admin Promote Page</title>
<link rel="stylesheet" type="text/css" href="TCaddadmin.css">

<?php include 'hidden/TCnavbar.php'; ?>
<form action="TCaddadminscript.php" method="post">
  <fieldset>
  <legend>Promote an Admin:</legend>
  <label for="username">Enter target username:</label><input type="text" name="username" id="username">
  <br> 
  <input type="submit" value="Promote">
  </fieldset>
</form>

<p></p>
<h2>User List:</h2>
<p>Users available to become admins.</p>
<?php /*Go find all the non-admin users in the site*/
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$query = "select * from TCusers where admin = 0;"; 
	
	$result = mysql_query($query, $connection);
	
	echo "<table border='1'>
	<tr>
	<th>Username</th>
	<th>First Name</th>
	<th>Last Name</th>
	</tr>";
	
	while($row = mysql_fetch_array($result)){
	  echo "<tr>";
	  echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['firstname'] . "</td>";
	  echo "<td>" . $row['lastname'] . "</td>";

	  echo "</tr>";
	  }
	echo "</table>";
	?>
    <p></p>
    <h2>Admin List:</h2>
<p>Current administrators for TradeCore.</p>
<?php /*Go find all the admin users in the site*/
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$query = "select * from TCusers where admin = 1;"; 
	
	$result = mysql_query($query, $connection);
	
	echo "<table border='1'>
	<tr>
	<th>Username</th>
	<th>First Name</th>
	<th>Last Name</th>
	</tr>";
	
	while($row = mysql_fetch_array($result)){
	  echo "<tr>";
	  echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['firstname'] . "</td>";
	  echo "<td>" . $row['lastname'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	?>
</body>
</html>