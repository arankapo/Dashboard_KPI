<?php
include('koneksi.php');

$id = $_POST['id'];
$modul = $_POST['modul'];

if ($modul == 'Kabupaten') {
    if($id=='SP_OS'){
        $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nama_dept='STOCK PREPARATION (SP)_OS' order by nama_karyawan ASC") or die(mysqli_error($con));
       $kabupaten = '<option>---Pilih Karyawan---</option>';
       while ($dt = mysqli_fetch_array($sql)) {
           $kabupaten .= '<option value="' . $dt['nik_karyawan'] . '">' . $dt['nama_karyawan'] . '</option>';
       }
    
        echo $kabupaten;
    }
    else {
        $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nama_dept='$id' order by nama_karyawan ASC") or die(mysqli_error($con));
        $kabupaten = '<option>---Pilih Karyawan---</option>';
        while ($dt = mysqli_fetch_array($sql)) {
            $kabupaten .= '<option value="' . $dt['nik_karyawan'] . '">' . $dt['nama_karyawan'] . '</option>';
        }

        echo $kabupaten;
    }
    
} else if ($modul == 'nik') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $nik .= '<option value="' . $dt['nik_karyawan'] . '">' . $dt['nik_karyawan'] . '</option>';
    }
	


    echo $nik;
	 
} else if ($modul == 'sub_dept') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $sub_dept .= '<option value="' . $dt['sub_dept'] . '">' . $dt['sub_dept'] . '</option>';
    }
	


    echo $sub_dept;	
} else if ($modul == 'tgl_masuk') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $tgl_masuk .= '<option value="' . $dt['tgl_masuk'] . '">' . $dt['tgl_masuk'] . '</option>';
    }
	


    echo $tgl_masuk;	
	
} else if ($modul == 'lama_bekerja') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $lama_bekerja .= '<option value="' . $dt['lama_bekerja'] . '">' . $dt['lama_bekerja'] . '</option>';
    }
	


    echo $lama_bekerja;	

}else if ($modul == 'grade_sebelum') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $grade_sebelum .= '<option value="' . $dt['grade_sebelum'] . '">' . $dt['grade_sebelum'] . '</option>';
    }
	


    echo $grade_sebelum;	
}else if ($modul == 'grade_sesudah') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $grade_sesudah .= '<option value="' . $dt['grade_sesudah'] . '">' . $dt['grade_sesudah'] . '</option>';
    }
	


    echo $grade_sesudah;	
}else if ($modul == 'grade_sesudah') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $grade_sesudah .= '<option value="' . $dt['grade_sesudah'] . '">' . $dt['grade_sesudah'] . '</option>';
    }
	


    echo $grade_sesudah;	
}else if ($modul == 'tanggal_perubahan') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $tanggal_perubahan .= '<option value="' . $dt['tanggal_perubahan'] . '">' . $dt['tanggal_perubahan'] . '</option>';
    }
	


    echo $tanggal_perubahan;	
}else if ($modul == 'status') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $status .= '<option value="' . $dt['status'] . '">' . $dt['status'] . '</option>';
    }
	


    echo $status;	
}else if ($modul == 'perubahan') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $perubahan .= '<option value="' . $dt['perubahan'] . '">' . $dt['perubahan'] . '</option>';
    }
	


    echo $perubahan;
}else if ($modul == 'periode') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $periode .= '<option value="' . $dt['periode'] . '">' . $dt['periode'] . '</option>';
    }
	


    echo $periode;
}else if ($modul == 'jabatan') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $jabatan .= '<option value="' . $dt['jabata_karyawan'] . '">' . $dt['jabatan_karyawan'] . '</option>';
    }
	


    echo $jabatan;
}else if ($modul == 'detail_karyawan') {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan_outs where nik_karyawan='$id' order by nama_karyawan ASC") or die(mysqli_error($koneksi));
    while ($dt = mysqli_fetch_array($sql)) {
        $jabatan .= '<option value="' . $dt['jabata_karyawan'] . '">' . $dt['jabatan_karyawan'] . '</option>';
    }
	


    echo $jabatan;
}
?>