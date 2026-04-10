<?php
include('../../conf/koneksi.php');
$nik = $_GET['nik'];
$id = $_GET['id'];
$nama = $_GET['nama'];
$namadept = $_GET['nama_dept'];
$jabatan = $_GET['jabatan'];
$unitker = $_GET['unit_kerja'];
$atasan = $_GET['nama_atasan'];
$query = mysqli_query($koneksi,"INSERT INTO tb_karyawan (nik_karyawan, nama_karyawan, jabatan_karyawan, id_dept, nama_dept, unit_kerja, atasan_karyawan) VALUES('$nik','$nama','$jabatan','$id','$namadept','$unitker','$atasan')");
header('Location: ../index.php?page=data-permintaan');

?>

