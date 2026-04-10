<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
use Dompdf\Options;
$dompdf = new Dompdf();
$options = new Options();
$no = $_GET['nik'];
$query = mysqli_query($koneksi,"SELECT * FROM tb_nilai_karyawan WHERE no_tr='$no'");
$html = '<table border="2" width="100%">
        <tr>
            <th><center><img src="http://10.20.6.38/ekinerja/app/reportpdf/mse1.jpg" /></center></th>
        </tr>
		</table>';
		
$html .= '<table border="1" width="100%">
        <tr>
            <th><center>Penilaian Karyawan</center></th>
        </tr>
		</table>';

$no = 1;
while($row = mysqli_fetch_array($query))
{
    $html .='<table border="1" width="100%"> 
	"<tr>
	    <th style="text-align: left;" width="17%">Jenis Penilaian</th>
        <td width="14%">'.$row["no_dok"].'</td>
		<th width="10%" style="text-align: left;">Revisi</th>
        <td width="12%">'.$row["revisi"].'</td>
        <th width="15%" style="text-align: left;">Tanggal Efektif</th>
        <td width="10%">'.date("d-m-Y",strtotime($row["tanggal_efektif"])).'</td>
    </tr>";
	
	"<tr>
	    <th style="text-align: left;">Departement</left></th>
        <td>'.$row["nama_dept"].'</td>
		<th style="text-align: left;">Unit Kerja</th>
        <td>'.$row["unit_kerja"].'</td>
        <th style="text-align: left;">Periode</th>
        <td>'.$row["periode"].'</td>
    </tr>"
	</table>';
	
	$html .='<table border="1" width="100%"> 
	"<tr>
	    <th width="22%" style="text-align: left;">Nama Karyawan</th>
        <td>'.$row["nama_karyawan"].'</td>
    </tr>";	
	"<tr>
	    <th style="text-align: left;">NIK</th>
        <td>'.$row["nik"].'</td>
    </tr>";
	"<tr>
	   <th style="text-align: left;">Jabatan</th>
        <td>'.$row["jabatan"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">Departement</th>
        <td>'.$row["sub_dept"].'</td>	
    </tr>";
	</table>';
	$html .= '<b>PENCAPAIAN KINERJA KUANTITATIF<br/></b>';
	$html .= '<b>A. Indeks Prestasi Kunci W = 50%</b>';
	$html .='<table border="1" width="100%"> 
	"<tr>
	    <th style="text-align: left;">1. Pencapaian Target / Hasil Kerja</th>
        <td width="12%" style="text-align: center;">'.$row["nilaia1"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">Skor A</th>
        <td style="text-align: center;">'.$row["skora"].'</td>
    </tr>";
	</table>';
	
	$html .= '<b>B. Kemampuan Individu W = 30%</b>';
	$html .='<table border="1" width="100%"> 
	"<tr>
	    <th style="text-align: left;">1. Upaya Ekstra :</th>
        <td width="12%" style="text-align: center;">'.$row["nilaib1"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">2. Bekerja Dibawah Tekanan</th>
        <td style="text-align: center;">'.$row["nilaib2"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">3. Kemampuan Teknis</th>
        <td style="text-align: center;">'.$row["nilaib3"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">4. Pengetahuan Sesuai tuntutan jabatan</th>
        <td style="text-align: center;">'.$row["nilaib4"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">5. Keterampilan Keahlian di bidangnya</th>
        <td style="text-align: center;">'.$row["nilaib5"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">6. Kualitas Kerja</th>
        <td style="text-align: center;">'.$row["nilaib6"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">7. Kerapihan / Dokumentasi</th>
        <td style="text-align: center;">'.$row["nilaib7"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">8. Disiplin Kerja</th>
        <td style="text-align: center;">'.$row["nilaib8"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">9. Inovasi / Ide Kreatif</th>
        <td style="text-align: center;">'.$row["nilaib9"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">10. Motivasi Kerja</th>
        <td style="text-align: center;">'.$row["nilaib10"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">Skor B</th>
        <td style="text-align: center;">'.$row["skorb"].'</td>
    </tr>";
	</table>';
	
	$html .= '<b>C. Kemampuan Manajerial W = 20%</b>';
	$html .='<table border="1" width="100%"> 
	"<tr>
	    <th style="text-align: left;">1. Kerjasama Team</th>
        <td width="12%" style="text-align: center;">'.$row["nilaic1"].'</td>
    </tr>";
	"<tr>
	    <th style="text-align: left;">2. Kepedulian Terhadap Lingkungan</th>
        <td style="text-align: center;">'.$row["nilaic2"].'</td>
    
	"<tr>
	"<tr>
	    <th style="text-align: left;">3. Kepedulian Terhadap Keselamatan Kerja</th>
        <td style="text-align: center;">'.$row["nilaic3"].'</td>
    
	"<tr>
	"<tr>
	    <th style="text-align: left;">4. Kemampuan Untuk Menangani Masalah</th>
        <td style="text-align: center;">'.$row["nilaic4"].'</td>
    
	"<tr>
	"<tr>
	    <th style="text-align: left;">5. Pemberian Ide</th>
        <td style="text-align: center;">'.$row["nilaic5"].'</td>
    
	"<tr>	
	    <th style="text-align: left;">Skor C</th>
        <td style="text-align: center;">'.$row["skorc"].'</td>
    </tr>";
	"<tr>	
	    <th style="text-align: left;">Total Skor</th>
        <td style="text-align: center;">'.$row["totalskor"].'</td>
    </tr>";
	"<tr>	
	    <th style="text-align: left;">Hasil Skor</th>
        <td style="text-align: center;">'.$row["hurufskor"].'</td>
    </tr>";
	"<tr>	
	    <th style="text-align: left;">Catatan</th>
        <td>.</td>
    </tr>";
	</table>';
	
	$html .='<table border="1" width="100%"> 
	"<tr>
        <td>'.$row["catatan"].'</td>
    </tr>";	
	</table>';	
	$html .= '<br/>';
	$html .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Karyawan,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Supervisor,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kepala Bagian,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HRD,<br/></b>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................)</b>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<br/>';
	$html .= '<br/>';
	

	$html .='<table border="1" width="100%"> 
	"<tr>
        <th width="22%" style="text-align: left;">Rekomendasi</th>
		<td>'.$row["rekomendasi"].'</td>
    </tr>";
	"<tr>
		<th width="22%" style="text-align: left;">Jenis Perubahan</th>
		<td>'.$row["jenis_perubahan"].'</td>
    </tr>";	
	</table>';
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
$dompdf->stream('KPI.pdf', array("Attachment" => false));
?>