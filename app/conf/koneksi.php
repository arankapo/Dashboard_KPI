<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ekinerja";

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