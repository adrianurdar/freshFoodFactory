<?php

require 'vendor/autoload.php';
header("Access-Control-Allow-Origin: *");


$API_KEY='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';
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
//echo "Connect Successfully. Host info: " . mysqli_get_host_info($link)."<br>";

$post_nume=$_POST["nume"];
$post_prenume=$_POST["prenume"];
$post_telefon=$_POST["telefon"];
$post_adresa=$_POST["adresa"];
$post_email=$_POST["email"];
$post_detalii=$_POST["detalii"];
$post_qSalami=$_POST["qSalami"];
$post_qTonno=$_POST["qTonno"];
$post_qCaprese=$_POST["qCaprese"];
$post_qBacon=$_POST["qBacon"];
$post_q3F=$_POST["q3F"];
$post_qVeggie=$_POST["qVeggie"];

if( empty($post_nume) || empty($post_prenume) || empty($post_telefon) || empty($post_adresa) || empty($post_email) ) 
{
	echo "Va rugam sa completati toate campurile cu informatii de livrare";
}
else
{
   echo "Date adaugate is: ". $post_nume ."<br>";
   echo "1:" .$post_prenume ."<br>";
   echo "2:" .$post_telefon ."<br>";
   echo "3:" .$post_email ."<br>";
   echo "4:" .$post_adresa ."<br>";
   echo "5:" .$post_detalii ."<br>";
   $mesaj = "Comanda primita de la ".$post_nume." ".$post_prenume.", ".$post_telefon.", ".$post_email.", ".$post_adresa.", ".$post_detalii.". <br>Comanda: ";
   
   if($post_q3F)
   {
	   $mesaj .= $post_q3F." x Buc Sandvis 3F; ";
   }
   if($post_qBacon)
   {
	   $mesaj .= $post_qBacon." x Buc Sandvis Bacon&Eggs; ";
   }
   if($post_qVeggie)
   {
	   $mesaj .= $post_qVeggie." x Buc Sandvis Veggie; ";
   }
   if($post_qSalami)
   {
	   $mesaj .= $post_qSalami." x Buc Sandvis Salami; ";
   }
   if($post_qTonno)
   {
	   $mesaj .= $post_qTonno." x Buc Sandvis Tonno; ";
   }
   if($post_qCaprese)
   {
	   $mesaj .= $post_qCaprese." x Buc Sandvis Caprese; ";
   }
	$mesaj .= "<br>";
	echo $mesaj;
   // $sql = "INSERT INTO clienti (nume, prenume, adresa, nrTel, email) VALUES ('$post_nume', '$post_prenume', '$post_adresa', '$post_telefon', 'defEmail' )";

	// if ($link->query($sql) === TRUE) 
	// {
		// echo "New record created successfully";
	// }
	// else
	// {
		// echo "Error: " . $sql . "<br>" . $link->error;
	// }

	$email = new \SendGrid\Mail\Mail(); 
	$email->setFrom("example@gmail.com", "Example User");
	$email->setSubject("Comanda FFF");
	$email->addTo("danidarstar@yahoo.co.uk", $post_nume." ".$post_prenume);
	// $email->addContent("text/plain", $mesaj);
	$email->addContent(
		"text/html", "<strong>".$mesaj."</strong>"
	);
	$sendgrid = new \SendGrid($API_KEY);
	try {
		$response = $sendgrid->send($email);
		print $response->statusCode() . "\n";
		print_r($response->headers());
		print $response->body() . "\n";
	} catch (Exception $e) {
		echo 'Caught exception: '. $e->getMessage() ."\n";
	}
 
}
$link->close();
?>
