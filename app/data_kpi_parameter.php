<?php
// Pastikan koneksi.php sudah di-include di index.php

$id_kpi = isset($_GET['kpi_id']) ? (int)$_GET['kpi_id'] : null;

if (!$id_kpi) {
    $_SESSION['alert_message'] = '<div class="alert alert-danger">ID KPI tidak ditemukan.</div>';
    header('Location: index.php?page=data-kpi-master');
    exit;
}

// Inisialisasi variabel untuk tampilan
$kpi_info = [
    'indikator' => 'N/A',
    'kpi' => 'N/A',
    'jabatan' => 'N/A',
    'bobot' => 'N/A',
    'id_jabatan' => 0
];
$parameter_data = [];
$total_bobot_parameter = 0;

// 1. Ambil detail KPI dan Jabatan terkait
$query_kpi_info = $koneksi->prepare("
    SELECT 
        km.indikator, km.kpi, km.bobot, km.id_jabatan, tj.nama_jabatan
    FROM kpi_master km
    JOIN jabatan tj ON km.id_jabatan = tj.id_jabatan
    WHERE km.id_kpi_master = ?
");
$query_kpi_info->bind_param("i", $id_kpi);
$query_kpi_info->execute();
$result_info = $query_kpi_info->get_result();
if ($result_info->num_rows > 0) {
    $info = $result_info->fetch_assoc();
    $kpi_info['indikator'] = $info['indikator'];
    $kpi_info['kpi'] = $info['kpi'];
    $kpi_info['bobot'] = $info['bobot'];
    $kpi_info['jabatan'] = $info['nama_jabatan'];
    $kpi_info['id_jabatan'] = $info['id_jabatan'];
} else {
    $_SESSION['alert_message'] = '<div class="alert alert-danger">Data KPI tidak valid.</div>';
    header('Location: index.php?page=data-kpi-master');
    exit;
}
$query_kpi_info->close();


// 2. Ambil data Parameter Score
$query_param = "SELECT parameter_id, parameter_nilai, score FROM kpi_parameter WHERE id_kpi_master = ? ORDER BY score DESC";
$stmt_param = $koneksi->prepare($query_param);
$stmt_param->bind_param("i", $id_kpi);
$stmt_param->execute();
$result_param = $stmt_param->get_result();
$parameter_data = $result_param->fetch_all(MYSQLI_ASSOC);
$stmt_param->close();

// Hitung total score parameter (Opsional, untuk validasi)
foreach ($parameter_data as $param) {
    $total_bobot_parameter += $param['score'];
}


// 3. Logika HAPUS data parameter
if (isset($_GET['delete_param_id'])) {
    $id_param_to_delete = (int)$_GET['delete_param_id'];
    
    $delete_query = $koneksi->prepare("DELETE FROM kpi_parameter WHERE parameter_id = ?");
    $delete_query->bind_param("i", $id_param_to_delete);
    
    if ($delete_query->execute()) {
        $_SESSION['alert_message'] = '<div class="alert alert-success">Data Parameter berhasil dihapus!</div>';
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menghapus data parameter: ' . $delete_query->error . '</div>';
    }
    $delete_query->close();

    header('Location: index.php?page=data-kpi-parameter&kpi_id=' . $id_kpi);
    exit;
}

// Tampilkan pesan alert jika ada
if (isset($_SESSION['alert_message'])) {
    echo $_SESSION['alert_message'];
    unset($_SESSION['alert_message']);
}
?>

<script language="JavaScript" type="text/javascript">
function checkDeleteParameter(){
    return confirm('Apakah yakin hapus data parameter ini?');
}
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan Parameter Score KPI</h3>
                    </div>
                    <div class="card-body">
                        <div class="callout callout-info">
                            <h5>Detail KPI:</h5>
                            <p>
                                <strong>Jabatan:</strong> <?php echo htmlspecialchars($kpi_info['jabatan']); ?><br>
                                <strong>Bobot Indikator:</strong> <?php echo htmlspecialchars($kpi_info['bobot']); ?>%<br>
                                <strong>Indikator:</strong> <?php echo nl2br(htmlspecialchars($kpi_info['indikator'])); ?><br>
                                <strong>KPI:</strong> <?php echo nl2br(htmlspecialchars($kpi_info['kpi'])); ?>
                            </p>
                            <a href="index.php?page=data-kpi-master&jabatan_id=<?php echo $kpi_info['id_jabatan']; ?>" class="btn btn-sm btn-default"><i class="fas fa-arrow-left"></i> Kembali ke Daftar KPI</a>
                        </div>
                        
                        <a href="index.php?page=input-kpi-parameter&kpi_id=<?php echo $id_kpi; ?>" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Parameter Baru</a>
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Parameter</th>
                                    <th>Score</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($parameter_data)) {
                                    echo "<tr><td colspan='3'>Tidak ada data parameter score untuk KPI ini.</td></tr>";
                                } else {
                                    foreach($parameter_data as $data){
                                ?>
                                <tr>
                                    <td><?php echo nl2br(htmlspecialchars($data['parameter_nilai']));?></td>
                                    <td><?php echo htmlspecialchars($data['score']);?></td>
                                    <td>
                                        <a href="index.php?page=input-kpi-parameter&id=<?php echo urlencode($data['parameter_id']);?>&kpi_id=<?php echo $id_kpi; ?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="index.php?page=data-kpi-parameter&kpi_id=<?php echo $id_kpi; ?>&delete_param_id=<?php echo urlencode($data['parameter_id']);?>" class="btn btn-danger btn-sm" onclick="return checkDeleteParameter()">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Score:</th>
                                    <th><?php echo $total_bobot_parameter; ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>