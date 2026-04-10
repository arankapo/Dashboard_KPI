<?php
include('koneksi.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    echo '<div class="alert alert-danger">ID tidak valid.</div>';
    exit;
}
// Ambil data header
$q_header = mysqli_query($koneksi, "SELECT * FROM evaluasi_training_header WHERE id = $id");
$header = mysqli_fetch_assoc($q_header);
if (!$header) {
    echo '<div class="alert alert-danger">Data tidak ditemukan.</div>';
    exit;
}
// Ambil data detail
$q_detail = mysqli_query($koneksi, "SELECT * FROM evaluasi_training_detail WHERE id_header = $id ORDER BY no_pertanyaan");
$detail = [];
while ($d = mysqli_fetch_assoc($q_detail)) {
    $detail[$d['no_pertanyaan']] = $d;
}
// Ambil pertanyaan
$q_pertanyaan = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE tipe = 'evtra' ORDER BY No");

// Reset pointer pertanyaan
mysqli_data_seek($q_pertanyaan, 0);
$dept = $header['divisi'];
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <form method="POST" action="edit/edit_data_evaluasi_training.php">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <div class="card">
            <div class="card-header">
              <h3 class="text-center">Edit Evaluasi Training</h3>
            </div>
            <div class="alert alert-secondary text-center">
              <strong>EVALUASI EFEKTIFITAS TRAINING</strong>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="col-sm-12">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Judul Training :</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" value="<?php echo htmlspecialchars($header['judul_training']); ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Tanggal :</label>
                    <div class="col-sm-6">
                      <input type="date" class="form-control" value="<?php echo htmlspecialchars($header['tanggal_training']); ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Nama Penyelenggara :</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="penyelenggara" value="<?php echo htmlspecialchars($header['penyelenggara']); ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Nama Peserta :</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_peserta" value="<?php echo htmlspecialchars($header['nama_peserta']); ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Nama Trainer :</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($header['nama_trainer']); ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-5 col-form-label">Divisi :</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($header['divisi']); ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12">
                  <h5>A. Evaluasi Materi</h5>
                  <div class="row mb-2">
                    <div class="col-sm-12">
                      <div class="d-flex justify-content-between" style="max-width:500px;">
                        <div><strong>5 = Sangat Jelas</strong></div>
                        <div><strong>4 = Baik</strong></div>
                        <div><strong>3 = Cukup</strong></div>
                        <div><strong>2 = Kurang</strong></div>
                        <div><strong>1 = Tidak Jelas</strong></div>
                      </div>
                    </div>
                  </div>
                  <?php
                  mysqli_data_seek($q_pertanyaan, 0);
                  while ($p = mysqli_fetch_assoc($q_pertanyaan)) {
                    if ($p['No'] == 4) {
                      echo '<h5>B. Evaluasi Pengembangan Diri</h5>';
                      echo '<div class="row mb-2">'
                        .'<div class="col-sm-12">'
                        .'<div class="d-flex justify-content-between" style="max-width:500px;">'
                        .'<div><strong>5 = Sangat Ingin</strong></div>'
                        .'<div><strong>4 = Ingin</strong></div>'
                        .'<div><strong>3 = Cukup</strong></div>'
                        .'<div><strong>2 = Kurang</strong></div>'
                        .'<div><strong>1 = Tidak Ingin</strong></div>'
                        .'</div>'
                        .'</div>'
                        .'</div>';
                    }
                    $nilai = isset($detail[$p['No']]['nilai']) ? $detail[$p['No']]['nilai'] : 0;
                    echo '<div class="form-group row">'
                      .'<label for="pernyataanke-'.$p['No'].'" class="col-sm-9 col-form-label">'
                      .$p['No'].'. '.$p['Deskripsi'].'
                      </label>'
                      .'<div class="col-sm-2">'
                      .'<select class="form-control" name="pernyataanke-'.$p['No'].'" disabled>';
                    for ($i = 0; $i <= 5; $i++) {
                      $selected = ($nilai == $i) ? 'selected' : '';
                      echo "<option value='$i' $selected>$i</option>";
                    }
                    echo '</select>'
                      .'</div>'
                      .'</div>';
                  }
                  ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12">
                  <h5>C. Jelaskan beberapa poin pengembangan diri yang bisa diterapkan dalam pekerjaan sehari-hari!</h5>
                  <textarea class="form-control" name="point_pengembangan" rows="3" readonly><?php echo htmlspecialchars($header['point_pengembangan']); ?></textarea>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12">
                  <h5>D. Diisi oleh Kepala Bagian</h5>
                  <div class="form-group">
                    <div class="form-group row align-items-center">
                      <label class="col-sm-9 col-form-label">Seberapa baik pencapaian tujuan training setelah peserta mengikuti training?</label>
                      <div class="col-sm-2">
                        <select class="form-control" name="pencapaian"> <?php // Changed name from d_pencapaian to pencapaian to match DB column ?>
                          <?php
                          // Get the stored value from the database
                          $db_pencapaian = isset($header['pencapaian']) ? $header['pencapaian'] : ''; // Changed to 'pencapaian'
                          $opsi_d = ['Tidak Baik','Kurang Baik','Baik','Sangat Baik'];
                          foreach ($opsi_d as $val) {
                            $selected = ($db_pencapaian == $val) ? 'selected' : '';
                            echo "<option value='$val' $selected>$val</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Alasan :</label>
                    <textarea class="form-control" name="alasan" rows="2"><?php echo isset($header['alasan']) ? htmlspecialchars($header['alasan']) : ''; ?></textarea> <?php // Changed name from d_alasan to alasan ?>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <div class="col-sm-12">
                  <h5>E. Kesimpulan hasil training (max H+3 bulan) diisi oleh HRD</h5>
                  <div class="form-group">
                    <label>1. Peningkatan pengetahuan</label>
                    <input type="text" class="form-control mb-2" name="pengetahuan" value="<?php echo isset($header['pengetahuan']) ? htmlspecialchars($header['pengetahuan']) : ''; ?>"> <?php // Added value attribute ?>
                  </div>
                  <div class="form-group">
                    <label>2. Penerapan tujuan training</label>
                   <input type="text" class="form-control mb-2" name="penerapan" value="<?php echo isset($header['penerapan']) ? htmlspecialchars($header['penerapan']) : ''; ?>"> <?php // Added value attribute ?>
                  </div>
                  <div class="form-group">
                    <label>3. Penilaian Kepala Bagian peserta training</label>
                    <input type="text" class="form-control mb-2" name="penilaian" value="<?php echo isset($header['penilaian']) ? htmlspecialchars($header['penilaian']) : ''; ?>"> <?php // Added value attribute ?>
                  </div>
                  <div class="form-group">
                    <label>4. Efektifitas Training</label>
                    <select class="form-control" name="efektivitas">
                        <?php
                        // Get the stored value from the database
                        $db_efektivitas = isset($header['efektivitas']) ? $header['efektivitas'] : ''; // Changed to 'efektivitas'
                        $opsi_ef = ['Efektif', 'Kurang Efektif', 'Tidak Efektif'];
                        foreach ($opsi_ef as $val) {
                          $selected = ($db_efektivitas == $val) ? 'selected' : '';
                          echo "<option value='$val' $selected>$val</option>";
                        }
                        ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
            <br>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>