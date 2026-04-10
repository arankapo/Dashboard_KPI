# e-Kinerja — Sistem Informasi Kinerja Karyawan

Aplikasi web internal berbasis PHP untuk manajemen kinerja karyawan PT. Mega Surya Eratama. Dikembangkan untuk membantu tim HRD dalam mengelola penilaian karyawan, KPI, permintaan rekrutmen, pelatihan, dan proses exit interview secara terpusat dan efisien.

## Fitur Utama

### Manajemen Karyawan
- Data master karyawan (NIK, jabatan, departemen, unit kerja, atasan)
- Manajemen departemen dan sub-departemen
- Manajemen jabatan
- Import data karyawan via CSV

### Penilaian Kinerja (KPI)
- Master KPI per jabatan dengan bobot penilaian
- Parameter KPI yang dapat dikonfigurasi
- Penilaian karyawan reguler dan outsourcing
- Penilaian multi-level: Staff, Supervisor, Manajer, Direksi
- Export laporan penilaian ke PDF

### Permintaan & Rekrutmen
- Form permintaan karyawan baru (FR/HRDGA/003)
- Alur persetujuan (approval) permintaan
- Tracking status permintaan oleh HRD

### Pelatihan (Training)
- Pengajuan permintaan training
- Evaluasi hasil training
- Laporan rekapitulasi training

### Exit Interview
- Form exit interview karyawan yang resign
- Detail dan laporan exit interview

### Administrasi
- Manajemen user & hak akses menu
- Pengaturan akses per role
- Ganti password

## Teknologi

- **Backend**: PHP (Native)
- **Database**: MySQL
- **Frontend**: AdminLTE 3, Bootstrap 4, jQuery
- **Reporting**: DOMPDF (export ke PDF)
- **Server**: Apache (XAMPP/LAMP)

## Cara Instalasi

### Prasyarat
- PHP >= 7.4
- MySQL >= 5.7
- Apache Web Server (XAMPP / LAMP / WAMP)

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/arankapo/Dashboard_KPI.git
cd Dashboard_KPI
```

**2. Konfigurasi database**

Buat database baru di MySQL:
```sql
CREATE DATABASE ekinerja;
```

Import file SQL:
```bash
mysql -u root -p ekinerja < database/ekinerja.sql
```

**3. Konfigurasi koneksi**

Edit file `conf/koneksi.php`:
```php
$host     = "localhost";
$user     = "root";
$password = "";
$database = "ekinerja";
```

**4. Jalankan aplikasi**

Letakkan folder project di:
- XAMPP: `C:/xampp/htdocs/ekinerja`
- LAMP: `/var/www/html/ekinerja`

Buka browser: `http://localhost/ekinerja`

## Struktur Project

```
ekinerja/
├── app/
│   ├── add/              # Script tambah data
│   ├── edit/             # Script edit data
│   ├── conf/             # Konfigurasi koneksi DB
│   ├── reportpdf/        # Export laporan PDF (DOMPDF)
│   ├── assets/           # CSS & JS lokal
│   ├── image/            # Gambar & logo
│   ├── import_csv/       # Import data via CSV
│   ├── index.php         # Router utama aplikasi
│   ├── dashboard.php     # Halaman dashboard
│   ├── data_karyawan.php # Manajemen karyawan
│   ├── data_kpi_master.php        # Master KPI
│   ├── data_penilaian_supervisor.php  # Penilaian supervisor
│   ├── data_permintaan_karyawan.php   # Permintaan rekrutmen
│   └── ...
└── conf/
    ├── koneksi.php       # Konfigurasi database
    └── login.php         # Halaman login
```

## Screenshots

> *Tambahkan screenshot aplikasi di sini*

## Developer

**Rian Rizki Prayogo** — IT Staff & Web Developer  
Dikembangkan selama bekerja di PT. Mega Surya Eratama (2025)

[GitHub](https://github.com/arankapo) · [Email](mailto:rian.prayogo@icloud.com)

---

> **Catatan**: Aplikasi ini dikembangkan untuk kebutuhan internal perusahaan. Data sensitif perusahaan telah dihapus dari repository ini.