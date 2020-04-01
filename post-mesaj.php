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
$post_telefon=$_POST["telefon"];
$post_email=$_POST["email"];
$post_msj=$_POST["message"];
$returnVal = true;
if( empty($post_nume) || empty($post_telefon) || empty($post_email) || empty($post_msj)) 
{
		$returnVal = false;
}
else
{
   $mesaj = "Mesaj primit de la ".$post_nume."<br>".$post_telefon.", ".$post_email.".<br>Mesaj: ".$post_msj;
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
	$email->setSubject("Mesaj formular FFF");
	$email->addTo("danidarstar@yahoo.co.uk", $post_nume);
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
		//return true;
	} catch (Exception $e) {
		echo 'Caught exception: '. $e->getMessage() ."\n";
		$returnVal = false;
	}
 
}
$link->close();
return $returnVal;
?>
