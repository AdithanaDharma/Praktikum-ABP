Screenshot:
<img width="1366" height="724" alt="Cuplikan layar 2026-04-17 224000" src="https://github.com/user-attachments/assets/81fcce19-0e5d-4edf-ab36-112f5adfde53" />
<img width="1366" height="728" alt="Cuplikan layar 2026-04-17 223932" src="https://github.com/user-attachments/assets/69b2be02-9daa-4cae-8c2c-9efa8a7aee19" />


# AJAX Fetch Profil

Proyek sederhana ini mendemonstrasikan cara menggunakan **AJAX (Asynchronous JavaScript and XML)** dengan library **jQuery** untuk mengambil data dari server secara dinamis tanpa perlu memuat ulang (refresh) halaman web secara keseluruhan.

## Penjelasan Singkat Kode

Aplikasi ini terdiri dari dua komponen utama:

### 1. `Data.php` (Backend)
File ini bertindak sebagai API sederhana (backend) yang menyediakan data.
- Mengatur header `Content-Type: application/json` agar output dikenali sebagai format JSON standar.
- Berisi sebuah array assosiatif di dalam PHP yang menyimpan beberapa data profil (Nama, Pekerjaan, dan Lokasi).
- Menggunakan fungsi `json_encode()` untuk mengubah array PHP tersebut menjadi format string JSON yang siap dikirimkan ke client (browser).

### 2. `index.html` (Frontend)
File ini menangani tampilan (UI) dan logika interaksi di sisi browser (client-side).
- Terdapat sebuah elemen tombol (`<button id="btn-tampilkan">`) dan div penampung hasil yang awalnya disembunyikan (`<div id="hasil-profil"></div>`).
- Menggunakan library **jQuery** untuk mempermudah pemanggilan AJAX.
- Ketika tombol ditekan, fungsi `$.ajax()` dipanggil dengan method `GET` menuju URL `Data.php`.
- Jika data berhasil diambil (`success`), maka data JSON tersebut akan diiterasi menggunakan `$.each()`.
- Tiap profil akan diformat menggunakan HTML dan ditambahkan (append) ke dalam div `#hasil-profil`, yang kemudian akan dimunculkan ke layar menggunakan `.show()`.

