<?php
include('koneksi.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$id = isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : 0);
if ($id <= 0) {
    echo '<div class="alert alert-danger">ID tidak valid.</div>';
    exit;
}
// Ambil data header
$q_header = mysqli_query($koneksi, "SELECT * FROM evaluasi_training_header WHERE id = $id");
$header = mysqli_fetch_assoc($q_header);
if (!$header) {
    echo '<div class="alert alert-danger">Data tidak ditemukan.</div>';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $penyelenggara = $_POST['penyelenggara'];
    $nama_peserta = $_POST['nama_peserta'];
    $point_pengembangan = $_POST['point_pengembangan'];
    $pencapaian = $_POST['pencapaian'];
    $alasan = $_POST['alasan'];
    $pengetahuan = $_POST['pengetahuan'];
    $penerapan = $_POST['penerapan'];
    $penilaian = $_POST['penilaian'];
    $efektivitas = $_POST['efektivitas'];
    $stmt = $koneksi->prepare("UPDATE evaluasi_training_header SET penyelenggara=?, nama_peserta=?, point_pengembangan=?, pencapaian=?, alasan=?, pengetahuan=?, penerapan=?, penilaian=?, efektivitas=? WHERE id=?");
    $stmt->bind_param("sssssssssi", $penyelenggara, $nama_peserta, $point_pengembangan, $pencapaian, $alasan, $pengetahuan, $penerapan, $penilaian, $efektivitas, $id);
    $stmt->execute();
    $stmt->close();
   
    $no_permintaan = isset($header['no_permintaan']) ? $header['no_permintaan'] : '';
    echo '<script>alert("Data berhasil diupdate."); window.location.href="../index.php?page=data-evaluasi-training&no_permintaan=' . urlencode($no_permintaan) . '";</script>';
    exit;
}
?>