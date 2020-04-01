<?php

header("Access-Control-Allow-Origin: *");
require __DIR__ . '/vendor/autoload.php';


// Your Account SID and Auth Token from twilio.com/console
$account_sid = '2dc079aa';
$auth_token = 'gWq3A81WmFc8xxV5';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]


/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "3fdatabase");
//$link = mysqli_connect("188.212.156.35", "freshfoo_admin", "{t8!!WOOyb_6", "freshfoo_3fdatabase"); /* freshfoo_admin Pass:{t8!!WOOyb_6*/ 

// Check connection
if($link === false)
	{
    die("ERROR: Could not connect. " . mysqli_connect_error());
	}
 
// Print host information
echo "Connect Successfully. Host info: " . mysqli_get_host_info($link)."<br>";

$basic  = new \Nexmo\Client\Credentials\Basic($account_sid, $auth_token);
$client = new \Nexmo\Client($basic);

try {
	//// fetch data from the table 
	$smsText = 'Astazi te servim cu: ';
	$records_sandv = mysqli_query($link, 'select id, nume, pret from sandvisuri');
	foreach( $records_sandv as $dataS ) // using foreach  to display each element of array
	{
		$smsText = $smsText.'Varianta '.$dataS['id'].' '.$dataS['nume'].' la pretul de '.$dataS['pret'].' RON; ';
	}

	$smsText = $smsText.' Asteptam comanda ta cu raspuns la numarul acesta pana in ora 8.30. O zi frumoasa!';

	// fetch data from the table clienti
	$records_clients = mysqli_query($link, 'select nume, prenume, adresa, nrTel from clienti');
	foreach( $records_clients as $dataC ) // using foreach  to display each element of array
	{
		echo 'Salut '. $dataC['prenume'].' '.$dataC['nume'].'! '.$smsText. "<br>";
		
		$message = $client->message()->send([
		'to' => '4'.$dataC['nrTel'],
			'from' => 'Fresh Food Factory',
			'text' => 'Salut '. $dataC['prenume'].' '.$dataC['nume'].'! '.$smsText
		]);
		
	}
} catch (Exception $e) {
    echo "The message was not sent. Error: " . $e->getMessage() . "\n";
}
$link->close();
?>
