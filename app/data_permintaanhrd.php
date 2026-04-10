<!-- Content Wrapper. Contains page content -->
<?php
$dept = $_SESSION['dept'];
// --- OPTIMASI IF-ELSE: MAPPING DEPARTEMEN ---
$deptMap = [
    'HRGA'      => "SELECT * FROM tb_permintaan_karyawan where nama_dept='hrga'",
    'HRGA_OS'   => "SELECT * FROM tb_permintaan_karyawan where nama_dept in ('hrga','IT','SECURITY','HR','GA')",
    'HRD'       => "SELECT * FROM tb_permintaan_karyawan",
    'FAA'       => "SELECT * FROM tb_permintaan_karyawan where nama_dept='faa'",
    'QC'        => "SELECT * FROM tb_permintaan_karyawan where nama_dept='qc'",
    'PWP'       => "SELECT * FROM tb_permintaan_karyawan where nama_dept='pwp'",
    'LINKOM'    => "SELECT * FROM tb_permintaan_karyawan where nama_dept='linkom'",
    'PM'        => "SELECT * FROM tb_permintaan_karyawan where nama_dept='pm'",
    'BENGKEL'   => "SELECT * FROM tb_permintaan_karyawan where nama_dept='bengkel'",
    'WWT'       => "SELECT * FROM tb_permintaan_karyawan where nama_dept='wwt'",
    'MEKANIK'   => "SELECT * FROM tb_permintaan_karyawan where nama_dept='mekanik'",
    'CONVERTING'=> "SELECT * FROM tb_permintaan_karyawan where nama_dept='converting'",
    'AFVALAN'   => "SELECT * FROM tb_permintaan_karyawan where nama_dept='afvalan'",
    'WAREHOUSE' => "SELECT * FROM tb_permintaan_karyawan where nama_dept='warehouse'",
    'MARKETING' => "SELECT * FROM tb_permintaan_karyawan where nama_dept='marketing'",
    'PPIC'      => "SELECT * FROM tb_permintaan_karyawan where nama_dept='ppic'",
    'SP'        => "SELECT * FROM tb_permintaan_karyawan where nama_dept='sp'"
];
$sql = isset($deptMap[$dept]) ? $deptMap[$dept] : $deptMap['HRD'];
$query = mysqli_query($koneksi, $sql);
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
					while($peg = mysqli_fetch_array($query)) {
						echo '<tr>';
						echo '<td>' . $peg['nama_dept'] . '</td>';
						echo '<td width="8%">' . $peg['jabatan'] . '</td>';
						echo '<td width="8%">' . $peg['status_karyawan'] . '</td>';
						echo '<td width="8%">' . $peg['progres'] . '</td>';
						echo '<td width="10%">' . $peg['tanggal_pengajuan'] . '</td>';
						echo '<td>' . $peg['tanggal_approve'] . '</td>';
						echo '<td>' . $peg['tanggal_close'] . '</td>';
						echo '<td>' . $peg['penempatan'] . '</td>';
						echo '<td width="8%">' . $peg['klasifikasi'] . '</td>';
						echo '<td>' . $peg['jumlah'] . '</td>';
						echo '<td>' . $peg['jumlah_approve'] . '</td>';
						echo '<td>' . $peg['jumlah_terpenuhi'] . '</td>';
						echo '<td>';
						if ($peg['progres'] == 'Open') {
							echo '<a href="edit/hapus_permintaan_karyawan.php?nik=' . $peg['no_permintaan'] . '" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a> ';
							echo '<a href="index.php?page=edit-data-permintaan&&nik=' . $peg['no_permintaan'] . '" class="btn btn-sm btn-warning">Edit</a> ';
							echo '<a href="edit/update_tanggal_close.php?nik=' . $peg['no_permintaan'] . '" class="btn btn-sm btn-success">Close</a> ';
						}
						if ($peg['progres'] == 'On Progress') {
							echo '<a href="edit/update_tanggal_close.php?nik=' . $peg['no_permintaan'] . '" class="btn btn-sm btn-success">Close</a> ';
						}
						echo '<a href="reportpdf/printpermintaan.php?nik=' . $peg['no_permintaan'] . '" class="fa fa-download" target="_blank">Print</a>';
						echo '</td>';
						echo '</tr>';
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
