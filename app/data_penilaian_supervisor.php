<!-- Content Wrapper. Contains page content -->

<?php
include('koneksi.php');
$dept = $_SESSION['dept']
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
                <h3 class="text-center"><img src="image/mse.png">  PT. MEGA SURYA ERATAMA</h3> 
              </div>
			<div class="alert alert-secondary text-center"" >
                <strong>PENILAIAN KINERJA KARYAWAN</strong>
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
                      <input type="text" class="form-control" placeholder="- " name="revisi" Readonly value="0">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4	 col-form-label"> Tanggal :</label>
                    <div class="col-sm-7">
                      <input type="date" class="form-control" placeholder="Tanggal Efektif " name="tanggal_efektif" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement : <?php ECHO $dept ?></label>
                    <div class="col-sm-7">
						<select class="form-control" name="nama_dept" id="id_departemen">
											<option>-Pilih Nama Dept-</option>
										
											<?php
											if ($dept == 'HRGA') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept IN ('HRD','HRGA')" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
												
											
											}else if ($dept == 'HRGA_OUTS') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept IN ('HRD','HRGA')" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'QC') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='qc'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'FAA') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='faa'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'LINKOM') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='linkom'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'PM') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='pm'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'PWP') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='pwp'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'WORKSHOP') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='workshop'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
												else if ($dept == 'BENGKEL') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='bengkel'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'WWT') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='wwt'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'GBJ') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='gbj'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'MEKANIK') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='mekanik'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
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
											
											else if ($dept == 'COATING') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='coating'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'PPIC') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='ppic'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'CONVERTING') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='converting'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'AFVALAN') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='afvalan'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'WAREHOUSE') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='warehouse'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'MARKETING') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='marketing'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'SP') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='sp'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
											}
											else{
												$query = "SELECT * FROM tb_dept where id_dept = '".$dept."' ORDER BY nama_dept ASC";
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
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Unit Kerja :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="unit_kerja" id="id_unit_kerja">
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
                     <select class="form-control" name="periode" id="periode">
											<option>2025</option>
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
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jabatan :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="jabatan" id="id_jabatan"></select>
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
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement :</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="sub_dept" id="id_sub_dept"></select>
                    </div>
                  </div>
				</div>
			</div>
			
			
			
			
			<div class="alert alert-secondary">
                <strong>PENCAPAIAN KINERJA KUANTITATIF</strong>
			</div>
				
			<div class="col-sm-12 border-top border-bottom">
                <label>A. Pencapaian Kinerja ( W = 50% )</label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">1. Pencapaian Target / Hasil Kerja :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label"> Skor A = W x R =</label>
            	        <div class="col-sm-3">
						<input type="text" name="skora" id="skora" class="form-control" Readonly value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-4"><b>R = Rating tingkat nilai dalam bentuk angka 1 s/d 5</b></div>
				</div>
            </div>
			
			
			<div class="col-sm-12 border-top border-bottom">
                <label>B. Kemampuan Individu (W = 30%)</label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">1. Kedisiplinan Kerja :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">2. Ketertiban Kerja :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">3. Keinginan untuk berkembang :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">4. Motivasi Kerja :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">5. Koordinasi Kerja :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">6. Ketepatan Menangkap Intruksi Kerja :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">7. Laporan hasil kerja :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">8. Temuan Pelanggaran/kesalahan hasil kerja :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">9. Pengetahuan sesuai tuntutan jabatan :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">10. Keterampilan Keahlian dibidang kerjanya :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">11. Kemampuan Bekerja dibawah tekanan :</label>
            	        <div class="col-sm-3">
            	         <input type="number" step="any" min="0" max="5" name="nilaib11" id="nilaib11" class="form-control" value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-4"></div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">  Skor B = </label>
            	        <div class="col-sm-3">
            	          <input type="text" name="skorb" id="skorb" class="form-control" Readonly value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-4"></div>
				</div>
			
            </div>
			
			<div class="col-sm-12 border-top border-bottom">
                <label>C. Kemampuan Manajerial (W = 20%)</label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">1. Kepedulian Terhadap Lingkungan kerja (5R) :</label>
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
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">2. Kepedulian Terhadap Keselamatan Kerja (K3) :</label>
            	        <div class="col-sm-3">
            	          <input type="number" step="any" min="0" max="5" name="nilaic2" id="nilaic2" class="form-control" value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-4">A = 4.5 - 5 Istimewa - Diperpanjang Kontrak</div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">3. Naluri Kepemimpinan :</label>
            	        <div class="col-sm-3">
            	          <input type="number" step="any" min="0" max="5" name="nilaic3" id="nilaic3" class="form-control" value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-4">B = 3.5 - 4.4 Bagus - Diperpanjang Kontrak</div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">4. Kemampuan Menangani Masalah :</label>
            	        <div class="col-sm-3">
            	         <input type="number" step="any" min="0" max="5" name="nilaic4" id="nilaic4" class="form-control" value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-4">C = 2.5 - 3.4 Cukup - Dalam Masa Penilaian</div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label">5. Pengembangan Ide di lingkup kerjanya :</label>
            	        <div class="col-sm-3">
            	          <input type="number" step="any" min="0" max="5" name="nilaic5" id="nilaic5" class="form-control" value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-5">D = 1.5 - 2.4 Gagal - Tidak Diperpanjang Kontrak</div>
				</div>
				<div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label"> Skor C = </label>
            	        <div class="col-sm-3">
            	          <input type="text" name="skorc" id="skorc" class="form-control" Readonly value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-4">E = 0 - 1.4 Gagal</div>
				</div>

            </div>
			
			
			<div class="col-sm-12 border-top border-bottom">
                <label>Total Hasil Penilaian</label>
            </div>
			<div class="col-sm-12 border-top border-bottom">
                <div class="row">
					<div class="col-sm-7">
						<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label"> Total Hasil Skor =</label>
            	        <div class="col-sm-3">
            	          <input type="text" name="totalskor" id="totalskor" class="form-control" Readonly value="0">
            	        </div>
            	      </div>
					</div>
    				<div class="col-sm-4">
					<div class="form-group row">
            	        <label for="inputEmail3" class="col-sm-7	 col-form-label"> Huruf Hasil Skor =</label>
            	        <div class="col-sm-3">
            	          <input type="text" name="hurufskor" id="hurufskor" class="form-control" Readonly value="0">
            	        </div>
            	      </div>
					</div>
				</div>
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
function getFloat(id) {
  return parseFloat($(id).val()) || 0;
}

function updateSkor() {
  // Skor A
  var nilaia1 = getFloat('#nilaia1');
  var skora = nilaia1 * 0.5;
  $('#skora').val(skora);

  // Skor B
  var nilaib = 0;
  for (var i = 1; i <= 11; i++) {
    nilaib += getFloat('#nilaib' + i);
  }
  var skorb = nilaib / 11 * 0.3;
  $('#skorb').val(skorb.toFixed(2)); // tampilkan 2 angka di belakang koma

  // Skor C
  var nilaic = 0;
  for (var i = 1; i <= 5; i++) {
    nilaic += getFloat('#nilaic' + i);
  }
  var skorc = nilaic / 5 * 0.2;
  $('#skorc').val(skorc);

  // Total Skor
  var total = (skora + skorb + skorc) .toFixed(2);
  $('#totalskor').val(total);

  // Huruf Skor
  var huruf = 'E';
  if (total >= 4.5) huruf = 'A';
  else if (total >= 3.5) huruf = 'B';
  else if (total >= 2.5) huruf = 'C';
  else if (total >= 1.5) huruf = 'D';
  $('#hurufskor').val(huruf);
}

$(document).ready(function () {
  // Event untuk semua input nilai
  $('#nilaia1').on('input', updateSkor);
  for (var i = 1; i <= 11; i++) {
    $('#nilaib' + i).on('input', updateSkor);
  }
  for (var i = 1; i <= 5; i++) {
    $('#nilaic' + i).on('input', updateSkor);
  }
  // Inisialisasi awal
  updateSkor();
});
</script>
