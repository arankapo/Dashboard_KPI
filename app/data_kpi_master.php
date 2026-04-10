<?php
// Pastikan koneksi.php sudah di-include di index.php

// Inisialisasi variabel
$selected_jabatan_id = isset($_GET['jabatan_id']) ? (int)$_GET['jabatan_id'] : null;
$kpi_data = [];

// Logika HAPUS data KPI Master
if (isset($_GET['delete_kpi_id'])) {
    $id_kpi_to_delete = (int)$_GET['delete_kpi_id'];

    // Mulai transaksi untuk menghapus parameter terkait terlebih dahulu
    mysqli_begin_transaction($koneksi);

    try {
        // 1. Hapus Parameter terkait (dari tb_kpi_parameter - asumsi tabel ini ada)
        // Kita gunakan kueri langsung tanpa prepare/bind untuk query yang simpel ini, 
        // tapi dalam aplikasi nyata, sangat disarankan menggunakan prepared statements
        $delete_param_query = "DELETE FROM kpi_parameter WHERE parameter_id = $id_kpi_to_delete";
        if (!mysqli_query($koneksi, $delete_param_query)) {
             throw new Exception("Error menghapus parameter: " . mysqli_error($koneksi));
        }

        // 2. Hapus KPI Master
        $delete_kpi_query = $koneksi->prepare("DELETE FROM kpi_master WHERE kpi_master_id = ?");
        $delete_kpi_query->bind_param("i", $id_kpi_to_delete);
        if (!$delete_kpi_query->execute()) {
             throw new Exception("Error menghapus KPI: " . $delete_kpi_query->error);
        }
        $delete_kpi_query->close();

        mysqli_commit($koneksi);
        $_SESSION['alert_message'] = '<div class="alert alert-success">Data KPI berhasil dihapus beserta parameternya!</div>';

    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menghapus KPI: ' . $e->getMessage() . '</div>';
    }

    header('Location: index.php?page=data-kpi-master&jabatan_id=' . $selected_jabatan_id);
    exit;
}

// Ambil semua data jabatan untuk dropdown
$query_jabatan = "SELECT id_jabatan, nama_jabatan FROM jabatan ORDER BY nama_jabatan ASC";
$result_jabatan = mysqli_query($koneksi, $query_jabatan);

// Ambil data KPI berdasarkan jabatan yang dipilih
if ($selected_jabatan_id) {
    // Join dengan tb_jabatan hanya untuk memastikan nama jabatan (opsional)
    $query_kpi = "SELECT 
                    km.id_kpi_master AS id_kpi, 
                    km.no_urut, 
                    km.indikator, 
                    km.kpi, 
                    km.bobot,
                    tj.nama_jabatan
                  FROM kpi_master km
                  JOIN jabatan tj ON km.id_jabatan = tj.id_jabatan
                  WHERE km.id_jabatan = ? 
                  ORDER BY km.no_urut ASC";
    
    $stmt = $koneksi->prepare($query_kpi);
    $stmt->bind_param("i", $selected_jabatan_id);
    $stmt->execute();
    $result_kpi = $stmt->get_result();
    $kpi_data = $result_kpi->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Tampilkan pesan alert jika ada
if (isset($_SESSION['alert_message'])) {
    echo $_SESSION['alert_message'];
    unset($_SESSION['alert_message']);
}
?>

<script language="JavaScript" type="text/javascript">
function checkDeleteKPI(){
    return confirm('Apakah yakin hapus data KPI ini? Semua data parameter terkait juga akan terhapus.');
}

function redirectToKPI(select) {
    var jabatanId = select.value;
    if (jabatanId) {
        window.location.href = 'index.php?page=data-kpi-master&jabatan_id=' + jabatanId;
    }
}
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan KPI Master per Jabatan</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group col-md-4">
                            <label for="select_jabatan">Pilih Jabatan:</label>
                            <select id="select_jabatan" class="form-control" onchange="redirectToKPI(this)">
                                <option value="">-- Pilih Jabatan --</option>
                                <?php
                                while($data_jabatan = mysqli_fetch_assoc($result_jabatan)){
                                    $selected = ($data_jabatan['id_jabatan'] == $selected_jabatan_id) ? 'selected' : '';
                                    echo '<option value="' . htmlspecialchars($data_jabatan['id_jabatan']) . '" ' . $selected . '>' . htmlspecialchars($data_jabatan['nama_jabatan']) . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <?php if ($selected_jabatan_id): ?>
                        <hr>
                        <a href="index.php?page=input-kpi-master&jabatan_id=<?php echo $selected_jabatan_id; ?>" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah KPI</a>
                        
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Indikator</th>
                                    <th>KPI</th>
                                    <th>Bobot (%)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($kpi_data)) {
                                    echo "<tr><td colspan='5'>Tidak ada data KPI untuk jabatan ini.</td></tr>";
                                } else {
                                    foreach($kpi_data as $data){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data['no_urut']);?></td>
                                    <td><?php echo nl2br(htmlspecialchars($data['indikator']));?></td>
                                    <td><?php echo nl2br(htmlspecialchars($data['kpi']));?></td>
                                    <td><?php echo htmlspecialchars($data['bobot']);?></td>
                                    <td>
                                        <a href="index.php?page=input-kpi-master&id=<?php echo urlencode($data['id_kpi']);?>" class="btn btn-info btn-sm">Edit KPI</a>
                                        <a href="index.php?page=data-kpi-parameter&kpi_id=<?php echo urlencode($data['id_kpi']);?>" class="btn btn-warning btn-sm">Atur Parameter</a>
                                        <a href="index.php?page=data-kpi-master&jabatan_id=<?php echo $selected_jabatan_id; ?>&delete_kpi_id=<?php echo urlencode($data['id_kpi']);?>" class="btn btn-danger btn-sm" onclick="return checkDeleteKPI()">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>