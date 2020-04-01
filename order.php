<?php

header("Access-Control-Allow-Origin: *");

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "3fdatabase");
/* Attempt MySQL server connection. Assuming you are running MySQL */
//$link = mysqli_connect("188.212.156.35", "freshfoo_admin", "{t8!!WOOyb_6", "freshfoo_3fdatabase"); /* freshfoo_admin Pass:{t8!!WOOyb_6*/
 
// Check connection
if($link === false)
	{
    die("ERROR: Could not connect. " . mysqli_connect_error());
	}


$quantity=$_POST["quantity"];
$price=$_POST["price"];

if( $quantity >= 0 )
 
{
	$lineprice = intval($quantity) * (float)filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
	echo $lineprice." RON"; 
}
$link->close();
?>
