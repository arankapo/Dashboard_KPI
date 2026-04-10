<?php
include('koneksi.php');
$no_dok = $_GET['no_dok'];
$revisi= $_GET['revisi'];
$tanggal_efektif = $_GET['tanggal_efektif'];
$nama_dept = $_GET['nama_dept'];
$unit_kerja = $_GET['unit_kerja'];
$periode = $_GET['periode'];
$nama = $_GET['nama'];
$nik = $_GET['nik'];
$jabatan = $_GET['jabatan'];
$sub_dept = $_GET['sub_dept'];
$nilaia1 = $_GET['nilaia1'];
$skora = $_GET['skora'];
$nilaib1 = $_GET['nilaib1'];
$nilaib2 = $_GET['nilaib2'];
$nilaib3 = $_GET['nilaib3'];
$nilaib4= $_GET['nilaib4'];
$nilaib5 = $_GET['nilaib5'];
$nilaib6 = $_GET['nilaib6'];
$nilaib7 = $_GET['nilaib7'];
$nilaib8 = $_GET['nilaib8'];
$nilaib9 = $_GET['nilaib9'];
$nilaib10 = $_GET['nilaib10'];
$nilaib11 = $_GET['nilaib11'];
$skorb = $_GET['skorb'];
$nilaic1 = $_GET['nilaic1'];
$nilaic2 = $_GET['nilaic2'];
$nilaic3 = $_GET['nilaic3'];
$nilaic4 = $_GET['nilaic4'];
$skorc = $_GET['skorc'];
$nilaic5 = $_GET['nilaic5'];
$totalskor = $_GET['totalskor'];
$hurufskor = $_GET['hurufskor'];
$catatan = $_GET['catatan'];
//$rekomendasi = $_GET['rekomendasi'];
//$jenis_perubahan = $_GET['jenis_perubahan'];

$query = mysqli_query($koneksi,"INSERT INTO tb_nilai_karyawan(no_dok, revisi, tanggal_efektif, nama_dept, unit_kerja, periode, nama_karyawan, nik, jabatan, sub_dept, nilaia1, skora, nilaib1, nilaib2, nilaib3, nilaib4, nilaib5, nilaib6, nilaib7, nilaib8, nilaib9, nilaib10, nilaib11 , skorb, nilaic1, nilaic2, nilaic3, nilaic4, nilaic5, skorc, totalskor, hurufskor, catatan) VALUES ('$no_dok','$revisi','$tanggal_efektif','$nama_dept','$unit_kerja','$periode','$nama','$nik','$jabatan','$sub_dept','$nilaia1','$skora','$nilaib1','$nilaib2','$nilaib3','$nilaib4','$nilaib5','$nilaib6','$nilaib7','$nilaib8','$nilaib9','$nilaib10','$nilaib11','$skorb','$nilaic1','$nilaic2','$nilaic3','$nilaic4','$nilaic5','$skorc','$totalskor','$hurufskor','$catatan')");
header('Location: ../index.php?page=data-penilaian');

?>

