<?php
// detail_exit_interview.php
// detail_exit_interview.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$message = '';
$detail_ei = null;
$pernyataan_ei1 = [];
$pernyataan_ei2 = [];

// Periksa apakah ID exit interview diterima dari URL
if (isset($_GET['id'])) {
    $id_exit_interview = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Di detail_exit_interview.php

// Query untuk detail header (informasi karyawan)
$sql_detail_header = "SELECT 
                        ei.id_exit_interview,
                        k.nama_karyawan,
                        k.nik,
                        d.nama_dept,
                        k.jabatan,
                        k.divisi,
                        k.no_telp,
                        k.tanggal_masuk,
                        ei.tanggal_resign 
                      FROM tb_exit_interview_header ei
                      JOIN tb_karyawan k ON ei.id_karyawan = k.id_karyawan
                      JOIN tb_dept d ON k.id_departemen = d.id_departemen
                      WHERE ei.id_exit_interview = '$id_exit_interview'";
$result_detail_header = mysqli_query($koneksi, $sql_detail_header);
$detail_ei = mysqli_fetch_assoc($result_detail_header);

// Query untuk detail jawaban pertanyaan
$sql_jawaban_detail = "SELECT tbd.no_pertanyaan, tbd.jawaban_rating, tbd.jawaban_essay, tp.Deskripsi, tp.tipe
                       FROM tb_exit_interview_detail tbd
                       JOIN tb_pertanyaan tp ON tbd.no_pertanyaan = tp.No
                       WHERE tbd.id_exit_interview = '$id_exit_interview'
                       ORDER BY tp.No ASC";
$result_jawaban_detail = mysqli_query($koneksi, $sql_jawaban_detail);

// Kemudian Anda akan memproses $result_jawaban_detail dalam loop untuk menampilkan pertanyaan dan jawaban
// Anda tidak akan lagi memiliki kolom pernyataanke_1, exin2_1, dll. langsung di $detail_ei
// Anda perlu memetakan jawaban dari $result_jawaban_detail ke array terpisah.

// Contoh pemetaan jawaban
$jawaban_rating = [];
$jawaban_essay = [];
while ($row_jawaban = mysqli_fetch_assoc($result_jawaban_detail)) {
    if ($row_jawaban['tipe'] == 'exin1') {
        $jawaban_rating[$row_jawaban['no_pertanyaan']] = $row_jawaban['jawaban_rating'];
    } elseif ($row_jawaban['tipe'] == 'exin2') {
        $jawaban_essay[$row_jawaban['no_pertanyaan']] = $row_jawaban['jawaban_essay'];
    }
}
} else {
    $message = '<div class="alert alert-warning" role="alert">ID Exit Interview tidak spesifik.</div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Exit Interview</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .container {
            margin-top: 30px;
        }
        .card-header h3 {
            margin-bottom: 0;
        }
        .detail-row {
            margin-bottom: 10px;
        }
        .detail-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4 text-center">Detail Exit Interview</h2>

        <?php echo $message; ?>

        <?php if ($detail_ei): ?>
        <div class="card">
            <div class="card-header">
                <h3>Informasi Karyawan</h3>
            </div>
            <div class="card-body">
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">ID Exit Interview:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['id_exit_interview']); ?></div>
                </div>
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">Nama Karyawan:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['nama_karyawan']); ?></div>
                </div>
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">NIK:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['nik']); ?></div>
                </div>
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">Departemen:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['nama_dept']); ?></div>
                </div>
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">Jabatan:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['jabatan']); ?></div>
                </div>
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">Divisi:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['divisi']); ?></div>
                </div>
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">No. Telp:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['no_telp']); ?></div>
                </div>
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">Tanggal Masuk:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['tanggal_masuk']); ?></div>
                </div>
                <div class="row detail-row">
                    <div class="col-sm-4 detail-label">Tanggal Resign:</div>
                    <div class="col-sm-8"><?php echo htmlspecialchars($detail_ei['tanggal_resign']); ?></div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3>Hasil Pernyataan (Rating)</h3>
            </div>
            <div class="card-body">
                <?php
                // Tampilkan hasil pernyataan sesi pertama (rating)
                foreach ($pernyataan_ei1 as $no => $deskripsi) {
                    $column_name = 'pernyataanke_' . $no; // Contoh: pernyataanke_1
                    if (isset($detail_ei[$column_name])) {
                        echo '<div class="row detail-row">';
                        echo '<div class="col-sm-9">' . htmlspecialchars($no) . '. ' . htmlspecialchars($deskripsi) . '</div>';
                        echo '<div class="col-sm-3 text-right">' . htmlspecialchars($detail_ei[$column_name]) . '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3>Hasil Pernyataan (Essay)</h3>
            </div>
            <div class="card-body">
                <?php
                // Tampilkan hasil pernyataan sesi kedua (textarea)
                foreach ($pernyataan_ei2 as $no => $deskripsi) {
                    $column_name = 'exin2_' . $no; // Contoh: exin2_1
                    if (isset($detail_ei[$column_name])) {
                        echo '<div class="row detail-row">';
                        echo '<div class="col-sm-12"><strong>' . htmlspecialchars($no) . '. ' . htmlspecialchars($deskripsi) . '</strong></div>';
                        echo '<div class="col-sm-12">';
                        echo '<textarea class="form-control" rows="3" readonly>' . htmlspecialchars($detail_ei[$column_name]) . '</textarea>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="data_exit_interview.php" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>

        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>