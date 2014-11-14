<?php require 'TCuserprotect.php';
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	$user_bid = 0.00;
	$auc_id_bid = 0;
	$querytraderesult = 0;
	$queryresult = 0;
	$queryoldresult = 'an item';
	$querybo = 'what';
	$queryresult = 'hmm';
	
	if (isset($_POST['bidfield'])) {
		$user_bid = abs(0.00 + strip_tags(mysql_real_escape_string($_POST['bidfield'])));
	}
	if (isset($_POST['rad_auc_id'])) {
		$auc_id_bid = (int) $_POST['rad_auc_id'];
	}
	//if an auction is selected
	if ($auc_id_bid > 0) {
		$querytest = "SELECT * FROM TCauctions WHERE auctionid = $auc_id_bid;"; //get the info for that auction
		$querytestresult = mysql_fetch_array(mysql_query($querytest, $connection)); //and make it into an array
		//if the action was a bid
		if(isset($_POST['bidsubmit'])) {
		
			//then see if the current bid is either null or less that what was just bid
			if ((($user_bid > (0.00 + $querytestresult['currentbid']) || ($querytestresult['currentbid'] == NULL) && ($user_bid >= (0.00 + $querytestresult['initprice']))))) {
				//if there has been a prior bidder get their email and then send an email to them
				if ($querytestresult['currentbid'] != NULL) {
					$queryold = "SELECT username, email, itemname FROM TCtrades, TCusers, TCauctions WHERE TCtrades.tradeid = $auc_id_bid AND TCtrades.buyerid = TCusers.username AND TCauctions.auctionid = $auc_id_bid;";
					$queryoldresult = mysql_fetch_array(mysql_query($queryold, $connection));
					//mail(to,subject,message,headers,parameters)
					$subject = "TradeCore: Outbid on: " . $queryoldresult['itemname'];
					$message = '<html>
					<head>
						<title>TradeCore: Outbid on: ' . $queryoldresult['itemname'] . '</title>
						<style type="text/css">body {font-family:sans-serif; }</style>
					</head>
					<body>
						<h1>TradeCore Outbid Notification</h1>
						<p>Hello ' . $queryoldresult['username']. '.
							<br><br>
							You have been outbid on ' . $queryoldresult['itemname'] . '<br>
							<br><br>
							Try Again!
							<br><br><br>
							Note: Do not respond to this email, it leads to nothing.
						</p>
					</body>
					</html>
					';
					$from = "noreply@TradeCore.com";
					$headers = "From: $from";
					$headers .= 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					mail($queryoldresult['email'],$subject,$message,$headers);
					
				}//end of email if buyerid isnt null
				//send email to old high bidder to say fail
				//update the tcauction table with the new bid
				$query = "UPDATE TCauctions SET currentbid = $user_bid WHERE auctionid = $auc_id_bid;";
				$queryresult = mysql_query($query, $connection);
				//update the tctrades table with new buyer id
				$querytrade = "UPDATE TCtrades SET buyerid = '".$_SESSION['TCusername']."' WHERE tradeid = $auc_id_bid;";
				$querytraderesult = mysql_query($querytrade, $connection);
				
			} //end of bid success
		} //end of the bid function
		
		//if the button hit was buyout
		if (isset($_POST['buyoutsubmit'])) {
			//do a bunch of stuff so it buys out the auction
	   		if ($querytestresult['currentbid'] != NULL) {
					$queryold = "SELECT username, email, itemname FROM TCtrades, TCusers, TCauctions WHERE TCtrades.tradeid = $auc_id_bid AND TCtrades.buyerid = TCusers.username AND TCauctions.auctionid = $auc_id_bid;";
					$queryoldresult = mysql_fetch_array(mysql_query($queryold, $connection));
					//mail(to,subject,message,headers,parameters)
					$subject = "TradeCore: Outbid on: " . $queryoldresult['itemname'];
					$message = '<html>
					<head>
						<title>TradeCore: Outbid on: ' . $queryoldresult['itemname'] . '</title>
						<style type="text/css">body {font-family:sans-serif; }</style>
					</head>
					<body>
						<h1>TradeCore Outbid Notification</h1>
						<p>Hello ' . $queryoldresult['username']. '.
							<br><br>
							You have been outbid on ' . $queryoldresult['itemname'] . '<br>
							<br><br>
							Try Again!
							<br><br><br>
							Note: Do not respond to this email, it leads to nothing.
						</p>
					</body>
					</html>
					';
					$from = "noreply@TradeCore.com";
					$headers = "From: $from";
					$headers .= 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					mail($queryoldresult['email'],$subject,$message,$headers);
					
				}//end of email if buyerid isnt null
			
				//update the tcauction table with the buyout/// currentbid = {$querytestresult['buyout']} AND 
				$querybo = "UPDATE TCauctions SET currentbid = ". (0.00 +$querytestresult['buyout'] )." WHERE auctionid = $auc_id_bid;";
				$queryboresult = mysql_query($querybo, $connection);
				$query = "UPDATE TCauctions SET expired = 1 WHERE auctionid = $auc_id_bid;";
				$queryresult = mysql_query($query, $connection);
				//update the tctrades table with new buyer id
				$querytrade = "UPDATE TCtrades SET buyerid = '".$_SESSION['TCusername']."' WHERE tradeid = $auc_id_bid;";
				$querytraderesult = mysql_query($querytrade, $connection);
				
				//get email address
				$getemail = "SELECT email FROM TCusers, TCtrades WHERE TCtrades.tradeid = $auc_id_bid AND TCusers.username = '".$_SESSION['TCusername']."' ;";
				$getemailresult = mysql_fetch_array(mysql_query($getemail));
				
				//get the seller id
				$getseller = "SELECT sellerid FROM TCtrades WHERE tradeid = $auc_id_bid;";
				$getsellerresult = mysql_fetch_array(mysql_query($getseller));
				//email content
				$subjectwin = "TradeCore: Auction won: " . $querytestresult['itemname'];
				$messagewin = '<html>
				<head>
					<title>TradeCore: Auction won: ' . $querytestresult['itemname'] . '</title>
					<style type="text/css">body {font-family:sans-serif; }</style>
				</head>
				<body>
					<h1>TradeCore Win Notification</h1>
					<p>Hello ' . $_SESSION['TCusername']. '.
						<br><br>
						You have won an auction for: ' . $querytestresult['itemname'] . ', listed by: ' . $getsellerresult['sellerid'] . '<br>
						for ' . $querytestresult['buyout'] .'<br>
						<br><br>
						Win Again!
						<br><br><br>
						Note: Do not respond to this email, it leads to nothing.
					</p>
				</body>
				</html>
				';
				$fromwin = "noreply@TradeCore.com";
				$headerswin = "From: $fromwin";
				$headerswin .= 'MIME-Version: 1.0' . "\r\n";
				$headerswin .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($getemailresult['email'],$subjectwin,$messagewin,$headerswin);
				
				//send email to seller
				$getselleremail = "SELECT email FROM TCusers WHERE TCusers.username = '".$getsellerresult['sellerid']."';";
				$getselleremailresult = mysql_fetch_array(mysql_query($getselleremail));
			
			//send email to seller
			$subject = "TradeCore: Auction sold: " . $querytestresult['itemname'];
				$message = '<html>
				<head>
					<title>TradeCore: Auction sold: ' . $querytestresult['itemname'] . '</title>
					<style type="text/css">body {font-family:sans-serif; }</style>
				</head>
				<body>
					<h1>TradeCore Sale Notification</h1>
					<p>Hello ' .$getsellerresult['sellerid']. '.
						<br><br>
						Your auction of: ' . $querytestresult['itemname'] . ' has been sold to ' . $_SESSION['TCusername']. '<br>
						for ' . $querytestresult['buyout'] .'<br>
						<br><br>
						Sell Again!
						<br><br><br>
						Note: Do not respond to this email, it leads to nothing.
					</p>
				</body>
				</html>
				';
				$from = "noreply@TradeCore.com";
				$headers = "From: $from";
				$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($getselleremailresult['email'],$subject,$message,$headers);
				
		} //end buyout
	
	}//end of if auction is selected
	//post results of bidding --to fix
	if (($queryresult == 1) && ($querytraderesult == 1)) { ?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
        <html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        	<title>TradeCore Bid Success</title>
     
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Bid Success!</h1>
            
            <p>You have successfully bidded on: <?php echo $queryoldresult['itemname']; ?>.<br>
            <a href="TCviewauctions.php">Browse more auctions</a><br>
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
        	<title>TradeCore Bid Failure</title>
       
			<?php include 'hidden/TCnavbar.php'; ?>
            <h1>Bid Failure.</h1>
            <p>You should select an auction and enter a bid higher than the current bid or the starting price. 
            <a href="TCviewauctions.php">Browse more auctions</a><br>
            <a href="index.php">Index</a></p>
        </body>
        </html>
<?php } 
?>