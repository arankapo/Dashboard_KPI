<!-- Content Wrapper. Contains page content -->

<?php
include('koneksi.php');
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$dept = isset($_SESSION['dept']) ? $_SESSION['dept'] : '';

// Ambil no_permintaan dari GET
$no_permintaan = isset($_GET['no_permintaan']) ? $_GET['no_permintaan'] : '';
$judul_training = '';
$tanggal_training = '';
$nama_trainer = '';
if ($no_permintaan != '') {
	$q = mysqli_query(
		$koneksi,
		"SELECT * FROM tb_permintaan_training WHERE no_permintaan='" . mysqli_real_escape_string($koneksi, $no_permintaan) . "'"
	);
	if ($row = mysqli_fetch_assoc($q)) {
		$judul_training = $row['topik'];
		$tanggal_training = $row['tgl_training'];
		$nama_trainer = $row['trainer'];
	}
}
?>
<script src="assets/js/jquery.js"></script>

	<!-- Main content -->             
	<section class="content">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-12">
			<form method="get" action="add/tambah_evaluasi_training.php">
				<input type="hidden" name="no_permintaan" value="<?php echo htmlspecialchars($no_permintaan); ?>">
				<div class="card">
					<div class="card-header">
						<h3 class="text-center">
							<img src="image/mse.png"> PT. MEGA SURYA ERATAMA
						</h3>
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
										<input type="text" class="form-control" name="judul_training" value="<?php echo htmlspecialchars($judul_training); ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-5 col-form-label">Tanggal :</label>
									<div class="col-sm-6">
										<input type="date" class="form-control" name="tanggal_training" value="<?php echo htmlspecialchars($tanggal_training); ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-5 col-form-label">Nama Penyelenggara :</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="penyelenggara">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Nama Peserta :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="nama_peserta">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Nama Trainer :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="nama_trainer" value="<?php echo htmlspecialchars($nama_trainer); ?>" readonly>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-5 col-form-label">Divisi :</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="divisi" value="<?php echo htmlspecialchars($dept); ?>" readonly>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<h5>A. Evaluasi Materi</h5>
								<?php
								// Query untuk menampilkan pernyataan 
								$sql = mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE tipe = 'evtra'");
								while ($data = mysqli_fetch_array($sql)) {
									if ($data['No'] == 4) {
										echo '<h5>B. Evaluasi Pengembangan Diri</h5>';
									}
									echo '<div class="form-group row">'
										.'<label for="pernyataanke-'.$data['No'].'" class="col-sm-6 col-form-label">'
										.$data['No'].'. '.$data['Deskripsi'].'
										</label>'
										.'<div class="col-sm-2">'
										.'<select class="form-control" name="pernyataanke-'.$data['No'].'">';
									for ($i = 0; $i <= 5; $i++) {
										echo "<option>" . $i . "</option>";
									}
									echo '</select>'
										.'</div>';
									// Menampilkan keterangan jawaban di sebelah kanan dari setiap pernyataan 
									switch ($data['No']) {
									    case 1:
									        echo '<div class="col-sm-4">5 = Sangat Jelas/ Sangat Ingin</div>';
									        break;
									    case 2:
									        echo '<div class="col-sm-4">4 = Baik/Ingin</div>';
									        break;
									    case 3:
									        echo '<div class="col-sm-4">3 = Cukup</div>';
									        break;
									    case 4:
									        echo '<div class="col-sm-4">2 = Kurang</div>';
									        break;
									    case 5:
									        echo '<div class="col-sm-4">1 = Tidak Jelas/ Tidak Ingin</div>';
									        break;
									}
									echo '</div>';
								}
								?>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<h5>C. Jelaskan beberapa poin pengembangan diri yang bisa diterapkan dalam pekerjaan sehari-hari!</h5>
								<textarea class="form-control" name="point_pengembangan" rows="3"></textarea>
							</div>
						</div>
					</div>
					<br>
					<button type="submit" class="btn btn-primary">Save</button>
					<br>
				</div>
			</form>
<!-- /.card -->
			
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
		crossorigin="anonymous"></script>

	<script>
		$(document).ready(function () {
			//fungsi untuk mengaktifkan jquery
			//untuk memeriksa untuk field dengan id id_departemen mengalami perubahan maka akan menjalankan fungsi berikut
			$('#id_departemen').on('change', function () {
				var id_dept = $(this).val();
				$.ajax({
					//mengambil ambil_data.php
					url: 'ambil_data.php',
					//mengirim data menggunakan metode post
					type: "POST",
					//mengambil data 
					data: {
						modul: 'Kabupaten',
						id: id_dept
					},
					success: function (respond) {
						$("#id_kabupaten").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})

			$('#id_kabupaten').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data.php',
					type: "POST",
					data: {
						modul: 'nik',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_nik").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#id_kabupaten').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data.php',
					type: "POST",
					data: {
						modul: 'jabatan',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_jabatan").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#id_kabupaten').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data.php',
					type: "POST",
					data: {
						modul: 'sub_dept',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_sub_dept").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})



		});

	</script>



	  
	</thead>
					
			  <!-- /.card-body -->
			</div>
			<!-- /.card -->
		  </div>
		  <!-- /.col -->
		</div>
		<!-- /.row -->
	  </div>
	  <!-- /.container-fluid -->
	</section>
	<!-- /.content -->
