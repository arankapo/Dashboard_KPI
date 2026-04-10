<?php
// Pastikan koneksi.php sudah di-include di index.php

$is_edit = isset($_GET['id']);
$id_kpi = $is_edit ? (int)$_GET['id'] : null;
$id_jabatan = isset($_GET['jabatan_id']) ? (int)$_GET['jabatan_id'] : ($is_edit ? null : null);

$no_urut = '';
$indikator = '';
$kpi_desc = '';
$bobot = '';
$nama_jabatan = 'N/A';
$redirect_url = 'index.php?page=data-kpi-master';

// 1. Ambil data Jabatan
if ($id_jabatan) {
    $q_jabatan = $koneksi->prepare("SELECT nama_jabatan FROM jabatan WHERE id_jabatan = ?");
    $q_jabatan->bind_param("i", $id_jabatan);
    $q_jabatan->execute();
    $r_jabatan = $q_jabatan->get_result();
    if ($r_jabatan->num_rows > 0) {
        $nama_jabatan = $r_jabatan->fetch_assoc()['nama_jabatan'];
    }
    $q_jabatan->close();
    $redirect_url .= '&jabatan_id=' . $id_jabatan;
}

// 2. Jika mode EDIT, ambil data KPI lama
if ($is_edit) {
    $query_edit = $koneksi->prepare("SELECT id_jabatan, no_urut, indikator, kpi, bobot FROM kpi_master WHERE id_kpi_master = ?");
    $query_edit->bind_param("i", $id_kpi);
    $query_edit->execute();
    $result_edit = $query_edit->get_result();
    
    if ($result_edit->num_rows > 0) {
        $data_edit = $result_edit->fetch_assoc();
        $id_jabatan = $data_edit['id_jabatan']; // Ambil ID Jabatan dari data KPI
        $no_urut = $data_edit['no_urut'];
        $indikator = $data_edit['indikator'];
        $kpi_desc = $data_edit['kpi'];
        $bobot = $data_edit['bobot'];

        // Ambil ulang nama jabatan jika belum terambil di langkah 1 (hanya dari link edit)
        if ($nama_jabatan === 'N/A') {
            $q_jabatan_edit = $koneksi->prepare("SELECT nama_jabatan FROM jabatan WHERE id_jabatan = ?");
            $q_jabatan_edit->bind_param("i", $id_jabatan);
            $q_jabatan_edit->execute();
            if ($r_jabatan_edit = $q_jabatan_edit->get_result()->fetch_assoc()) {
                 $nama_jabatan = $r_jabatan_edit['nama_jabatan'];
            }
            $q_jabatan_edit->close();
        }
        $redirect_url = 'index.php?page=data-kpi-master&jabatan_id=' . $id_jabatan;
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Data KPI tidak ditemukan.</div>';
        header('Location: index.php?page=data-kpi-master');
        exit;
    }
    $query_edit->close();
}



// 3. Logika Simpan (Tambah/Edit)
if (isset($_POST['submit_kpi'])) {
    $id_jabatan_post = (int)$_POST['id_jabatan'];
    $no_urut_post = (int)$_POST['no_urut'];
    $indikator_post = trim($_POST['indikator']);
    $kpi_desc_post = trim($_POST['kpi_desc']);
    $bobot_post = (int)$_POST['bobot'];

    if (empty($indikator_post) || empty($kpi_desc_post) || $bobot_post <= 0 || $id_jabatan_post <= 0) {
        $_SESSION['alert_message'] = '<div class="alert alert-warning">Semua field wajib diisi dengan benar.</div>';
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
    
    $redirect_url_post = 'index.php?page=data-kpi-master&jabatan_id=' . $id_jabatan_post;

    if ($is_edit) {
        // UPDATE data
        $query = $koneksi->prepare("UPDATE kpi_master SET no_urut=?, indikator=?, kpi=?, bobot=? WHERE id_kpi_master = ?");
        $query->bind_param("issii", $no_urut_post, $indikator_post, $kpi_desc_post, $bobot_post, $id_kpi);
        $message = "diperbarui";
    } else {
        // INSERT data baru
        $query = $koneksi->prepare("INSERT INTO kpi_master (id_jabatan, no_urut, indikator, kpi, bobot) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("iissi", $id_jabatan_post, $no_urut_post, $indikator_post, $kpi_desc_post, $bobot_post);
        $message = "ditambahkan";
    }
    
    if ($query->execute()) {
        $_SESSION['alert_message'] = '<div class="alert alert-success">Data KPI berhasil ' . $message . '!</div>';
        header('Location: ' . $redirect_url_post);
        exit;
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal ' . $message . ' data KPI: ' . $query->error . '</div>';
        // Simpan input user saat gagal
        $no_urut = $no_urut_post;
        $indikator = $indikator_post;
        $kpi_desc = $kpi_desc_post;
        $bobot = $bobot_post;
        // Kembali ke halaman input dengan data yang dipertahankan (jika perlu)
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
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $is_edit ? 'Edit Data KPI' : 'Tambah Data KPI'; ?></h3>
                        <div class="card-tools"><span class="badge badge-light">Jabatan: <?php echo htmlspecialchars($nama_jabatan); ?></span></div>
                    </div>
                    
                    <form method="POST" action="">
                        <input type="hidden" name="id_jabatan" value="<?php echo htmlspecialchars($id_jabatan); ?>">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="no_urut" class="col-sm-3 col-form-label">No. Urut</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="no_urut" name="no_urut" 
                                           value="<?php echo htmlspecialchars($no_urut); ?>" required min="1">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="indikator" class="col-sm-3 col-form-label">Indikator</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="indikator" name="indikator" rows="3" required><?php echo htmlspecialchars($indikator); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kpi_desc" class="col-sm-3 col-form-label">KPI (Key Performance Indicator)</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="kpi_desc" name="kpi_desc" rows="3" required><?php echo htmlspecialchars($kpi_desc); ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="bobot" class="col-sm-3 col-form-label">Bobot (%)</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="bobot" name="bobot" 
                                           value="<?php echo htmlspecialchars($bobot); ?>" required min="1" max="100">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="submit_kpi" class="btn btn-primary">Simpan KPI</button>
                            <a href="<?php echo htmlspecialchars($redirect_url); ?>" class="btn btn-default">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>