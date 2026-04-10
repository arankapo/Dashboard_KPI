<?php
include('koneksi.php');
$dept = isset($_SESSION['dept']) ? $_SESSION['dept'] : '';
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
            <h3 class="card-title">Data Evaluasi Training</h3> </div>
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
             <thead>
                <tr>
                  <th>NO</th>
                  <th>NO PERMINTAAN</th>
                  <th>JUDUL TRAINING</th>
                  <th>TANGGAL</th>
                  <th>PESERTA</th>
                  <th>TRAINER</th>
                  <th>DIVISI</th>
                  <th>POIN PENGEMBANGAN</th>
                  <th>Evaluasi</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no_permintaan = isset($_GET['no_permintaan']) ? $_GET['no_permintaan'] : '';
                if (!empty($dept)) {
                    if (!empty($no_permintaan)) {
                        $query = mysqli_query($koneksi, "SELECT * FROM evaluasi_training_header WHERE divisi = '".$dept."' AND no_permintaan = '".mysqli_real_escape_string($koneksi, $no_permintaan)."'");
                    } else {
                        $query = mysqli_query($koneksi, "SELECT * FROM evaluasi_training_header WHERE divisi = '".$dept."'");
                    }
                } else {
                    $query = false;
                    echo "<tr><td colspan='9' class='text-center'>Departemen tidak teridentifikasi atau tidak ada data.</td></tr>";
                }
                if ($query) {
                    $no = 1;
                    while($row = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $no++;?></td>
                        <td><?php echo htmlspecialchars($row['no_permintaan']);?></td>
                        <td><?php echo htmlspecialchars($row['judul_training']);?></td>
                        <td><?php echo htmlspecialchars($row['tanggal_training']);?></td>
                        <td><?php echo htmlspecialchars($row['nama_peserta']);?></td>
                        <td><?php echo htmlspecialchars($row['nama_trainer']);?></td>
                        <td><?php echo htmlspecialchars($row['divisi']);?></td>
                        <td><?php echo htmlspecialchars($row['point_pengembangan']);?></td>
                        <td>
                            <a href="index.php?page=edit-evaluasi-training&id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Evaluasi</a>
                        </td>
                        <td>
                          <a href="reportpdf/printevaluasitraining.php?id=<?php echo $row['id'];?>" class="fa fa-download" target="_blank">Print</a>
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
