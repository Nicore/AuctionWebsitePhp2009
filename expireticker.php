<?php
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	
	
	$query = "SELECT auctionid, itemname, currentbid FROM TCauctions WHERE expired = 0 AND expiretime < NOW();";

	$queryresult = mysql_query($query, $connection);
	
	
	//for every record i just got, have a look in tctrades and get the seller's id and buyer id then look in
	//tcusers for the sellers and buyers(if not null) emails, create emails stating that their auctions have expired
	while ($row = mysql_fetch_array($queryresult)) {
		//seller email
		$findtraders = "SELECT username, email, buyerid FROM TCusers, TCtrades WHERE TCtrades.tradeid = ".$row['auctionid']." AND TCtrades.sellerid = TCusers.username;";
		$foundtraders = mysql_fetch_array(mysql_query($findtraders, $connection));
		if ($foundtraders['buyerid'] == NULL) {
			//mail(to,subject,message,headers,parameters) email to send lister in event of auction fail
				$subject = "TradeCore: Auction expiry: " . $row['itemname'];
				$message = '<html>
				<head>
					<title>TradeCore: Auction expiry: ' . $row['itemname'] . '</title>
					<style type="text/css">body {font-family:sans-serif; }</style>
				</head>
				<body>
					<h1>TradeCore Expiry Notification</h1>
					<p>Hello ' . $foundtraders['username']. '.
						<br><br>
						Your auction of: ' . $row['itemname'] . ' has expired without any bids<br>
						<br><br>
						List Again!
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
				mail($foundtraders['email'],$subject,$message,$headers);
		} else { //end of if no buyers stmt 
			//email aimed at seller
				$subject = "TradeCore: Auction sold: " . $row['itemname'];
				$message = '<html>
				<head>
					<title>TradeCore: Auction sold: ' . $row['itemname'] . '</title>
					<style type="text/css">body {font-family:sans-serif; }</style>
				</head>
				<body>
					<h1>TradeCore Sale Notification</h1>
					<p>Hello ' . $foundtraders['username']. '.
						<br><br>
						Your auction of: ' . $row['itemname'] . ' has been sold to ' . $foundtraders['buyerid'] . '<br>
						for ' . $row['currentbid'] .'<br>
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
				mail($foundtraders['email'],$subject,$message,$headers);
			//get buyer details
			$findwinner = "SELECT email FROM TCusers WHERE username = '".$foundtraders['buyerid']."';";
			$foundwinner = mysql_fetch_array(mysql_query($findwinner, $connection));
			
			//email to buyer
				$subjectwin = "TradeCore: Auction won: " . $row['itemname'];
				$messagewin = '<html>
				<head>
					<title>TradeCore: Auction won: ' . $row['itemname'] . '</title>
					<style type="text/css">body {font-family:sans-serif; }</style>
				</head>
				<body>
					<h1>TradeCore Win Notification</h1>
					<p>Hello ' . $foundtraders['buyerid']. '.
						<br><br>
						You have won an auction for: ' . $row['itemname'] . ', listed by: ' . $foundtraders['username'] . '<br>
						for ' . $row['currentbid'] .'<br>
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
				mail($foundwinner['email'],$subjectwin,$messagewin,$headerswin);
			
		} //end of else zone where sale emails are sent to buyer and seller
		
	}// end of while email loop
	
	//requires more fixing here
	$queryupdate = "UPDATE TCauctions SET expired = 1 WHERE expiretime < NOW();";
	$queryupdateresult = mysql_query($queryupdate, $connection);
	

?>