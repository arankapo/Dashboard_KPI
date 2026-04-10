<?php
// jika user klik delete, proses hapus data user
if (isset($_GET['delete_id'])) {
    $user_id_to_delete = (int)$_GET['delete_id'];

    // Mulai transaksi untuk memastikan konsistensi data
    mysqli_begin_transaction($koneksi);

    try {
        // 1. Hapus entri akses menu yang terkait dengan pengguna ini terlebih dahulu
        $delete_access_query = $koneksi->prepare("DELETE FROM tb_user_menu_access WHERE user_id = ?");
        $delete_access_query->bind_param("i", $user_id_to_delete);
        if (!$delete_access_query->execute()) {
            throw new Exception("Error menghapus akses menu: " . $delete_access_query->error);
        }
        $delete_access_query->close();

        // 2. Kemudian hapus pengguna dari tabel tb_user
        $delete_user_query = $koneksi->prepare("DELETE FROM tb_user WHERE Id = ?");
        $delete_user_query->bind_param("i", $user_id_to_delete);
        if (!$delete_user_query->execute()) {
            throw new Exception("Error menghapus pengguna: " . $delete_user_query->error);
        }
        $delete_user_query->close();

        // Commit transaksi jika semua query berhasil
        mysqli_commit($koneksi);
        $_SESSION['alert_message'] = '<div class="alert alert-success">Pengguna berhasil dihapus!</div>';

    } catch (Exception $e) {
        // Rollback transaksi jika ada error
        mysqli_rollback($koneksi);
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menghapus pengguna: ' . $e->getMessage() . '</div>';
    }

    // Redirect untuk membersihkan URL dari parameter delete_id
    header('Location: index.php?page=data-user');
    //exit;
}

// Tampilkan pesan alert jika ada
if (isset($_SESSION['alert_message'])) {
    echo $_SESSION['alert_message'];
    unset($_SESSION['alert_message']); // Hapus pesan setelah ditampilkan
}
?>

<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Apakah yakin hapus data user ini? Data akses menu pengguna juga akan terhapus.');
}
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <a href="index.php?page=input-user" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah Pengguna Baru</a>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Departemen</th>
                                    <th>Sub Departemen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT Id, Nama, Username, Level, nama_dept, sub_dept FROM tb_user ORDER BY Nama ASC";
                                $result = mysqli_query($koneksi, $query);

                                if (!$result) {
                                    echo "<tr><td colspan='7'>Error mengambil data: " . mysqli_error($koneksi) . "</td></tr>";
                                } else if (mysqli_num_rows($result) == 0) {
                                    echo "<tr><td colspan='7'>Tidak ada data pengguna yang ditemukan.</td></tr>";
                                } else {
                                    while($data = mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($data['Id']);?></td>
                                    <td><?php echo htmlspecialchars($data['Nama']);?></td>
                                    <td><?php echo htmlspecialchars($data['Username']);?></td>
                                    <td><?php echo htmlspecialchars($data['Level']);?></td>
                                    <td><?php echo htmlspecialchars($data['nama_dept']);?></td>
                                    <td><?php echo htmlspecialchars($data['sub_dept']);?></td>
                                    <td>
                                        <a href="index.php?page=edit-user&id=<?php echo urlencode($data['Id']);?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="index.php?page=data-user&delete_id=<?php echo urlencode($data['Id']);?>" class="btn btn-danger btn-sm" onclick="return checkDelete()">Hapus</a>
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