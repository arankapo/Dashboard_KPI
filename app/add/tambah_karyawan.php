<?php
include('../koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nik_karyawan = mysqli_real_escape_string($koneksi, $_POST['nik_karyawan']);
    $nama_karyawan = mysqli_real_escape_string($koneksi, $_POST['nama_karyawan']);
    $jabatan_karyawan = mysqli_real_escape_string($koneksi, $_POST['jabatan_karyawan']);
    $sub_dept = mysqli_real_escape_string($koneksi, $_POST['sub_dept']);
    $id_dept = mysqli_real_escape_string($koneksi, $_POST['nama_dept']); // nama_dept berisi id_dept dari form
    $unit_kerja = mysqli_real_escape_string($koneksi, $_POST['unit_kerja']);
    $atasan_karyawan = mysqli_real_escape_string($koneksi, $_POST['atasan_karyawan']);

    $query_dept = mysqli_query($koneksi, "SELECT nama_dept FROM tb_dept WHERE id_dept='$id_dept'");
    $data_dept = mysqli_fetch_assoc($query_dept);
    $nama_dept = $data_dept['nama_dept'];

    // Query untuk memasukkan data ke tabel tb_karyawan
    $sql = "INSERT INTO tb_karyawan (nik_karyawan, nama_karyawan, jabatan_karyawan, sub_dept, nama_dept, unit_kerja, atasan_karyawan) 
            VALUES ('$nik_karyawan', '$nama_karyawan', '$jabatan_karyawan', '$sub_dept', '$nama_dept', '$unit_kerja', '$atasan_karyawan')";

    if (mysqli_query($koneksi, $sql)) {
        echo "Data karyawan berhasil ditambahkan!";
        // Anda bisa mengarahkan pengguna kembali ke halaman daftar karyawan atau halaman lainnya
        // header("Location: ../halaman_karyawan.php");
        header('Location: ../index.php?page=input-nama-karyawan');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi);
}
?>