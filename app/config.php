<?php 

$con = mysqli_connect('localhost','root','','ekinerja')or die(mysqli_error($con));
if (!$con) {
    echo "Koneksi Gagal!";
}


?>