<?php
include('../../conf/koneksi.php');
//echo $_GET['nama'];
//echo $_GET['nilaipk1'];
$query = mysqli_query($koneksi,"INSERT INTO tb_pegawai (Nik,Nama,Jabatan,Divisi,Unit_Kerja,Level) VALUES('4031001','Siswanta','Manajer HRGA','HRGA','Mega Jasem','Manajer')");

?>

