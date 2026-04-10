<?php
include('koneksi.php');
$nik = $_GET['nik'];


$query = mysqli_query($koneksi,"DELETE FROM tb_permintaan_karyawan WHERE no_permintaan='$nik'");
header('Location: ../index.php?page=data-permintaan');

?>

