<?php
$server_name = "localhost";

$usernamee = "root";
$password = "";

$db = "thedreamfair";
$conn = mysqli_connect($server_name,$usernamee,$password,$db) ;

if(!$conn)
{
	echo mysqli_connect_error();
}
// else
// {
// 	//echo "database connection successfully". "<BR>";
// }
?>