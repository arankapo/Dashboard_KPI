<!-- Content Wrapper. Contains page content -->
<?php
include('koneksi.php');
$dept = $_SESSION['dept'];
?>
<script src="assets/js/jquery.js"></script>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <form method="get" action="add/tambah_permintaan_training.php">
          <div class="card">
            <div class="card-header">
              <h3 class="text-center"><img src="image/mse.png">  PT. MEGA SURYA ERATAMA</h3>
            </div>
            <div class="alert alert-secondary text-center">
              <strong>PERMINTAAN PROGRAM</strong><br>
              <strong>TRAINING, COACHING, COUNSELING, MENTORING</strong>
            </div>
            <div class="col-sm-12 border-top border-bottom">
              <div class="row">
                <div class="col-sm-12 border-top ">
                  <label>1. Informasi dokumen</label>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> No Dokumen :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="no_dok" readonly id="no_dok">
                        <option>FR/HRDGA/001</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"> Revisi :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="revisi" readonly value="0">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Tanggal Dok:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="tanggal_efektif" readonly value="10 Maret 2025">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Departement :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="nama_dept" id="id_departemen">
                        <option>-Pilih Nama Dept-</option>
                        <?php
                        $sql = mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='".$dept."'");
                        while ($data = mysqli_fetch_array($sql)) {
                        ?>
                        <option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label"> Jabatan :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="unit_kerja" id="id_unit_kerja">
                        <option>Kabag</option>
                        <option>Manajer</option>
                        <option>Kasi</option>
                        <option>Staff</option>
                        <option>Operator</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Tanggal Pengajuan :</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" name="tanggal_pengajuan" readonly value="<?php echo date('Y-m-d'); ?>">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 border-top ">
                  <label>2. Informasi Permintaan</label>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Program :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="program" id="program">
                        <option>Training</option>
                        <option>Coaching</option>
                        <option>Counseling</option>
                        <option>Mentoring</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Tanggal Pelaksaan :</label>
                    <div class="col-sm-7">
                      <input type="month" class="form-control" name="tanggal_pemenuhan" value="<?php echo date('Y-m'); ?>">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Jmlh Peserta:</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="jumlah_peserta" id="jumlah_peserta">
                        <option> < 5 </option>
                        <option> 5 - 10 </option>
                        <option> 10 - 15 </option>
                        <option> > 15  </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Trainer/Provider Training : </label>
                    <div class="col-sm-7">
                      <select class="form-control" name="trainer_provider" id="trainer_provider">
                        <option>Internal</option>
                        <option>Eksternal</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Topik/Tema TCCM : </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" name="topik_tema" placeholder="Topik/Tema Training">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Bagian / Area Kerja :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="area_kerja" id="area_kerja" required>
                        <option value="">Pilih Departemen</option>
                        <?php
                        $departemen_query = $koneksi->query("SELECT Id_dept, nama_dept FROM tb_dept ORDER BY nama_dept ASC");
                        while ($row = $departemen_query->fetch_assoc()) {
                          echo "<option value='{$row['Id_dept']}'>{$row['nama_dept']}</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 border-top ">
                  <label>3. Prasarana Yang dibutuhkan</label>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Tempat</label>
                    <div class="col-sm-7">
                      	<label><input type="checkbox" name="tempat[]" value="R. Meeting"> R. Meeting</label><br>
                      	<label><input type="checkbox" name="tempat[]" value="Hotel"> Hotel</label><br>
                      	<label><input type="checkbox" name="tempat[]" value="Lembaga Training"> Lembaga Training</label><br>
                      	<label><input type="checkbox" name="tempat[]" value="Area Kerja"> Area Kerja</label><br>
            			<label><input type="checkbox" name="tempat[]" value="Lain Lain" id="tempat-lainnya-checkbox"> Lain Lain</label><br>
            			<input type="text" name="tempat_lainnya_text" id="tempat-lainnya-text" class="form-control" style="display:none;" placeholder="Masukkan tempat lainnya">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Peralatan</label>
                    <div class="col-sm-7">
                      <label><input type="checkbox" name="peralatan[]" value="Komputer"> Komputer</label><br>
                      <label><input type="checkbox" name="peralatan[]" value="LCD"> LCD</label><br>
                      <label><input type="checkbox" name="peralatan[]" value="Speaker"> Speaker</label><br>
                      <label><input type="checkbox" name="peralatan[]" value="Materi"> Materi</label><br>
                      <label><input type="checkbox" name="peralatan[]" value="Alat Tulis"> Alat Tulis</label><br>
                      <label><input type="checkbox" name="peralatan[]" value="Evaluasi"> Evaluasi</label><br>
                      <label><input type="checkbox" name="peralatan[]" value="Snack"> Snack</label><br>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 border-top ">
                  <label>4. Catatan Capaian</label>
                </div>
                <div class="col-sm-8">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Jenis Evaluasi dan Tindak Lanjut yang diharapkan</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="tipe_evaluasi" id="tipe_evaluasi">
                        <option> respon </option>
                        <option> Pre-post Test </option>
                        <option> Penilaian Implementasi </option>
                        <option> Pembuatan Proyek Kerja </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label"> Alasan Diadakan</label>
                    <div class="col-sm-7">
                      <label><input type="checkbox" name="alasan[]" value="Refreshment"> Refreshment</label><br>
                      <label><input type="checkbox" name="alasan[]" value="Pengembangan"> Pengembangan</label><br>
                      <label><input type="checkbox" name="alasan[]" value="Perbaikan"> Perbaikan</label><br>
                      <label><input type="checkbox" name="alasan[]" value="Prosedur/Metode Kerja Baru"> Prosedur/Metode Kerja Baru</label><br>
                      <label><input type="checkbox" name="alasan[]" value="Lain Lain" id="alasan-lainnya-checkbox"> Lainnya</label>
                      <input type="text" name="alasan_lainnya_text" id="alasan-lainnya-text" class="form-control" style="display:none;" placeholder="Masukkan alasan lainnya">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group row">
                    <label class="col-sm-5 col-form-label">Goal yang Diharapkan</label>
                    <div class="col-sm-7">
                      <label><input type="checkbox" name="goal[]" value="Motivasi"> Motivasi</label><br>
                      <label><input type="checkbox" name="goal[]" value="Skill"> Skill</label><br>
                      <label><input type="checkbox" name="goal[]" value="Zero Defect"> Zero Defect</label><br>
                      <label><input type="checkbox" name="goal[]" value="Pengayaan Metode"> Pengayaan Metode</label><br>
                      <label><input type="checkbox" name="goal[]" value="Lainnya" id="goal-lainnya-checkbox"> Lainnya</label>
                      <input type="text" name="goal_lainnya_text" id="goal-lainnya-text" class="form-control" style="display:none;" placeholder="Masukkan goal lainnya">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 border-top border-bottom">
                <label>Uraian Permintaan Training :</label>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <textarea class="form-control" name="catatan"></textarea>
                </div>
              </div>
              <div class="col-sm-12 border-top border-bottom">
                <label></label>
              </div>
              <div class="col-sm-12 border-top border-bottom">
                <label>NOTE :<br>* Pastikan data yang dimasukan Benar dan Sesuai </label>
                <br>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
	// Checkbox alasan lainnya
	const tempatCheckbox = document.getElementById('tempat-lainnya-checkbox');
	const tempatText = document.getElementById('tempat-lainnya-text');
	const alasanCheckbox = document.getElementById('alasan-lainnya-checkbox');
	const alasanText = document.getElementById('alasan-lainnya-text');
	const goalCheckbox = document.getElementById('goal-lainnya-checkbox');
	const goalText = document.getElementById('goal-lainnya-text');
						
	tempatCheckbox.addEventListener('change', function() {
	  tempatText.style.display = this.checked ? 'block' : 'none';
	  if (!this.checked) tempatText.value = '';
	});
	alasanCheckbox.addEventListener('change', function() {
	  alasanText.style.display = this.checked ? 'block' : 'none';
	  if (!this.checked) alasanText.value = '';
	});
	goalCheckbox.addEventListener('change', function() {
	  goalText.style.display = this.checked ? 'block' : 'none';
	  if (!this.checked) goalText.value = '';
	});
</script>
