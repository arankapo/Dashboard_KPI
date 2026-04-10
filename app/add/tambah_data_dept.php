<?php
include('../koneksi.php');
$id = $_GET['id'];
$nama = $_GET['nama'];
$sub = $_GET['sub'];
$query = mysqli_query($koneksi, "INSERT INTO tb_dept (id_dept,nama_dept,sub_dept) VALUES('$id','$nama','$sub')");
header('Location: ../index.php?page=input-data-dept');

?>