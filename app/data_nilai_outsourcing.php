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
                    <th>NIK</th>
                    <th>NAMA</th>
					<th>JABATAN</th>
                    <th>TANGGAL</th>
                    <th>SKOR A</th>
					<th>SKOR B</th>
					<th>SKOR C</th>
					<th>TOTAL SKOR</th>
					<th>HURUF SKOR</th>
					<th>CATATAN</th>
					<th>ACTION</th>
                  </tr>
                  </thead>
                  <tbody>
				  <!-- $query= memamnggil query di tabel tb_pegawai dengan $koneksi.php-->
				  <!-- while $peg =  melakukan perulangan dengan data aray sampai data keluar semua-->
					<?php
						// --- OPTIMASI IF-ELSE: MAPPING DEPARTEMEN ---
						$deptMap = [
							'HRGA'      => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='hrga_outs'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'HRD'       => ['table' => 'tb_nilai_karyawan', 'where' => '', 'nama' => 'nama_karyawan', 'jabatan' => 'jabatan', 'print' => 'printkpi.php', 'hapus' => 'hapus_nilai_karyawan.php'],
							'HRGA_OS'   => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='hrga_outs'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'FAA'       => ['table' => 'tb_nilai_karyawan', 'where' => "nama_dept='faa'", 'nama' => 'nama_karyawan', 'jabatan' => 'jabatan', 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'QC'        => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='qc_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'PWP'       => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='pwp_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'LINKOM'    => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='linkom_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'PM'        => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='pm_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'WORKSHOP'  => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='workshop_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'BENGKEL'   => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='bengkel_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'WWT'       => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='wwt_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'GBJ'       => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='gbj_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'MEKANIK'   => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='mekanik_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'PURC'      => ['table' => 'tb_nilai_karyawan', 'where' => "nama_dept='purc'", 'nama' => 'nama_karyawan', 'jabatan' => 'jabatan', 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'COATING'   => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='coating_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'CONVERTING'=> ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='converting_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'DIREKSI'   => ['table' => 'tb_nilai_karyawan_os', 'where' => '', 'nama' => 'nama_karyawan', 'jabatan' => 'jabatan', 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'AFVALAN'   => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='afvalan_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'WAREHOUSE' => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='warehouse_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php'],
							'MARKETING' => ['table' => 'tb_nilai_karyawan', 'where' => "nama_dept='marketing'", 'nama' => 'nama_karyawan', 'jabatan' => 'jabatan', 'print' => 'printkpi.php', 'hapus' => 'hapus_nilai_karyawan.php'],
							'PPIC'      => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='ppic_os'", 'nama' => 'nama', 'jabatan' => null, 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php', 'edit' => true],
							'SP'        => ['table' => 'tb_nilai_karyawan_os', 'where' => "nama_dept='sp_os'", 'nama' => 'nama_karyawan', 'jabatan' => 'jabatan', 'print' => 'printkpios.php', 'hapus' => 'hapus_nilai_karyawan_os.php', 'edit' => true],
						];
						if (isset($deptMap[$dept])) {
							$conf = $deptMap[$dept];
							$sql = "SELECT * FROM " . $conf['table'];
							// Khusus DIREKSI, tampilkan semua data tanpa filter WHERE
							if ($dept !== 'DIREKSI' && $conf['where']) {
								$sql .= " WHERE " . $conf['where'];
							}
							$query = mysqli_query($koneksi, $sql);
							while($peg = mysqli_fetch_array($query)) {
								echo '<tr>';
								echo "<td width='5%'>" . (isset($peg['nik']) ? $peg['nik'] : (isset($peg['no_tr']) ? $peg['no_tr'] : '-')) . "</td>";
								echo "<td>" . (isset($peg[$conf['nama']]) ? $peg[$conf['nama']] : '-') . "</td>";
								echo "<td>" . (isset($conf['jabatan']) && $conf['jabatan'] && isset($peg[$conf['jabatan']]) ? $peg[$conf['jabatan']] : '-') . "</td>";
								echo "<td>" . (isset($peg['tanggal_efektif']) ? $peg['tanggal_efektif'] : '-') . "</td>";
								echo "<td width='8%'>" . (isset($peg['skora']) ? $peg['skora'] : '-') . "</td>";
								echo "<td width='8%'>" . (isset($peg['skorb']) ? $peg['skorb'] : '-') . "</td>";
								echo "<td width='8%'>" . (isset($peg['skorc']) ? $peg['skorc'] : '-') . "</td>";
								echo "<td>" . (isset($peg['totalskor']) ? $peg['totalskor'] : '-') . "</td>";
								echo "<td width='3%'>" . (isset($peg['hurufskor']) ? $peg['hurufskor'] : '-') . "</td>";
								echo "<td>" . (isset($peg['catatan']) ? $peg['catatan'] : '-') . "</td>";
								echo "<td>";
								echo '<a href="edit/' . $conf['hapus'] . '?nik=' . (isset($peg['no_tr']) ? $peg['no_tr'] : '') . '" class="btn btn-sm btn-danger" onclick="return checkDelete()">Hapus</a> ';
								if (isset($conf['edit']) && $conf['edit']) {
									echo '<a href="index.php?page=edit-data-nilai&&nik=' . (isset($peg['no_tr']) ? $peg['no_tr'] : '') . '" class="btn btn-sm btn-success">Edit</a> ';
								}
								echo '<a href="reportpdf/' . $conf['print'] . '?nik=' . (isset($peg['no_tr']) ? $peg['no_tr'] : '') . '" class="fa fa-download">Print</a>';
								echo "</td>";
								echo '</tr>';
							}
						} else {
							echo "<tr><td colspan='11'>Departemen tidak valid.</td></tr>";
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

