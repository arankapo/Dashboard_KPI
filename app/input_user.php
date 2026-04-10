<?php

// app/input_user.php

//inisialisasi pesan variabel pesan error
$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $nama_dept = $_POST['nama_dept'];
    $sub_dept = $_POST['sub_dept'];

    // Hashing password baru
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Periksa apakah username sudah ada
    $check_query = $koneksi->prepare("SELECT COUNT(*) FROM tb_user WHERE Username = ?");
    $check_query->bind_param("s", $username);
    $check_query->execute();
    $check_query->bind_result($count);
    $check_query->fetch();
    $check_query->close();
    // Jika username sudah ada, tampilkan pesan error
    // jika tidak, lanjutkan dengan penyimpanan data
    if ($count > 0) {
        $message = '<div class="alert alert-danger">Username sudah ada. Mohon gunakan username lain.</div>';
    } else {
        // Simpan password yang sudah di-hash
        $stmt = $koneksi->prepare("INSERT INTO tb_user (Nama, Username, Password, Level, nama_dept, sub_dept) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nama, $username, $hashed_password, $level, $nama_dept, $sub_dept);
        // Eksekusi query untuk menyimpan data pengguna baru
        // Jika berhasil, tampilkan pesan sukses
        // Jika gagal, tampilkan pesan error
        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Pengguna baru berhasil ditambahkan!</div>';
            // Bersihkan form setelah sukses
            $_POST = array(); // Mengosongkan POST agar input tidak terisi lagi
        } else {
            $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
        }
        $stmt->close();
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Pengguna Baru</h3>
                    </div>
                    <?php
                        // Tampilkan pesan jika ada
                        echo $message;
                    ?>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" autofocus=""  required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" id="level" name="level" required>
                                    <option value="">Pilih Level</option>
                                    <option value="Admin" >Admin</option>
                                    <option value="User" >User</option>
                                    <option value="HRD" >HRD</option>
                                    <option value="Staff" >Staff</option>
                                    <option value="Supervisor" >Supervisor</option>
                                    <option value="SPV_HRGA" >SPV_HRGA</option>
                                    <option value="Manajer" >Manajer</option>
                                    <option value="Direksi" >Direksi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_dept">Departemen</label>
                                <select class="form-control" name="nama_dept" id="nama_dept" required>
								    <option value="">Pilih Departemen</option>
                                    <?php
                                    // Ambil data departemen dari database
                                    $departemen_query = $koneksi->query("SELECT Id_dept, nama_dept FROM tb_dept ORDER BY nama_dept ASC");
                                    while ($row = $departemen_query->fetch_assoc()) {
                                        echo "<option value='{$row['Id_dept']}'>{$row['nama_dept']}</option>"; // Changed value to Id_dept
                                    }
                                    ?>
						        </select>
                            </div>

                            <div class="form-group">
                                <label for="sub_dept">Sub Departemen</label>
                                <select class="form-control" id="sub_dept" name="sub_dept">
                                    <option value="">Pilih Sub Departemen</option>
                                    </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="index.php?page=data-user" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#departemen').on('change', function() {
        var id_dept = $(this).val();
        if(id_dept) {
            $.ajax({
                type: 'POST',
                url: 'ambil_sub_departemen.php',
                data: {id_dept: id_dept},
                success: function(html) {
                    $('#sub_departemen').html(html);
                }
            });
        } else {
            $('#sub_departemen').html('<option value="">Pilih Sub Departemen</option>');
        }
    });
});
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