<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//$link = mysqli_connect("localhost", "root", "", "3fdatabase");
/* Attempt MySQL server connection. Assuming you are running MySQL */
//$link = mysqli_connect("188.212.156.35", "freshfoo_admin", "{t8!!WOOyb_6", "freshfoo_3fdatabase"); /* freshfoo_admin Pass:{t8!!WOOyb_6*/

session_start();
$_SESSION['is_logged_in'] = "yes";
$post_email="";
$post_password="";
$post_email=$_POST["email"];
$post_password=$_POST["password"];
$hash = '$2y$10$kIeAgT5e2zhchLrcWYoLUOTKzkuMQstlSWqFcexKTyb0n2HwNrDoO';

//echo "startSTARTstart";//"Ba nu esti prost";

if( $post_email || $post_password)
 {

	if (strcmp($post_email,'asadad@gmail.com') || !password_verify($post_password, $hash)) 
	{
		echo "Ba  esti prost?<br>".$_SESSION['is_logged_in'];
	}
	else
	{
		echo "Ba nu esti prost!";
		$_SESSION['is_logged_in'] = true;
		echo "<script> window.location.assign('servicesadmin.php'); </script>";
		exit;
	}
}	
else
{
	echo "lINII GOALE! ";
}
//$link->close();
?>
