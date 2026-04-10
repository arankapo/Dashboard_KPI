<?php
include('koneksi.php');
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options = new Options();
// Penting: Aktifkan isRemoteEnabled agar Dompdf bisa memuat gambar dari URL HTTP
$options->set('isRemoteEnabled', true);
$dompdf->setOptions($options);

// Memastikan parameter 'id' diterima dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: ID Exit Interview tidak ditemukan.");
}

$id_exit_interview = $_GET['id'];

// --- Query untuk data HEADER Exit Interview ---
$query_header = mysqli_query($koneksi, "SELECT * FROM `tb_exit_interview_header` WHERE id_exit_interview='" . mysqli_real_escape_string($koneksi, $id_exit_interview) . "'");
$data_header = mysqli_fetch_array($query_header);

if (!$data_header) {
    die("Data Exit Interview dengan ID " . htmlspecialchars($id_exit_interview) . " tidak ditemukan.");
}

// --- Query untuk data DETAIL Exit Interview
$query_detail = mysqli_query($koneksi, "
    SELECT
        ted.no_pertanyaan,
        ted.nilai,
        ted.tipe,
        tp.deskripsi AS pertanyaan_text_from_db
    FROM
        tb_exit_interview_detail ted
    JOIN
        tb_pertanyaan tp ON ted.no_pertanyaan = tp.No AND ted.tipe = tp.tipe
    WHERE
        ted.id_exit_interview = '" . mysqli_real_escape_string($koneksi, $id_exit_interview) . "'
    ORDER BY
        ted.tipe ASC, ted.no_pertanyaan ASC
");

// --- Query untuk data SERAH TERIMA ---
$query_serah_terima = mysqli_query($koneksi, "SELECT * FROM `tb_exit_interview_serah_terima` WHERE id_exit_interview='" . mysqli_real_escape_string($koneksi, $id_exit_interview) . "'");
$data_serah_terima = mysqli_fetch_array($query_serah_terima);


$html = '';
$html .= '<table border="2" width="100%">
        <tr>
            <th><center><img src="http://10.20.6.38/ekinerja/app/reportpdf/mse1.jpg" /></center></th>
        </tr>
		</table>';

$html .= '<table border="1" width="100%">
            <tr>
                <th><center>EXIT INTERVIEW FORM</center></th>
            </tr>
          </table>';

$html .= '<table border="1" width="100%">
    <tr>
        <th style="text-align: left;" width="22%">Nama Karyawan</th>
        <td>' . htmlspecialchars($data_header['namakaryawan']) . '</td>
         <th style="text-align: left;">NIK</th>
        <td>' . htmlspecialchars($data_header['nik']) . '</td>
    </tr>

    <tr>
        <th style="text-align: left;">Divisi</th>
        <td>' . htmlspecialchars($data_header['divisi']) . '</td>
        <th style="text-align: left;">Departemen</th>
        <td>' . htmlspecialchars($data_header['nama_dept']) . '</td>
    </tr>
    <tr>
        <th style="text-align: left;">Jabatan</th>
        <td>' . htmlspecialchars($data_header['jabatan']) . '</td>
        <th style="text-align: left;">No. Telepon</th>
        <td>' . htmlspecialchars($data_header['no_telp']) . '</td>
    </tr>
    <tr>
        <th style="text-align: left;">Tanggal Masuk</th>
        <td>' . htmlspecialchars($data_header['tanggal_masuk']) . '</td>
        <th style="text-align: left;">Tanggal Resign</th>
        <td>' . htmlspecialchars($data_header['tanggal_resign']) . '</td>
    </tr>
    </table><br>';

$current_tipe = ''; // Variabel untuk melacak tipe saat ini

// Memastikan pointer hasil query diatur ulang ke awal jika sudah pernah digunakan
mysqli_data_seek($query_detail, 0);

if (mysqli_num_rows($query_detail) > 0) {
    while ($detail_row = mysqli_fetch_array($query_detail)) {
        // Cek jika 'tipe' telah berubah
        if ($detail_row['tipe'] != $current_tipe) {
            // Tutup tabel sebelumnya jika bukan yang pertama
            if ($current_tipe != '') {
                $html .= '</tbody></table><br>';
            }
            // Perbarui tipe saat ini
            $current_tipe = $detail_row['tipe'];
            $no_urut = 1; // Reset nomor pertanyaan untuk setiap tipe baru
            // Tambahkan judul untuk tipe baru

            // Mulai tabel baru untuk tipe ini
            $html .= '<table border="1" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th width="75%">Pertanyaan</th>
                                <th width="20%">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>';
        }
        $html .= '<tr>
                    <td class="center-text">' . htmlspecialchars($detail_row['no_pertanyaan']) . '</td>
                    <td>' . htmlspecialchars($detail_row['pertanyaan_text_from_db']) . '</td>
                    <td>' . htmlspecialchars($detail_row['nilai']) . '</td>
                  </tr>';
    }
    // Tutup tabel terakhir setelah loop selesai
    $html .= '</tbody></table><br>';
} else {
    $html .= '<p class="center-text">Tidak ada detail wawancara ditemukan.</p>';
}

// --- Bagian Laporan Serah Terima ---
if ($data_serah_terima) {
    $html .= '<br/><table border="1" width="100%">';
    $html .= '<thead>';
    $html .= '<tr><th colspan="2">Penyelesaian di Setiap Departemen</th><th>Penjelasan</th><th>Nama</th><th>Verifikasi Head of Dept</th></tr>';
    $html .= '</thead>';
    $html .= '<tbody>';

    // A. FINANCE & ACCOUNTING
    $html .= '<tr><td rowspan="6">A.</td><td rowspan="6">FINANCE & ACCOUNTING</td><td>1. Penyelesaian Klaim Asuransi</td><td></td><td>' . htmlspecialchars($data_serah_terima['klaim_asuransi']) . '</td></tr>';
    $html .= '<tr><td>2. Penyelesaian Klaim Produksi</td><td></td><td>' . htmlspecialchars($data_serah_terima['klaim_produksi']) . '</td></tr>';
    $html .= '<tr><td>3. Penyelesaian Pinjaman Karyawan</td><td></td><td>' . htmlspecialchars($data_serah_terima['pinjaman_karyawan']) . '</td></tr>';
    $html .= '<tr><td>4. Penyelesaian Pinjaman Bank Mandiri</td><td></td><td>' . htmlspecialchars($data_serah_terima['pinjaman_bank_mandiri']) . '</td></tr>';
    $html .= '<tr><td>5. Penyelesaian Kas Bon</td><td></td><td>' . htmlspecialchars($data_serah_terima['kas_bon']) . '</td></tr>';
    $html .= '<tr><td>6. Lain-lain</td><td></td><td></td></tr>'; // No specific field for "Lain-lain" in DB

    // B. IT
    $html .= '<tr><td rowspan="5">B.</td><td rowspan="5">IT</td><td>1. Pengembalian Komputer/Notebook</td><td></td><td>' . htmlspecialchars($data_serah_terima['pengembalian_komputer']) . '</td></tr>';
    $html .= '<tr><td>2. Penghapusan Alamat Email</td><td></td><td>' . htmlspecialchars($data_serah_terima['penghapusan_email']) . '</td></tr>';
    $html .= '<tr><td>3. Penghapusan User ID dari Sistem</td><td></td><td>' . htmlspecialchars($data_serah_terima['penghapusan_user_id']) . '</td></tr>';
    $html .= '<tr><td>4. Pengembalian Fasilitas Lain</td><td></td><td>' . htmlspecialchars($data_serah_terima['pengembalian_fasilitas_it']) . '</td></tr>';
    $html .= '<tr><td>5. Lain-lain</td><td></td><td></td></tr>'; // No specific field for "Lain-lain" in DB
    
    // C. DEPARTEMEN KARYAWAN
    $html .= '<div style="page-break-before: always;"></div>';
    $html .= '<tr><td rowspan="8">C.</td><td rowspan="8">DEPARTEMEN KARYAWAN</td><td>1. Pengembalian Data</td><td></td><td></td></tr>';
    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;a. Laporan-laporan</td><td></td><td>' . htmlspecialchars($data_serah_terima['pengembalian_data_laporan']) . '</td></tr>';
    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;b. Penyimpanan data soft copy</td><td></td><td>' . htmlspecialchars($data_serah_terima['penyimpanan_softcopy']) . '</td></tr>';
    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;c. Penyerahan password data</td><td></td><td>' . htmlspecialchars($data_serah_terima['penyerahan_password']) . '</td></tr>';
    $html .= '<tr><td>2. Pengembalian Contact Person</td><td></td><td></td></tr>';
    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;a. Telepon kode bintang</td><td></td><td>' . htmlspecialchars($data_serah_terima['kontak_telepon_bintang']) . '</td></tr>';
    $html .= '<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;b. Data contact customer/provider terkait</td><td></td><td>' . htmlspecialchars($data_serah_terima['kontak_customer_provider']) . '</td></tr>';
    $html .= '<tr><td>3. Lain-lain</td><td></td><td></td></tr>';

    // D. HUMAN RESOURCE - GENERAL AFFAIR
    $html .= '<tr><td rowspan="7">D.</td><td rowspan="7">HUMAN RESOURCE - GENERAL AFFAIR</td><td>1. Pengembalian ID Card</td><td></td><td>' . htmlspecialchars($data_serah_terima['pengembalian_id_card']) . '</td></tr>';
    $html .= '<tr><td>2. Pengembalian Kunci Locker/Ruang</td><td></td><td>' . htmlspecialchars($data_serah_terima['pengembalian_kunci_locker']) . '</td></tr>';
    $html .= '<tr><td>3. Pengembalian Handphone/Blackberry</td><td></td><td>' . htmlspecialchars($data_serah_terima['pengembalian_handphone']) . '</td></tr>';
    $html .= '<tr><td>4. Pengembalian Kendaraan Dinas</td><td></td><td>' . htmlspecialchars($data_serah_terima['pengembalian_kendaraan_dinas']) . '</td></tr>';
    $html .= '<tr><td>5. Pengembalian buku Peraturan Perusahaan.</td><td></td><td>' . htmlspecialchars($data_serah_terima['pengembalian_buku_peraturan']) . '</td></tr>';
    $html .= '<tr><td>6. Penyelesaian Sisa Cuti</td><td></td><td>' . htmlspecialchars($data_serah_terima['penyelesaian_sisa_cuti']) . '</td></tr>';
    $html .= '<tr><td>7. Lain-lain</td><td></td><td></td></tr>'; // No specific field for "Lain-lain" in DB

    // E. DOKUMEN
    $html .= '<tr><td rowspan="7">E.</td><td rowspan="7">DOKUMEN</td><td>1. Surat Pengunduran Diri</td><td></td><td>' . htmlspecialchars($data_serah_terima['surat_pengunduran_diri']) . '</td></tr>';
    $html .= '<tr><td>2. Surat Tidak Perpanjang Kontrak</td><td></td><td>' . htmlspecialchars($data_serah_terima['surat_tidak_perpanjang_kontrak']) . '</td></tr>';
    $html .= '<tr><td>3. Perhitungan Kompensasi</td><td></td><td>' . htmlspecialchars($data_serah_terima['hitung_kompensasi']) . '</td></tr>';
    $html .= '<tr><td>4. Exit Interview</td><td></td><td>' . htmlspecialchars($data_serah_terima['exit_interview']) . '</td></tr>';
    $html .= '<tr><td>5. Memo Karyawan Keluar</td><td></td><td>' . htmlspecialchars($data_serah_terima['memo_karyawan_keluar']) . '</td></tr>';
    $html .= '<tr><td>6. Surat Pernyataan Pengakhiran Hubungan Kerja</td><td></td><td>' . htmlspecialchars($data_serah_terima['surat_akhir_hubungan_kerja']) . '</td></tr>';
    $html .= '<tr><td>7. Surat Pengangkatan SK Tetap</td><td></td><td>' . htmlspecialchars($data_serah_terima['surat_sk_tetap']) . '</td></tr>';

    $html .= '</tbody></table><br/>';
}

// --- Bagian Keterangan ---
if (!empty($data_header['keterangan'])) {
    $html .= '<br/>'; // Tambahkan baris kosong untuk pemisah
    $html .= '<h3>Keterangan:</h3>';
    $html .= '<br/>'; // Tambahkan baris kosong untuk pemisah
    $html .= '<table border="1" width="100%">';
    $html .= '<tr>';
    $html .= '<td>' . nl2br(htmlspecialchars($data_header['keterangan'])) . '</td>';
    $html .= '</tr>';
    $html .= '</table>';
}

// --- Bagian Tanda Tangan ---
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


$html .= "</html>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Exit_Interview_" . $data_header['nik'] . ".pdf", array("Attachment" => 0));
exit();
?>