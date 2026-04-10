<?php
include('koneksi.php'); 
require_once("dompdf/autoload.inc.php"); 

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options = new Options();   

// Pastikan dari data_permintaan_training.php Anda mengirimkan 'id'
$id_training = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

// Query untuk mengambil data dari tabel tb_permintaan_training berdasarkan no_tr
$query = mysqli_query($koneksi, "SELECT * FROM tb_permintaan_training WHERE no_tr='$id_training'");
$data_training = mysqli_fetch_array($query); // Mengambil satu baris data

// Jika tidak ada data ditemukan, berikan pesan error dan redirect
if (!$data_training) {
    echo "<script>alert('Data permintaan training tidak ditemukan.'); window.close();</script>";
    exit;
}

// --- Proses data 'tempat' dan 'peralatan' untuk tampilan daftar ---
$tempat_list_html = '';
if (isset($data_training['tempat']) && !empty($data_training['tempat'])) {
    $tempat_array = explode(', ', $data_training['tempat']);
    $tempat_list_html .= '<ul>';
    foreach ($tempat_array as $item) {
        $tempat_list_html .= '<li>' . htmlspecialchars($item) . '</li>';
    }
    $tempat_list_html .= '</ul>';
}

$peralatan_list_html = '';
if (isset($data_training['peralatan']) && !empty($data_training['peralatan'])) {
    $peralatan_array = explode(', ', $data_training['peralatan']);
    $peralatan_list_html .= '<ul>';
    foreach ($peralatan_array as $item) {
        $peralatan_list_html .= '<li>' . htmlspecialchars($item) . '</li>';
    }
    $peralatan_list_html .= '</ul>';
}
$alasan_list_html = '';
if (isset($data_training['alasan']) && !empty($data_training['alasan'])) {
    $alasan_array = explode(', ', $data_training['alasan']);
    $alasan_list_html .= '<ul>';
    foreach ($alasan_array as $item) {
        $alasan_list_html .= '<li>' . htmlspecialchars($item) . '</li>';
    }
    $alasan_list_html .= '</ul>';
}

$goal_list_html = '';
if (isset($data_training['goal']) && !empty($data_training['goal'])) {
    $goal_array = explode(', ', $data_training['goal']);
    $goal_list_html .= '<ul>';
    foreach ($goal_array as $item) {
        $goal_list_html .= '<li>' . htmlspecialchars($item) . '</li>';
    }
    $goal_list_html .= '</ul>';
}


$html = '<table border="2" width="100%">
        <tr>
            <th><center><img src="http://10.20.6.38/ekinerja/app/reportpdf/mse1.jpg" /></center></th>
        </tr>
		</table>';
$html .= '<table border="1" width="100%">
        <tr>
            <th><center>Permintaan Training</center></th> </tr>
		</table>';
// Tampilkan detail data permintaan training
$html .= '<table border="1" width="100%"> 
    <tr>
        <th style="text-align: left; width: 25%;">No. Dokumen</th>
        <td style="width: 25%;">FR-HRDGA-001</td>
        <th style="text-align: left; width: 25%;">Tgl Dokumen</th>
        <td style="width: 25%;">10 Maret 2025</td>
    </tr>	
	<tr>
        <th style="text-align: left; width: 25%;">Rev</th>
        <td style="width: 25%;">0</td>
        <th style="text-align: left; width: 25%;">Tgl Pengajuan Training</th>
        <td style="width: 25%;">'.(isset($data_training["tgl_pembuatan"]) ? date('d F Y', strtotime($data_training["tgl_pembuatan"])) : '').'</td>
    </tr>
    <tr>
        <th style="text-align: left;">Departemen</th>
        <td>'.(isset($data_training["departemen"]) ? $data_training["departemen"] : '').'</td>
        <th style="text-align: left;">Jabatan</th>
        <td>'.(isset($data_training["jabatan"]) ? $data_training["jabatan"] : '').'</td>
    </tr>
    <tr>
		<th style="text-align: left;">Trainer/Provider</th>
        <td>'.(isset($data_training["trainer"]) ? $data_training["trainer"] : '').'</td>
        <th style="text-align: left;">Jumlah Peserta</th>
        <td>'.(isset($data_training["jml_peserta"]) ? htmlspecialchars($data_training["jml_peserta"]) : '').'</td>
        
    </tr>
    <tr>
        <th style="text-align: left;">Tanggal Pelaksanaan</th>
        <td>'.(isset($data_training["tgl_training"]) ? date('F Y', strtotime($data_training["tgl_training"])) : '').'</td>
		<th style="text-align: left;">Waktu Pelaksanaan</th>
        <td>'.(isset($data_training["jam_training"]) ? $data_training["jam_training"] : '').'</td>
    </tr>';
$html .= '</table>';
$html .= '<br/>';
$html .='<table border="1" width="100%"> ';
$html .='
    <tr>
		<th style="text-align: left; width: 25%;">Topik/Tema Training</th>
        <td>&nbsp;'.(isset($data_training["topik"]) ? $data_training["topik"] : '').'</td>
    </tr>
    <tr>
        <th style="text-align: left;">Tempat</th>
        <td>'.$tempat_list_html.'</td> </tr>
    <tr>
        <th style="text-align: left;">Peralatan</th>
        <td>'.$peralatan_list_html.'</td> </tr>
    <tr>
        <th style="text-align: left;">Alasan Diadakan</th>
        <td>'.$alasan_list_html.'</td> </tr>
    <tr>
        <th style="text-align: left;">Goal Diadakan</th>
        <td>'.$goal_list_html.'</td> </tr>';
$html .= '</table>';
$html .= '<br/>';
$html .= '<b>Uraian Training</b>';
$html .='<table border="1" width="100%"> ';
$html .='
    <tr>
        <td colspan="3">'.(isset($data_training["uraian_training"]) ? $data_training["uraian_training"] : '').'</td>
    </tr>
</table>';
// Bagian tanda tangan
$html .= '<br/><br/>';
$html .= '<p align="right">&nbsp;&nbsp;&nbsp;Mojokerto, '. date('d F Y', strtotime($data_training["tgl_pembuatan"])) .'</p>'; // Mengambil tanggal pembuatan dari DB
$html .= '<br/>';
$html .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kepala Bagian,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HRD,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Manajemen<br/></b>';
$html .= '<br/>';
$html .= '<br/>';
$html .= '<br/>';
$html .= '<br/>';
$html .= '<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (...............................) </b>';
$html .= '</body></html>';

$dompdf->loadHtml($html);
$dompdf->set_option('isRemoteEnabled',true);
// Setting ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');
// Render HTML sebagai PDF
$dompdf->render();
// Output PDF ke browser
$dompdf->stream("permintaan_training_".$data_training["no_permintaan"].".pdf", array("Attachment" => 0));
?>