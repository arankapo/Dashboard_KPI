<?php

if (!isset($koneksi)) {
    echo "Error: Koneksi database belum dibuat. Mohon sertakan file koneksi Anda.";
    exit;
}

// Proses hapus data departemen
if (isset($_GET['delete_dept_id'])) {
    $dept_id_to_delete = $_GET['delete_dept_id'];

    // Mulai transaksi untuk memastikan konsistensi data
    mysqli_begin_transaction($koneksi);

    try {
        // 1. Hapus sub-departemen yang terkait dengan departemen ini terlebih dahulu
        $delete_sub_dept_query = $koneksi->prepare("DELETE FROM tb_dept_sub WHERE id_dept = ?");
        $delete_sub_dept_query->bind_param("s", $dept_id_to_delete);
        if (!$delete_sub_dept_query->execute()) {
            throw new Exception("Error menghapus sub departemen terkait: " . $delete_sub_dept_query->error);
        }
        $delete_sub_dept_query->close();

        // 2. Kemudian hapus departemen dari tabel tb_dept
        $delete_dept_query = $koneksi->prepare("DELETE FROM tb_dept WHERE Id_dept = ?");
        $delete_dept_query->bind_param("s", $dept_id_to_delete);
        if (!$delete_dept_query->execute()) {
            throw new Exception("Error menghapus departemen: " . $delete_dept_query->error);
        }
        $delete_dept_query->close();

        // Commit transaksi jika semua query berhasil
        mysqli_commit($koneksi);
        $_SESSION['alert_message'] = '<div class="alert alert-success">Departemen dan sub-departemen terkait berhasil dihapus!</div>';

    } catch (Exception $e) {
        // Rollback transaksi jika ada error
        mysqli_rollback($koneksi);
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menghapus departemen: ' . $e->getMessage() . '</div>';
    }

    // Redirect untuk membersihkan URL dari parameter delete_dept_id
    header('Location: index.php?page=data-departemen');
    exit;
}

// Tampilkan pesan alert jika ada
if (isset($_SESSION['alert_message'])) {
    echo $_SESSION['alert_message'];
    unset($_SESSION['alert_message']);
}
?>

<script language="JavaScript" type="text/javascript">
function checkDeleteDept(){
    return confirm('Apakah yakin hapus data departemen ini? Semua sub departemen di bawahnya juga akan terhapus.');
}
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Departemen</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php?page=tambah-departemen" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Departemen Baru</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Departemen</th>
                                    <th>Nama Departemen</th>
                                    <th>Sub-Departemen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query_dept = "SELECT Id_dept, nama_dept FROM tb_dept ORDER BY nama_dept ASC";
                                $result_dept = mysqli_query($koneksi, $query_dept);

                                if (!$result_dept) {
                                    echo "<tr><td colspan='4'>Error mengambil data departemen: " . mysqli_error($koneksi) . "</td></tr>";
                                } else if (mysqli_num_rows($result_dept) == 0) {
                                    echo "<tr><td colspan='4'>Tidak ada data departemen yang ditemukan.</td></tr>";
                                } else {
                                    while($data_dept = mysqli_fetch_array($result_dept)){
                                        // Query untuk menghitung jumlah sub-departemen
                                        $query_count_sub = $koneksi->prepare("SELECT COUNT(*) AS total FROM tb_dept_sub WHERE id_dept = ?");
                                        $query_count_sub->bind_param("s", $data_dept['Id_dept']);
                                        $query_count_sub->execute();
                                        $result_count_sub = $query_count_sub->get_result();
                                        $data_count_sub = $result_count_sub->fetch_assoc();
                                        $jumlah_sub_dept = $data_count_sub['total'];
                                        $query_count_sub->close();
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data_dept['Id_dept']);?></td>
                                    <td><?php echo htmlspecialchars($data_dept['nama_dept']);?></td>
                                    <td>
                                        <a href="index.php?page=data-sub-departemen&dept_id=<?php echo urlencode($data_dept['Id_dept']);?>" class="btn btn-primary btn-sm">
                                            Lihat (<?php echo $jumlah_sub_dept; ?>)
                                        </a>
                                    </td>
                                    <td>
                                        <a href="index.php?page=edit-departemen&id=<?php echo urlencode($data_dept['Id_dept']);?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="index.php?page=data-departemen&delete_dept_id=<?php echo urlencode($data_dept['Id_dept']);?>" class="btn btn-danger btn-sm" onclick="return checkDeleteDept()">Hapus</a>
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