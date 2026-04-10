<!-- Content Wrapper. Contains page content -->
<script src="assets/js/jquery.js"></script>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<form method="get" action="add/tambah_nilai_karyawan.php">
					<div class="card">
						<div class="card-header">
							<h5 class="text-center">PT. MEGA SURYA ERATAMA</h5>
						</div>
						<div class="alert alert-secondary">
							<strong>FORM PENILAIAN KINERJA KARYAWAN</strong>
						</div>

						<div class="row">
							<div class="col-sm-4">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-5	 col-form-label"> No Dokumen :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" placeholder="No Dokumen :"
											name="no_dok">
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-5	 col-form-label"> Revisi :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" placeholder="Revisi :" name="revisi">
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-4	 col-form-label"> Tanggal Efektif :</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" placeholder="Tanggal Efektif :"
											name="tanggal_efektif">
									</div>
								</div>
							</div>
						</div>

						<div class="row">

							<div class="col-sm-4">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-5	 col-form-label">Departement :</label>
									<div class="col-sm-7">
										<select class="form-control" name="nama_dept" id="id_departemen">
											<option>-Pilih Nama Dept-</option>
											
										</select>
										</select>
									</div>
								</div>
							</div>

						</div>

						<div class="col-sm-12 border-top border-bottom">
							<label></label>
						</div>

						<div class="row">
							<div class="col-sm-4">
								<div class="form-group row">
									<label for="inputEmail3" class="col-sm-5	 col-form-label">Kabupaten :</label>
									<div class="col-sm-7">
										<select class="form-control" name="id_kabupaten" id="id_kabupaten">

										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3"></div>

					</div>
					<button type="submit" class="btn btn-primary">Save</button>

			</div>
			</form>
		</div>



		<!-- /.card-header -->


	</div>
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
				var id_provinsi = $(this).val();
				$.ajax({
					//mengambil ambil_data.php
					url: 'ambil_data.php',
					//mengirim data menggunakan metode post
					type: "POST",
					//mengambil data 
					data: {
						modul: 'Kabupaten',
						id: id_provinsi
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
				var id_provinsi = $(this).val();
				$.ajax({
					url: 'ambil_data.php',
					type: "POST",
					data: {
						modul: 'nik',
						id: id_provinsi
					},
					success: function (respond) {
						$("#nik").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})


		});

	</script>


	</script>

	</html>

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
<script type="text/javascript">
	$("#nilaic1).keyup(function(){   
   var a = parseFloat($("#nilaic1").val());
	var b = parseFloat($("#nilaic2").val());
	var b = parseFloat($("#nilaic3").val());
	var b = parseFloat($("#nilaic4").val());
	var b = parseFloat($("#nilaic5").val());
	var c = a + b + c + d + e;
	$("#totalc").val(c);
 });