<?php require 'TCuserprotect.php';
	$connection = mysql_connect("host.place.com", "user", "password");
	mysql_select_db('user_prod', $connection);
	$auc_id = 0;
//if (isset($_GET['Item']) ){
	$auc_id = (0 + $_GET['Item']);
	//go ahead and connect to the database, fetching the auction's description and echoing it
	$getdesc = "SELECT itemdesc FROM TCauctions WHERE auctionid = $auc_id;";
	$getdescresult = mysql_fetch_array(mysql_query($getdesc, $connection));
	echo $getdescresult['itemdesc'];
//} else { echo "There's no description for this one";}


?>