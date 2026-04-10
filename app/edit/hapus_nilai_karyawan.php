<?php
include('koneksi.php');
$no = $_GET['nik'];


$query = mysqli_query($koneksi,"DELETE FROM tb_nilai_karyawan WHERE no_tr='$no'");
header('Location: ../index.php?page=data-penilaian');

?>

