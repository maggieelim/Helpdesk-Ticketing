# Helpdesk Ticketing

Proyek **Helpdesk Ticketing** adalah aplikasi berbasis web untuk manajemen tiket. Aplikasi ini memungkinkan merchant untuk membuat, melacak, dan mengelola tiket secara efisien. Sistem ini dirancang untuk memberikan solusi cepat bagi tim helpdesk, technical support, dan merchant dalam mengelola masalah terkait produk atau layanan.

---

## Fitur Utama
- **Pembuatan Tiket**: Merchant dapat membuat tiket dengan memasukkan judul dan deskripsi masalah.
- **Manajemen Tiket**: Manager dapat mengelola tiket berdasarkan status dan prioritas.
- **Penugasan Tiket**: Manager dapat menugaskan tiket kepada technical support berdasarkan **service point** yang sesuai.
- **Pelaporan dan Statistik**: Laporan kinerja dan statistik mengenai tiket yang diselesaikan.

---

## Prasyarat

Sebelum menjalankan aplikasi, pastikan Anda memiliki perangkat berikut:

1. **PHP** 7.4 atau lebih baru
2. **Composer** (untuk manajemen dependensi PHP)
3. **Laravel** (framework PHP)
4. **PostgreSQL** sebagai database
5. **Node.js** dan **npm** (untuk manajemen dependensi frontend)
6. **Visual Studio Code** atau editor teks lainnya
7. **Python** (jika menggunakan integrasi untuk analitik atau model machine learning)

---


## Restore Database

Untuk mengembalikan (restore) database PostgreSQL menggunakan **pgAdmin**, ikuti langkah-langkah berikut:

### 1. Buka pgAdmin dan Masuk
- Jalankan aplikasi **pgAdmin** di komputer Anda.
- Masukkan **Master Password** jika diminta, kemudian klik **OK** untuk terhubung ke server PostgreSQL.

### 2. Buat Database Baru
- Di panel **Browser**, klik kanan pada **Databases**, lalu pilih **Create** > **Database...**.
- Isi nama database sesuai keinginan (misalnya, `helpdesk`), kemudian klik **Save**.

### 3. Mulai Proses Restore
- Setelah database baru dibuat, klik kanan pada database tersebut di panel **Browser**, lalu pilih **Restore...**.

### 4. Pilih File Backup
- Di dialog **Restore**, pada tab **General**, klik ikon **folder** di sebelah kolom **Filename**.
- Navigasikan ke lokasi file backup Anda (dengan ekstensi `.backup` atau `.sql`), pilih file tersebut, lalu klik **Select**.

### 5. Konfigurasi Opsi Restore
- Pastikan format file backup sesuai dengan yang dipilih (misalnya, **Custom** atau **Plain**).

### 6. Jalankan Proses Restore
- Klik **Restore** untuk memulai proses.
- Monitor **Messages** di bagian bawah jendela pgAdmin untuk memastikan proses berjalan tanpa error.

### 7. Verifikasi Hasil Restore
- Setelah proses selesai, perluas database di panel **Browser** untuk memastikan semua skema dan tabel telah dipulihkan dengan benar.

---

## Instalasi

### 1. Clone Repositori
Clone repositori ke lokal Anda:
```bash
git clone https://github.com/maggieelim/Helpdesk-Ticketing.git
cd Helpdesk-Ticketing
```

### 2. Instal Dependensi PHP
Instal dependensi PHP menggunakan Composer:
```bash
composer install
```

### 3. Instal Dependensi Frontend
Instal dependensi frontend menggunakan npm:
```bash
npm install
```

### 4. Konfigurasi Database
1. Buat database PostgreSQL dengan nama **helpdesk** (atau sesuai dengan preferensi Anda).
2. Salin file `.env.example` ke file `.env` dan sesuaikan konfigurasi database dengan detail yang sesuai:
   ```bash
   cp .env.example .env
   ```
3. Sesuaikan pengaturan database di file `.env`:
   ```
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=helpdesk
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

### 5. Migrasi Database
Lakukan migrasi database untuk membuat tabel yang diperlukan:
```bash
php artisan migrate
```

### 6. Menjalankan Aplikasi
Jalankan server Laravel menggunakan perintah:
```bash
php artisan serve
```
Aplikasi dapat diakses di **http://127.0.0.1:8000** atau URL yang tertera di terminal.

---

## Manual Book

Manual Book dapat diakses melalui tautan berikut:  
[Helpdesk Ticketing Manual Book](https://drive.google.com/file/d/155ymvZ2WKWgtCFHo6S05Bn-_qFZD4RLi/view?usp=sharing)

