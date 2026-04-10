<?php
// Pastikan file koneksi database Anda sudah di-include di sini
// Contoh: include 'koneksi.php';
// Anda perlu mengganti 'koneksi.php' dengan nama file koneksi database Anda yang sebenarnya.

if (!isset($koneksi)) {
    echo "Error: Koneksi database belum dibuat. Mohon sertakan file koneksi Anda.";
    exit;
}

$id_sub_dept_to_edit = null;
$id_dept_current = null; // Untuk menyimpan ID departemen saat ini untuk redirect

// Ambil ID Sub Departemen dari URL
if (isset($_GET['id'])) {
    $id_sub_dept_to_edit = (int)$_GET['id'];

    // Ambil juga ID Departemen dari URL untuk redirect setelah edit
    if (isset($_GET['dept_id'])) {
        $id_dept_current = htmlspecialchars($_GET['dept_id']);
    }

    // Query untuk mengambil data sub departemen yang akan diedit
    $stmt_fetch = $koneksi->prepare("SELECT id_sub_dept, id_dept, nama_sub_dept FROM tb_dept_sub WHERE id_sub_dept = ?");
    $stmt_fetch->bind_param("i", $id_sub_dept_to_edit);
    $stmt_fetch->execute();
    $result_fetch = $stmt_fetch->get_result();

    if ($result_fetch->num_rows > 0) {
        $data_sub_dept = $result_fetch->fetch_assoc();
        $current_id_dept = $data_sub_dept['id_dept'];
        $current_nama_sub_dept = $data_sub_dept['nama_sub_dept'];
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Data Sub Departemen tidak ditemukan!</div>';
        header('Location: index.php?page=data-departemen'); // Redirect jika data tidak ditemukan
        exit;
    }
    $stmt_fetch->close();
} else {
    // Jika tidak ada ID sub departemen di URL, redirect kembali ke halaman data departemen
    header('Location: index.php?page=data-departemen');
    exit;
}

// Proses jika form disubmit
if (isset($_POST['update'])) {
    $id_sub_dept = (int)$_POST['id_sub_dept'];
    $id_dept_baru = $_POST['id_dept'];
    $nama_sub_dept_baru = $_POST['nama_sub_dept'];

    // Validasi input
    if (empty($id_dept_baru) || empty($nama_sub_dept_baru)) {
        $_SESSION['alert_message'] = '<div class="alert alert-warning">Semua kolom harus diisi!</div>';
    } else {
        // Query untuk update data sub departemen
        $stmt_update = $koneksi->prepare("UPDATE tb_dept_sub SET id_dept = ?, nama_sub_dept = ? WHERE id_sub_dept = ?");
        $stmt_update->bind_param("ssi", $id_dept_baru, $nama_sub_dept_baru, $id_sub_dept);

        if ($stmt_update->execute()) {
            $_SESSION['alert_message'] = '<div class="alert alert-success">Sub Departemen berhasil diperbarui!</div>';
            // Redirect kembali ke halaman data sub departemen untuk departemen yang relevan
            header('Location: index.php?page=data-sub-departemen&dept_id=' . urlencode($id_dept_baru));
            exit;
        } else {
            $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal memperbarui sub departemen: ' . $stmt_update->error . '</div>';
        }
        $stmt_update->close();
    }
}

// Tampilkan pesan alert jika ada
if (isset($_SESSION['alert_message'])) {
    echo $_SESSION['alert_message'];
    unset($_SESSION['alert_message']); // Hapus pesan setelah ditampilkan
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Sub Departemen</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <input type="hidden" name="id_sub_dept" value="<?php echo htmlspecialchars($id_sub_dept_to_edit); ?>">
                            <div class="form-group">
                                <label for="id_dept">Departemen</label>
                                <select class="form-control" id="id_dept" name="id_dept" required>
                                    <option value="">-- Pilih Departemen --</option>
                                    <?php
                                    // Ambil data departemen dari tb_dept untuk dropdown
                                    $query_dept = "SELECT Id_dept, nama_dept FROM tb_dept ORDER BY nama_dept ASC";
                                    $result_dept = mysqli_query($koneksi, $query_dept);

                                    if ($result_dept && mysqli_num_rows($result_dept) > 0) {
                                        while ($data_dept_option = mysqli_fetch_array($result_dept)) {
                                            $selected = ($current_id_dept == $data_dept_option['Id_dept']) ? 'selected' : '';
                                            echo '<option value="' . htmlspecialchars($data_dept_option['Id_dept']) . '" ' . $selected . '>' . htmlspecialchars($data_dept_option['nama_dept']) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Tidak ada departemen tersedia</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_sub_dept">Nama Sub Departemen</label>
                                <input type="text" class="form-control" id="nama_sub_dept" name="nama_sub_dept" value="<?php echo htmlspecialchars($current_nama_sub_dept); ?>" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="update" class="btn btn-info">Update</button>
                            <a href="index.php?page=data-sub-departemen&dept_id=<?php echo urlencode($id_dept_current); ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>