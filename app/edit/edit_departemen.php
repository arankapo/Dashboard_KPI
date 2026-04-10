<?php
// Pastikan file koneksi database Anda sudah di-include di sini
// Contoh: include 'koneksi.php';
// Anda perlu mengganti 'koneksi.php' dengan nama file koneksi database Anda yang sebenarnya.

if (!isset($koneksi)) {
    echo "Error: Koneksi database belum dibuat. Mohon sertakan file koneksi Anda.";
    exit;
}

$id_dept_to_edit = null;

// Ambil ID Departemen dari URL
if (isset($_GET['id'])) {
    $id_dept_to_edit = htmlspecialchars($_GET['id']);

    // Query untuk mengambil data departemen yang akan diedit
    $stmt_fetch = $koneksi->prepare("SELECT Id_dept, nama_dept FROM tb_dept WHERE Id_dept = ?");
    $stmt_fetch->bind_param("s", $id_dept_to_edit);
    $stmt_fetch->execute();
    $result_fetch = $stmt_fetch->get_result();

    if ($result_fetch->num_rows > 0) {
        $data_dept = $result_fetch->fetch_assoc();
        $current_nama_dept = $data_dept['nama_dept'];
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Data Departemen tidak ditemukan!</div>';
        header('Location: index.php?page=data-departemen'); // Redirect jika data tidak ditemukan
        exit;
    }
    $stmt_fetch->close();
} else {
    // Jika tidak ada ID departemen di URL, redirect kembali ke halaman data departemen
    header('Location: index.php?page=data-departemen');
    exit;
}

// Proses jika form disubmit
if (isset($_POST['update'])) {
    $id_dept_form = htmlspecialchars($_POST['id_dept']); // Ini adalah ID yang mungkin berubah jika Anda mengizinkan edit ID
    $nama_dept_baru = htmlspecialchars($_POST['nama_dept']);

    // Validasi input
    if (empty($id_dept_form) || empty($nama_dept_baru)) {
        $_SESSION['alert_message'] = '<div class="alert alert-warning">Semua kolom harus diisi!</div>';
    } else {
        // Query untuk update data departemen
        // Perhatian: Jika Id_dept adalah Primary Key dan tidak boleh diubah,
        // maka Anda tidak perlu memasukkan 'Id_dept = ?' di SET clause dan tidak perlu $_POST['id_dept'] di bind_param.
        // Cukup gunakan Id_dept_to_edit di WHERE clause.
        // Jika Id_dept bisa diubah, pastikan tidak ada duplikasi ID.
        
        // Asumsi Id_dept adalah Primary Key dan tidak disarankan diubah, hanya nama_dept yang diubah.
        $stmt_update = $koneksi->prepare("UPDATE tb_dept SET nama_dept = ? WHERE Id_dept = ?");
        $stmt_update->bind_param("ss", $nama_dept_baru, $id_dept_to_edit);

        // Jika Anda ingin mengizinkan pengubahan ID Departemen:
        // $stmt_update = $koneksi->prepare("UPDATE tb_dept SET Id_dept = ?, nama_dept = ? WHERE Id_dept = ?");
        // $stmt_update->bind_param("sss", $id_dept_form, $nama_dept_baru, $id_dept_to_edit);
        // Penting: Jika Id_dept adalah FK di tb_dept_sub, Anda perlu CASCADE UPDATE di database atau update tb_dept_sub juga.

        if ($stmt_update->execute()) {
            $_SESSION['alert_message'] = '<div class="alert alert-success">Departemen berhasil diperbarui!</div>';
            // Redirect kembali ke halaman data departemen
            header('Location: index.php?page=data-departemen');
            exit;
        } else {
            $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal memperbarui departemen: ' . $stmt_update->error . '</div>';
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
                        <h3 class="card-title">Edit Departemen</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_dept">ID Departemen</label>
                                <input type="text" class="form-control" id="id_dept" name="id_dept" value="<?php echo htmlspecialchars($id_dept_to_edit); ?>" readonly required>
                                </div>
                            <div class="form-group">
                                <label for="nama_dept">Nama Departemen</label>
                                <input type="text" class="form-control" id="nama_dept" name="nama_dept" value="<?php echo htmlspecialchars($current_nama_dept); ?>" placeholder="Masukkan Nama Departemen" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="update" class="btn btn-info">Update</button>
                            <a href="index.php?page=data-departemen" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>