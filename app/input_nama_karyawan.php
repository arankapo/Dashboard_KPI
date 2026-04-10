<?php
include('koneksi.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<script src="assets/js/jquery.js"></script>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form method="post" action="add/tambah_karyawan.php">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">
                                <img src="image/mse.png"> PT. MEGA SURYA ERATAMA
                            </h3>
                        </div>
                        <div class="alert alert-secondary text-center">
                            <strong>FORM INPUT DATA KARYAWAN</strong>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">NIK Karyawan :</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nik_karyawan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Nama Karyawan :</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nama_karyawan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Jabatan Karyawan :</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="jabatan_karyawan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Nama Department :</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="nama_dept" id="nama_dept">
                                            <option value="">-- Pilih Departemen --</option>
                                            <?php
                                            // Ambil data departemen dari tabel tb_dept
                                            $q_dept = mysqli_query($koneksi, "SELECT * FROM tb_dept ORDER BY nama_dept ASC");
                                            while ($data_dept = mysqli_fetch_array($q_dept)) {
                                                echo '<option value="' . htmlspecialchars($data_dept['Id_dept']) . '">' . htmlspecialchars($data_dept['nama_dept']) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Sub Department :</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="sub_dept" id="sub_dept">
                                            <option value="">-- Pilih Sub Departemen --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Unit Kerja :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="unit_kerja">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Atasan Karyawan :</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="atasan_karyawan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function(){
    $('#nama_dept').change(function(){
        var id_dept = $(this).val(); // Get Id_dept directly from value
        if(id_dept){
            $.ajax({
                type:'POST',
                url:'ambil_data.php', 
                data:{id:id_dept, modul:'sub_dept2'}, // Pass id and modul
                success:function(html){
                    $('#sub_dept').html(html);
                }
            });
        } else {
            $('#sub_dept').html('<option value="">Pilih Sub Departemen</option>');
        }
    });
});
</script>