  <!-- Content Wrapper. Contains page content -->
<?php
$dept = $_SESSION['dept']
?>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Apakah yakin hapus data?');
}
</script>    
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
				    <th>DEPT</th>
					<th>BAGIAN</th>
					<th>STATUS</th>
					<th>PROGRESS</th>
                    <th>TGL_PENGAJUAN</th>
					<th>TGL_APPROVE</th>
                    <th>TGL_CLOSE</th>
                    <th>PENEMPATAN</th>
                    <th>KLASIFIKASI</th>
					<th>JUMLAH</th>
					<th>JML_APPROVE</th>
					<th>JML_TERPENUHI</th>
					<th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
				  <!-- $query= memamnggil query di tabel tb_pegawai dengan $koneksi.php-->
				  <!-- while $peg =  melakukan perulangan dengan data aray sampai data keluar semua-->
					<?php
					if ($dept == 'HRGA') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan ");
						while($peg = mysqli_fetch_array($query)){
					?>
				    <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="index.php?page=edit-approve-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Approve</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="index.php?page=edit-jumlah-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit Terpenuhi</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'HRD') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan");
						while($peg = mysqli_fetch_array($query)){
					?>
				    <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="index.php?page=edit-approve-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Approve</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="index.php?page=edit-jumlah-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit Terpenuhi</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
					
				  </tr>
						<?php }
					}
					
					else if ($dept == 'FAA') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='faa'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'PURC') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='purc'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'QC') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='qc'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'PWP') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='pwp'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'LINKOM') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='linkom'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'PM') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='pm'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'WORKSHOP') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='workshop'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'BENGKEL') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='bengkel'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'WWT') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='wwt'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'MEKANIK') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='mekanik'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success" onclick="return checkDelete()">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'CONVERTING') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='converting'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'AFVALAN') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='afvalan'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'WAREHOUSE') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='warehouse'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'MARKETING') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='marketing'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'DIREKSI') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan ");
						while($peg = mysqli_fetch_array($query)){
					?>
				 
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'PPIC') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='ppic'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
                    <td width='5%'><?php echo $peg['nik'];?></td>
					<td><?php echo $peg['nama_karyawan'];?></td>
					<td><?php echo $peg['jabatan'];?></td>
					<td><?php echo $peg['tanggal_efektif'];?></td>
					<td width='8%'><?php echo $peg['skora'];?></td>
					<td width='8%'><?php echo $peg['skorb'];?></td>
					<td width='8%'><?php echo $peg['skorc'];?></td>
					<td><?php echo $peg['totalskor'];?></td>
					<td width='3%'><?php echo $peg['hurufskor'];?></td>
					<td><?php echo $peg['catatan'];?></td>
					<td><a href="edit/hapus_nilai_karyawan.php?nik=<?php echo $peg['nik'];?>" class="btn btn-sm btn-danger">Hapus</a>
					    <a href="reportpdf/printkpi.php?nik=<?php echo $peg['nik'];?>" class="fa fa-download">Print</a></td>
					</td>
				  </tr>
						<?php }
					}
					
					else if ($dept == 'SP') {
						$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan where nama_dept='sp'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
				    <td><?php echo $peg['nama_dept'];?></td>
					<td width='8%'><?php echo $peg['jabatan'];?></td>
					<td width='8%'><?php echo $peg['status_karyawan'];?></td>
					<td width='8%'><?php echo  $peg['progres'];?></td>
                    <td width='10%'><?php echo $peg['tanggal_pengajuan'];?></td>
					<td><?php echo $peg['tanggal_approve'];?></td>
					<td><?php echo $peg['tanggal_close'];?></td>
					<td><?php echo $peg['penempatan'];?></td>
					<td width='8%'><?php echo $peg['klasifikasi'];?></td>
					<td><?php echo $peg['jumlah'];?></td>
					<td><?php echo $peg['jumlah_approve'];?></td>
					<td><?php echo $peg['jumlah_terpenuhi'];?></td>
					<?php
					if ($peg['progres']== 'Open') {?>
						<td><a href="edit/hapus_permintaan_karyawan.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="index.php?page=edit-data-permintaan&&nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-warning">Edit</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					
					else if ($peg['progres']== 'On Progress') {?>
					<td>
						<a href="edit/update_tanggal_close.php?nik=<?php echo $peg['no_permintaan'];?>" class="btn btn-sm btn-success">Close</a>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }
					else if ($peg['progres']== 'Closed') {?>
					<td>
						<a href="reportpdf/printpermintaan.php?nik=<?php echo $peg['no_permintaan'];?>" class="fa fa-download">Print</a></td>
					</td>
					<?php }?>
				  </tr>
						<?php }
					}
					
										
					?>
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
 