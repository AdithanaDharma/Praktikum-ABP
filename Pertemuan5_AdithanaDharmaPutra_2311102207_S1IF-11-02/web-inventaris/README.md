# Web Inventaris Toko Pak Cokomi & Mas Wowo




## 📸 Tangkapan Layar (Screenshots)

*Berikut adalah visualisasi dari aplikasi Web Inventaris:*

### 1. Halaman Login
<img width="1912" height="904" alt="image" src="https://github.com/user-attachments/assets/d840a53f-f09f-4bcd-b41a-76630f1dc4ca" />
*Sistem masuk yang aman menggunakan Laravel Breeze.*

### 2. Halaman Kasir
<img width="1482" height="907" alt="image" src="https://github.com/user-attachments/assets/4ee87545-6ca5-483b-a1d3-ba01f4d5c32f" />


### 3. Tabel Produk
<img width="1833" height="913" alt="image" src="https://github.com/user-attachments/assets/9f464056-76a5-4d95-9acb-26469edd4679" />


### 3. Modal Konfirmasi CRUD
<img width="1603" height="794" alt="image" src="https://github.com/user-attachments/assets/645683ad-021a-4e0a-b7e5-5972c09e707e" />
<img width="1833" height="913" alt="image" src="https://github.com/user-attachments/assets/9f464056-76a5-4d95-9acb-26469edd4679" />
<img width="1507" height="771" alt="image" src="https://github.com/user-attachments/assets/639165fa-90d4-4b6b-8aba-449b47fd5dd3" />
<img width="1415" height="855" alt="image" src="https://github.com/user-attachments/assets/16bb7238-d1b6-4b84-bd37-ffd84795fe49" />
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
     Atau sesuai dengan Seeder
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

### NAMA: Adithana Dharma Putra
### NIM: 2311102207
### Kelas: S1IF-11-02
