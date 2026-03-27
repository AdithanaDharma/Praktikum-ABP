# Dokumentasi Proyek

Dokumentasi ini berisi hasil tangkapan layar web, tautan presentasi, dan video demonstrasi dari proyek yang dikerjakan.

## Tangkapan Layar Web

Berikut adalah 3 tangkapan layar dari aplikasi web:

1. Tangkapan Layar 1
![Tangkapan Layar 1]()

2. Tangkapan Layar 2
![Tangkapan Layar 2]()

3. Tangkapan Layar 3
![Tangkapan Layar 3]()

## File PowerPoint

Berikut adalah tautan menuju file presentasi PowerPoint:

[Tautan File PowerPoint]()

## Video Demonstrasi

Klik gambar thumbnail di bawah ini untuk melihat video demonstrasi proyek di YouTube:

[![Thumbnail Youtube](foto)](link)

## Penjelasan Singkat Program

Aplikasi ini merupakan sebuah sistem web berbasis CRUD (Create, Read, Update, Delete) yang dikembangkan menggunakan framework CodeIgniter 4. Program ini dibuat untuk mempermudah proses pengelolaan data secara digital dan terstruktur dengan antarmuka yang mudah digunakan dan responsif. 

## Panduan Menjalankan Program (Clone)

Bagi Anda yang ingin meng-clone dan menjalankan program ini di lokal, ikuti langkah-langkah berikut:

1. **Clone Repository:**
   Buka terminal atau CMD dan jalankan perintah berikut:
   ```bash
   git clone https://github.com/AdithanaDharma/Praktikum-ABP.git
   ```

2. **Masuk ke Direktori Proyek:**
   ```bash
   cd crud-ci4
   ```

3. **Install Dependencies:**
   Pastikan Anda telah menginstal Composer. Kemudian jalankan:
   ```bash
   composer install
   ```

4. **Konfigurasi Environment:**


5. **Lakukan Migrasi Database:**
   Buat database kosong terlebih dahulu di MySQL/MariaDB sesuai konfigurasi di file `.env`. Setelah itu jalankan perintah berikut untuk migrasi tabel secara otomatis:
   ```bash
   php spark migrate
   ```

6. **Jalankan Aplikasi:**
   Nyalakan development server dari CodeIgniter 4 dengan perintah:
   ```bash
   php spark serve
   ```
   Buka browser dan buka tautan `http://localhost:8080` untuk melihat aplikasi berjalan.
