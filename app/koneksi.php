<?php

$db_host = "localhost";
$db_user = "your_username";
$db_pass = "your_password";
$db_name = "ekinerja";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno()) {
  echo 'Gagal melakukan koneksi ke Database : ' . mysqli_connect_error();
}

?>