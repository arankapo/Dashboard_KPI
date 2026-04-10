<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "ekinerja";
	
	$kon = mysqli_connect($host, $user, $pass);

        
	if(!$kon)
				die ("Gagal koneksi karena ".mysqli_error());
				
	$dbKon = mysqli_select_db($dbname, $kon);
	
	if(!$dbKon) 
				die ("Gagal membuka database $dbname karena".mysqli_error());

?>