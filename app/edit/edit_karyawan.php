<?php
// edit_karyawan.php
include('koneksi.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah parameter 'nik' ada di URL
if (!isset($_GET['nik']) || empty($_GET['nik'])) {
    header('Location: data_karyawan.php');
    exit;
}

$nik_to_edit = mysqli_real_escape_string($koneksi, $_GET['nik']);

// Ambil data karyawan yang akan diedit
$query_data = "SELECT * FROM tb_karyawan WHERE nik_karyawan = '$nik_to_edit'";
$result_data = mysqli_query($koneksi, $query_data);
$data_karyawan = mysqli_fetch_array($result_data);

if (!$data_karyawan) {
    echo '<div class="alert alert-danger">Data karyawan tidak ditemukan.</div>';
    exit;
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik_karyawan = mysqli_real_escape_string($koneksi, $_POST['nik_karyawan']);
    $nama_karyawan = mysqli_real_escape_string($koneksi, $_POST['nama_karyawan']);
    $jabatan_karyawan = mysqli_real_escape_string($koneksi, $_POST['jabatan_karyawan']);
    $sub_dept = mysqli_real_escape_string($koneksi, $_POST['sub_dept']);
    $nama_dept_id = mysqli_real_escape_string($koneksi, $_POST['nama_dept']); // Ini adalah Id_dept
    $unit_kerja = mysqli_real_escape_string($koneksi, $_POST['unit_kerja']);
    $atasan_karyawan = mysqli_real_escape_string($koneksi, $_POST['atasan_karyawan']);

    // Dapatkan nama departemen dari Id_dept yang dipilih
    $query_dept_name = mysqli_query($koneksi, "SELECT nama_dept FROM tb_dept WHERE Id_dept = '$nama_dept_id'");
    $nama_dept = mysqli_fetch_array($query_dept_name)['nama_dept'];

    // Query untuk update data
    $query_update = "UPDATE tb_karyawan SET
                        nama_karyawan='$nama_karyawan',
                        jabatan_karyawan='$jabatan_karyawan',
                        sub_dept='$sub_dept',
                        nama_dept='$nama_dept',
                        unit_kerja='$unit_kerja',
                        atasan_karyawan='$atasan_karyawan'
                    WHERE nik_karyawan='$nik_karyawan'";

    if (mysqli_query($koneksi, $query_update)) {
        $_SESSION['alert_message'] = '<div class="alert alert-success">Data karyawan berhasil diperbarui!</div>';
        header('Location: index.php?page=data-karyawan');
        exit;
    } else {
        echo '<div class="alert alert-danger">Gagal memperbarui data: ' . mysqli_error($koneksi) . '</div>';
    }
}

// Ambil Id_dept dari nama_dept karyawan saat ini
$q_id_dept = mysqli_query($koneksi, "SELECT Id_dept FROM tb_dept WHERE nama_dept = '" . mysqli_real_escape_string($koneksi, $data_karyawan['nama_dept']) . "'");
$id_dept_karyawan = mysqli_fetch_array($q_id_dept)['Id_dept'];

?>

<script src="assets/js/jquery.js"></script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="post" action="index.php?page=edit-karyawan&nik=<?php echo htmlspecialchars($data_karyawan['nik_karyawan']); ?>">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Edit Data Karyawan</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">NIK Karyawan :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="nik_karyawan" value="<?php echo htmlspecialchars($data_karyawan['nik_karyawan']); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Nama Karyawan :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="nama_karyawan" value="<?php echo htmlspecialchars($data_karyawan['nama_karyawan']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Jabatan Karyawan :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="jabatan_karyawan" value="<?php echo htmlspecialchars($data_karyawan['jabatan_karyawan']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Nama Department :</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="nama_dept" id="nama_dept">
                                        <option value="">-- Pilih Departemen --</option>
                                        <?php
                                        // Ambil data departemen dari tabel tb_dept
                                        $q_dept = mysqli_query($koneksi, "SELECT * FROM tb_dept ORDER BY nama_dept ASC");
                                        while ($data_dept = mysqli_fetch_array($q_dept)) {
                                            $selected = ($data_dept['Id_dept'] == $id_dept_karyawan) ? 'selected' : '';
                                            echo '<option value="' . htmlspecialchars($data_dept['Id_dept']) . '" ' . $selected . '>' . htmlspecialchars($data_dept['nama_dept']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Sub Department :</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="sub_dept" id="sub_dept">
                                        <option value="">-- Pilih Sub Departemen --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Unit Kerja :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="unit_kerja" value="<?php echo htmlspecialchars($data_karyawan['unit_kerja']); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Atasan Karyawan :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="atasan_karyawan" value="<?php echo htmlspecialchars($data_karyawan['atasan_karyawan']); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="index.php?page=data-karyawan" class="btn btn-secondary">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Ketika dropdown departemen (id='nama_dept') berubah
        $('#nama_dept').on('change', function() {
            var id_dept = $(this).val();
            if (id_dept) {
                $.ajax({
                    type: 'POST',
                    url: 'ambil_data.php',
                    data: {
                        modul: 'sub_dept2',
                        id: id_dept
                    },
                    success: function(html) {
                        $('#sub_dept').html(html);
                        // Pilih sub departemen yang sudah ada di database setelah dropdown terisi
                        var current_sub_dept = "<?php echo htmlspecialchars($data_karyawan['sub_dept']); ?>";
                        if(current_sub_dept) {
                            $('#sub_dept').val(current_sub_dept);
                        }
                    }
                });
            } else {
                $('#sub_dept').html('<option value="">-- Pilih Sub Departemen --</option>');
            }
        });

        // Trigger change event on page load if a department is already selected
        var selected_dept = $('#nama_dept').val();
        if(selected_dept) {
            $('#nama_dept').trigger('change');
        }
    });
</script>