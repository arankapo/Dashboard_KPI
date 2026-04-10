<?php


$message = '';
$user_id = null;
$user_data = [];

// Memeriksa apakah pengguna sudah login (ID pengguna ada di sesi)
if (isset($_SESSION['id'])) {
    $user_id = (int)$_SESSION['id'];
    
    // Ambil data pengguna dari database
    $stmt = $koneksi->prepare("SELECT Id, Nama, Username FROM tb_user WHERE Id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
    } else {
        $message = '<div class="alert alert-danger">Pengguna tidak ditemukan. Silakan login kembali.</div>';
        $user_id = null; // Reset user_id jika tidak ditemukan
    }
    $stmt->close();
} else {
    $message = '<div class="alert alert-warning">Anda harus login untuk mengubah password.</div>';
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_id !== null) {
    
    $new_password = $_POST['password'] ?? '';  

    // Validasi input password
    if (empty($new_password)) {
        $message = '<div class="alert alert-warning">Password baru tidak boleh kosong.</div>';
    } else {

        $password_to_save = $new_password; // Menggunakan password apa adanya (tanpa hash)
        
        // **PERINGATAN KEAMANAN:** Sebaiknya gunakan `password_hash()` untuk menyimpan password dengan aman.
        $password_to_save = password_hash($new_password, PASSWORD_DEFAULT);

        $stmt = $koneksi->prepare("UPDATE tb_user SET Password = ? WHERE Id = ?");
        $stmt->bind_param("si", $password_to_save, $user_id); // 's' for string (password), 'i' for integer (user_id)

        if ($stmt->execute()) {
            $message = '<div class="alert alert-success">Password berhasil diperbarui!</div>';
            // Tidak perlu me-refresh user_data karena hanya password yang berubah
        } else {
            $message = '<div class="alert alert-danger">Error saat memperbarui password: ' . $stmt->error . '</div>';
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
                        <h3 class="card-title">Ganti Password</h3>
                    </div>
                    <?php echo $message; // Menampilkan pesan status ?>
                    
                    <?php if ($user_id !== null && !empty($user_data)): // Tampilkan form hanya jika user_id valid dan data pengguna ada ?>
                    <form action="" method="POST">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user_data['Nama']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user_data['Username']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="password">Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Ubah Password</button>
                            <a href="index.php?page=dashboard" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                    <?php else: ?>
                        <div class="card-body">
                            <p>Tidak dapat menampilkan formulir ganti password. Pastikan Anda sudah login.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>