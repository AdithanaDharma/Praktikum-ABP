# Laporan Praktikum Pertemuan 9 - Integrasi Firebase & State Management

**Nama:** Adithana Dharma Putra  
**NIM:** 2311102207  
**Kelas:** S1IF-11-02  
**Proyek:** pertemuan9 (To-Do List with FCM)

---

## 1. Deskripsi Proyek
Proyek ini adalah aplikasi Flutter sederhana untuk mengelola daftar tugas (To-Do List) yang mengimplementasikan dua konsep utama:
1.  **State Management**: Menggunakan package `Provider` untuk mengelola data tugas secara reaktif.
2.  **Firebase Cloud Messaging (FCM)**: Mengintegrasikan layanan push notification dari Firebase untuk menerima pesan/notifikasi pada perangkat.

## 2. Fitur Utama
- **Tambah Tugas**: Menambahkan item tugas baru melalui dialog input.
- **Hapus Semua**: Membersihkan seluruh daftar tugas dengan satu klik.
- **Status Tugas**: Menandai tugas yang sudah selesai dengan checkbox (coretan teks).
- **Push Notification**: Menerima notifikasi baik saat aplikasi berada di foreground maupun background.

## 3. Implementasi Teknik
### A. Provider (State Management)
Data dikelola dalam kelas `TaskProvider` yang mengekstensi `ChangeNotifier`. Perubahan data dipicu oleh fungsi `addTask`, `removeTask`, dan `clearAllTasks` yang kemudian memanggil `notifyListeners()` untuk memperbarui UI.

### B. Firebase Integration
- **Package Name**: `com.example.ertemuan9`
- **Plugin**: Menggunakan `google-services` plugin di level proyek dan aplikasi.
- **FCM Logic**: Menggunakan `FirebaseMessaging` untuk meminta izin, mengambil token, dan menangani pesan masuk melalui `onMessage` dan `onBackgroundMessage`.
---

## 4. Hasil Pengujian (Screenshots)

### A. Tampilan Utama & Daftar Tugas
<img width="720" height="1451" alt="WhatsApp Image 2026-06-13 at 13 35 23" src="https://github.com/user-attachments/assets/6f025ccb-dec2-4741-ba0a-c8a56cdeac75" />
<img width="720" height="1451" alt="WhatsApp Image 2026-06-13 at 13 35 24" src="https://github.com/user-attachments/assets/0ec486d6-b02e-4e88-8e93-9929f4781e39" />


### B. Fitur pilih Tugas
<img width="720" height="1451" alt="WhatsApp Image 2026-06-13 at 13 35 23 (1)" src="https://github.com/user-attachments/assets/5bc636b6-1f71-4a41-a550-94b52328ce10" />

### C. Konfigurasi Firebase Console
<img width="1823" height="922" alt="image" src="https://github.com/user-attachments/assets/82deff73-7ee7-4348-bdf9-e2b94684b77d" />


### D. Pengujian Notifikasi FCM
<img width="1496" height="907" alt="WhatsApp Image 2026-06-13 at 13 32 13" src="https://github.com/user-attachments/assets/2ca6799a-9506-498f-8c24-72cc7e322d01" />
<img width="720" height="1451" alt="WhatsApp Image 2026-06-13 at 13 32 18" src="https://github.com/user-attachments/assets/1c0672c7-a5fb-4571-a2a5-98205f406778" />

---

## 5. Kesimpulan
Aplikasi berhasil mengintegrasikan `Provider` untuk manajemen state yang efisien dan `Firebase Cloud Messaging` untuk fitur notifikasi. 
