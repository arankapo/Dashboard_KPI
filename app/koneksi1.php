<?php
$db_host = "localhost";
$db_user = "your_username";
$db_pass = "your_password";
$db_name = "ekinerja";

// Create connection
$koneksi = mysqli_connect($servername, $username, $password, $dbname);
//$koneksi = mysqli_connect('localhost','root','','ekinerja' );
// Check connection
//if (!$koneksi){
	//die("Connection failed: ",mysqli_connect_error());
	//die("koneksi Gagal :". mysqli_connect_error());
//	}
//else{
	//echo "koneksi berhasil";
//}

//session_start();
?>