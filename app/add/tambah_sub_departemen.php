<?php


if (!isset($koneksi)) {
    echo "Error: Koneksi database belum dibuat. Mohon sertakan file koneksi Anda.";
    exit;
}

$id_dept_preselected = ''; // Variabel untuk menampung ID departemen jika ada dari URL

// Ambil ID Departemen jika ada dari URL (saat diakses dari 'Lihat Sub-Departemen')
if (isset($_GET['dept_id'])) {
    $id_dept_preselected = htmlspecialchars($_GET['dept_id']);
}

// Proses jika form disubmit
if (isset($_POST['simpan'])) {
    $id_dept = $_POST['id_dept'];
    $nama_sub_dept = $_POST['nama_sub_dept'];

    // Validasi input
    if (empty($id_dept) || empty($nama_sub_dept)) {
        $_SESSION['alert_message'] = '<div class="alert alert-warning">Semua kolom harus diisi!</div>';
    } else {
        // Query untuk menyimpan data sub departemen baru
        $stmt = $koneksi->prepare("INSERT INTO tb_dept_sub (id_dept, nama_sub_dept) VALUES (?, ?)");
        $stmt->bind_param("ss", $id_dept, $nama_sub_dept);

        if ($stmt->execute()) {
            $_SESSION['alert_message'] = '<div class="alert alert-success">Sub Departemen berhasil ditambahkan!</div>';
            // Redirect kembali ke halaman data sub departemen untuk departemen terkait
            header('Location: index.php?page=data-sub-departemen&dept_id=' . urlencode($id_dept));
            exit;
        } else {
            $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menambahkan sub departemen: ' . $stmt->error . '</div>';
        }
        $stmt->close();
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
                        <h3 class="card-title">Input Sub Departemen Baru</h3>
                    </div>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="id_dept">Departemen</label>
                                <select class="form-control" id="id_dept" name="id_dept" required>
                                    <option value="">-- Pilih Departemen --</option>
                                    <?php
                                    // Ambil data departemen dari tb_dept untuk dropdown
                                    $query_dept = "SELECT Id_dept, nama_dept FROM tb_dept ORDER BY nama_dept ASC";
                                    $result_dept = mysqli_query($koneksi, $query_dept);

                                    if ($result_dept && mysqli_num_rows($result_dept) > 0) {
                                        while ($data_dept = mysqli_fetch_array($result_dept)) {
                                            $selected = ($id_dept_preselected == $data_dept['Id_dept']) ? 'selected' : '';
                                            echo '<option value="' . htmlspecialchars($data_dept['Id_dept']) . '" ' . $selected . '>' . htmlspecialchars($data_dept['nama_dept']) . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">Tidak ada departemen tersedia</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_sub_dept">Nama Sub Departemen</label>
                                <input type="text" class="form-control" id="nama_sub_dept" name="nama_sub_dept" placeholder="Masukkan Nama Sub Departemen" required>
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