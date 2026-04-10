  <!-- Content Wrapper. Contains page content -->
<?php
include('koneksi.php');
$dept = $_SESSION['dept'];
$nik = $_GET['nik'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_nilai_karyawan WHERE nik='$nik'");
$view=mysqli_fetch_array($query);
?>
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
                <strong>FORM PENILAIAN KINERJA KARYAWAN1</strong>
				</div>
				
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> No Dokumen :</label>
                    <div class="col-sm-7">
					  <select class="form-control" name="no_dok" id="no_dok">
											<option>-Pilih No Dokumen-</option>
										
											<?php
											
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_list_doc" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['no_doc']?>"><?=$data['nama_doc']?></option> 
											<?php							
											}?>
											
						</select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Revisi :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="- " name="revisi" Readonly value="<?php echo $view['revisi'];?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4	 col-form-label"> Tanggal Efektif :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="Tanggal Efektif " name="tanggal_efektif">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement :</label>
                    <div class="col-sm-7">
						<select class="form-control" name="nama_dept" id="id_departemen">
											<option>-Pilih Nama Dept-</option>
										
											<?php
											if ($dept == 'HRGA') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='hrga'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											
											}else if ($dept == 'DIREKSI') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='direksi'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}?>
											
						</select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Unit Kerja :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="nama_dept" id="id_departemen">
											<option>Mega Jasem</option>
											<option>Mega Sepanjang</option>
					  </select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4	 col-form-label"> Periode :</label>
                    <div class="col-sm-7">
                     <select class="form-control" name="nama_dept" id="id_departemen">
											<option>2024</option>
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
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Nama Karyawan :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="nama" id="id_kabupaten"></select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Nama Penilai :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="nama_penilai">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> NIK</label>
                    <div class="col-sm-7">
                     <select class="form-control" name="nik" id="id_nik"></select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> NIK</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="nik_penilai">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jabatan :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="jabatan" id="id_jabatan"></select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jabatan :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="jabatan_penilai">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="sub_dept" id="id_sub_dept"></select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="sub_dept_penilai">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="alert alert-secondary">
                <strong>PENCAPAIAN KINERJA KUANTITATIF</strong>
			</div>
				
			<div class="col-sm-12 border-top border-bottom">
                <label>A. Indeks Prestasi Kunci W = 50%</label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
                <label>Aspek Yang Dinilai</label>
            </div>
			
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">1. Pencapaian Target / Hasil Kerja :</label>
                    <div class="col-sm-3">
					<input type="number" step="any" min="0" max="5" name="nilaia1" id="nilaia1" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-5"><b>W = Bobot dalam persen %</b></div>
			</div>
			
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Skor A = W x R =</label>
                    <div class="col-sm-3">
					<input type="text" class="form-control" Readonly value="<?php echo $view['skora'];?>">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"><b>R = Rating tingkat nilai dalam bentuk angka 1 s/d 5</b></div>
			</div>
			
			<div class="col-sm-12 border-top border-bottom">
                <label>B. Indeks Prestasi Kunci W = 30%</label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
                <label>Aspek Yang Dinilai</label>
            </div>
			
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">1. Upaya Ekstra :</label>
                    <div class="col-sm-3">
                      <input type="number" step="any" min="0" max="5" name="nilaib1" id="nilaib1" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"><b>Kerterangan Rating R :</b></div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">2. Bekerja Dibawah Tekanan :</label>
                    <div class="col-sm-3">
                     <input type="number" step="any" min="0" max="5" name="nilaib2" id="nilaib2" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">5 = Istimewa Jauh diatas rata rata standar</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">3. Kemampuan Teknis :</label>
                    <div class="col-sm-3">
                     <input type="number" step="any" min="0" max="5" name="nilaib3" id="nilaib3" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">4 = Bagus Di atas standar</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">4. Pengetahuan Sesuai tuntutan jabatan :</label>
                    <div class="col-sm-3">
                      <input type="number" step="any" min="0" max="5" name="nilaib4" id="nilaib4" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">3 = Cukup Sesuai standar</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">5. Keterampilan Keahlian di bidangnya :</label>
                    <div class="col-sm-3">
                      <input type="number" step="any" min="0" max="5" name="nilaib5" id="nilaib5" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">2 = Kurang Perlu perbaikan</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">6. Kualitas Kerja :</label>
                    <div class="col-sm-3">
                      <input type="number" step="any" min="0" max="5" name="nilaib6" id="nilaib6" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">1 = Gagal Jauh dari standar</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">7. Kerapihan /  Dokumentasi :</label>
                    <div class="col-sm-3">
                     <input type="number" step="any" min="0" max="5" name="nilaib7" id="nilaib7" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"></div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">8. Disiplin Kerja :</label>
                    <div class="col-sm-3">
                     <input type="number" step="any" min="0" max="5" name="nilaib8" id="nilaib8" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"></div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">9. Inovasi /  Ide Kreatif :</label>
                    <div class="col-sm-3">
                    <input type="number" step="any" min="0" max="5" name="nilaib9" id="nilaib9" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"></div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">10. Motivasi Kerja :</label>
                    <div class="col-sm-3">
                     <input type="number" step="any" min="0" max="5" name="nilaib10" id="nilaib10" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"></div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">  Skor B = W x Total R / Banyaknya R =</label>
                    <div class="col-sm-3">
                      <input type="text" name="skorb" id="skorb" class="form-control" Readonly value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"></div>
			</div>
			
			<div class="col-sm-12 border-top border-bottom">
                <label>C. Indeks Prestasi Kunci W = 20%</label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
                <label>Aspek Yang Dinilai</label>
            </div>
			
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">1. Kerjasama Team :</label>
                    <div class="col-sm-3">
						<input type="number" step="any" min="0" max="5" name="nilaic1" id="nilaic1" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"><b>Keterangan Hasil Skor :</b></div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">2. Kepedulian Terhadap Lingkungan :</label>
                    <div class="col-sm-3">
                      <input type="number" step="any" min="0" max="5" name="nilaic2" id="nilaic2" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">A = 8 - 10 Istimewa / Jauh melebihi standar</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">3. Kepedulian Terhadap Keselamatan Kerja :</label>
                    <div class="col-sm-3">
                      <input type="number" step="any" min="0" max="5" name="nilaic3" id="nilaic3" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">B = 6 - 8 Bagus / Melebihi standar</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">4. Kemampuan Untuk Menangani Masalah :</label>
                    <div class="col-sm-3">
                     <input type="number" step="any" min="0" max="5" name="nilaic4" id="nilaic4" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">C = 4 - 6 Cukup / Memenuhi standar</div>
			</div>
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">5. Pemberian Ide :</label>
                    <div class="col-sm-3">
                      <input type="number" step="any" min="0" max="5" name="nilaic5" id="nilaic5" class="form-control" value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">D = 2 - 4 Kurang</div>
			</div>
			
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Skor C = W x Total R / Banyaknya R =</label>
                    <div class="col-sm-3">
                      <input type="text" name="skorc" id="skorc" class="form-control" Readonly value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4">E = 0 - 2 Gagal</div>
			</div>
			
			<div class="col-sm-12 border-top border-bottom">
                <label>Total Hasil Penilaian</label>
            </div>
			<div class="row">
				<div class="col-sm-8">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Total Hasil Skor = Skor A + Skor B + Skor C =</label>
                    <div class="col-sm-3">
                      <input type="text" name="totalskor" id="totalskor" class="form-control" Readonly value="0">
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"></div>
			</div>
			<div class="col-sm-12 border-top border-bottom">
                <label>CATATAN KHUSUS :</label>
            </div>
			
			<div class="row">
				<div class="col-sm-12">
					  <div class="col-sm-12">
                      <textarea type="text" class="form-control" placeholder="" name="catatan"></textarea>
                    </div>
				</div>
			</div>			  
			  
              <div class="col-sm-12 border-top border-bottom">
                    <label></label>
                </div>
				
			<div class="col-sm-12 border-top border-bottom">
                    <label></label>	
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">Rekomendasi</label>
                    <div class="col-sm-5">
                     <select class="form-control" name="nama_dept" id="id_departemen">
											<option>Dapat melanjutkan masa SPK</option>
					 </select>
                    </div>
                  </div>
				</div>
    			<div class="col-sm-4"></div>
			</div>
			</div>
				
			<div class="col-sm-12 border-top border-bottom">
                    <label>NOTE :
					<br>1. 
					<br>2. </label>
					<br>
				<br>
				<br>
                </div>
				<div class="row">
				<div class="col-sm-7">
				</div>
    			</div>
					  <button type="submit" class="btn btn-primary">Save</button>
                
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
   $("#totalskor").val(f);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
   $("#totalskor").val(p);
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
    $("#totalskor").val(k);
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
    $("#totalskor").val(k);
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
    $("#totalskor").val(k);
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
    $("#totalskor").val(k);
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
    $("#totalskor").val(k);
 });
 
  
 
</script>
 