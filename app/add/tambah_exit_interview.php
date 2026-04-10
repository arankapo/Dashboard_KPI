<?php
include('../../conf/koneksi.php');

// Pastikan koneksi.php mengembalikan objek $koneksi (mysqli object)
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// --- BAGIAN 1: GENERASI ID UNTUK EXIT INTERVIEW (akan digunakan di header dan detail) ---
$today_date = date("Ymd");
$id_prefix = "EXIN" . $today_date . "";

// Dapatkan Nomor Urut Terakhir untuk Hari Ini dari kolom id_exit_interview di tabel header
$query_get_max_urut = "SELECT MAX(SUBSTRING(id_exit_interview, LENGTH(?) + 1)) AS max_urut
                       FROM tb_exit_interview_header
                       WHERE id_exit_interview LIKE CONCAT(?, '%')";

$stmt_get_max = mysqli_prepare($koneksi, $query_get_max_urut);
if ($stmt_get_max === false) {
    die("Gagal mempersiapkan query MAX_URUT: " . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($stmt_get_max, "ss", $id_prefix, $id_prefix);
mysqli_stmt_execute($stmt_get_max);
$result_max_urut = mysqli_stmt_get_result($stmt_get_max);
$row_max_urut = mysqli_fetch_assoc($result_max_urut);
$max_urut = $row_max_urut['max_urut'];

$new_urut = 1;
if ($max_urut !== null && is_numeric($max_urut)) {
    $new_urut = (int)$max_urut + 1;
}

$formatted_urut = sprintf("%03d", $new_urut);
$id_wawancara_sesi = $id_prefix . $formatted_urut; // Ini adalah ID unik untuk sesi wawancara ini

// --- BAGIAN 2: AMBIL DATA HEADER DARI $_GET DAN MASUKKAN KE tb_exit_interview_header ---

$namakaryawan = isset($_GET['namakaryawan']) ? $_GET['namakaryawan'] : '';
$nama_dept = isset($_GET['nama_dept']) ? $_GET['nama_dept'] : '';
$nik = isset($_GET['nik']) ? $_GET['nik'] : '';
$jabatan = isset($_GET['jabatan']) ? $_GET['jabatan'] : '';
$divisi = isset($_GET['divisi']) ? $_GET['divisi'] : '';
$no_telp = isset($_GET['no_telp']) ? $_GET['no_telp'] : '';
$tanggal_masuk = isset($_GET['tanggal_masuk']) ? $_GET['tanggal_masuk'] : null;
$tanggal_resign = isset($_GET['tanggal_resign']) ? $_GET['tanggal_resign'] : null;
$keterangan = isset($_GET['keterangan']) ? $_GET['keterangan'] : null;

// Query INSERT untuk tabel header
$sql_insert_header = "INSERT INTO tb_exit_interview_header
                      (id_exit_interview, namakaryawan, nama_dept, nik, jabatan, divisi, no_telp, tanggal_masuk, tanggal_resign,keterangan)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt_header = mysqli_prepare($koneksi, $sql_insert_header);
if ($stmt_header === false) {
    die("Gagal mempersiapkan statement INSERT header: " . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($stmt_header, "ssssssssss",
    $id_wawancara_sesi,
    $namakaryawan,
    $nama_dept,
    $nik,
    $jabatan,
    $divisi,
    $no_telp,
    $tanggal_masuk,
    $tanggal_resign,
    $keterangan
);

$header_insert_success = false;
if (mysqli_stmt_execute($stmt_header)) {
    $header_insert_success = true;
} else {
    echo "<h3 style='color: red;'>Gagal memasukkan Data Header: " . mysqli_stmt_error($stmt_header) . "</h3>";
    mysqli_stmt_close($stmt_header);
    mysqli_stmt_close($stmt_get_max);
    mysqli_close($koneksi);
    exit();
}
mysqli_stmt_close($stmt_header);


// --- BAGIAN 3: PROSES DETAIL PERTANYAAN PERTAMA (Tipe: exin1) ---
$tipe_data_exin1 = "exin1";
$tipe_data_exin2 = "exin2";

$stmt_insert_detail = mysqli_prepare($koneksi, "INSERT INTO tb_exit_interview_detail (id_exit_interview, no_pertanyaan, nilai, tipe) VALUES (?, ?, ?, ?)");

if ($stmt_insert_detail === false) {
    die("Gagal mempersiapkan statement INSERT detail: " . mysqli_error($koneksi));
}

$detail_insert_success = true; // Asumsikan sukses sampai ada kegagalan
for ($i = 1; $i <= 30; $i++) {
    $param_name = 'pernyataanke-' . $i;
    $nilai_pernyataan = isset($_GET[$param_name]) ? $_GET[$param_name] : '';

    mysqli_stmt_bind_param($stmt_insert_detail, "siss",
        $id_wawancara_sesi,
        $i,
        $nilai_pernyataan,
        $tipe_data_exin1
    );

    if (!mysqli_stmt_execute($stmt_insert_detail)) {
        $detail_insert_success = false; // Set ke false jika ada kegagalan
    }
}


// --- BAGIAN 4: PROSES DETAIL PERTANYAAN KEDUA (Tipe: exin2) ---

$query_get_exin2_nos = "SELECT No FROM tb_pertanyaan WHERE tipe = ? ORDER BY No ASC";
$stmt_get_exin2_nos = mysqli_prepare($koneksi, $query_get_exin2_nos);
if ($stmt_get_exin2_nos === false) {
    die("Gagal mempersiapkan query EXIN2_NOS: " . mysqli_error($koneksi));
}
mysqli_stmt_bind_param($stmt_get_exin2_nos, "s", $tipe_data_exin2);
mysqli_stmt_execute($stmt_get_exin2_nos);
$result_exin2_nos = mysqli_stmt_get_result($stmt_get_exin2_nos);

$exin2_question_numbers = [];
while ($row = mysqli_fetch_assoc($result_exin2_nos)) {
    $exin2_question_numbers[] = $row['No'];
}
mysqli_stmt_close($stmt_get_exin2_nos);

foreach ($exin2_question_numbers as $no_pertanyaan) {
    $param_name = 'exin2-' . $no_pertanyaan;
    $nilai_pernyataan = isset($_GET[$param_name]) ? $_GET[$param_name] : '';

    mysqli_stmt_bind_param($stmt_insert_detail, "siss",
        $id_wawancara_sesi,
        $no_pertanyaan,
        $nilai_pernyataan,
        $tipe_data_exin2
    );

    if (!mysqli_stmt_execute($stmt_insert_detail)) {
        $detail_insert_success = false; // Set ke false jika ada kegagalan
    }
}


// --- BAGIAN 5: AMBIL DATA PENYELESAIAN DEPARTEMEN DAN MASUKKAN KE tb_exit_interview_serah_terima ---

// Ambil semua data dari $_GET untuk serah terima

// FINANCE & ACCOUNTING
$klaim_asuransi = isset($_GET['klaim_asuransi']) ? $_GET['klaim_asuransi'] : null;
$klaim_produksi = isset($_GET['klaim_produksi']) ? $_GET['klaim_produksi'] : null;
$pinjaman_karyawan = isset($_GET['pinjaman_karyawan']) ? $_GET['pinjaman_karyawan'] : null;
$pinjaman_bank_mandiri = isset($_GET['pinjaman_bank_mandiri']) ? $_GET['pinjaman_bank_mandiri'] : null;
$kas_bon = isset($_GET['kas_bon']) ? $_GET['kas_bon'] : null;

// IT
$pengembalian_komputer = isset($_GET['komputer']) ? $_GET['komputer'] : null;
$penghapusan_email = isset($_GET['email']) ? $_GET['email'] : null;
$penghapusan_user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$pengembalian_fasilitas_it = isset($_GET['fasilitas_lain_it']) ? $_GET['fasilitas_lain_it'] : null;

// DEPARTEMEN KARYAWAN
$data_laporan = isset($_GET['data_laporan']) ? $_GET['data_laporan'] : null;
$data_softcopy = isset($_GET['data_softcopy']) ? $_GET['data_softcopy'] : null;
$password_data = isset($_GET['password_data']) ? $_GET['password_data'] : null;
$kontak_telepon = isset($_GET['kontak_telepon']) ? $_GET['kontak_telepon'] : null;
$kontak_customer = isset($_GET['kontak_customer']) ? $_GET['kontak_customer'] : null;

// HUMAN RESOURCE - GENERAL AFFAIR
$pengembalian_id_card = isset($_GET['id_card']) ? $_GET['id_card'] : null; // Changed variable name to reflect column name

$kunci_locker = isset($_GET['kunci_locker']) ? $_GET['kunci_locker'] : null; // Changed variable name to reflect column name
$handphone = isset($_GET['handphone']) ? $_GET['handphone'] : null; // Changed variable name to reflect column name
$kendaraan_dinas = isset($_GET['kendaraan_dinas']) ? $_GET['kendaraan_dinas'] : null; // Changed variable name to reflect column name
$buku_peraturan = isset($_GET['buku_peraturan']) ? $_GET['buku_peraturan'] : null; // Changed variable name to reflect column name

$cuti_belum_diambil = isset($_GET['sisa_cuti']) ? $_GET['sisa_cuti'] : null;

//DOKUMEN

$serah_terima_surat_pengunduran_diri = isset($_GET['surat_pengunduran_diri']) ? $_GET['surat_pengunduran_diri'] : null;
$surat_tidak_perpanjang_kontrak = isset($_GET['surat_tidak_perpanjang_kontrak']) ? $_GET['surat_tidak_perpanjang_kontrak'] : null;
$hitung_kompensasi = isset($_GET['kompensasi']) ? $_GET['kompensasi'] : null;
$exit_interview_serah_terima = isset($_GET['exit_interview']) ? $_GET['exit_interview'] : null;
$memo_karyawan_keluar = isset($_GET['memo_karyawan_keluar']) ? $_GET['memo_karyawan_keluar'] : null;
$surat_akhir_hubungan_kerja = isset($_GET['akhir_hubungan_kerja']) ? $_GET['akhir_hubungan_kerja'] : null;
$surat_sk_tetap = isset($_GET['sk_tetap']) ? $_GET['sk_tetap'] : null;


// Query INSERT untuk tabel tb_exit_interview_serah_terima
$sql_serah_terima = "INSERT INTO tb_exit_interview_serah_terima (
    id_exit_interview, klaim_asuransi, klaim_produksi, pinjaman_karyawan, pinjaman_bank_mandiri, kas_bon,
    pengembalian_komputer, penghapusan_email, penghapusan_user_id, pengembalian_fasilitas_it,
    pengembalian_data_laporan, penyimpanan_softcopy, penyerahan_password, kontak_telepon_bintang, kontak_customer_provider,
    
    pengembalian_id_card,pengembalian_kunci_locker,pengembalian_handphone,pengembalian_kendaraan_dinas,
    pengembalian_buku_peraturan,  penyelesaian_sisa_cuti	,
    
    surat_pengunduran_diri,surat_tidak_perpanjang_kontrak, hitung_kompensasi, 
    exit_interview, memo_karyawan_keluar,surat_akhir_hubungan_kerja, surat_sk_tetap
) VALUES ( ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?, 
    ?, ?, ?, ?, ?,
    ?, ?, ?, ?, ?,
    ?, ?, ?
)";
$stmt_serah_terima = mysqli_prepare($koneksi, $sql_serah_terima);
if ($stmt_serah_terima === false) {
    die("Gagal mempersiapkan statement INSERT serah terima: " . mysqli_error($koneksi));
}
mysqli_stmt_bind_param($stmt_serah_terima, "ssssssssssssssssssssssssssss",
    $id_wawancara_sesi,
    $klaim_asuransi,
    $klaim_produksi,
    $pinjaman_karyawan,
    $pinjaman_bank_mandiri,
    $kas_bon,

    $pengembalian_komputer, // Maps to pengembalian_komputer
    $penghapusan_email,
    $penghapusan_user_id,
    $pengembalian_fasilitas_it,
    
    $data_laporan, // Maps to laporan_laporan
    $data_softcopy, // Maps to penyimpanan_softcopy
    $password_data, // Maps to penyerahan_password
    $kontak_telepon, // Maps to kontak_telepon_bintang
    $kontak_customer, // Maps to kontak_customer_provider
    
    $pengembalian_id_card, // Maps to pengembalian_id_card
    $kunci_locker,
    $handphone,
    $kendaraan_dinas,
    $buku_peraturan,
    $cuti_belum_diambil,
    
    $serah_terima_surat_pengunduran_diri,
    $surat_tidak_perpanjang_kontrak,
    $hitung_kompensasi,
    $exit_interview_serah_terima, // Maps to exit_interview (column name)
    $memo_karyawan_keluar,
    $surat_akhir_hubungan_kerja,
    $surat_sk_tetap
);

$serah_terima_insert_success = false;
if (mysqli_stmt_execute($stmt_serah_terima)) {
    $serah_terima_insert_success = true;
} else {
    echo "<h3 style='color: red;'>Gagal memasukkan Data Serah Terima: " . mysqli_stmt_error($stmt_serah_terima) . "</h3>";
    // Anda bisa memilih untuk tidak menghentikan script di sini jika ingin tetap melanjutkan,
    // atau menghentikannya jika data serah terima ini krusial.
    // Untuk tujuan ini, kita akan tetap melanjutkan untuk melihat pesan error lain jika ada.
}
mysqli_stmt_close($stmt_serah_terima);


// --- BAGIAN 6: PENUTUP DAN REDIRECTION ---

mysqli_stmt_close($stmt_insert_detail);
mysqli_stmt_close($stmt_get_max);
mysqli_close($koneksi);

// Pastikan semua insert berhasil sebelum redirect
if ($header_insert_success && $detail_insert_success && $serah_terima_insert_success) {
    header('Location: ../index.php?page=data-exit-interview');
    exit(); // Penting untuk menghentikan eksekusi script setelah redirect
} else {
    // Jika ada kegagalan, Anda bisa mengarahkan ke halaman error atau kembali ke form
    // Atau tampilkan pesan error yang sudah ada di atas
    echo "<h3 style='color: red;'>Proses penyimpanan data tidak lengkap. Silakan periksa log server untuk detail.</h3>";
}
?>