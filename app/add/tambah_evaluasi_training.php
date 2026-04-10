<?php
include('../koneksi.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ambil data dari GET
$no_permintaan = isset($_GET['no_permintaan']) ? $_GET['no_permintaan'] : '';
$judul_training = isset($_GET['judul_training']) ? $_GET['judul_training'] : '';
$tanggal_training = isset($_GET['tanggal_training']) ? $_GET['tanggal_training'] : '';
$penyelenggara = isset($_GET['penyelenggara']) ? $_GET['penyelenggara'] : '';
$nama_peserta = isset($_GET['nama_peserta']) ? $_GET['nama_peserta'] : '';
$nama_trainer = isset($_GET['nama_trainer']) ? $_GET['nama_trainer'] : '';
$divisi = isset($_GET['divisi']) ? $_GET['divisi'] : '';
$point_pengembangan = isset($_GET['point_pengembangan']) ? $_GET['point_pengembangan'] : '';

// Insert ke tabel header evaluasi_training_header
$query_header = "INSERT INTO evaluasi_training_header (no_permintaan, judul_training, tanggal_training, penyelenggara, nama_peserta, nama_trainer, divisi, point_pengembangan) VALUES (?,?,?,?,?,?,?,?)";
$stmt = mysqli_prepare($koneksi, $query_header);
mysqli_stmt_bind_param($stmt, 'ssssssss', $no_permintaan, $judul_training, $tanggal_training, $penyelenggara, $nama_peserta, $nama_trainer, $divisi, $point_pengembangan);
$success = mysqli_stmt_execute($stmt);

if ($success) {
    $id_header = mysqli_insert_id($koneksi);
    // Insert detail evaluasi
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE tipe = 'evtra'");
    while ($data = mysqli_fetch_array($sql)) {
        $no = $data['No'];
        $nilai = isset($_GET['pernyataanke-'.$no]) ? $_GET['pernyataanke-'.$no] : 0;
        $teks_pertanyaan = $data['Deskripsi'];
        $query_detail = "INSERT INTO evaluasi_training_detail (id_header, no_pertanyaan, nilai, teks_pertanyaan) VALUES (?,?,?,?)";
        $stmt_detail = mysqli_prepare($koneksi, $query_detail);
        mysqli_stmt_bind_param($stmt_detail, 'iiis', $id_header, $no, $nilai, $teks_pertanyaan);
        mysqli_stmt_execute($stmt_detail);
    }
    echo '<script>alert("Data evaluasi berhasil disimpan."); window.location.href="../index.php?page=data-evaluasi-training";</script>';
} else {
    echo '<script>alert("Gagal menyimpan data evaluasi."); window.history.back();</script>';
}
?>
