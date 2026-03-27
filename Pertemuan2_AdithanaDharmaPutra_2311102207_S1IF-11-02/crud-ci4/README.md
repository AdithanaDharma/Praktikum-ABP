# Dokumentasi Proyek

Dokumentasi ini berisi hasil tangkapan layar web, tautan presentasi, dan video demonstrasi dari proyek yang dikerjakan.

## Tangkapan Layar Web

Berikut adalah beberapa tangkapan layar dari aplikasi web:

1. Tangkapan Layar Dashboard
![Cuplikan layar 2026-03-27 215327](https://github.com/user-attachments/assets/f612d3b6-67d2-4516-bfff-b26c855c18ac)
 
2. Tangkapan Layar Kasir
![Cuplikan layar 2026-03-27 215406](https://github.com/user-attachments/assets/12de8224-f101-45a2-a55e-831e17d36bd3)

3. Tangkapan Layar Management Barang
![Cuplikan layar 2026-03-27 215350](https://github.com/user-attachments/assets/8bd26c98-1aa1-4a0a-869c-6c908f938fc3)

4. Tangkapan Layar modal tambah Barang
![Cuplikan layar 2026-03-27 215501](https://github.com/user-attachments/assets/d59a2391-e9f8-48b3-8106-66fe16eea1b5)

## File PowerPoint

Berikut adalah tautan menuju file presentasi PowerPoint:

([Slide PPT.pdf](https://github.com/user-attachments/files/26308144/Slide.PPT.pdf)
)

## Video Demonstrasi

Klik gambar thumbnail di bawah ini untuk melihat video demonstrasi proyek di YouTube:

![Cuplikan layar 2026-03-27 220205](https://github.com/user-attachments/assets/d77f6d77-6241-492f-a007-d89e32289025)
TAUTAN: https://youtu.be/hXKFJTp-XRM

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
