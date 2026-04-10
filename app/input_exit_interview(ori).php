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
			<form method="get" action="add/tambah_nilai_karyawan_os.php">
              <div class="card">
              <div class="card-header">
                <h3 class="text-center"><img src="image/mse.png">  PT. MEGA SURYA ERATAMA</h3> 
              </div>
			<div class="alert alert-secondary text-center" >
                <strong>EXIT INTERVIEW</strong>
				</div>
				
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> No Form :</label>
                    <div class="col-sm-7">
					  <select class="form-control" name="no_dok" id="no_dok">
											<option>FR/HRDGA/005</option>
											
						</select>
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
								<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement :</label>
                    <div class="col-sm-7">
						<select class="form-control" name="nama_dept" id="id_departemen">
											<option>-Pilih Nama Dept-</option>
										
											<?php
											if ($dept == 'HRGA') {
												$sql=mysqli_query($koneksi, "SELECT DISTINCT * FROM tb_dept where nama_dept='hrga_outs'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['nama_dept']?>"><?=$data['nama_dept']?></option> 
											<?php
												}
												
											
											}
											
											else if ($dept == 'HRGA_OS') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='hrga_outs'" );
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
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
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
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'PM') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='pm'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'PWP') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='pwp_os'" );
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
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
												else if ($dept == 'BENGKEL') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='bengkel'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'WWT') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='wwt_os'" );
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
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'MEKANIK') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='mekanik'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
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
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'PPIC') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='ppic'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'CONVERTING') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='converting'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'AFVALAN') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='afvalan'" );
												while ($data=mysqli_fetch_array($sql)) {
											?>
												<option value="<?=$data['sub_dept']?>"><?=$data['sub_dept']?></option> 
											<?php
												}
											}
											
											else if ($dept == 'WAREHOUSE') {
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='warehouse_os'" );
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
												$sql=mysqli_query($koneksi, "SELECT * FROM tb_dept where nama_dept='sp_os'" );
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
			</div>
			
			<div class="col-sm-12 border-top border-bottom">
                <label></label>
            </div>
				
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-6	 col-form-label"> Nama Karyawan :</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="" name="namakaryawan" required="" autofocus="" ></input>
                    </div>
                  </div>
				</div>
				<div class="col-sm-3"></div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Departement :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="Departemen" required="" autofocus="" ></input>
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
					</div>
					<div class="col-sm-12">
					    <div class="row"> <div class="col-sm-6"> <div>1 = Sangat tidak sesuai</div>
					            <div>2 = Tidak sesuai</div>
					            <div>3 = Kadang sesuai dan kadang tidak sesuai</div>
					        </div>
					        <div class="col-sm-6"> <div>4 = Sesuai</div>
					            <div>5 = Sangat sesuai</div>
					        </div>
					    </div>
					</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9 col-form-label">
							1. Secara umum pekerjaan yang saya lakukan sudah sesuai dengan apa yang saya harapkan
							</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9 col-form-label">2. Saya merasa dapat mengerjakan tugas saya dengan baik dan benar</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">3. Pekerjaan saya relevan dengan keahlian & pengalaman saya</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">4. Saya mendapat pengetahuan baru selama bekerja di perusahaan ini</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">5. Saya tidak merasa ada banyak tekanan (pressure) di dalam pekerjaan saya</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">6. Tanggung jawab yang diberikan perusahaan sudah sesuai dengan harapan saya</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">7. Saya mudah menghubungi / berkomunikasi dengan atasan</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							8. Saya mendapatkan bimbingan dan arahan yang jelas dalam bekerja
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							9. Saya merasa didukung oleh atasan dalam bekerja
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							10. Atasan memberikan feedback mengenai hasil kerja saya
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							11. Atasan menilai saya secara obyektif
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							12. Atasan peka terhadap kebutuhan saya
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							13. Saya diperlakukan adil (dengan rekan kerja lainnya) oleh atasan
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							14. Atasan mempercayai kemampuan saya dalam bekerja
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							15. Saya merasa diterima oleh rekan kerja dalam lingkungan departemen saya
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							16. Saya dapat bekerja sama dengan rekan kerja dalam menyelesaikan pekerjaan
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							17. Rekan kerja sangat mendukung saya dalam bekerja
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							18. Saya merasa mudah untuk berkomunikasi dengan rekan kerja
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							19. Saya merasa akrab dengan sesama rekan kerja
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							20. Saya merasa rekan-rekan di departemen lain sangat bersahabat dan dapat menerima saya
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							21. Saya merasa jenjang karir di bagian saya cukup jelas
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							22. Saya memiliki kesempatan untuk mengembangkan karir
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							23. Saya merasa kebijakan promosi jabatan cukup adil di perusahaan ini
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							24. Atasan langsung saya terbuka dan memperhatikan masa depan karir saya
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							25. Saya memiliki kesempatan dalam menyumbangkan ide untuk pengembangan perusahaan
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							26. Saya merasa dapat berkembang dan memiliki kesempatan untuk maju di perusahaan ini
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							27. Saya menerima dukungan (materiil, sumber daya dan fasilitas kerja) yang memadai dari perusahaan
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							28. Saya merasa perusahaan memperhatikan kesejahteraan karyawan
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							29. Saya merasa puas atas kompensasi (upah) yang diberikan perusahaan
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
                    	</div>
                  	</div>
					<div class="form-group row">
                    	<label for="inputEmail3" class="col-sm-9	 col-form-label">
							30. Saya merasa puas atas benefit (tunjangan kesehatan & asuransi) yang diberikan perusahaan
						</label>
                    	<div class="col-sm-2">
                    	  	<select class="form-control" name="unit_kerja" id="id_unit_kerja">
								<option>0</option><option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
						  	</select>
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
                      <textarea type="text" class="form-control" placeholder="" name="catatan" required="" autofocus="" data-errormessage-value-missing="isi nama lengkap yang sesuai.!"></textarea>
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
					url: 'ambil_data_outs.php',
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
					url: 'ambil_data_outs.php',
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
					url: 'ambil_data_outs.php',
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
			
			$('#id_kabupaten').on('change', function () {
				var id_kabupaten = $(this).val();
				$.ajax({
					url: 'ambil_data_outs.php',
					type: "POST",
					data: {
						modul: 'tgl_masuk',
						id: id_kabupaten
					},
					success: function (respond) {
						$("#id_tgl_masuk").html(respond);
					},
					error: function () {
						alert("Gagal Mengambil Data");
					}
				})
			})
			
			$('#id_kabupaten').on('change', function () {
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
			
			$('#id_kabupaten').on('change', function () {
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
			
			$('#id_kabupaten').on('change', function () {
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
			
			$('#id_kabupaten').on('change', function () {
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
			
			$('#id_kabupaten').on('change', function () {
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
			
			$('#id_kabupaten').on('change', function () {
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
			
			$('#id_kabupaten').on('change', function () {
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
 