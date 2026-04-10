<?php
include('koneksi.php');
$no = $_GET['no_permintaan'];
$jumlah_approve = $_GET['jumlah_approve'];
$tanggal_approve = $_GET['tanggal_approve'];


$query = mysqli_query($koneksi,"UPDATE tb_permintaan_karyawan SET jumlah_approve='$jumlah_approve', progres='On Progress', tanggal_approve='$tanggal_approve' WHERE no_permintaan='$no'");
header('Location: ../index.php?page=data-permintaan');

?>

