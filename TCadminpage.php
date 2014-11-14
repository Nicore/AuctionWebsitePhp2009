<?php require 'TCadminprotect.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>TradeCore Administrator Page</title>

<?php include 'hidden/TCnavbar.php'; ?>
<p>You've reachd the administrator's page.</p>
<h2>User List:</h2>
<p>Note: 1 = True, 0 = False.</p>
<?php /*basically go to the database and get everything from the TCusers table, then
	go ahead and churn each row from the database out into a table row*/
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$query = "select * from TCusers;"; 
	
	$result = mysql_query($query, $connection);
	
	echo "<table border='1'>
	<tr>
	<th>Username</th>
	<th>Firstname</th>
	<th>Lastname</th>
	<th>Email</th>
	<th>Verified</th>
	<th>Admin</th>
	<th>Blocked</th>
	</tr>";
	
	while($row = mysql_fetch_array($result)){
	  echo "<tr>";
	  echo "<td>" . $row['username'] . "</td>";
	  echo "<td>" . $row['firstname'] . "</td>";
	  echo "<td>" . $row['lastname'] . "</td>";
	  echo "<td>" . $row['email'] . "</td>";
	  echo "<td>" . $row['verified'] . "</td>";
	  echo "<td>" . $row['admin'] . "</td>";
	  echo "<td>" . $row['blocked'] . "</td>";
	  echo "</tr>";
	  }
	echo "</table>";
	?>
</body>
</html>