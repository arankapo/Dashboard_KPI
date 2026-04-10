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
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>JABATAN</th>
                    <th>DIVISI</th>
                    <th>UNIT KERJA</th>
					<th>LEVEL</th>
                  </tr>
                  </thead>
                  <tbody>
				  <!-- $query= memamnggil query di tabel tb_pegawai dengan $koneksi.php-->
				  <!-- while $peg =  melakukan perulangan dengan data aray sampai data keluar semua-->
					<?php
						$query = mysqli_query($koneksi,"SELECT * FROM tb_pegawai");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
                    <td width='10%'><?php echo $peg['Nik'];?></td>
					<td><?php echo $peg['Nama'];?></td>
					<td><?php echo $peg['Jabatan'];?></td>
					<td><?php echo $peg['Divisi'];?></td>
					<td width='15%'><?php echo $peg['Unit_Kerja'];?></td>
					<td><?php echo $peg['Level'];?></td>
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
 