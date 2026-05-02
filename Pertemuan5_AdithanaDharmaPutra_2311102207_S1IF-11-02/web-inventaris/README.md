# 📦 Web Inventaris Toko Pak Cokomi & Mas Wowo

Selamat datang di sistem manajemen inventaris modern yang dirancang khusus untuk membantu **Pak Cokomi** mengelola stok barang di tokonya **Mas Wowo**. Aplikasi ini dibangun menggunakan framework Laravel dengan fokus pada kemudahan penggunaan dan keamanan.

## 🚀 Fitur Utama

- **Sistem Autentikasi (Laravel Breeze)**: Keamanan terjamin untuk akses data inventaris.
- **Manajemen Produk (CRUD)**:
    - **Dashboard Data Table**: Tampilan daftar produk yang rapi dan informatif.
    - **Form Tambah Produk**: Input data produk baru dengan mudah.
    - **Form Edit Produk**: Perbarui informasi produk yang sudah ada.
    - **Hapus dengan Modal Konfirmasi**: Mencegah penghapusan data secara tidak sengaja dengan popup konfirmasi.
- **Database Seeder & Factory**: Data awal sudah tersedia untuk simulasi belanja Mas Wowo.
- **Desain Responsif**: Menggunakan Tailwind CSS untuk tampilan yang premium dan nyaman di berbagai perangkat.

---

## 📸 Tangkapan Layar (Screenshots)

*Berikut adalah visualisasi dari aplikasi Web Inventaris:*

### 1. Halaman Login
![Halaman Login](https://via.placeholder.com/800x450.png?text=Placeholder+Halaman+Login)
*Sistem masuk yang aman menggunakan Laravel Breeze.*

### 2. Dashboard & Tabel Produk
![Dashboard Inventaris](https://via.placeholder.com/800x450.png?text=Placeholder+Tabel+Produk)
*Daftar stok barang milik Pak Cokomi yang siap dibeli Mas Wowo.*

### 3. Modal Konfirmasi Hapus
![Modal Delete](https://via.placeholder.com/800x450.png?text=Placeholder+Modal+Konfirmasi+Hapus)
*Fitur keamanan tambahan untuk memastikan data tidak terhapus tanpa sengaja.*

---

## 🛠️ Persiapan & Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project ini secara lokal:

1. **Clone Repository**
   ```bash
   git clone <url-repository>
   cd web-inventaris
   ```

2. **Instal Dependensi PHP & JS**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan sesuaikan pengaturan database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi & Seeding Database**
   Jalankan perintah ini untuk membuat tabel dan mengisi data awal (Sangat penting agar data tidak kosong!).
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   # Di terminal terpisah
   npm run dev
   ```

6. **Akses Akun Admin Default**
   - **Email**: `admin@admin.com`
   - **Password**: `password`

---

## 📂 Dokumentasi Project

### Struktur Model (`Product`)
Data produk disimpan dengan atribut berikut:
- `name`: Nama barang/produk.
- `description`: Deskripsi detail produk.
- `price`: Harga satuan produk.
- `stock`: Jumlah ketersediaan stok.

### Arsitektur Folder Penting
- `app/Http/Controllers/ProductController.php`: Menangani logika bisnis CRUD.
- `database/factories/ProductFactory.php`: Template pembuatan data produk otomatis.
- `database/seeders/ProductSeeder.php`: Pengisian data produk ke database.
- `resources/views/product/`: Kumpulan view Blade untuk antarmuka pengguna.

---

## 🤝 Kontribusi
Project ini dibuat untuk memenuhi tugas Praktikum ABP. Semoga dengan sistem ini, Pak Cokomi bisa makin sukses dagangnya dan Mas Wowo nggak pusing lagi kalau mau belanja!

**Dibuat oleh**: Adithana Dharma Putra (2311102207)
**Kelas**: S1IF-11-02
