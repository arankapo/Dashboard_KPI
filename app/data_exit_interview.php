<?php
// data_exit_interview.php

// Pastikan sesi sudah dimulai dan variabel dept tersedia
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$dept = isset($_SESSION['dept']) ? $_SESSION['dept'] : '';

// Asumsi $koneksi sudah tersedia karena ini di-include dari file utama
?>

<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Apakah yakin hapus data?');
}
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Exit Interview</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Sesi</th>
                                    <th>NIK</th>
                                    <th>Nama Karyawan</th>
                                    <th>Departemen</th>
                                    <th>Jabatan</th>
                                    <th>Divisi</th>
                                    <th>No. Telp</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Tanggal Resign</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Mengambil data dari tb_exit_interview_header
                                $query = "SELECT * FROM tb_exit_interview_header";
                                
                                // (Bagian filter departemen jika ada, biarkan tetap sama)
                                
                                $result = mysqli_query($koneksi, $query);
                                
                                if (!$result) {
                                    echo "<tr><td colspan='10'>Error mengambil data: " . mysqli_error($koneksi) . "</td></tr>";
                                } else if (mysqli_num_rows($result) == 0) {
                                    echo "<tr><td colspan='10'>Tidak ada data exit interview yang ditemukan.</td></tr>";
                                } else {
                                    while($data = mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td width='10%'><?php echo htmlspecialchars($data['id_exit_interview']);?></td>
                                    <td width='10%'><?php echo htmlspecialchars($data['nik']);?></td>
                                    <td><?php echo htmlspecialchars($data['namakaryawan']);?></td>
                                    <td><?php echo htmlspecialchars($data['nama_dept']);?></td>
                                    <td><?php echo htmlspecialchars($data['jabatan']);?></td>
                                    <td><?php echo htmlspecialchars($data['divisi']);?></td>
                                    <td><?php echo htmlspecialchars($data['no_telp']);?></td>
                                    <td><?php echo htmlspecialchars($data['tanggal_masuk']);?></td>
                                    <td><?php echo htmlspecialchars($data['tanggal_resign']);?></td>
                                    <td>
                                        
                                        <a href="reportpdf/print_exit_interview.php?id=<?php echo urlencode($data['id_exit_interview']);?>" class="fa fa-download btn btn-success btn-sm" target="_blank">Print</a>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>