<?php
// Pastikan file koneksi.php sudah menginisialisasi $koneksi
include('koneksi.php');

// Menggunakan operator null coalescing (??) untuk memeriksa dan menetapkan nilai default
// Ini adalah cara yang lebih ringkas dan modern daripada menggunakan isset()
$no_dok = $_GET['no_dok'] ?? '';
$revisi = $_GET['revisi'] ?? '';
$tanggal_efektif = $_GET['tanggal_efektif'] ?? '';
$nama_dept = $_GET['nama_dept'] ?? '';
$unit_kerja = $_GET['unit_kerja'] ?? '';
$tahun = $_GET['tahun'] ?? '';
$nik = $_GET['nik'] ?? '';
$sub_dept = $_GET['sub_dept'] ?? '';
$tgl_masuk = $_GET['tgl_masuk'] ?? '';
$lama_bekerja = $_GET['lama_bekerja'] ?? '';
$grade_sebelum = $_GET['grade_sebelum'] ?? '';
$grade_sesudah = $_GET['grade_sesudah'] ?? '';
$tanggal_perubahan = $_GET['tanggal_perubahan'] ?? '';
$status = $_GET['status'] ?? '';
$perubahan = $_GET['perubahan'] ?? '';
$periode = $_GET['periode'] ?? '';
$nilaia1 = $_GET['nilaia1'] ?? '';
$skora = $_GET['skora'] ?? '';
$nilaib1 = $_GET['nilaib1'] ?? '';
$nilaib2 = $_GET['nilaib2'] ?? '';
$nilaib3 = $_GET['nilaib3'] ?? '';
$nilaib4 = $_GET['nilaib4'] ?? '';
$nilaib5 = $_GET['nilaib5'] ?? '';
$nilaib6 = $_GET['nilaib6'] ?? '';
$nilaib7 = $_GET['nilaib7'] ?? '';
$nilaib8 = $_GET['nilaib8'] ?? '';
$nilaib9 = $_GET['nilaib9'] ?? '';
$nilaib10 = $_GET['nilaib10'] ?? '';
$skorb = $_GET['skorb'] ?? '';
$nilaic1 = $_GET['nilaic1'] ?? '';
$nilaic2 = $_GET['nilaic2'] ?? '';
$nilaic3 = $_GET['nilaic3'] ?? '';
$nilaic4 = $_GET['nilaic4'] ?? '';
$nilaic5 = $_GET['nilaic5'] ?? '';
$skorc = $_GET['skorc'] ?? '';
$totalskor = $_GET['totalskor'] ?? '';
$hurufskor = $_GET['hurufskor'] ?? '';
$catatan = $_GET['catatan'] ?? '';
$rekomendasi = $_GET['rekomendasi'] ?? '';

// Inisialisasi variabel nama
$nama = null;

// 1. Ambil nama karyawan berdasarkan NIK menggunakan prepared statement
if (!empty($nik)) {
    $sql_select = "SELECT nama_karyawan FROM tb_karyawan_outs WHERE nik_karyawan = ?";
    $stmt_select = mysqli_prepare($koneksi, $sql_select);
    
    if ($stmt_select) {
        mysqli_stmt_bind_param($stmt_select, "s", $nik);
        mysqli_stmt_execute($stmt_select);
        $result = mysqli_stmt_get_result($stmt_select);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $nama = $row['nama_karyawan'];
        }
        mysqli_stmt_close($stmt_select);
    } else {
        die("Error dalam menyiapkan kueri SELECT: " . mysqli_error($koneksi));
    }
}

// 2. Lanjutkan dengan kueri INSERT hanya jika nama berhasil ditemukan
if ($nama !== null) {
    $sql_insert = "INSERT INTO tb_nilai_karyawan_os (
        no_dok, revisi, tanggal_efektif, nama_dept, unit_kerja, tahun, nama, nik, sub_dept, 
        tgl_masuk, lama_bekerja, grade_sebelum, grade_sesudah, tanggal_perubahan, status, perubahan, periode, 
        nilaia1, skora, nilaib1, nilaib2, nilaib3, nilaib4, nilaib5, nilaib6, nilaib7, nilaib8, nilaib9, nilaib10, 
        skorb, nilaic1, nilaic2, nilaic3, nilaic4, nilaic5, skorc, totalskor, hurufskor, catatan, rekomendasi
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

    $stmt_insert = mysqli_prepare($koneksi, $sql_insert);

    if ($stmt_insert) {
        mysqli_stmt_bind_param(
            $stmt_insert, "ssssssssssssssssssssssssssssssssssssssss", 
            $no_dok, $revisi, $tanggal_efektif, $nama_dept, $unit_kerja, $tahun, $nama, $nik, $sub_dept, 
            $tgl_masuk, $lama_bekerja, $grade_sebelum, $grade_sesudah, $tanggal_perubahan, $status, $perubahan, $periode, 
            $nilaia1, $skora, $nilaib1, $nilaib2, $nilaib3, $nilaib4, $nilaib5, $nilaib6, $nilaib7, $nilaib8, $nilaib9, $nilaib10, 
            $skorb, $nilaic1, $nilaic2, $nilaic3, $nilaic4, $nilaic5, $skorc, $totalskor, $hurufskor, $catatan, $rekomendasi
        );

        if (mysqli_stmt_execute($stmt_insert)) {
            header('Location: ../index.php?page=data-penilaian');
            exit(); 
        } else {
            echo "Error saat mengeksekusi kueri INSERT: " . mysqli_error($koneksi);
        }
        mysqli_stmt_close($stmt_insert);
    } else {
        die("Error dalam menyiapkan kueri INSERT: " . mysqli_error($koneksi));
    }
} else {
    echo "Error: Nama karyawan tidak ditemukan untuk NIK yang diberikan.";
}

// Tutup koneksi database
mysqli_close($koneksi);
?>