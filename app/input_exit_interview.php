<?php
include('koneksi.php');
$dept = $_SESSION['dept'] ?? ''; // Menggunakan null coalescing operator untuk menghindari error jika $_SESSION['dept'] tidak terdefinisi
?>
<script src="assets/js/jquery.js"></script>
<script type="text/javascript" src="js/civem.js"></script>
  
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
			<form method="get" action="add/tambah_exit_interview.php">
              	<div class="card">
              		<div class="card-header">
              		  <h3 class="text-center"><img src="image/mse.png">  PT. MEGA SURYA ERATAMA</h3> 
              		</div>
					<div class="alert alert-secondary text-center" >
            		    <strong>EXIT INTERVIEW</strong>
						</div>
					<div class="col-sm-12 border-top border-bottom">
            		    <label></label>
            		</div>
					<div class="row">
						<div class="col-sm-5">
							<div class="form-group row">
            		        <label for="inputDepartemen" class="col-sm-6 col-form-label"> Departement :</label>
            		        <div class="col-sm-6">
            		          <select class="form-control" name="nama_dept" id="id_departemen">
									<option>-Pilih Nama Dept-</option>
									<?php
										// Query untuk mengisi dropdown departemen
										$sql=mysqli_query($koneksi, "SELECT DISTINCT * FROM tb_dept" );
										while ($data=mysqli_fetch_array($sql)) {
											echo "<option value='".$data['nama_dept']."'>".$data['nama_dept']."</option> ";
										}
									?>
								</select>
            		        </div>
            		      </div>
						</div>
						<div class="col-sm-5">
							<div class="form-group row">
            		        <label for="inputNamaKaryawan" class="col-sm-6 col-form-label"> Nama Karyawan :</label>
            		        <div class="col-sm-6">
							  	<select class="form-control" name="namakaryawan" id="inputNamaKaryawan"></select>
            		        </div>
            		      </div>
						</div>
					</div>
            		<div class="row">
            		    <div class="col-sm-5">
            		        <div class="form-group row">
            		            <label for="nik" class="col-sm-6 col-form-label"> NIK :</label>
            		            <div class="col-sm-6">
									<select class="form-control" name="nik" id="nik"></select>
            		            </div>
            		        </div>
            		    </div>
            		    <div class="col-sm-5">
            		        <div class="form-group row">
            		            <label for="jabatan" class="col-sm-6 col-form-label"> Jabatan :</label>
            		            <div class="col-sm-6">
									<select class="form-control" name="jabatan" id="jabatan"></select>
            		            </div>
            		        </div>
            		    </div>
            		</div>
            		<div class="row">
            		    <div class="col-sm-5">
            		        <div class="form-group row">
            		            <label for="inputDivisi" class="col-sm-6 col-form-label"> Divisi :</label>
            		            <div class="col-sm-6">
									<select class="form-control" name="divisi" id="inputDivisi"></select>
            		            </div>
            		        </div>
            		    </div>
            		    <div class="col-sm-5">
            		        <div class="form-group row">
            		            <label for="inputNoTelp" class="col-sm-6 col-form-label"> No. Telp :</label>
            		            <div class="col-sm-6">
            		                <input type="text" class="form-control" id="inputNoTelp" placeholder="" name="no_telp" required="">
            		            </div>
            		        </div>
            		    </div>
            		</div>
            		<div class="row">
            		    <div class="col-sm-5">
            		        <div class="form-group row">
            		            <label for="tanggal_masuk" class="col-sm-6 col-form-label"> Tanggal Masuk :</label>
            		            <div class="col-sm-6">
									<select class="form-control" name="tanggal_masuk" id="tanggal_masuk"></select>
            		            </div>
            		        </div>
            		    </div>
            		    <div class="col-sm-5">
            		        <div class="form-group row">
            		            <label for="inputTanggalResign" class="col-sm-6 col-form-label"> Tanggal Resign :</label>
            		            <div class="col-sm-6">
            		                <input type="date" class="form-control" id="inputTanggalResign" name="tanggal_resign" required="">
            		            </div>
            		        </div>
            		    </div>
            		</div>
            		<div class="alert alert-secondary">
            		    <strong>PERNYATAAN</strong>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<b>Keterangan Rating R :</b>
								<div class="row"> 
									<div class="col-sm-6"> 
										<div>1 = Sangat tidak sesuai</div>
								        <div>2 = Tidak sesuai</div>
								        <div>3 = Kadang sesuai dan kadang tidak sesuai</div>
								    </div>
								    <div class="col-sm-6"> <div>4 = Sesuai</div>
								        <div>5 = Sangat sesuai</div>
								    </div>
								</div>
								<?php
									// Query untuk menampilkan pernyataan sesi pertama
									$sql=mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE tipe = 'exin1'" );
									while ($data=mysqli_fetch_array($sql)) {
										echo '
										<div class="form-group row">
            		        				<label for="pernyataanke-'.$data['No'].'" class="col-sm-9 col-form-label">
												'.$data['No'].'. '.$data['Deskripsi'].'
												</label>
            		        				<div class="col-sm-2">
            		        				  	<select class="form-control" name="pernyataanke-'.$data['No'].'">';
										for ($i = 0; $i <= 5; $i++) {
										    echo "<option>" . $i . "</option>";
										}
										echo '
											  	</select>
            		        				</div>
            		      				</div>';
									}
								?>
							</div>
						</div>
					</div>
								
					<div class="alert alert-secondary">
            		    <strong>PERNYATAAN 2</strong>
					</div>
					<div class="row">
						<div class="col-sm-12">
						<div class="col-sm-12">
							<?php
								// Query untuk menampilkan pernyataan sesi kedua
								// Ini akan mencakup pertanyaan "Tolong ceritakan alasan utama Anda meninggalkan perusahaan ini"
								// jika ada di database dengan tipe 'exin2'
								$sql=mysqli_query($koneksi, "SELECT * FROM tb_pertanyaan WHERE tipe = 'exin2'" );
								while ($data=mysqli_fetch_array($sql)) {
									echo '
									<div class="form-group row">
            		        			<label for="exin2-'.$data['No'].'" class="col-sm-9 col-form-label">
											'.$data['No'].'. '.$data['Deskripsi'].'
											</label>
            		        			<div class="col-sm-12">
            		    				    <textarea type="text" class="form-control" placeholder="" name="exin2-'.$data['No'].'"  ></textarea>
            		    				</div>
            		      			</div>';
								}
							?>
						</div>
					</div>
				</div>	  
				<div class="col-sm-12 border-top border-bottom">
				    <label>NOTE :
					<br>* Pastikan data yang dimasukan Benar dan Sesuai </label>
					<br>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert-secondary">
            		    	<strong>LAPORAN SERAH TERIMA</strong>
						</div>
					<div class="col-sm-12">
						<h4>A. FINANCE & ACCOUNTING</h4>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								1. Penyelesaian Klaim Asuransi
							</label>
                    		<div class="col-sm-2">
                    	  		<input type="radio" id="klaim_asuransi" name="klaim_asuransi" value="Ya">
					        	<label for="klaim_asuransi">Ya</label>
					        	<input type="radio" id="klaim_asuransi" name="klaim_asuransi" value="Tidak">
					        	<label for="klaim_asuransi">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								2. Penyelesaian Klaim Produksi
							</label>
                    		<div class="col-sm-2">
                    	  		<input type="radio" id="klaim_produksi_ya" name="klaim_produksi" value="Ya">
					        	<label for="klaim_produksi_ya">Ya</label>
					        	<input type="radio" id="klaim_produksi_tidak" name="klaim_produksi" value="Tidak">
					        	<label for="klaim_produksi_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								3. Penyelesaian Pinjaman Karyawan
							</label>
                    		<div class="col-sm-2">
                    	  		<input type="radio" id="pinjaman_karyawan_ya" name="pinjaman_karyawan" value="Ya">
					    	    <label for="pinjaman_karyawan_ya">Ya</label>
					    	    <input type="radio" id="pinjaman_karyawan_tidak" name="pinjaman_karyawan" value="Tidak">
					    	    <label for="pinjaman_karyawan_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								4. Penyelesaian Pinjaman Bank Mandiri
							</label>
                    		<div class="col-sm-2">
                    	  		<input type="radio" id="pinjaman_bank_mandiri_ya" name="pinjaman_bank_mandiri" value="Ya">
					    	    <label for="pinjaman_bank_mandiri_ya">Ya</label>
					    	    <input type="radio" id="pinjaman_bank_mandiri_tidak" name="pinjaman_bank_mandiri" value="Tidak">
					    	    <label for="pinjaman_bank_mandiri_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								5. Penyelesaian Kas Bon
							</label>
                    		<div class="col-sm-2">
								<input type="radio" id="kas_bon_ya" name="kas_bon" value="Ya">
					    	    <label for="kas_bon_ya">Ya</label>
					    	    <input type="radio" id="kas_bon_tidak" name="kas_bon" value="Tidak">
					    	    <label for="kas_bon_tidak">Tidak</label>
                    		</div>
                  		</div>
						<h4>B. IT</h4>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								1. Pengembalian Komputer/Notebook (IT Assets)
							</label>
                    		<div class="col-sm-2">
								<input type="radio" id="komputer_ya" name="komputer" value="Ya">
						        <label for="komputer_ya">Ya</label>
						        <input type="radio" id="komputer_tidak" name="komputer" value="Tidak">
						        <label for="komputer_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								2. Penghapusan Alamat Email
							</label>
                    		<div class="col-sm-2">
								<input type="radio" id="email_ya" name="email" value="Ya">
						        <label for="email_ya">Ya</label>
						        <input type="radio" id="email_tidak" name="email" value="Tidak">
						        <label for="email_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								3. Penghapusan User ID dari Sistem
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="user_id_ya" name="user_id" value="Ya">
						        <label for="user_id_ya">Ya</label>
						        <input type="radio" id="user_id_tidak" name="user_id" value="Tidak">
						        <label for="user_id_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								4. Pengembalian Fasilitas Lain (IT)
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="fasilitas_lain_it_ya" name="fasilitas_lain_it" value="Ya">
						        <label for="fasilitas_lain_it_ya">Ya</label>
						        <input type="radio" id="fasilitas_lain_it_tidak" name="fasilitas_lain_it" value="Tidak">
						        <label for="fasilitas_lain_it_tidak">Tidak</label>
                    		</div>
                  		</div>
						<h4>C. DEPARTEMEN KARYAWAN</h4>
						<h5>1. Pengembalian Data</h5>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								1.a. Laporan-laporan
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="data_laporan_ya" name="data_laporan" value="Ya">
						        <label for="data_laporan_ya">Ya</label>
						        <input type="radio" id="data_laporan_tidak" name="data_laporan" value="Tidak">
						        <label for="data_laporan_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								1.b. Penyimpanan data soft copy
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="data_softcopy_ya" name="data_softcopy" value="Ya">
						        <label for="data_softcopy_ya">Ya</label>
						        <input type="radio" id="data_softcopy_tidak" name="data_softcopy" value="Tidak">
						        <label for="data_softcopy_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								1.c. Penyerahan password data
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="password_data_ya" name="password_data" value="Ya">
						        <label for="password_data_ya">Ya</label>
						        <input type="radio" id="password_data_tidak" name="password_data" value="Tidak">
						        <label for="password_data_tidak">Tidak</label>
                    		</div>
                  		</div>
						<h5>2. Pengembalian Contact Person</h5>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								2.a. Telepon kode bintang
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="kontak_telepon_ya" name="kontak_telepon" value="Ya">
						        <label for="kontak_telepon_ya">Ya</label>
						        <input type="radio" id="kontak_telepon_tidak" name="kontak_telepon" value="Tidak">
						        <label for="kontak_telepon_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								2.b. Data contact customer/provider terkait
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="kontak_customer_ya" name="kontak_customer" value="Ya">
						        <label for="kontak_customer_ya">Ya</label>
						        <input type="radio" id="kontak_customer_tidak" name="kontak_customer" value="Tidak">
						        <label for="kontak_customer_tidak">Tidak</label>
                    		</div>
                  		</div>
						<h4>D. HUMAN RESOURCE - GENERAL AFFAIR</h4>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								1. Pengembalian ID Card
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="id_pengunduran_diri_ya" name="id_card" value="Ya">
						        <label for="id_pengunduran_diri_ya">Ya</label>
						        <input type="radio" id="id_card_tidak" name="id_card" value="Tidak">
						        <label for="id_card_tidak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								2. Pengembalian Kunci Locker/Ruang
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="kunci_locker" name="kunci_locker" value="Ya">
						        <label for="kunci_locker">Ya</label>
						        <input type="radio" id="kunci_locker" name="kunci_locker" value="Tidak">
						        <label for="kunci_locker">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								3. Pengembalian Handphone/Blackberry
							</label>
                    		<div class="col-sm-2">
								<input type="radio" id="handphone" name="handphone" value="Ya">
						        <label for="handphone">Ya</label>
						        <input type="radio" id="handphone" name="handphone" value="Tidak">
						        <label for="handphone">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								4. Pengembalian Kendaraan Dinas
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="kendaraan_dinas" name="kendaraan_dinas" value="Ya">
						        <label for="kendaraan_dinas">Ya</label>
						        <input type="radio" id="kendaraan_dinas" name="kendaraan_dinas" value="Tidak">
						        <label for="kendaraan_dinas">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								5. Pengembalian buku Peraturan Perusahaan
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="buku_peraturan" name="buku_peraturan" value="Ya">
						        <label for="buku_peraturan">Ya</label>
						        <input type="radio" id="buku_peraturan" name="buku_peraturan" value="Tidak">
						        <label for="buku_peraturan">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								6. Penyelesaian Sisa Cuti
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="sisa_cuti" name="sisa_cuti" value="Ya">
						        <label for="sisa_cuti">Ya</label>
						        <input type="radio" id="sisa_cuti" name="sisa_cuti" value="Tidak">
						        <label for="sisa_cuti">Tidak</label>
                    		</div>
                  		</div>
						<h4>E. DOKUMEN</h4>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								1. Surat Pengunduran Diri
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="surat_pengunduran_diri" name="surat_pengunduran_diri" value="Ya">
						        <label for="surat_pengunduran_diri">Ya</label>
						        <input type="radio" id="surat_pengunduran_diri" name="surat_pengunduran_diri" value="Tidak">
						        <label for="surat_pengunduran_diri">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								2. Surat Tidak Perpanjang Kontrak
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="surat_tidak_perpanjang_kontrak" name="surat_tidak_perpanjang_kontrak" value="Ya">
						        <label for="surat_tidak_perpanjang_kontrak">Ya</label>
						        <input type="radio" id="surat_tidak_perpanjang_kontrak" name="surat_tidak_perpanjang_kontrak" value="Tidak">
						        <label for="surat_tidak_perpanjang_kontrak">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								3. Perhitungan Kompensasi
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="kompensasi" name="kompensasi" value="Ya">
						        <label for="kompensasi">Ya</label>
						        <input type="radio" id="kompensasi" name="kompensasi" value="Tidak">
						        <label for="kompensasi">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								4. Exit Interview
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="exit_interview" name="exit_interview" value="Ya">
						        <label for="exit_interview">Ya</label>
						        <input type="radio" id="exit_interview" name="exit_interview" value="Tidak">
						        <label for="exit_interview">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								5. Memo Karyawan Keluar
							</label>
                    		<div class="col-sm-2">
								<input type="radio" id="memo_karyawan_keluar" name="memo_karyawan_keluar" value="Ya">
						        <label for="memo_karyawan_keluar">Ya</label>
						        <input type="radio" id="memo_karyawan_keluar" name="memo_karyawan_keluar" value="Tidak">
						        <label for="memo_karyawan_keluar">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								6. Surat Pernyataan Pengakhiran Hubungan Kerja
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="akhir_hubungan_kerja" name="akhir_hubungan_kerja" value="Ya">
						        <label for="akhir_hubungan_kerja">Ya</label>
						        <input type="radio" id="akhir_hubungan_kerja" name="akhir_hubungan_kerja" value="Tidak">
						        <label for="akhir_hubungan_kerja">Tidak</label>
                    		</div>
                  		</div>
						<div class="form-group row">
                    		<label for="inputEmail3" class="col-sm-9 col-form-label">
								7. Surat Pengangkatan SK Tetap
							</label>
                    		<div class="col-sm-2">
						        <input type="radio" id="sk_tetap" name="sk_tetap" value="Ya">
						        <label for="sk_tetap">Ya</label>
						        <input type="radio" id="sk_tetap" name="sk_tetap" value="Tidak">
						        <label for="sk_tetap">Tidak</label>
                    		</div>
                  		</div>
						
			  		</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert-secondary">
            		    	<strong>LAPORAN SERAH TERIMA 2</strong>
						</div>
						<div class="col-sm-12">
							<h4>Serah Terima Dokumen</h4>
							<div class="form-group row">
            		        	<label for="keterangan" class="col-sm-9 col-form-label">
									</label>
            		        	<div class="col-sm-12">
            		    		    <textarea type="text" class="form-control" placeholder="" name="keterangan"  ></textarea>
            		    		</div>
            		      	</div>
							
			  			</div>
					</div>
				</div>
				<br>
				<button type="submit" class="btn btn-primary">Save</button>
				<br>
			</div>
		</div>
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
					url: 'ambil_data_outs.php',
					//mengirim data menggunakan metode post
					type: "POST",
					//mengambil data 
					data: {
						modul: 'Kabupaten',
						id: id_dept
					},
					success: function (respond) {
						$("#inputNamaKaryawan").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})

			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'nik',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#nik").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'sub_dept',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#inputDivisi").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})

			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'jabatan',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#jabatan").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'tgl_masuk',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#tanggal_masuk").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'lama_bekerja',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_lama_bekerja").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'grade_sebelum',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_grade_sebelum").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'grade_sesudah',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_grade_sesudah").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'tanggal_perubahan',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_tanggal_perubahan").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'status',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_status").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'perubahan',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_perubahan").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#inputNamaKaryawan').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'periode',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_periode").html(respond);
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
					
              </div>
            </div>
          </div>
        </div>
      </section>
