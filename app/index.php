<!DOCTYPE html>
<html lang="en">
<?php
session_start(); 
?>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<body class="hold-transition sidebar-mini layout-fixed">

<?php
// Pastikan tidak ada output SEBELUM baris ini.
// Semua error_reporting, ini_set, ob_start, dll., harus di bawah session_start();
error_reporting(E_ALL); // Untuk debugging
ini_set('display_errors', 1); // Untuk debugging
ob_start(); // Jika Anda masih ingin menggunakan output buffering

if(!isset($_SESSION['nama']) || empty($_SESSION['nama'])){ // Cek apakah session 'nama' sudah di-set
    header('Location: ../index.php?session_expired');
    exit; // Pastikan untuk keluar dari skrip setelah redirect
}

include('head.php');
include('koneksi.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"> <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include('preloader.php'); ?>

        <?php include('navbar.php'); ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <?php include('logo.php'); ?>

            <?php include('sidebar.php'); ?>
            </aside>

        <?php include('content_header.php'); ?>
        <?php
        $pages = [
            'dashboard' => 'dashboard.php',
            'data-nilai' => 'data_nilai.php',
            'data-penilaian' => 'data_nilai.php',
            'data-penilaian-supervisor' => 'data_penilaian_supervisor.php',
            'data-penilaian-manajer' => 'data_penilaian_manajer.php',
            'data-dept' => 'data_dept.php',
            'data-karyawan' => 'data_karyawan.php',
            'input-data-dept' => 'input_data_dept.php',
            'input-data-karyawan' => 'input_data_karyawan.php',
            'edit-karyawan' => 'edit/edit_karyawan.php',
            'edit-data-nilai' => 'edit/edit_data_nilai.php',
            'report-print-nilai' => 'reportpdf/report.php',
            'data-permintaan-karyawan' => 'data_permintaan_karyawan.php',
            'data-permintaan' => 'data_permintaan.php',
            'data-permintaanhrd' => 'data_permintaanhrd.php',
            'edit-jumlah-permintaan' => 'edit/edit_jumlah_permintaan_karyawan.php',
            'edit-data-permintaan' => 'edit/edit_data_permintaan_karyawan.php',
            'edit-approve-permintaan' => 'edit/edit_approve_permintaan_karyawan.php',
            'edit-close-permintaan' => 'edit/update_tanggal_close.php',
            'data-permintaan-training' => 'data_permintaan_training.php',
            'input-permintaan-training' => 'input_permintaan_training.php',
            'data-evaluasi-training' => 'data_evaluasi_training.php',
            'edit-evaluasi-training' => 'edit_evaluasi_training.php',
            'input-evaluasi-interview' => 'input_evaluasi_training.php',
            'input-penilaian-outsourcing' => 'input_penilaian_outsourcing.php',
            'data-nilai-outsourcing' => 'data_nilai_outsourcing.php',
            'input-exit-interview' => 'input_exit_interview.php',
            'pengaturan-akses-menu' => 'pengaturan_akses_menu.php',
            'data-exit-interview' => 'data_exit_interview.php',
            'data-user' => 'data_user.php',
            'input-user' => 'input_user.php',
            'edit-user' => 'edit/edit_user.php',
			'input-nama-karyawan' => 'input_nama_karyawan.php',
			'edit-password' => 'edit/edit_password.php',
            'data-departemen' => 'data_departemen.php',
            'data-sub-departemen' => 'data_sub_departemen.php',
            'tambah-sub-departemen' => 'add/tambah_sub_departemen.php',
            'edit-sub-departemen' => 'edit/edit_sub_departemen.php',
            'edit-departemen' => 'edit/edit_departemen.php',
            'tambah-departemen' => 'add/tambah_departemen.php',
            'data-jabatan' => 'data_jabatan.php', // Halaman master jabatan
            'data-kpi-master' => 'data_kpi_master.php', // Halaman pengaturan KPI
            'input-jabatan' => 'input_jabatan.php', // Halaman input jabatan
            'input-kpi-master' => 'input_kpi_master.php', // Halaman input KPI
            'data-kpi-parameter' => 'data_kpi_parameter.php', // Untuk menampilkan & CRUD Parameter
            'input-kpi-parameter' => 'input_kpi_parameter.php' // Opsional: Untuk form tambah/edit parameter
        ];
        if (isset($_GET['page']) && isset($pages[$_GET['page']])) {
            include($pages[$_GET['page']]);
        } else {
            include('dashboard.php');
        }
        ?>
        </div>

    <?php include('footer.php'); ?>
    <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <?php
    ob_end_flush(); // Flush the output buffer to send all output to the browser
?>
</body>

</html>