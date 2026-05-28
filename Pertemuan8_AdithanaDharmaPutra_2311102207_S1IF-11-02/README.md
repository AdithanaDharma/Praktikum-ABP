# Aplikasi Ambil Foto & Notifikasi Lokal

Proyek ini adalah aplikasi Flutter sederhana yang mendemonstrasikan integrasi fitur kamera (menggunakan Camera API dan Image Picker) serta sistem notifikasi lokal menggunakan paket `flutter_local_notifications`.

## Fitur Utama

1. **Ambil Foto (Camera API)**: Membuka pratinjau kamera secara langsung dalam aplikasi untuk mengambil foto secara kustom.
2. **Pilih Foto (Image Picker)**: Mengambil atau memilih gambar dari galeri perangkat.
3. **Notifikasi Lokal**: Menampilkan notifikasi sistem setiap kali foto berhasil diambil atau dipilih, memberikan umpan balik instan kepada pengguna.

## Dokumentasi Fitur

Berikut adalah langkah-langkah dan tampilan fitur dalam aplikasi:

### 1. Tampilan Awal
Halaman utama yang menampilkan tombol interaksi dan area pratinjau foto.
<img width="720" height="1451" alt="WhatsApp Image 2026-05-28 at 20 15 03" src="https://github.com/user-attachments/assets/f36e06f4-4e44-4fdc-a39a-6db3e13c178b" />

### 2. Pengambilan Gambar (Camera API)
Tampilan antarmuka saat membuka kamera menggunakan Camera API kustom.
<img width="720" height="1451" alt="WhatsApp Image 2026-05-28 at 20 15 04" src="https://github.com/user-attachments/assets/115fc7b3-c924-4820-bab8-8622e4261673" />

### 3. Notifikasi Berhasil (Camera API)
Notifikasi yang muncul setelah foto berhasil diambil melalui Camera API.
<img width="720" height="1451" alt="WhatsApp Image 2026-05-28 at 20 15 05 (1)" src="https://github.com/user-attachments/assets/09d8b690-c3f4-4190-b518-39427f76b6bf" />
<img width="720" height="1451" alt="WhatsApp Image 2026-05-28 at 20 15 05" src="https://github.com/user-attachments/assets/cc76ebbf-7eaf-4b7b-ac9b-3e306074bca3" />


### 4. Memilih Gambar dari Galeri
Proses pemilihan foto menggunakan pustaka `image_picker`.
<img width="720" height="1451" alt="WhatsApp Image 2026-05-28 at 20 15 05 (2)" src="https://github.com/user-attachments/assets/02d9ea38-4df3-4c49-9ba0-68c386760c16" />

### 5. Notifikasi Berhasil (Galeri)
Notifikasi yang muncul setelah foto berhasil dipilih dari galeri.
<img width="720" height="1451" alt="WhatsApp Image 2026-05-28 at 20 15 06" src="https://github.com/user-attachments/assets/0fb937a9-4082-41cc-883d-c975e5cc4e0d" />
<img width="720" height="1451" alt="WhatsApp Image 2026-05-28 at 20 15 06 (1)" src="https://github.com/user-attachments/assets/f82bf663-932b-4a8a-856b-8b4ec31457f4" />

## Cara Menjalankan

1. Jalankan `flutter pub get` untuk mengunduh semua dependency.
2. Hubungkan perangkat fisik atau emulator.
3. Jalankan `flutter run`.

---
**Dibuat oleh:** Adithana Dharma Putra
**NIM:** 2311102207
**Kelas:** S1IF-11-02
