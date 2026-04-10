<?php
// Pastikan koneksi.php sudah di-include di index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// HAPUS setelah debugging selesai.
// Logika HAPUS data jabatan
if (isset($_GET['delete_id'])) {
    $id_jabatan_to_delete = (int)$_GET['delete_id'];

    // Cek apakah ada KPI yang terhubung ke jabatan ini (menghindari error FK)
    $check_kpi = $koneksi->prepare("SELECT COUNT(*) FROM tb_kpi_master WHERE id_jabatan = ?");
    
    if (!$check_kpi) {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal Prepare Kueri Cek KPI: ' . $koneksi->error . '</div>';
    } else {
        $check_kpi->bind_param("i", $id_jabatan_to_delete);
        
        if (!$check_kpi->execute()) {
             $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal Execute Kueri Cek KPI: ' . $check_kpi->error . '</div>';
        } else {
            $check_kpi->bind_result($count);
            $check_kpi->fetch();
            $check_kpi->close();

            if ($count > 0) {
                $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menghapus! Jabatan ini masih memiliki ' . $count . ' data KPI terkait. Harap hapus KPI terkait terlebih dahulu.</div>';
            } else {
                // Hapus data jika tidak ada KPI terkait
                $delete_query = $koneksi->prepare("DELETE FROM tb_jabatan WHERE id_jabatan = ?");
                
                if (!$delete_query) {
                    $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal Prepare Kueri Hapus Jabatan: ' . $koneksi->error . '</div>';
                } else {
                    $delete_query->bind_param("i", $id_jabatan_to_delete);
                    
                    if ($delete_query->execute()) {
                        $_SESSION['alert_message'] = '<div class="alert alert-success">Data Jabatan berhasil dihapus!</div>';
                    } else {
                        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menghapus data jabatan: ' . $delete_query->error . '</div>';
                    }
                    $delete_query->close();
                }
            }
        }
    }
    
    // Pastikan ini selalu dijalankan agar pesan alert tampil
    header('Location: index.php?page=data-jabatan');
    exit;
}
// Tampilkan pesan alert jika ada
if (isset($_SESSION['alert_message'])) {
    echo $_SESSION['alert_message'];
    unset($_SESSION['alert_message']);
}
?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Master Jabatan</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php?page=input-jabatan" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Jabatan Baru</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT id_jabatan, nama_jabatan FROM jabatan ORDER BY nama_jabatan ASC";
                                $result = mysqli_query($koneksi, $query);

                                if (!$result) {
                                    echo "<tr><td colspan='3'>Error mengambil data: " . mysqli_error($koneksi) . "</td></tr>";
                                } else if (mysqli_num_rows($result) == 0) {
                                    echo "<tr><td colspan='3'>Tidak ada data jabatan yang ditemukan.</td></tr>";
                                } else {
                                    while($data = mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data['id_jabatan']);?></td>
                                    <td><?php echo htmlspecialchars($data['nama_jabatan']);?></td>
                                    <td>
                                        <a href="index.php?page=input-jabatan&id=<?php echo urlencode($data['id_jabatan']);?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="index.php?page=data-jabatan&delete_id=<?php echo urlencode($data['id_jabatan']);?>" class="btn btn-danger btn-sm" onclick="return checkDelete()">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>