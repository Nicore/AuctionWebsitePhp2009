<?php require 'TCadminprotect.php';
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$auc_id_purge = 0;
	$querypurgeresult = 0;
	$queryresult = 0;
	$queryoldresult = '';
	$querypurgetraderesult = 0;
	$querytestresult = '';
	
	if (isset($_POST['rad_auc_id'])) {
		$auc_id_purge = (int) $_POST['rad_auc_id'];
	}
	//if an auction is selected
	if ($auc_id_purge > 0) {
		$querytest = "SELECT * FROM TCauctions WHERE auctionid = $auc_id_purge;"; //get the info for that auction
		$querytestresult = mysql_fetch_array(mysql_query($querytest, $connection)); //and make it into an array
		
		$querypurge = "DELETE FROM TCauctions WHERE auctionid = $auc_id_purge;";
		$querypurgeresult = mysql_query($querypurge);
		
		$querypurgetrades = "DELETE FROM TCtrades WHERE tradeid = $auc_id_purge;";
		$querypurgetradesresult = mysql_query($querypurgetrades);
	
	}//end of if auction is selected
	//post results of bidding --to fix
	if (($querypurgeresult == 1) && ($querypurgetradesresult == 1)) { ?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Bid Success</title>
     
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Purge Success!</h1>
            <p>You have successfully purged: <?php echo $querytestresult['itemname']; ?>.<br>
            <a href="TCpurgeauction.php">Purge more auctions</a><br>
            <a href="index.php">Index</a></p>
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
        	<title>TradeCore Purge Failure</title>
       
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Purge Failure.</h1>
            <p>You should select an auction to purge before hitting that button. 
            <a href="TCpurgeauction.php">Purge auctions</a><br>
            <a href="index.php">Index</a></p>
        </body>
        </html>
<?php } 
?>