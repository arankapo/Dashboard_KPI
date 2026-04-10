<?php
include('koneksi.php');
$no_dok = $_GET['no_dok'];
$revisi= $_GET['revisi'];
$tanggal_efektif = $_GET['tanggal_efektif'];
$tanggal_pengajuan = $_GET['tanggal_pengajuan'];
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

$k_tambahan = $_GET['kualifikasi_tambahan'];

$stmt = $koneksi->prepare("INSERT INTO tb_permintaan_karyawan (no_dok, revisi, tanggal_efektif, tanggal_pengajuan, tanggal_pemenuhan, nama_dept, penempatan, jam_kerja, klasifikasi, jumlah, jabatan, status_karyawan, jenis_kelamin, pendidikan_minimum, jurusan, usia, pengalaman, alasan, job_desk, progres, k_tambahan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$progres = 'Open';
$stmt->bind_param("sssssssssssssssssssss", $no_dok, $revisi, $tanggal_efektif, $tanggal_pengajuan, $tanggal_pemenuhan, $nama_dept, $penempatan, $jam_kerja, $klasifikasi, $jumlah, $jabatan, $status_karyawan, $jenis_kelamin, $pendidikan_minimum, $jurusan, $usia, $pengalaman, $alasan, $job_desk, $progres, $k_tambahan);
$stmt->execute();

header('Location: ../index.php?page=data-permintaan');

?>

