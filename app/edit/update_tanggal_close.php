<?php
include('koneksi.php');
$nik = $_GET['nik'];

$query = mysqli_query($koneksi,"UPDATE tb_permintaan_karyawan SET progres='Closed', tanggal_close=now() WHERE no_permintaan='$nik'");
header('Location: ../index.php?page=data-permintaan');

?>

