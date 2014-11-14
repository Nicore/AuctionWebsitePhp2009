<?php	require 'TCuserprotect.php';
$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	//required data
	$auc_itemname = '';
	$auc_expiretime = 0;
	$auc_initprice = 0;
	//others
	$auc_expirerange = $_POST['expirerange']; //shouldnt need cleaning
	$auc_buyout = 0;
	$auc_itemdesc = '';
	$auc_imgname = '';
		
	//cleans the required data, stripping php, html and sql stuff
	if (isset($_POST['itemname'])) {
		$auc_itemname = strip_tags(mysql_real_escape_string($_POST['itemname']));
	}
	if (isset($_POST['expiretime'])) {
		$auc_expiretime = abs((int) strip_tags(mysql_real_escape_string($_POST['expiretime'])));
	}
	if (isset($_POST['initprice'])) {
		$auc_initprice = abs(0.00 + strip_tags(mysql_real_escape_string($_POST['initprice'])));
	}
	//cleans optional data
	$auc_buyout = abs(0.00 + strip_tags(mysql_real_escape_string($_POST['buyout'])));
	$auc_itemdesc = strip_tags(mysql_real_escape_string($_POST['itemdesc']));
	$auc_imgname = strip_tags(mysql_real_escape_string($_FILES['incoming']['name']));
	
	//picture upload stuff
	if (isset($_FILES['incoming'])) {
	if ($_FILES['incoming']['error'] == UPLOAD_ERR_OK && //checking stuff
	substr($_FILES['incoming']['name'], -4) == ".jpg" && //has extension .jpg
	$_FILES['incoming']['size'] < 100000) { //under 100,000 bytes in size
			
		  $imageinfo = getimagesize($_FILES['incoming']['tmp_name']);
		  if ($imageinfo['mime'] == 'image/jpeg') { // and is actually an image

			move_uploaded_file($_FILES['incoming']['tmp_name'],
				"images/".$_FILES['incoming']['name']);
		}
	} else {
		//have the fail page appear
		?>
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Auction Listing Failure</title>
        
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Auction Listing Failure.</h1>
            <p>You should really upload an image that complies with the specifications. <br>
            Go back and 
            <a href="TCcreateauction.php">try again.</a><br>
            <a href="index.php">TradeCore Index</a></p>
        </body>
        </html>
		<?php
	}
	}
	
	//inserts data into TCusers table
	$insert = "insert into TCauctions (itemname, imgurl, expiretime, initprice, itemdesc, buyout, expired) 
		values ('$auc_itemname', '$auc_imgname', TIMESTAMPADD($auc_expirerange, $auc_expiretime, NOW()), $auc_initprice, '$auc_itemdesc',
					$auc_buyout, 0);"; 
	
	$result = mysql_query($insert, $connection);
	
	$query_auc = "SELECT MAX(auctionid) FROM TCauctions;";
	$querylatestauc = mysql_query($query_auc, $connection);
	$row = mysql_fetch_array($querylatestauc);
	//insert into the TCtrades table for users vs auctions
	$inserttrade = "insert into TCtrades (tradeid, sellerid) values (".$row['MAX(auctionid)'].", '".$_SESSION['TCusername']."');";
	$resulttrade = mysql_query($inserttrade, $connection);
	//if the insert is successful (1) then return with a success page, otherwise return a fail page.
	if (($result == 1) && ($resulttrade == 1)) { 
	
	?> 
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Auction Listing Success</title>
    
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>You have successfully listed an auction!</h1>
            <p>Wait and see who will buy it!.<br>
            Auction #: <?php echo $row['MAX(auctionid)']; ?><br>
            <a href="TCviewauctions.php">View Current Auctions</a><br>
            <a href="index.php">TradeCore Index</a></p>
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
        	<title>TradeCore Auction Listing Failure</title>
        
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Auction Listing Failure.</h1>
   
            <p>You must enter an item name, initial price and set a timeframe for your auction. <br>
            Go back and 
            <a href="TCcreateauction.php">try again.</a><br>
            <a href="index.php">TradeCore Index</a></p>
        </body>
        </html>
		<?php }
?>