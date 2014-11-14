<?php require 'TCadminprotect.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="TCpurgeauction.css">
<script type="text/javascript" src="jquery.js"></script>

<script src="viewauctionsjquery.js" type="text/javascript"></script>

<title>TradeCore Auction Purging</title>

<?php include 'hidden/TCnavbar.php'; ?>
<?php /*ok what we're doing here is getting all the relevant fields to display for auctions, the description is intended to be accessed
	with jquery like the soupshack thing*/
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$query = "SELECT auctionid, itemname, imgurl, expiretime, initprice, currentbid, buyout, sellerid, buyerid FROM TCauctions, TCtrades WHERE
		TCauctions.auctionid = TCtrades.tradeid;"; 
	
	$result = mysql_query($query, $connection);
	?> 
    
    <form action="TCpurgeauctionscript.php" method="post">
    <fieldset>
    
    <legend>Entire Auction List:</legend>
    <p>Select an auction and...</p>
    
    <input type="submit" name="purge" id="purge" value="Purge"> 
    <br>
    <br>
    <table width="900" id="auctable">
    	<tr>
        	<th id="radbtn"></th>
        	<th id="imghead">Image</th>
            <th id="namehead">Item Name</th>
            <th id="expdate">Expire Date</th>
            <th id="usrnme">Seller</th>
            <th id="usrnme">Highest Bidder</th>
            <th id="numbox">Current Bid</th>
            <th id="numbox">Initial Price</th>
            <th id="numbox">Buyout</th>
        </tr>
    
    <?php
	while($row = mysql_fetch_array($result)) {
		echo "<tr><td><input name=\"rad_auc_id\" type=\"radio\" value=\"{$row['auctionid']}\" id=\"radbtn\"></td><td id=\"imgbox\"><img height=\"50px\" width=\"50px\" src=\"images/{$row['imgurl']}\" id=\"{$row['auctionid']}\" alt=\"{$row['itemname']}\"></img></td> <td id=\"namehead\">" . $row['itemname'] . "</td><td id=\"expdate\">" . $row['expiretime'] . "</td><td id=\"usrnme\">" . $row['sellerid'] . "</td><td id=\"usrnme\"> "; //if buyer isnt null, post name, otherwise say something different
					if ($row['buyerid'] != NULL) {
						echo $row['buyerid'];
					} else { echo "None Yet."; }
					echo "</td>	<td id=\"numbox\">"; //if bid isnt null, echo bid, else none
					if ($row['currentbid'] != NULL) {
						echo "$" . $row['currentbid'];
					} else { echo "None Yet."; }
					echo "</td>	<td id=\"numbox\"> $" . $row['initprice'] . "</td><td id=\"numbox\"> "; //if buyout isnt null, list buyout, else none.
					if ($row['buyout'] != NULL) {
						echo "$" . $row['buyout'];
					} else { echo "None."; }
					echo "</td>	</tr>";
		
		
	}
	?>
    </table>
    <div id="popup"></div>
    </fieldset>
	</form>
    <?php
	/* //this is the old method aka admin page
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
	echo "</table>"; */
	?>
</body>
</html>