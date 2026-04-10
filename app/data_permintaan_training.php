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
                <h3 class="card-title">Data Permintaan Training</h3> </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                 <thead>
                    <tr>
                      <th>NO</th>
                      <th>DEPARTEMEN</th>
                      
                      <th>TANGGAL</th>
                      <th>TOPIK</th>
                      <th>LOKASI</th>
                      <th>PERALATAN</th>
                      <th>PROGRESS</th>
                      <th>Jumlah Evaluasi</th>
                      <th>Insert Evaluasi</th>
                      <th>Lihat Evaluasi</th>
                      <th>ACTION</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Jika departemen tidak kosong, filter data berdasarkan departemen tersebut
                    if (!empty($dept)) {
                        if (strtoupper($dept) == 'HRD' or strtoupper($dept) == 'DIREKSI' or strtoupper($dept) == '') {
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_permintaan_training");
                        } else {
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_permintaan_training WHERE departemen = '$dept'");
                        }
                    } else {
                        $query = false; // Set query ke false agar tidak ada data yang ditampilkan
                        echo "<tr><td colspan='14' class='text-center'>Departemen tidak teridentifikasi atau tidak ada data.</td></tr>";
                    }
                    if ($query) {
                        while($peg = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $peg['no_permintaan'];?></td>
                            <td><?php echo $peg['departemen'];?></td>
                            <td><?php echo $peg['tgl_training'];?></td>
                            <td><?php echo $peg['topik'];?></td>
                            <td><?php echo $peg['tempat'];?></td>
                            <td><?php echo $peg['peralatan'];?></td>
                            <td><?php echo $peg['progres'];?></td>
                            <td>
                                <?php
                                $no_permintaan = $peg['no_permintaan'];
                                $q_eval = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM evaluasi_training_header WHERE no_permintaan = '$no_permintaan'");
                                $eval = mysqli_fetch_assoc($q_eval);
                                $jumlah_evaluasi = $eval ? $eval['jumlah'] : 0;
                                echo $jumlah_evaluasi.' / ' . $peg['jml_peserta'];
                                ?>
                            </td>
                            <td>
                                <a href="index.php?page=input-evaluasi-interview&no_permintaan=<?php echo $peg['no_permintaan']; ?>" class="btn btn-primary btn-sm">Insert Evaluasi</a>
                            </td>
                            <td>
                                <a href="index.php?page=data-evaluasi-training&no_permintaan=<?php echo $peg['no_permintaan']; ?>" class="btn btn-success btn-sm">Lihat Evaluasi</a>
                            </td>
                            <td>
                                <a href="reportpdf/printpermintaantraining.php?id=<?php echo $peg['no_tr'];?>" class="fa fa-download" target="_blank">Print</a>
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

