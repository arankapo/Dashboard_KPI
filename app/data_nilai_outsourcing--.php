  <!-- Content Wrapper. Contains page content -->
<?php
$dept = $_SESSION['dept']
$sub_dept = $_SESSION['sub_dept']
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
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>TANGGAL</th>
                    <th>SKOR A</th>
					<th>SKOR B</th>
					<th>SKOR C</th>
					<th>TOTAL SKOR</th>
					<th>HURUF SKOR</th>
					<th>CATATAN</th>
					<th>ACTION<?php echo $sub_dept;?></th>
                  </tr>
                  </thead>
                  <tbody>
				  <!-- $query= memamnggil query di tabel tb_pegawai dengan $koneksi.php-->
				  <!-- while $peg =  melakukan perulangan dengan data aray sampai data keluar semua-->
					<?php
					
						$query = mysqli_query($koneksi,"SELECT * FROM tb_nilai_karyawan_os where sub_dept='SECURITY'");
						while($peg = mysqli_fetch_array($query)){
					?>
				  <tr>
                    <td width='10%'><?php echo $peg['nik'];?></td>
					<td><?php echo $peg['nama'];?></td>
					<td><?php echo $peg['tanggal_efektif'];?></td>
					<td width='8%'><?php echo $peg['skora'];?></td>
					<td width='8%'><?php echo $peg['skorb'];?></td>
					<td width='8%'><?php echo $peg['skorc'];?></td>
					<td><?php echo $peg['totalskor'];?></td>
					<td width='3%'><?php echo $peg['hurufskor'];?></td>
					<td><?php echo $peg['catatan'];?></td>
					<td><a href="edit/hapus_nilai_karyawan_os.php?nik=<?php echo $peg['no_tr'];?>" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a>
						<a href="reportpdf/printkpios.php?nik=<?php echo $peg['no_tr'];?>" class="fa fa-download">Print</a></td>
					</td>
				  </tr>
						<?php }
					
					
					
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
 