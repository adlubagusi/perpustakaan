<?php
/*$server = "localhost";
$user = "root";
$pass = "";
$db = "perpus";

$koneksidb = mysqli_connect($server,$user,$pass)or die("Gagal Koneksi".mysql_error());
if(!$koneksidb){
    echo "Failed Connection";
}

mysqli_select_db($db)or die("Database Not Found".mysql_error());
*/
$host = "localhost";
	$user = "root";
	$pass = "310801";
	$name = "db_perpus_3.1";
	 
	$koneksidb = mysqli_connect($host, $user, $pass ,$name)or die("Not connected.");
$denda1=500;
?>