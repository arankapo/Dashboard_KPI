<?php
include('koneksi.php');
$no = $_GET['no_permintaan'];
$jumlah_terpenuhi = $_GET['jumlah_terpenuhi'];


$query = mysqli_query($koneksi,"UPDATE tb_permintaan_karyawan SET jumlah_terpenuhi='$jumlah_terpenuhi' WHERE no_permintaan='$no'");
header('Location: ../index.php?page=data-permintaan');

?>

