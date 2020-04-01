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
 
// Print host information
echo "Connect Successfully. Host info: " . mysqli_get_host_info($link)."<br>";

$post_nume=$_POST["nume"];
$post_prenume=$_POST["prenume"];
$post_telefon=$_POST["telefon"];
$post_adresa=$_POST["adresa"];

if( $post_nume )
 
{
 
   echo "Date adaugate is: ". $post_nume ."<br>";
   echo "1:" .$post_prenume ."<br>";
   echo "2:" .$post_telefon ."<br>";
   echo "3:" .$post_adresa ."<br>";

   $sql = "INSERT INTO clienti (nume, prenume, adresa, nrTel, email) VALUES ('$post_nume', '$post_prenume', '$post_adresa', '$post_telefon', 'defEmail' )";

	if ($link->query($sql) === TRUE) 
	{
		echo "New record created successfully";
	}
	else
	{
		echo "Error: " . $sql . "<br>" . $link->error;
	}
 
}
$link->close();
?>
