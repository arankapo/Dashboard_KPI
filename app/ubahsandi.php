<?php
include('koneksi.php'); // Sesuaikan dengan path file koneksi Anda

$sql = "SELECT Id, Password FROM tb_user WHERE LENGTH(Password) < 60"; // Asumsi password lama lebih pendek dari hash (sekitar 60 karakter untuk bcrypt)
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['Id'];
        $old_password = $row['Password'];

        // Hash password lama
        $hashed_password = password_hash($old_password, PASSWORD_DEFAULT);

        // Update database
        $update_sql = "UPDATE tb_user SET Password = ? WHERE Id = ?";
        $stmt = mysqli_prepare($koneksi, $update_sql);
        mysqli_stmt_bind_param($stmt, "si", $hashed_password, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Password untuk user ID " . $user_id . " berhasil di-hash.<br>";
        } else {
            echo "Error updating password for user ID " . $user_id . ": " . mysqli_error($koneksi) . "<br>";
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Tidak ada password lama yang perlu di-hash atau sudah di-hash.<br>";
}

mysqli_close($koneksi);
?>