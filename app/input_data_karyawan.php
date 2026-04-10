  <!-- Content Wrapper. Contains page content -->

    <!-- Main content -->             
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
		  <form method="get" action="add/tambah_data_karyawan.php">
              <div class="card">
              <div class="card-header">
                <h5 class="text-center">PT. MEGA SURYA ERATAMA</h5> 
              </div>
			<div class="alert alert-secondary">
                <strong>FORM DATA KARYAWAN</strong>
				</div>
				
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> NIK :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="nik">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					
                    <div class="form-group">
                                <label for="exampleFormControlSelect1">Provinsi</label>
                                <select class="form-control" id="id_departemen">
                                    <option>---Pilih Provinsi---</option>
                                    <?php
                                        $sql = mysqli_query($koneksi,"SELECT * FROM tb_dept order by nama_dept ASC") or die(mysqli_error($con));
                                        while ($dt = mysqli_fetch_array($sql)) {
                                    ?>
                                        <option value="<?php echo $dt['Id_dept'] ?>"><?php echo $dt['nama_dept'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-9	 col-form-label text-center"> Identitas  di  isi  secara  Lengkap  dan  Benar</label>
                    <div class="col-sm-7">
                      
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					
                    <div class="form-group">
                                <label for="exampleFormControlSelect1">Kabupaten</label>
                                <select class="form-control" id="id_kabupaten">
                                    <option>---Pilih Kabupaten---</option>
                                </select>
                            </div>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label">Departement :</label>
                    <div class="col-sm-7">
                      <select class="form-control select2" name="nama_dept" style="width: 100%;">
					<option> Silahkan Pilih..</option>
                    <?php
				    $query = mysqli_query($koneksi,"SELECT * FROM tb_dept order by nama_dept asc");
                    while($row = mysqli_fetch_array($query)) {
                    ?>

                    <option value="<?php echo $row['nama_dept']; ?>">
                    <?php echo $row['nama_dept']; ?>
                    </option>
					<?php } ?>
					</select>
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
					<label for="inputEmail3" class="col-sm-9	 col-form-label text-center" >Sesuai dengan data di HRD</label>
                    <div class="col-sm-7">
                    
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Jabatan :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="jabatan">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Unit Kerja :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="unit_kerja">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    
                    <div class="col-sm-7">
                      
                    </div>
                  </div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-5	 col-form-label"> Nama Atasan :</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" placeholder="" name="nama_atasan">
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                
                    <div class="col-sm-7">
                     
                    </div>
                  </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group row">
                    
                    <div class="col-sm-7">
                      
                    </div>
                  </div>
				</div>
			</div>
				
			    <button type="submit" class="btn btn-primary">Save</button>
                
				</div>
			</form>	
			</div>
				
				
				
              <!-- /.card-header -->
			  
			   
            </div>
            <!-- /.card -->
			
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
		<script>
         $(document).ready(function(){
            $('#id_departemen').on('change',function(){
                var id_provinsi = $(this).val();
                $.ajax({
                    url:'ambil_data.php',
                    type:"POST",
                    data:{
                        modul:'Kabupaten',
                        id:id_provinsi
                    },
                    success:function(respond){
                        $("#id_kabupaten").html(respond);
                    },
                    error:function(){
                        alert("Gagal Mengambil Data");
                    }
                })
            })
        });

    <	/script>

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
 