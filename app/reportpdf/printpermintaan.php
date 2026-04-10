<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
use Dompdf\Options;
$dompdf = new Dompdf();
$options = new Options();
$nik = $_GET['nik'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_permintaan_karyawan WHERE no_permintaan='$nik'");
$html = '<table border="2" width="100%">
        <tr>
            <th><center><img src="http://10.20.6.38/ekinerja/app/reportpdf/mse1.jpg" /></center></th>
        </tr>
		</table>';
		
$html .= '<table border="1" width="100%">
        <tr>
            <th><center>Permintaan Karyawan</center></th>
        </tr>
		</table>';

$no = 1;
while($row = mysqli_fetch_array($query))
{
    $html .='<table border="1" width="100%"> 
	"<tr>
	    <th style="text-align: left;" width="16%">No Formulir</th>
        <td width="10%">'.$row["no_dok"].'</td>
		<th style="text-align: left;">Penempatan</th>
        <td>'.$row["penempatan"].'</td>
        <th style="text-align: left;">Tanggal Efektif</th>
        <td>'.date("d-m-Y",strtotime($row["tanggal_pengajuan"])).'</td>
    </tr>";
	
	"<tr>
	    <th style="text-align: left;">Tgl Pengajuan</left></th>
        <td >'.date("d-m-Y",strtotime($row["tanggal_pengajuan"])).'</td>
		<th style="text-align: left;">Bagian</th>
        <td>'.$row["jabatan"].'</td>
		<th style="text-align: left;">Tanggal Approval</th>
		<td>'.date("d-m-Y",strtotime($row["tanggal_approve"])).'</td>
        
    </tr>"
	
	"<tr>
	    <th style="text-align: left;">Klasisifikasi</left></th>
        <td>'.$row["klasifikasi"].'</td>
		<th style="text-align: left;">Jam Kerja</th>
        <td>'.$row["jam_kerja"].'</td>
		<th style="text-align: left;">Tgl Pemenuhan</th>
        <td>'.date("d-m-Y",strtotime($row["tanggal_pemenuhan"])).'</td>
    </tr>"
	
	"<tr>
	    <th style="text-align: left;">Departement</left></th>
        <td>'.$row["nama_dept"].'</td>
		<th style="text-align: left;">Status</th>
        <td>'.$row["status_karyawan"].'</td>
		<th style="text-align: left;">Jumlah Permintaan</th>
        <td>'.$row["jumlah"].'</td>
    </tr>"
	</table>';
	$html .= '<br/>';
	$html .= '<b>Kualifikasi Karyawan</b>';
	$html .='<table border="1" width="100%"> 
	"<tr>
	    <th style="text-align: left;" width="17%">Jenis kelamin</th>
        <td width="14%">'.$row["jenis_kelamin"].'</td>
		<th style="text-align: left;" width="17%">Usia</th>
        <td width="14%">'.$row["usia"].'</td>
    </tr>";
	"<tr>
		<th width="15%" style="text-align: left;">Pendidikan</th>
        <td width="10%">'.$row["pendidikan_minimum"].'</td>
		<th width="15%" style="text-align: left;">Jurusan Pend</th>
        <td width="10%">'.$row["jurusan"].'</td>
    </tr>";	
	"<tr>
	    <th width="15%" style="text-align: left;">Pengalaman kerja</th>
        <td width="10%">'.$row["pengalaman"].'</td>
        <th width="15%" style="text-align: left;">Kualifikasi Tambahan</th>
        <td width="10%">'.$row["k_tambahan"].'</td>
    </tr>";
	</table>';
	$html .= '<br/>';
	$html .= '<b>Alasan Penambahan / Penggantian :</b>';
	$html .='<table border="1" width="100%"> 
	"<tr>
        <td>'.$row["alasan"].'</td>
    </tr>";		
	</table>';
	$html .= '<br/>';
	$html .= '<b>Job Deskripsi :</b>';
	$html .='<table border="1" width="100%"> 
	"<tr>
        <td>'.$row["job_desk"].'</td>
    </tr>";	
	</table>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kepala Bagian,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HRD,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Manajemen<br/></b>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................) </b>';
	$html .= '<br/>';
}

$no++;

$html .= "</html>";
$dompdf->set_option('isRemoteEnabled',true);
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('Legal', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Permintaan_Karyawan.pdf', array("Attachment" => false));
?>