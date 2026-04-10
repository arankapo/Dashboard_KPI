<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options = new Options();

// Ensure 'id' is sent, which now refers to evaluasi_training_header.id
$id_evaluasi_header = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

// Query to get data from evaluasi_training_header
$query_header = mysqli_query($koneksi, "SELECT * FROM evaluasi_training_header WHERE id='$id_evaluasi_header'");
$data_header = mysqli_fetch_array($query_header);

// If no data found for the header, provide an error message and redirect
if (!$data_header) {
    echo "<script>alert('Data evaluasi training tidak ditemukan.'); window.close();</script>";
    exit;
}

// Query to get detailed evaluation data
$query_detail = mysqli_query($koneksi, "SELECT * FROM evaluasi_training_detail WHERE id_header='$id_evaluasi_header' ORDER BY no_pertanyaan ASC");

$html = '<table border="2" width="100%">
        <tr>
            <th><center><img src="http://10.20.6.38/ekinerja/app/reportpdf/mse1.jpg" /></center></th>
        </tr>
        </table>';
$html .= '<table border="1" width="100%">
        <tr>
            <th><center>Formulir Evaluasi Training</center></th> </tr>
        </table>';

// Display header evaluation data
$html .= '<table border="1" width="100%">
    <tr>
        <th style="text-align: left; width: 25%;">No. Permintaan</th>
        <td style="width: 25%;">'.(isset($data_header["no_permintaan"]) ? htmlspecialchars($data_header["no_permintaan"]) : '').'</td>
        <th style="text-align: left; width: 25%;">Tanggal Training</th>
        <td style="width: 25%;">'.(isset($data_header["tanggal_training"]) ? date('d F Y', strtotime($data_header["tanggal_training"])) : '').'</td>
    </tr>
    <tr>
        <th style="text-align: left;">Judul Training</th>
        <td colspan="3">'.(isset($data_header["judul_training"]) ? htmlspecialchars($data_header["judul_training"]) : '').'</td>
    </tr>
    <tr>
        <th style="text-align: left;">Penyelenggara</th>
        <td>'.(isset($data_header["penyelenggara"]) ? htmlspecialchars($data_header["penyelenggara"]) : '').'</td>
        <th style="text-align: left;">Nama Peserta</th>
        <td>'.(isset($data_header["nama_peserta"]) ? htmlspecialchars($data_header["nama_peserta"]) : '').'</td>
    </tr>
    <tr>
        <th style="text-align: left;">Nama Trainer</th>
        <td>'.(isset($data_header["nama_trainer"]) ? htmlspecialchars($data_header["nama_trainer"]) : '').'</td>
        <th style="text-align: left;">Divisi</th>
        <td>'.(isset($data_header["divisi"]) ? htmlspecialchars($data_header["divisi"]) : '').'</td>
    </tr>
    <tr>
        <th style="text-align: left;">Point Pengembangan</th>
        <td colspan="3">'.(isset($data_header["point_pengembangan"]) ? nl2br(htmlspecialchars($data_header["point_pengembangan"])) : '').'</td>
    </tr>
</table>';

$html .= '<br/>';
$html .= '<b>Detail Evaluasi (Pertanyaan dan Nilai)</b>';
$html .= '<table border="1" width="100%">
    <tr>
        <th style="width: 5%;">No.</th>
        <th style="width: 80%;">Pertanyaan</th>
        <th style="width: 15%;">Nilai</th>
    </tr>';

$no = 1;
while ($data_detail = mysqli_fetch_array($query_detail)) {
    $html .= '<tr>
        <td style="text-align: center;">'.$no++.'.</td>
        <td>'.(isset($data_detail["teks_pertanyaan"]) ? htmlspecialchars($data_detail["teks_pertanyaan"]) : '').'</td>
        <td style="text-align: center;">'.(isset($data_detail["nilai"]) ? htmlspecialchars($data_detail["nilai"]) : '').'</td>
    </tr>';
}
$html .= '</table>';

$html .= '<br/>';
$html .='<table border="1" width="100%">
    <tr>
        <th style="text-align: left;"> Pencapaian</th>
        <td>'.(isset($data_header["pencapaian"]) ? nl2br(htmlspecialchars($data_header["pencapaian"])) : '').'</td>
    </tr>
    <tr>
        <th style="text-align: left;"> Alasan</th>
        <td >'.(isset($data_header["alasan"]) ? nl2br(htmlspecialchars($data_header["alasan"])) : '').'</td>
    </tr>
</table>';


$html .= '<br/>';
$html .= '<b>Pengetahuan</b>';
$html .='<table border="1" width="100%">
    <tr>
        <td colspan="3" >'.(isset($data_header["pengetahuan"]) ? nl2br(htmlspecialchars($data_header["pengetahuan"])) : '').'</td>
    </tr>
</table>';

$html .= '<br/>';
$html .= '<b>Penerapan</b>';
$html .='<table border="1" width="100%">
    <tr>
        <td colspan="3" >'.(isset($data_header["penerapan"]) ? nl2br(htmlspecialchars($data_header["penerapan"])) : '').'</td>
    </tr>
</table>';

$html .= '<br/>';
$html .= '<b>Penilaian</b>';
$html .='<table border="1" width="100%">
    <tr>
        <td colspan="3" >'.(isset($data_header["penilaian"]) ? nl2br(htmlspecialchars($data_header["penilaian"])) : '').'</td>
    </tr>
</table>';

$html .= '<br/>';
$html .= '<b>Efektivitas</b>';
$html .='<table border="1" width="100%">
    <tr>
        <td colspan="3" >'.(isset($data_header["efektivitas"]) ? nl2br(htmlspecialchars($data_header["efektivitas"])) : '').'</td>
    </tr>
</table>';


// Signature section
$html .= '<br/><br/>';
$html .= '<p align="right">Mojokerto, '. date('d F Y', strtotime($data_header["created_at"])) .'</p>'; // Using created_at from header
$html .= '<br/>';
$html .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kepala Bagian,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HRD,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Manajemen<br/></b>';
$html .= '<br/>';
$html .= '<br/>';
$html .= '<br/>';
$html .= '<br/>';
$html .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................) </b>';
$html .= '</body></html>';

$dompdf->loadHtml($html);
$dompdf->set_option('isRemoteEnabled',true);
// Setting paper size and orientation
$dompdf->setPaper('A4', 'portrait');
// Render HTML as PDF
$dompdf->render();
// Output PDF to browser
$dompdf->stream("evaluasi_training_".(isset($data_header["no_permintaan"]) ? $data_header["no_permintaan"] : 'unknown').".pdf", array("Attachment" => 0));
?>