<?php

header("Access-Control-Allow-Origin: *");

session_start();
//if(isset($_SESSION['is_logged_in'])=="yes") 
if(1)
{ 
// remove all session variables
session_unset();

// destroy the session
session_destroy();

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
$sqlClienti = "SELECT id, nume, prenume, adresa, nrTel, email FROM clienti";
$result = $link->query($sqlClienti);

if ($result->num_rows > 0) 
{
    // output data of each row
?>
<div class="container">
  <h2>Tabel Clienti</h2>          
  <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>nume</th>
        <th>prenume</th>
        <th>adresa</th>
        <th>nrTel</th>
        <th>email</th>
      </tr>
    </thead>
    <tbody>
<?php
    while($row = $result->fetch_assoc()) 
	{
?>
      <tr>
        <td><?php echo $row["id"] ?></td>
        <td><?php echo $row["nume"] ?></td>
        <td><?php echo $row["prenume"] ?></td>
        <td><?php echo $row["adresa"] ?></td>
        <td><?php echo $row["nrTel"] ?></td>
        <td><?php echo $row["email"] ?></td>
      </tr>
<?php	
 //       echo "id: " . $row["id"]. " - Name: " . $row["nume"]. " " . $row["prenume"]. "<br>";
    }
?>
    </tbody>
  </table>
</div>	

<?php
} 
else 
{
    echo "0 results";
}
// Print host information
echo "Connect Successfully. Host info: " . mysqli_get_host_info($link)."<br>";
?>
	<!-- jQuery library -->
	<script src="https://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
	<script>
		$(document).ready(function(){
		$("#senddata").click(function(){ 
				$.post("send_sms.php",function(postresult){
				$("#smsdiv").html(postresult);
				});

		});
		});
  
	</script>
	
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Modern Business - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">  

</head>

<body>
  
  <!-- Page Content -->

		<button id="senddata" class="btn btn-success btn-lg" type="submit">Trimite SMS</button>
		<div id="smsdiv"><h3>SMS trimise</h3></div>

 </body>



  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
<?php

$link->close();
}
else 
{
    header("Location: signinadmin.html");
}
?>

