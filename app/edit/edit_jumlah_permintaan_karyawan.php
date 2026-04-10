  <!-- Content Wrapper. Contains page content -->
<?php
include('koneksi.php');
$dept = $_SESSION['dept'];
$nik = $_GET['nik'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan WHERE no_permintaan='$nik'");
$view=mysqli_fetch_array($query);
?>
<script src="assets/js/jquery.js"></script>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Pastikan Jumlah Terpenuhi tidak lebih banyak dari Approve?');
}
</script>

    <!-- Main content -->             
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
			<form method="get" action="edit/update_jumlah_permintaan.php">
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
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> No Dokumen :</label>
                    <div class="col-sm-7">
					 <input type="text" class="form-control" name="no_permintaan" Readonly value="<?php echo $view['no_permintaan'];?>">
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
                     <input type="text" class="form-control" Readonly value="<?php echo $view['tanggal_pengajuan'];?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Tanggal Pemenuhan :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" Readonly value="<?php echo $view['tanggal_pemenuhan'];?>">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement :</label>
                    <div class="col-sm-7">
						<input type="text" class="form-control" Readonly value="<?php echo $view['nama_dept'];?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jumlah Approve</label>
                     <div class="col-sm-7">
                      <input type="text" class="form-control" Readonly value="<?php echo $view['jumlah_approve'];?>">
                    </div>
                  </div>
				</div>
			</div>
				
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Klasifikasi</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" Readonly value="<?php echo $view['klasifikasi'];?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jumlah Terpenuhi</label>
                     <div class="col-sm-7">
                     <input type="text" name="jumlah_terpenuhi" id="jumlah_terpenuhi" class="form-control">
                    </div>
                  </div>
				</div>
			</div>
			
				
			<div class="col-sm-12 border-top border-bottom">
                <label>Posisi karyawan</label>
            </div>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jabatan :</label>
                    <div class="col-sm-7">
                     <input type="text" class="form-control" Readonly value="<?php echo $view['jabatan'];?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Status Karyawan :</label>
                    <div class="col-sm-7">
                     <input type="text" class="form-control" Readonly value="<?php echo $view['status_karyawan'];?>">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
				<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jenis Kelamin :</label>
                    <div class="col-sm-7">
                     <input type="text" class="form-control" Readonly value="<?php echo $view['jenis_kelamin'];?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Penempatan :</label>
                     <div class="col-sm-7">
                      <input type="text" class="form-control" Readonly value="<?php echo $view['penempatan'];?>">
                    </div>
                  </div>
				</div>
			</div>
				
			<div class="col-sm-12 border-top border-bottom">
                <label>Klasifikasi karyawan</label>
            </div>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Pendidikan Minimum</label>
                    <div class="col-sm-7">
                     <input type="text" class="form-control" Readonly value="<?php echo $view['pendidikan_minimum'];?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jurusan Pendidikan :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" Readonly value="<?php echo $view['jurusan'];?>">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Usia </label>
                    <div class="col-sm-7">
						<input type="text" class="form-control" Readonly value="<?php echo $view['usia'];?>">
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Pengalaman Kerja :</label>
                    <div class="col-sm-7">
                     <input type="text" class="form-control" Readonly value="<?php echo $view['pengalaman'];?>">
                    </div>
                  </div>
			</div>
				</div>
				
			<div class="col-sm-12 border-top border-bottom">
                <label></label>
            </div>
			
			
			<div class="col-sm-12 border-top border-bottom">
                <label class="red">Alasan Penambahan / Penggantian :
				<br>* Wajib Di Isi </label>
            </div>
			
			<div class="row">
				<div class="col-sm-12">
					  <div class="col-sm-12">
                      <input type="text" class="form-control" Readonly value="<?php echo $view['alasan'];?>"></textarea>
                    </div>
				</div>
			</div>			  
			  
              <div class="col-sm-12 border-top border-bottom">
                    <label></label>
                </div>
			
			<div class="col-sm-12 border-top border-bottom">
                <label>Job Deskripsi :
				<br>* Wajib Di Isi </label>
            </div>
			
			<div class="row">
				<div class="col-sm-12">
					  <div class="col-sm-12">
                      <input type="text" class="form-control" Readonly value="<?php echo $view['job_desk'];?>"></textarea>
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
					  <button type="submit" class="btn btn-primary" onclick="return checkDelete()">Save</button>
                
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
 