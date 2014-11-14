<?php session_name('TCSESSION');
	session_set_cookie_params(0, '/~user/');
	session_start(); ?>

<!--TradeCore navigation bar code begins here-->

<link rel="stylesheet" type="text/css" href="TCnavbar.css">
</head>

<body>

<table width="100%" id="navbar"  border="0" cellpadding="0">
  <tr>
    <td id="navimage" align="left"><a href="./index.php"><img src="TClogo.jpg" width="200px" height="100px" alt="TradeCore"></a></td>
    <td class="navlinkbox"><a href="./index.php">Index</a></td>
    <?php  //if not logged in
	if (!isset($_SESSION['authorisation']) or ($_SESSION['authorisation'] != 'admin' and $_SESSION['authorisation'] != 'user')) { 
     echo '<td class="navlinkbox"><a href="./TCloginform.php">Log In</a></td> 
    <td class="navlinkbox"><a href="./TCregister.php">Register</a></td>
    <td class="spacer"></td>';
     } elseif ($_SESSION['authorisation'] == 'user') {
		// if you're logged in as a user 
     echo '<td class="navlinkbox"><a href="./TCuserpage.php">User</a></td> 
    <td class="navlinkbox"><a href="./TCuseredit.php">Edit Details</a></td>
	<td class="navlinkbox"><a href="./TCcreateauction.php">List Auction</a></td>
	<td class="navlinkbox"><a href="./TCviewauctions.php">Browse Auction</a></td>
	<td class="navlinkbox"><a href="TClogout.php">Log Out</a></td>
    <td class="spacer"></td>
    <td class="namebox">'.$_SESSION['TCusername'].': User</td>'  ;
       
	 } elseif  ($_SESSION['authorisation'] == 'admin') {
		//if youre logged in as an admin 
        echo '<td class="navlinkbox"><a href="./TCadminpage.php">Admin</a></td> 
    <td class="navlinkbox"><a href="./TCuserpage.php">User</a></td>
	<td class="navlinkbox"><a href="./TCuseredit.php">Edit Details</a></td>
	<td class="navlinkbox"><a href="./TCbanuser.php">Ban</a></td>
	<td class="navlinkbox"><a href="./TCbanadmin.php">Ban Admin</a></td>
	<td class="navlinkbox"><a href="./TCaddadmin.php">Add Admin</a></td>
	<td class="navlinkbox"><a href="./TCcreateauction.php">List Auction</a></td>
	<td class="navlinkbox"><a href="./TCviewauctions.php">Browse Auctions</a></td>
	<td class="navlinkbox"><a href="./TCpurgeauction.php">Purge Auctions</a></td>
	<td class="navlinkbox"><a href="TClogout.php">Log Out</a></td>
    <td class="spacer"></td> 
    <td class="namebox">'.$_SESSION['TCusername'].': Admin</td>'  ;
       
   } ?>    
  </tr>
</table>
<!--nav bar code ends-->