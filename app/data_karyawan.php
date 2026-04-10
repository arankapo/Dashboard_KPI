<?php
// data_karyawan.php
// Pastikan file koneksi.php sudah di-include
include('koneksi.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Logika untuk memproses penghapusan
// Perintah ini akan dieksekusi ketika user mengklik tombol "Hapus"
if (isset($_GET['delete_nik'])) {
    $nik_to_delete = mysqli_real_escape_string($koneksi, $_GET['delete_nik']);

    $query_delete = "DELETE FROM tb_karyawan WHERE nik_karyawan = '$nik_to_delete'";

    if (mysqli_query($koneksi, $query_delete)) {
        $_SESSION['alert_message'] = '<div class="alert alert-success">Data karyawan berhasil dihapus!</div>';
    } else {
        $_SESSION['alert_message'] = '<div class="alert alert-danger">Gagal menghapus data karyawan: ' . mysqli_error($koneksi) . '</div>';
    }

    // Redirect untuk membersihkan URL, sesuai dengan format aplikasi Anda
    header('Location: index.php?page=data-karyawan');
    exit;
}

// Tampilkan pesan alert jika ada
if (isset($_SESSION['alert_message'])) {
    echo $_SESSION['alert_message'];
    unset($_SESSION['alert_message']); // Hapus pesan setelah ditampilkan
}
?>

<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Apakah yakin ingin menghapus data karyawan ini?');
}
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Karyawan</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>NAMA</th>
                                    <th>JABATAN</th>
                                    <th>SUB DEPT</th>
                                    <th>NAMA DEPARTEMEN</th>
                                    <th>UNIT KERJA</th>
                                    <th>ATASAN</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM tb_karyawan ORDER BY nama_karyawan ASC");
                                while($peg = mysqli_fetch_array($query)){
                                ?>
                                <tr>
                                    <td width='10%'><?php echo htmlspecialchars($peg['nik_karyawan']);?></td>
                                    <td><?php echo htmlspecialchars($peg['nama_karyawan']);?></td>
                                    <td><?php echo htmlspecialchars($peg['jabatan_karyawan']);?></td>
                                    <td><?php echo htmlspecialchars($peg['sub_dept']);?></td>
                                    <td width='15%'><?php echo htmlspecialchars($peg['nama_dept']);?></td>
                                    <td width='15%'><?php echo htmlspecialchars($peg['unit_kerja']);?></td>
                                    <td><?php echo htmlspecialchars($peg['atasan_karyawan']);?></td>
                                    <td>
                                        <a href="index.php?page=edit-karyawan&nik=<?php echo urlencode($peg['nik_karyawan']);?>" class="btn btn-info btn-sm">Edit</a>
                                        <a href="index.php?page=data-karyawan&delete_nik=<?php echo urlencode($peg['nik_karyawan']);?>" class="btn btn-danger btn-sm" onclick="return checkDelete()">Hapus</a>
                                    </td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>