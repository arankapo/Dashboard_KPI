  <!-- Content Wrapper. Contains page content -->

<?php
include('koneksi.php');
$dept = $_SESSION['dept']
?>
<script src="assets/js/jquery.js"></script>
<script type="text/javascript" src="js/civem.js"></script>

    <!-- Main content -->             
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
			<form method="get" action="add/tambah_permintaan_karyawan.php">
              <div class="card">
              <div class="card-header">
                <h3 class="text-center"><img src="image/mse.png">  PT. MEGA SURYA ERATAMA</h3> 
              </div>
			<div class="alert alert-secondary text-center"" >
                <strong>PERMINTAAN KARYAWAN</strong>
				</div>
				
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5 col-form-label"> No Formulir :</label>
                    <div class="col-sm-7">
					  	<select class="form-control" name="no_dok" Readonly id="no_dok">
							<option>FR/HRDGA/003</option>
						</select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Revisi :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="- " name="revisi" Readonly value="0">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4	 col-form-label"> Tanggal :</label>
                    <div class="col-sm-7">
                     <input type="text" class="form-control" placeholder="Tanggal Efektif " name="tanggal_efektif" Readonly value="01 Desember 2022">
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
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Tanggal Pengajuan :</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" placeholder="Tanggal Pengajuan" name="tanggal_pengajuan" Readonly value="<?php echo date('Y-m-d'); ?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Tanggal Pemenuhan :</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" placeholder="Tanggal Pemenuhan " name="tanggal_pemenuhan" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4	 col-form-label"> Jumlah :</label>
                    <div class="col-sm-7">
                     <input type="text" name="jumlah" id="jumlah" class="form-control" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Klasifikasi</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="klasifikasi" id="klasifikasi" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
					  <option></option>
					  <option>Penambahan</option>
					  <option>Penggantian</option>
					  <option>Bagian Baru</option>
					  <option>Posisi Kosong</option>
					  </select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Penempatan :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="penempatan" id="penempatan" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
					  <option></option>
					  <option>PM1</option>
					  <option>PM2</option>
					  <option>Other</option>
					  </select>
                    </div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4	 col-form-label"> Jam Kerja :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="jam_kerja" id="jam_kerja" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
					  <option></option>
					  <option>Shift</option>
					  <option>Non Shift</option>
					  </select>
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement : </label>
                    <div class="col-sm-7">
						<select class="form-control" name="nama_dept" id="id_departemen" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
											<option></option>
										
											<?php
											if ($dept == 'HRGA') {
												$sql=mysqli_query($koneksi, "SELECT DISTINCT * FROM tb_dept where nama_dept='hrga'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
												
											}
											
											else if ($dept == 'HRD') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='hrga'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'HRGA_OS') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='hrga'" );
												while ($data=mysqli_fetch_array($sql)) {
												?>
												<option>HR</option>
												 <option>SECURITY</option>
												 <option>GA</option>
												 <option>IT</option>
											<?php
												}
											}
											
											
											else if ($dept == 'PURC') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='purc'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else{
												$query = "SELECT * FROM tb_dept where id_dept = '".$dept."' or nama_dept = '".$dept."' ORDER BY nama_dept ASC";
												$sql=mysqli_query($koneksi, $query );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											?>
											
						</select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Bagian :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="jabatan" id="jabatan" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
					  <option></option>
					  <option>Kabag</option>
					  <option>Kasie</option>
					  <option>Staff</option>
					  <option>Operator</option>
					  </select>
                    </div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4	 col-form-label"> Status :</label>
                    <div class="col-sm-7">
                     <select class="form-control" name="status_karyawan" id="status_karyawan" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
						<option></option>
						<option>PT</option>
						<option>OS</option>
						<option>HL</option>
						<option>SECURITY</option>
					</select>
                    </div>
                  </div>
				</div>
			</div>
							
			<div class="col-sm-12 border-top border-bottom">
                <label>Kualifikasi karyawan</label>
            </div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                     <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jenis Kelamin :</label>
                    <div class="col-sm-7">
                     	<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
							<option></option>
							<option>Laki-Laki</option>
							<option>Perempuan</option>
							<option>Laki-Laki/perempuan</option>
					  	</select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Pendidikan Minimum</label>
                    <div class="col-sm-7">
                     	<select class="form-control" name="pendidikan_minimum" id="pendidikan_minimum" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
							<option></option>
							<option>SMA/SMK/Sederajat</option>
							<option>Dlll/DlV</option>
							<option>S1</option>
							<option>S2</option>
					  	</select>
                    </div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4	 col-form-label"> Pengalaman Kerja :</label>
                    <div class="col-sm-7">
                     	<select class="form-control" name="pengalaman" id="pengalaman" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
							<option></option>
							<option>1 Tahun</option>
							<option>1 - 3 Tahun</option>
							<option>>3 Tahun</option>
					  	</select>
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                      <label for="inputEmail3" class="col-sm-5	 col-form-label"> Usia </label>
                    <div class="col-sm-7">
							<select class="form-control" name="usia" id="usia" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
								<option></option>
								<option>17 - 25</option>
								<option>25 - 40</option>
								<option>>40</option>
											
							</select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jurusan Pendidikan :</label>
                    <div class="col-sm-7">
                      	<select class="form-control" name="jurusan" id="jurusan" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!">
							<option></option>
							<option>IPA</option>
							<option>IPS</option>
							<option>TEKNIK ELEKTRO</option>
							<option>TEKNIK FISIKA</option>
							<option>TEKNIK LISTRIK</option>
							<option>TEKNIK INSTRUMEN</option>
							<option>TEKNIK INFORMATIKA</option>
							<option>TEKNIK INDUSTRI</option>
							<option>TEKNIK LINGKUNGAN</option>
							<option>TEKNIK SIPIL</option>
							<option>TEKNIK MESIN</option>
							<option>TEKNIK OTOMOTIF</option>
							<option>TEKNIK KENDARAAN RINGAN</option>
							<option>TEKNIK KOMPUTER</option>
							<option>TEKNIK KIMIA</option>
							<option>MANAJEMEN EKONOMI</option>
							<option>HUKUM</option>
							<option>PSIKOLOGI</option>
							<option>PEMASARAN</option>
							<option>PUBLIC RELATION</option>
							<option>LAIN LAIN JURUSAN YANG RELEVAN</option>
						</select>
                    </div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label"> Kualifikasi tambahan</label>
                    <div class="col-sm-7">
                     <input type="text" name="kualifikasi_tambahan" id="kualifikasi_tambahan" class="form-control">
                    </div>
                  </div>
				</div>
			</div>
			<div class="col-sm-12 border-top border-bottom">
                <label></label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
                <label class="red">Alasan Permintaan :
				<br><font color='#ff0000'>* Wajib Diisi </font></label>
            </div>
			
			<div class="row">
				<div class="col-sm-12">
					  <div class="col-sm-12">
                      <textarea type="text" class="form-control" placeholder="" name="alasan" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!"></textarea>
                    </div>
				</div>
			</div>			  
			  
              <div class="col-sm-12 border-top border-bottom">
                    <label></label>
                </div>
			
			<div class="col-sm-12 border-top border-bottom">
                <label>Job Deskripsi : 
				 	<i style="font-size: 12px;font-weight: normal;" >( mohon di tulis detail )</i>
					<br><font color='#ff0000'>* Wajib Diisi </font>
				</label>
            </div>
			
			<div class="row">
				<div class="col-sm-12">
					  <div class="col-sm-12">
                      <textarea type="text" class="form-control" placeholder="" name="job_desk" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!"></textarea>
                    </div>
				</div>
			</div>			  
            <div class="col-sm-12 border-top border-bottom">
                <label></label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
                <label></label>	
			</div>

			
			<div class="col-sm-12 border-top border-bottom">
            	<label>NOTE :
				<br>* Pastikan data yang dimasukan Benar dan Sesuai </label>
				<br>
            </div>
			<div class="row">
				<div class="col-sm-7">
				</div>
    		</div>
				<button type="submit" class="btn btn-primary" >Save</button>
			</div>	
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
$("#nilaia1").keyup(function(){   
   var a = parseFloat($("#nilaia1").val());
   var b = a * 50 / 100;
   $("#skora").val(b);
   var c = parseFloat($("#skora").val());
   var d = parseFloat($("#skorb").val());
   var e = parseFloat($("#skorc").val());
   var f = c + d + e;
   var g = f * 2;
    $("#totalskor").val(g);
	
	var nilai = g;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib1").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib2").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib3").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib4").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib5").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib6").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib7").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib8").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib9").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaib10").keyup(function(){   
   var a = parseFloat($("#nilaib1").val());
   var b = parseFloat($("#nilaib2").val());
   var c = parseFloat($("#nilaib3").val());
   var d = parseFloat($("#nilaib4").val());
   var e = parseFloat($("#nilaib5").val());
   var f = parseFloat($("#nilaib6").val());
   var g = parseFloat($("#nilaib7").val());
   var h = parseFloat($("#nilaib8").val());
   var i = parseFloat($("#nilaib9").val());
   var j = parseFloat($("#nilaib10").val());
   var k = a + b + c + d + e + f + g + h + i + j;
   var l = k /10 * 30 / 100;
   $("#skorb").val(l);
   var m = parseFloat($("#skora").val());
   var n = parseFloat($("#skorb").val());
   var o = parseFloat($("#skorc").val());
   var p = m + n + o;
   var q = p * 2;
    $("#totalskor").val(q);
	
	var nilai = q;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
});

$("#nilaic1").keyup(function(){   
    var a = parseFloat($("#nilaic1").val());
	var b = parseFloat($("#nilaic2").val());
	var c = parseFloat($("#nilaic3").val());
	var d = parseFloat($("#nilaic4").val());
	var e = parseFloat($("#nilaic5").val());
	var f = a + b + c + d + e;
	var g = f /5 * 20 / 100;;
	$("#skorc").val(g);
    var h = parseFloat($("#skora").val());
    var i = parseFloat($("#skorb").val());
    var j = parseFloat($("#skorc").val());
    var k = h + i + j;
	var l = k * 2;
    $("#totalskor").val(l);
	
	var nilai = l;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
 });
 
 $("#nilaic2").keyup(function(){   
    var a = parseFloat($("#nilaic1").val());
	var b = parseFloat($("#nilaic2").val());
	var c = parseFloat($("#nilaic3").val());
	var d = parseFloat($("#nilaic4").val());
	var e = parseFloat($("#nilaic5").val());
	var f = a + b + c + d + e;
	var g = f /5 * 20 / 100;;
	$("#skorc").val(g);
    var h = parseFloat($("#skora").val());
    var i = parseFloat($("#skorb").val());
    var j = parseFloat($("#skorc").val());
    var k = h + i + j;
	var l = k * 2;
    $("#totalskor").val(l);
	
	var nilai = l;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
 });
 
 $("#nilaic3").keyup(function(){   
    var a = parseFloat($("#nilaic1").val());
	var b = parseFloat($("#nilaic2").val());
	var c = parseFloat($("#nilaic3").val());
	var d = parseFloat($("#nilaic4").val());
	var e = parseFloat($("#nilaic5").val());
	var f = a + b + c + d + e;
	var g = f /5 * 20 / 100;;
	$("#skorc").val(g);
    var h = parseFloat($("#skora").val());
    var i = parseFloat($("#skorb").val());
    var j = parseFloat($("#skorc").val());
    var k = h + i + j;
	var l = k * 2;
    $("#totalskor").val(l);
	
	var nilai = l;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
 });
 
 $("#nilaic4").keyup(function(){   
    var a = parseFloat($("#nilaic1").val());
	var b = parseFloat($("#nilaic2").val());
	var c = parseFloat($("#nilaic3").val());
	var d = parseFloat($("#nilaic4").val());
	var e = parseFloat($("#nilaic5").val());
	var f = a + b + c + d + e;
	var g = f /5 * 20 / 100;;
	$("#skorc").val(g);
    var h = parseFloat($("#skora").val());
    var i = parseFloat($("#skorb").val());
    var j = parseFloat($("#skorc").val());
    var k = h + i + j;
	var l = k * 2;
    $("#totalskor").val(l);
	
	var nilai = l;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
 });
 
 $("#nilaic5").keyup(function(){   
    var a = parseFloat($("#nilaic1").val());
	var b = parseFloat($("#nilaic2").val());
	var c = parseFloat($("#nilaic3").val());
	var d = parseFloat($("#nilaic4").val());
	var e = parseFloat($("#nilaic5").val());
	var f = a + b + c + d + e;
	var g = f /5 * 20 / 100;;
	$("#skorc").val(g);
    var h = parseFloat($("#skora").val());
    var i = parseFloat($("#skorb").val());
    var j = parseFloat($("#skorc").val());
    var k = h + i + j;
	var l = k * 2;
    $("#totalskor").val(l);
	
	var nilai = l;
	
	if (nilai<2)
	{
    var huruf = 'E';
	}
	else if(nilai<4)
	{
    var huruf = 'D';
	}
	else if(nilai<6)
	{
     var huruf = 'C'; 
	}
	else if(nilai<8)
	{
     var huruf = 'B'; 
	}
	else if(nilai<10)
	{
    var huruf = 'A';
	}
	$("#hurufskor").val(huruf);
 });
 
  
 
</script>

<script>
    $("#update").click(function() {
if ($('#jumlah').val() == '') {
    $.alert({
      title: 'Alert!',
      content: 'Please enter item name',

    });
    $('#itemNameInput').focus();

    return false;
  }
});
</script>
 