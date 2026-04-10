<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$nik = $_GET['nik'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_nilai_karyawan WHERE nik='$nik'");
$html = '<center><h3>Daftar Nama Siswa</h3></center><hr/><br/>';
$html .= '<table border="3" width="100%">
        <tr>
            <th><center><h3>Daftar Nama Siswa</h3></center><hr/><br/></th>
        </tr>';

$no = 1;
while($row = mysqli_fetch_array($query))
{
    $html .='<table border="3" width="100%"> 
	"<tr>
	    <th width="20%">Jenis Penilaian</th>
        <td width="8%">'.$row["no_dok"].'</td>
		<th>Revisi</th>
        <td>'.$row["revisi"].'</td>
        <th>Tanggal</th>
        <td>'.date("d-m-Y",strtotime($row["tanggal_efektif"])).'</td>
    </tr>";
	
	"<tr>
	    <th>Departement</th>
        <td>'.$row["nama_dept"].'</td>
		<th>Unit Kerja</th>
        <td>'.$row["unit_kerja"].'</td>
        <th>Periode</th>
        <td>'.$row["periode"].'</td>
    </tr>";
	
	"<tr>
	    <th>Nama Karyawan</th>
        <td>'.$row["nama_karyawan"].'</td>
    </tr>";	
	"<tr>
	    <th>NIK</th>
        <td>'.$row["nik"].'</td>
    </tr>";
	"<tr>
	    <th>Jabatan</th>
        <td>'.$row["jabatan"].'</td>
    </tr>";
	"<tr>
	    <th>Departement</th>
        <td>'.$row["sub_dept"].'</td>
    </tr>";
	"<tr>
	    <th>1. Pencapaian Target / Hasil Kerja</th>
        <td>'.$row["nilaia1"].'</td>
    </tr>";
	"<tr>
	    <th>Skor A</th>
        <td>'.$row["skora"].'</td>
    </tr>";
	"<tr>
	    <th>1. Upaya Ekstra :</th>
        <td>'.$row["nilaib1"].'</td>
    </tr>";
	"<tr>
	    <th>2. Bekerja Dibawah Tekanan</th>
        <td>'.$row["nilaib2"].'</td>
    </tr>";
	"<tr>
	    <th>3. Kemampuan Teknis</th>
        <td>'.$row["nilaib3"].'</td>
    </tr>";
	"<tr>
	    <th>4. Pengetahuan Sesuai tuntutan jabatan</th>
        <td>'.$row["nilaib4"].'</td>
    </tr>";
	"<tr>
	    <th>5. Keterampilan Keahlian di bidangnya</th>
        <td>'.$row["nilaib5"].'</td>
    </tr>";
	"<tr>
	    <th>6. Kualitas Kerja</th>
        <td>'.$row["nilaib6"].'</td>
    </tr>";
	"<tr>
	    <th>7. Kerapihan / Dokumentasi</th>
        <td>'.$row["nilaib7"].'</td>
    </tr>";
	"<tr>
	    <th>8. Disiplin Kerja</th>
        <td>'.$row["nilaib8"].'</td>
    </tr>";
	"<tr>
	    <th>9. Inovasi / Ide Kreatif</th>
        <td>'.$row["nilaib9"].'</td>
    </tr>";
	"<tr>
	    <th>10. Motivasi Kerja</th>
        <td>'.$row["nilaib10"].'</td>
    </tr>";
	"<tr>
	    <th>Skor B</th>
        <td>'.$row["skorb"].'</td>
    </tr>";
	"<tr>
	    <th>1. Kerjasama Team</th>
        <td>'.$row["nilaic1"].'</td>
    </tr>";
	"<tr>
	    <th>2. Kepedulian Terhadap Lingkungan</th>
        <td>'.$row["nilaic2"].'</td>
    
	"<tr>
	    <th>Skor C</th>
        <td>'.$row["skorc"].'</td>
    </tr>"';
	
	
	
   
}

$no++;

$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('KPI.pdf');
?>