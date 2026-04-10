<?php
include('koneksi.php');
$no = $_GET['no_permintaan'];
$tanggal_pemenuhan = $_GET['tanggal_pemenuhan'];
$nama_dept = $_GET['nama_dept'];
$penempatan = $_GET['penempatan'];
$jam_kerja = $_GET['jam_kerja'];
$klasifikasi = $_GET['klasifikasi'];
$jumlah = $_GET['jumlah'];
$jabatan = $_GET['jabatan'];
$status_karyawan = $_GET['status_karyawan'];
$jenis_kelamin = $_GET['jenis_kelamin'];
$pendidikan_minimum = $_GET['pendidikan_minimum'];
$jurusan = $_GET['jurusan'];
$usia= $_GET['usia'];
$pengalaman = $_GET['pengalaman'];
$alasan = $_GET['alasan'];
$job_desk = $_GET['job_desk'];

$query = mysqli_query($koneksi,"UPDATE tb_permintaan_karyawan SET jumlah='$jumlah', tanggal_pemenuhan='$tanggal_pemenuhan', penempatan='$penempatan', jam_kerja='$jam_kerja', klasifikasi='$klasifikasi', jabatan='$jabatan', status_karyawan='$status_karyawan', jenis_kelamin='$jenis_kelamin', pendidikan_minimum='$pendidikan_minimum', jurusan='$jurusan', usia='$usia', pengalaman='$pengalaman', alasan='$alasan', job_desk='$job_desk' WHERE no_permintaan='$no'");
header('Location: ../index.php?page=data-permintaan');

?>

