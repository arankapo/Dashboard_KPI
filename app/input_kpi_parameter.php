<?php
// Pastikan koneksi.php sudah di-include di index.php

$is_edit = isset($_GET['id']);
$parameter_id = $is_edit ? (int)$_GET['id'] : null;
$id_kpi = isset($_GET['kpi_id']) ? (int)$_GET['kpi_id'] : null;

$parameter_nilai = '';
$score = '';
$kpi_info = ['indikator' => 'N/A', 'id_jabatan' => 0];

if (!$id_kpi) {
    $_SESSION['alert_message'] = '<div class="alert alert-danger">ID KPI harus disertakan.</div>';
    header('Location: index.php?page=data-kpi-master');
    exit;
}
$redirect_url = 'index.php?page=data-kpi-parameter&kpi_id=' . $id_kpi;


// 1. Ambil Info KPI untuk judul
$q_info = $koneksi->prepare("SELECT indikator, id_jabatan FROM kpi_master WHERE id_kpi_master = ?");
$q_info->bind_param("i", $id_kpi);
$q_info->execute();
$r_info = $q_info->get_result();
if ($r_info->num_rows > 0) {
    $kpi_info = $r_info->fetch_assoc();
}
$q_info->close();


// 2. Jika mode EDIT, ambil data lama
if ($is_edit) {
    $query_edit = $koneksi->prepare("SELECT parameter_nilai, score FROM kpi_parameter WHERE parameter_id = ? AND id_kpi_master = ?");
    $query_edit->bind_param("ii", $parameter_id, $id_kpi);
    $query_edit->execute();
    $result_edit = $query_edit->get_result();
    
    if ($result_edit->num_rows > 0) {
        $data_edit = $result_edit->fetch_assoc();
        $parameter_nilai = $data_edit['parameter_nilai'];
        $score = $data_edit['score'];
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Data parameter tidak ditemukan.</div>';
        header('Location: ' . $redirect_url);
        exit;
    }
    $query_edit->close();
}


// 3. Logika Simpan (Tambah/Edit)
if (isset($_POST['submit_parameter'])) {
    $parameter_nilai_post = trim($_POST['parameter_nilai']);
    $score_post = (int)$_POST['score'];
    $id_kpi_post = (int)$_POST['id_kpi']; // Pastikan id_kpi disembunyikan di form

    if (empty($parameter_nilai_post) || $score_post < 0 || $id_kpi_post <= 0) {
        $_SESSION['alert_message'] = '<div class="alert alert-warning">Semua field wajib diisi dengan benar.</div>';
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    if ($is_edit) {
        // UPDATE data
        $query = $koneksi->prepare("UPDATE kpi_parameter SET parameter_nilai = ?, score = ? WHERE parameter_id = ? AND id_kpi_master = ?");
        $query->bind_param("siii", $parameter_nilai_post, $score_post, $parameter_id, $id_kpi_post);
        $message = "diperbarui";
    } else {
        // INSERT data baru
        $query = $koneksi->prepare("INSERT INTO kpi_parameter (id_kpi_master, parameter_nilai, score) VALUES (?, ?, ?)");
        $query->bind_param("isi", $id_kpi_post, $parameter_nilai_post, $score_post);
        $message = "ditambahkan";
    }
    
    if ($query->execute()) {
        $_SESSION['alert_message'] = '<div class="alert alert-success">Data Parameter berhasil ' . $message . '!</div>';
        header('Location: ' . $redirect_url);
        exit;
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal ' . $message . ' data Parameter: ' . $query->error . '</div>';
        // Simpan input user saat gagal
        $parameter_nilai = $parameter_nilai_post;
        $score = $score_post;
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
                        <h3 class="card-title"><?php echo $is_edit ? 'Edit Parameter' : 'Tambah Parameter'; ?> Score</h3>
                        <div class="card-tools"><span class="badge badge-light">Indikator: <?php echo htmlspecialchars($kpi_info['indikator']); ?></span></div>
                    </div>
                    <form method="POST" action="">
                        <input type="hidden" name="id_kpi" value="<?php echo htmlspecialchars($id_kpi); ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="parameter_nilai">Deskripsi Parameter</label>
                                <textarea class="form-control" id="parameter_nilai" name="parameter_nilai" rows="3" required><?php echo htmlspecialchars($parameter_nilai); ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="score">Nilai Score</label>
                                <input type="number" class="form-control" id="score" name="score" 
                                       value="<?php echo htmlspecialchars($score); ?>" required min="0">
                                <small class="form-text text-muted">Contoh: 40, 30, 15, dst. Jumlah Score ini tidak perlu 100.</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="submit_parameter" class="btn btn-primary">Simpan</button>
                            <a href="<?php echo htmlspecialchars($redirect_url); ?>" class="btn btn-default">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>