<?php
// Include your database connection file
include('../koneksi.php'); // Sesuaikan path jika perlu

// Check if the form was submitted using GET method
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    // --- Generate Unique Training Number ---
    $kode = "PTR";
    $tahun = date("Y");
    $bulan = date("m");
    $tanggal = date("d");

    // Get the current date to filter records for today
    $today_date = date("Y-m-d");

    // Query to get the count of records for today using Prepared Statement
    $query_count = "SELECT COUNT(*) as total_records FROM tb_permintaan_training WHERE DATE(tgl_pembuatan) = ?";

    // Check if $koneksi is a valid mysqli object before preparing
    if ($koneksi instanceof mysqli) {
        if ($stmt_count = $koneksi->prepare($query_count)) {
            $stmt_count->bind_param("s", $today_date);
            $stmt_count->execute();
            $result_count = $stmt_count->get_result(); // Get the result set

            $total_records_today = 0;
            if ($result_count && $row_count = $result_count->fetch_assoc()) {
                $total_records_today = $row_count['total_records'];
            }
            $stmt_count->close(); // Close the statement for counting
        } else {
            // Handle error if prepare fails for count query
            error_log("Failed to prepare count statement: " . $koneksi->error);
            echo "<script>alert('Terjadi kesalahan sistem saat menghitung data.'); window.location.href='../index.php?page=input-permintaan-training';</script>";
            exit(); // Exit to prevent further execution
        }
    } else {
        // Handle error if $koneksi is not a valid mysqli object
        error_log("Database connection object is invalid.");
        echo "<script>alert('Koneksi database tidak valid.'); window.location.href='../index.php?page=input-permintaan-training';</script>";
        exit();
    }

    // Increment for the next sequence number for today
    $next_sequence = $total_records_today + 1;
    $no_urut = sprintf("%03d", $next_sequence); // Format as 001, 002, etc.

    // Combine to form the full training number
    $no_training = $kode . $tahun . $bulan . $tanggal . $no_urut;

    // --- Retrieve Form Data (No more mysqli_real_escape_string here) ---
    $jabatan = $_GET['unit_kerja'];
    $departemen = $_GET['nama_dept'];
    $program = $_GET['program'];
    $jml_peserta = $_GET['jumlah_peserta']; // Type casting for integers is still good
    //$jam_training = $_GET['waktu_pelaksanaan'];
    $tgl_training = $_GET['tanggal_pemenuhan'] . '-01'; // hasil: '2025-09-01'
    $trainer = $_GET['trainer_provider'];
    $topik = $_GET['topik_tema'];
    $area_kerja = $_GET['area_kerja'];
    $tipe_evaluasi = $_GET['tipe_evaluasi'];
    // Ambil data manual dari input text 'tempat lainnya'
    $tempat_lainnya_text = isset($_GET['tempat_lainnya_text']) ? $_GET['tempat_lainnya_text'] : '';
    // Ambil data manual dari input text 'alasan lainnya'
    $alasan_lainnya_text = isset($_GET['alasan_lainnya_text']) ? $_GET['alasan_lainnya_text'] : '';
    // Ambil data manual dari input text 'goal lainnya'
    $goal_lainnya_text = isset($_GET['goal_lainnya_text']) ? $_GET['goal_lainnya_text'] : '';



    // Handle 'Tempat' checkboxes. Combine selected values into a single string.
    $selected_tempat = [];
    if (isset($_GET['tempat']) && is_array($_GET['tempat'])) {
        foreach ($_GET['tempat'] as $tempat_item) {
            // No need to escape here, it will be handled by prepared statement later
            $selected_tempat[] = $tempat_item;
        }
    }

    // Cek jika 'Lainnya' dipilih dan ada input teks manual
    if (in_array('Lain Lain', $selected_tempat) && !empty($tempat_lainnya_text)) {
        // Cari index dari 'Lain Lain' dan ganti dengan nilai manual
        $tempat_lain_index = array_search('Lain Lain', $selected_tempat);
        if ($tempat_lain_index !== false) {
            $selected_tempat[$tempat_lain_index] = $tempat_lainnya_text;
        } else {
            // Jika tidak ditemukan, tambahkan saja ke array
            $selected_alasan[] = $tempat_lainnya_text;
        }
    }


    $tempat = implode(', ', $selected_tempat);

    // Handle 'Peralatan' checkboxes. Combine selected values into a single string.
    $selected_peralatan = [];
    if (isset($_GET['peralatan']) && is_array($_GET['peralatan'])) {
        foreach ($_GET['peralatan'] as $peralatan_item) {
            // No need to escape here
            $selected_peralatan[] = $peralatan_item;
        }
    }
    $peralatan = implode(', ', $selected_peralatan);

    $uraian_training = $_GET['catatan'];
    $tgl_pembuatan = $_GET['tanggal_pengajuan'];

    // Handle 'Alasan' checkboxes. Combine selected values into a single string.
    $selected_alasan = [];
    if (isset($_GET['alasan']) && is_array($_GET['alasan'])) {
        foreach ($_GET['alasan'] as $alasan_item) {
            $selected_alasan[] = $alasan_item;
        }
    }

    // Cek jika 'Lainnya' dipilih dan ada input teks manual
    if (in_array('Lain Lain', $selected_alasan) && !empty($alasan_lainnya_text)) {
        // Cari index dari 'Lain Lain' dan ganti dengan nilai manual
        $lain_lain_index = array_search('Lain Lain', $selected_alasan);
        if ($lain_lain_index !== false) {
            $selected_alasan[$lain_lain_index] = $alasan_lainnya_text;
        } else {
            // Jika tidak ditemukan, tambahkan saja ke array
            $selected_alasan[] = $alasan_lainnya_text;
        }
    }

    $alasan = implode(', ', $selected_alasan);

    // Handle 'Goal' checkboxes. Combine selected values into a single string.
    $selected_goal = [];
    if (isset($_GET['goal']) && is_array($_GET['goal'])) {
        foreach ($_GET['goal'] as $goal_item) {
            $selected_goal[] = $goal_item;
        }
    }

    // Cek jika 'Lainnya' dipilih dan ada input teks manual
    if (in_array('Lainnya', $selected_goal) && !empty($goal_lainnya_text)) {
        // Cari index dari 'Lainnya' dan ganti dengan nilai manual
        $lainnya_index = array_search('Lainnya', $selected_goal);
        if ($lainnya_index !== false) {
            $selected_goal[$lainnya_index] = $goal_lainnya_text;
        } else {
            // Jika tidak ditemukan, tambahkan saja ke array
            $selected_goal[] = $goal_lainnya_text;
        }
    }

    $goal = implode(', ', $selected_goal);


    // --- Prepare and Execute SQL INSERT Statement ---
    $sql_insert = "INSERT INTO tb_permintaan_training (
                        no_permintaan,
                        departemen,
                        jabatan,
                        program,
                        jml_peserta,
                        tgl_training,
                        trainer,
                        topik,
                        area_kerja,
                        tempat,
                        peralatan,
                        tipe_evaluasi,
                        alasan,  -- Tambahkan kolom alasan
                        goal,    -- Tambahkan kolom goal
                        uraian_training,
                        tgl_pembuatan
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt_insert = $koneksi->prepare($sql_insert)) {
        // Bind parameters:
        // s: string, i: integer, d: double, b: blob
        // Make sure the order and types match your columns
        $stmt_insert->bind_param("ssssssssssssssss",
            $no_training,
            $departemen,
            $jabatan,
            $program,
            $jml_peserta,
            $tgl_training,
            $trainer,
            $topik,
            $area_kerja,
            $tempat,
            $peralatan,
            $tipe_evaluasi,
            $alasan, // Masukkan variabel alasan
            $goal,   // Masukkan variabel goal
            $uraian_training,
            $tgl_pembuatan
        );

        if ($stmt_insert->execute()) {
            echo "<script>alert('Permintaan training berhasil disimpan dengan No. Training: " . $no_training . "'); window.location.href='../index.php?page=input-permintaan-training';</script>";
        } else {
            echo "<script>alert('Error saat menyimpan data: " . $stmt_insert->error . "'); window.location.href='../index.php?page=input-permintaan-training';</script>";
        }

        $stmt_insert->close(); // Close the statement for inserting
    } else {
        echo "<script>alert('Error saat mempersiapkan statement: " . $koneksi->error . "'); window.location.href='../index.php?page=input-permintaan-training';</script>";
    }

    // Close the database connection (only once after all operations)
    mysqli_close($koneksi);

} else {
    // If accessed directly without form submission (e.g., typing URL)
    echo "<script>alert('Akses tidak sah!'); window.location.href='../index.php?page=input-permintaan-training';</script>";
}
?>