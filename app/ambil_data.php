<?php
// ambil_data.php
include('koneksi.php');

$id = $_POST['id'];
$modul = $_POST['modul'];

if ($modul == 'Kabupaten') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan where nama_dept='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    $kabupaten = '<option>---Pilih Karyawan---</option>';
    while ($dt = mysqli_fetch_array($sql)) {
        $kabupaten .= '<option value="' . $dt['nama_karyawan'] . '">' . $dt['nama_karyawan'] . '</option>';
    }

    echo $kabupaten;
} else if ($modul == 'nik') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan where nama_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $nik .= '<option value="' . $dt['nik_karyawan'] . '">' . $dt['nik_karyawan'] . '</option>';
    }
    echo $nik;
} else if ($modul == 'jabatan') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan where nama_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $jabatan .= '<option value="' . $dt['jabatan_karyawan'] . '">' . $dt['jabatan_karyawan'] . '</option>';
    }
    echo $jabatan;
} else if ($modul == 'sub_dept') { 
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan where nama_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $sub_dept .= '<option value="' . $dt['sub_dept'] . '">' . $dt['sub_dept'] . '</option>';
    }
    echo $sub_dept;
} else if ($modul == 'sub_dept2') { // New module for fetching sub_dept from tb_dept_sub
    $sql = mysqli_query($koneksi, "SELECT nama_sub_dept FROM tb_dept_sub WHERE id_dept = '$id' ORDER BY nama_sub_dept ASC") or die(mysqli_error($koneksi));
    $sub_dept_options = '<option value="">Pilih Sub Departemen</option>';
    while ($dt = mysqli_fetch_array($sql)) {
        $sub_dept_options .= '<option value="' . htmlspecialchars($dt['nama_sub_dept']) . '">' . htmlspecialchars($dt['nama_sub_dept']) . '</option>';
    }
    echo $sub_dept_options;
}
?>