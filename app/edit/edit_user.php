<?php


$message = '';
$user_id = null;
$user_data = [];

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
    $stmt = $koneksi->prepare("SELECT Id, Nama, Username, Level, nama_dept, sub_dept FROM tb_user WHERE Id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
    } else {
        $message = '<div class="alert alert-danger">Pengguna tidak ditemukan.</div>';
        $user_id = null; // Reset user_id jika tidak ditemukan
    }
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id_to_update = (int)$_POST['user_id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $nama_dept = $_POST['nama_dept']; // This will now be Id_dept from the dropdown
    $sub_dept = $_POST['sub_dept'];
    $password = $_POST['password']; // Input password baru

    // Before updating, get the actual nama_dept from Id_dept
    $stmt_get_nama_dept = $koneksi->prepare("SELECT nama_dept FROM tb_dept WHERE Id_dept = ?");
    $stmt_get_nama_dept->bind_param("s", $nama_dept);
    $stmt_get_nama_dept->execute();
    $result_get_nama_dept = $stmt_get_nama_dept->get_result();
    $row_get_nama_dept = $result_get_nama_dept->fetch_assoc();
    $actual_nama_dept = $row_get_nama_dept['nama_dept'];
    $stmt_get_nama_dept->close();


    // Periksa apakah username sudah ada untuk user lain
    $check_query = $koneksi->prepare("SELECT COUNT(*) FROM tb_user WHERE Username = ? AND Id != ?");
    $check_query->bind_param("si", $username, $user_id_to_update);
    $check_query->execute();
    $check_query->bind_result($count);
    $check_query->fetch();
    $check_query->close();

    if ($count > 0) {
        $message = '<div class="alert alert-danger">Username sudah digunakan oleh pengguna lain. Mohon gunakan username yang berbeda.</div>';
        // Reload data pengguna agar form tetap terisi dengan data yang tidak berubah
        $stmt = $koneksi->prepare("SELECT Id, Nama, Username, Level, nama_dept, sub_dept FROM tb_user WHERE Id = ?");
        $stmt->bind_param("i", $user_id_to_update);
        $stmt->execute();
        $user_data = $stmt->get_result()->fetch_assoc();
        $stmt->close();
    } else {
        if (!empty($password)) {
            // Jika password diisi, hash password baru sebelum update
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $koneksi->prepare("UPDATE tb_user SET Nama = ?, Username = ?, Password = ?, Level = ?, nama_dept = ?, sub_dept = ? WHERE Id = ?");
            // Use actual_nama_dept for update
            $stmt->bind_param("ssssssi", $nama, $username, $hashed_password, $level, $actual_nama_dept, $sub_dept, $user_id_to_update);
        } else {
            // Jika password kosong, jangan update password
            $stmt = $koneksi->prepare("UPDATE tb_user SET Nama = ?, Username = ?, Level = ?, nama_dept = ?, sub_dept = ? WHERE Id = ?");
            // Use actual_nama_dept for update
            $stmt->bind_param("sssssi", $nama, $username, $level, $actual_nama_dept, $sub_dept, $user_id_to_update);
        }

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Data pengguna berhasil diperbarui!</div>';
            // Perbarui data yang ditampilkan di form setelah update
            $stmt_refresh = $koneksi->prepare("SELECT Id, Nama, Username, Level, nama_dept, sub_dept FROM tb_user WHERE Id = ?");
            $stmt_refresh->bind_param("i", $user_id_to_update);
            $stmt_refresh->execute();
            $user_data = $stmt_refresh->get_result()->fetch_assoc();
            $stmt_refresh->close();
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
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Pengguna</h3>
                    </div>
                    <?php echo $message; ?>
                    <?php if ($user_id !== null && !empty($user_data)): ?>
                    <form action="" method="POST">
                        <div class="card-body">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_data['Id']); ?>">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user_data['Nama']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user_data['Username']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password (Biarkan kosong jika tidak ingin mengubah)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select class="form-control" id="level" name="level" required>
                                    <option value="Admin" <?php echo ($user_data['Level'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                    <option value="User" <?php echo ($user_data['Level'] == 'User') ? 'selected' : ''; ?>>User</option>
                                    <option value="HRD" <?php echo ($user_data['Level'] == 'HRD') ? 'selected' : ''; ?>>HRD</option>
                                    <option value="Staff" <?php echo ($user_data['Level'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                                    <option value="Supervisor" <?php echo ($user_data['Level'] == 'Supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                                    <option value="SPV_HRGA" <?php echo ($user_data['Level'] == 'SPV_HRGA') ? 'selected' : ''; ?>>SPV_HRGA</option>
                                    <option value="Manajer" <?php echo ($user_data['Level'] == 'Manajer') ? 'selected' : ''; ?>>Manajer</option>
                                    <option value="Direksi" <?php echo ($user_data['Level'] == 'Direksi') ? 'selected' : ''; ?>>Direksi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_dept">Departemen</label>
                                <select class="form-control" name="nama_dept" id="nama_dept_edit" required>
                                    <option value="">Pilih Departemen</option>
                                    <?php
                                    // Ambil data departemen dari database
                                    $departemen_query_edit = $koneksi->query("SELECT Id_dept, nama_dept FROM tb_dept ORDER BY nama_dept ASC");
                                    $current_id_dept_for_user = '';
                                    if (!empty($user_data['nama_dept'])) {
                                        $stmt_get_id_dept = $koneksi->prepare("SELECT Id_dept FROM tb_dept WHERE nama_dept = ?");
                                        $stmt_get_id_dept->bind_param("s", $user_data['nama_dept']);
                                        $stmt_get_id_dept->execute();
                                        $result_get_id_dept = $stmt_get_id_dept->get_result();
                                        if ($row_get_id_dept = $result_get_id_dept->fetch_assoc()) {
                                            $current_id_dept_for_user = $row_get_id_dept['Id_dept'];
                                        }
                                        $stmt_get_id_dept->close();
                                    }

                                    while ($row_dept_edit = $departemen_query_edit->fetch_assoc()) {
                                        $selected_dept = ($current_id_dept_for_user == $row_dept_edit['Id_dept']) ? 'selected' : '';
                                        echo "<option value='{$row_dept_edit['nama_dept']}' {$selected_dept}>{$row_dept_edit['nama_dept']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_dept">Sub Departemen</label>
                                <select class="form-control" id="sub_dept_edit" name="sub_dept">
                                    <option value="">Pilih Sub Departemen</option>
                                    <?php
                                    // Pre-populate sub-departments if a department is already selected for the user
                                    if (!empty($current_id_dept_for_user)) {
                                        $stmt_sub_dept_edit = $koneksi->prepare("SELECT nama_sub_dept FROM tb_dept_sub WHERE id_dept = ? ORDER BY nama_sub_dept ASC");
                                        $stmt_sub_dept_edit->bind_param("s", $current_id_dept_for_user);
                                        $stmt_sub_dept_edit->execute();
                                        $result_sub_dept_edit = $stmt_sub_dept_edit->get_result();
                                        while ($row_sub_dept_edit = $result_sub_dept_edit->fetch_assoc()) {
                                            $selected_sub_dept = ($user_data['sub_dept'] == $row_sub_dept_edit['nama_sub_dept']) ? 'selected' : '';
                                            echo "<option value='{$row_sub_dept_edit['nama_sub_dept']}' {$selected_sub_dept}>{$row_sub_dept_edit['nama_sub_dept']}</option>";
                                        }
                                        $stmt_sub_dept_edit->close();
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Update</button>
                            <a href="index.php?page=data-user" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#nama_dept_edit').change(function(){
        var id_dept = $(this).val(); // Get Id_dept directly from value
        if(id_dept){
            $.ajax({
                type:'POST',
                url:'ambil_data.php', 
                data:{id:id_dept, modul:'sub_dept2'}, // Pass id and modul
                success:function(html){
                    $('#sub_dept_edit').html(html);
                }
            });
        } else {
            $('#sub_dept_edit').html('<option value="">Pilih Sub Departemen</option>');
        }
    });
});
</script>