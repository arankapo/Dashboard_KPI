<?php
// Pastikan file koneksi database Anda sudah di-include di sini
// Contoh: include 'koneksi.php';
if (!isset($koneksi)) {
    echo "Error: Koneksi database belum dibuat. Mohon sertakan file koneksi Anda.";
    exit;
}

$id_dept_terpilih = null;
$nama_dept_terpilih = "Tidak Diketahui";

// Ambil ID Departemen dari URL
if (isset($_GET['dept_id'])) {
    $id_dept_terpilih = $_GET['dept_id'];

    // Ambil nama departemen untuk ditampilkan di judul halaman
    $query_nama_dept = $koneksi->prepare("SELECT nama_dept FROM tb_dept WHERE Id_dept = ?");
    $query_nama_dept->bind_param("s", $id_dept_terpilih);
    $query_nama_dept->execute();
    $result_nama_dept = $query_nama_dept->get_result();
    if ($result_nama_dept->num_rows > 0) {
        $data_nama_dept = $result_nama_dept->fetch_assoc();
        $nama_dept_terpilih = htmlspecialchars($data_nama_dept['nama_dept']);
    }
    $query_nama_dept->close();
} else {
    // Jika tidak ada dept_id di URL, redirect kembali ke halaman data departemen
    header('Location: index.php?page=data-departemen');
    exit;
}


// Proses hapus data sub departemen
if (isset($_GET['delete_sub_dept_id'])) {
    $sub_dept_id_to_delete = (int)$_GET['delete_sub_dept_id'];

    mysqli_begin_transaction($koneksi);

    try {
        $delete_sub_dept_query = $koneksi->prepare("DELETE FROM tb_dept_sub WHERE id_sub_dept = ?");
        $delete_sub_dept_query->bind_param("i", $sub_dept_id_to_delete);
        if (!$delete_sub_dept_query->execute()) {
            throw new Exception("Error menghapus sub departemen: " . $delete_sub_dept_query->error);
        }
        $delete_sub_dept_query->close();

        mysqli_commit($koneksi);
        $_SESSION['alert_message'] = '<div class="alert alert-success">Sub Departemen berhasil dihapus!</div>';

    } catch (Exception $e) {
        mysqli_rollback($koneksi);
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menghapus sub departemen: ' . $e->getMessage() . '</div>';
    }

    // Redirect kembali ke halaman ini dengan dept_id yang sama
    header('Location: index.php?page=data-sub-departemen&dept_id=' . urlencode($id_dept_terpilih));
    exit;
}


// Tampilkan pesan alert jika ada
if (isset($_SESSION['alert_message'])) {
    echo $_SESSION['alert_message'];
    unset($_SESSION['alert_message']); // Hapus pesan setelah ditampilkan
}
?>

<script language="JavaScript" type="text/javascript">
function checkDeleteSubDept(){
    return confirm('Apakah yakin hapus data sub departemen ini?');
}
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Sub Departemen untuk Departemen: **<?php echo $nama_dept_terpilih; ?>**</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php?page=data-departemen" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Kembali ke Departemen</a>
                        <a href="index.php?page=tambah-sub-departemen&dept_id=<?php echo urlencode($id_dept_terpilih);?>" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Sub Departemen Baru</a>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Sub Departemen</th>
                                    <th>Nama Sub Departemen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Hanya tampilkan sub departemen yang memiliki id_dept yang sesuai
                                if ($id_dept_terpilih) {
                                    $query_sub_dept = $koneksi->prepare("SELECT id_sub_dept, nama_sub_dept FROM tb_dept_sub WHERE id_dept = ? ORDER BY nama_sub_dept ASC");
                                    $query_sub_dept->bind_param("s", $id_dept_terpilih);
                                    $query_sub_dept->execute();
                                    $result_sub_dept = $query_sub_dept->get_result();

                                    if (!$result_sub_dept) {
                                        echo "<tr><td colspan='3'>Error mengambil data sub departemen: " . mysqli_error($koneksi) . "</td></tr>";
                                    } else if ($result_sub_dept->num_rows == 0) {
                                        echo "<tr><td colspan='3'>Tidak ada data sub departemen yang ditemukan untuk departemen ini.</td></tr>";
                                    } else {
                                        while($data_sub_dept = $result_sub_dept->fetch_assoc()){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data_sub_dept['id_sub_dept']);?></td>
                                    <td><?php echo htmlspecialchars($data_sub_dept['nama_sub_dept']);?></td>
                                    <td>
                                        <a href="index.php?page=edit-sub-departemen&id=<?php echo urlencode($data_sub_dept['id_sub_dept']);?>&dept_id=<?php echo urlencode($id_dept_terpilih);?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="index.php?page=data-sub-departemen&delete_sub_dept_id=<?php echo urlencode($data_sub_dept['id_sub_dept']);?>&dept_id=<?php echo urlencode($id_dept_terpilih);?>" class="btn btn-danger btn-sm" onclick="return checkDeleteSubDept()">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    }
                                    $query_sub_dept->close();
                                } else {
                                    echo "<tr><td colspan='3'>Departemen tidak dipilih.</td></tr>";
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