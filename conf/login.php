<?php
session_start();
include('koneksi.php'); 


$username = $_POST['username'] ?? ''; 
$password = $_POST['password'] ?? '';


if (empty($username) && empty($password)) {
    header('Location:../index.php?error=empty_both');
    exit();
} elseif (empty($username)) {
    header('Location:../index.php?error=empty_username');
    exit();
} elseif (empty($password)) {
    header('Location:../index.php?error=empty_password');
    exit();
}

// Gunakan prepared statement untuk mencegah SQL Injection
$query_stmt = mysqli_prepare($koneksi, "SELECT Id, Nama, Level, nama_dept, sub_dept, Password, Username FROM tb_user WHERE username=?"); // Tambahkan 'Username' di SELECT

if (!$query_stmt) {
    header('Location:../index.php?error=db_prepare_error'); 
    exit();
}

mysqli_stmt_bind_param($query_stmt, "s", $username);
mysqli_stmt_execute($query_stmt);
$result = mysqli_stmt_get_result($query_stmt);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result); 
    $stored_hashed_password = $user['Password'];
    if (password_verify($password, $stored_hashed_password)) {
        $_SESSION['id'] = $user['Id'];
        $_SESSION['nama'] = $user['Nama'];
        $_SESSION['level'] = $user['Level'];
        $_SESSION['dept'] = $user['nama_dept'];
        $_SESSION['sub_dept'] = $user['sub_dept'];
        header('Location:../app');
        exit();
    } else {
        header('Location:../index.php?error=wrong_password'); 
        exit();
    }
} else {
    header('Location:../index.php?error=not_found'); 
    exit();
}
mysqli_stmt_close($query_stmt);
?>