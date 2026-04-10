<?php
if (!isset($koneksi)) {
    echo "Error: Koneksi database belum dibuat. Mohon sertakan file koneksi Anda.";
    exit;
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $id_dept = htmlspecialchars($_POST['id_dept']);
    $nama_dept = htmlspecialchars($_POST['nama_dept']);

    // Validasi input
    if (empty($id_dept) || empty($nama_dept)) {
        $_SESSION['alert_message'] = '<div class="alert alert-warning">ID Departemen dan Nama Departemen harus diisi!</div>';
    } else {
        // Cek apakah ID Departemen sudah ada di database
        $stmt_check = $koneksi->prepare("SELECT Id_dept FROM tb_dept WHERE Id_dept = ?");
        $stmt_check->bind_param("s", $id_dept);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $_SESSION['alert_message'] = '<div class="alert alert-danger">ID Departemen sudah ada. Gunakan ID lain!</div>';
        } else {
            // Query untuk menyimpan data departemen baru
            $stmt_insert = $koneksi->prepare("INSERT INTO tb_dept (Id_dept, nama_dept) VALUES (?, ?)");
            $stmt_insert->bind_param("ss", $id_dept, $nama_dept);

            if ($stmt_insert->execute()) {
                $_SESSION['alert_message'] = '<div class="alert alert-success">Departemen berhasil ditambahkan!</div>';
                // Redirect kembali ke halaman data departemen
                header('Location: index.php?page=data-departemen');
                exit;
            } else {
                $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menambahkan departemen: ' . $stmt_insert->error . '</div>';
            }
            $stmt_insert->close();
        }
        $stmt_check->close();
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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Input Departemen Baru</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_dept">ID Departemen</label>
                                <input type="text" class="form-control" id="id_dept" name="id_dept" placeholder="Masukkan ID Departemen (contoh: D001)" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_dept">Nama Departemen</label>
                                <input type="text" class="form-control" id="nama_dept" name="nama_dept" placeholder="Masukkan Nama Departemen" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            <a href="index.php?page=data-departemen" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>