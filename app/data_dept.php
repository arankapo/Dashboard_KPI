  <!-- Content Wrapper. Contains page content -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID DEPT</th>
                    <th>NAMA DEPARTEMEN</th>
                    <th>SUB DEPARTEMEN</th>
                  </tr>
                  </thead>
                  <tbody>
				  <!-- $query= memamnggil query di tabel tb_pegawai dengan $koneksi.php-->
				  <!-- while $peg =  melakukan perulangan dengan data aray sampai data keluar semua-->
					<?php
						$query = mysqli_query($koneksi,"SELECT * FROM tb_dept");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
					<td width='15%'><?php echo $peg['Id_dept'];?></td>
					<td width='15%'><?php echo $peg['nama_dept'];?></td>
					<td width='15%'><?php echo $peg['sub_dept'];?></td>
                  </tr>
						<?php }?>
                  </tfoot>
                </table>
              </div>
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
 