<?php
// Tentukan apakah mode 'Tambah' atau 'Edit'
$is_edit = isset($_GET['id']);
$id_jabatan = $is_edit ? (int)$_GET['id'] : null;
$nama_jabatan = '';

// Jika mode EDIT, ambil data lama
if ($is_edit) {
    $query_edit = $koneksi->prepare("SELECT nama_jabatan FROM jabatan WHERE id_jabatan = ?");
    $query_edit->bind_param("i", $id_jabatan);
    $query_edit->execute();
    $result_edit = $query_edit->get_result();
    
    if ($result_edit->num_rows > 0) {
        $data_edit = $result_edit->fetch_assoc();
        $nama_jabatan = $data_edit['nama_jabatan'];
    } else {
        // Data tidak ditemukan, redirect atau tampilkan pesan error
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Data jabatan tidak ditemukan.</div>';
        header('Location: index.php?page=data-jabatan');
        exit;
    }
    $query_edit->close();
}

// Logika Simpan (Tambah/Edit)
if (isset($_POST['submit_jabatan'])) {
    $nama_baru = trim($_POST['nama_jabatan']);

    if (empty($nama_baru)) {
        $_SESSION['alert_message'] = '<div class="alert alert-warning">Nama Jabatan tidak boleh kosong.</div>';
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    if ($is_edit) {
        // UPDATE data
        $query = $koneksi->prepare("UPDATE jabatan SET nama_jabatan = ? WHERE id_jabatan = ?");
        $query->bind_param("si", $nama_baru, $id_jabatan);
        $message = "diperbarui";
    } else {
        // INSERT data baru
        $query = $koneksi->prepare("INSERT INTO jabatan (nama_jabatan) VALUES (?)");
        $query->bind_param("s", $nama_baru);
        $message = "ditambahkan";
    }
    
    if ($query->execute()) {
        $_SESSION['alert_message'] = '<div class="alert alert-success">Data Jabatan berhasil ' . $message . '!</div>';
        header('Location: index.php?page=data-jabatan');
        exit;
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal ' . $message . ' data jabatan: ' . $query->error . '</div>';
        // Simpan input user saat gagal (untuk menghindari pengisian ulang)
        $nama_jabatan = $nama_baru; 
    }
    $query->close();
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
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $is_edit ? 'Edit Data' : 'Tambah Data'; ?> Jabatan</h3>
                    </div>
                    <form method="POST" action="">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama_jabatan">Nama Jabatan</label>
                                <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" 
                                       value="<?php echo htmlspecialchars($nama_jabatan); ?>" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="submit_jabatan" class="btn btn-primary">Simpan</button>
                            <a href="index.php?page=data-jabatan" class="btn btn-default">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>