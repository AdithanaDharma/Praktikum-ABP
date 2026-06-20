# Laporan Praktikum Pertemuan 11: State Management BLoC/Cubit

Praktikum ini mengimplementasikan sistem keranjang belanja sederhana menggunakan **Cubit** (bagian dari ekosistem flutter_bloc) untuk mengelola state aplikasi secara reaktif.

## 1. Konsep State Management yang Digunakan
Pada aplikasi ini, kita menggunakan **Cubit**, yang merupakan versi lebih sederhana dari BLoC. Cubit menggunakan fungsi untuk memicu perubahan state, bukan event, sehingga lebih ringkas untuk logika yang tidak terlalu kompleks.

### Komponen Utama:
- **Product Model**: Data class `Product` yang menggunakan `Equatable` agar objek bisa dibandingkan berdasarkan nilainya (id, nama, harga), bukan referensi memorinya.
- **CartCubit**: Mengelola `List<Product>` sebagai statenya. Memiliki fungsi `addToCart` untuk menambah produk dan `removeFromCart` untuk menghapus.
- **BlocProvider**: Menyediakan instance `CartCubit` ke seluruh pohon widget di bawahnya (dalam hal ini, seluruh aplikasi).
- **BlocBuilder**: Mendengarkan perubahan pada `CartCubit` dan membangun ulang UI (seperti jumlah item di badge dan daftar item di keranjang) secara otomatis saat state berubah.

## 2. Fitur Aplikasi
- Menampilkan daftar produk (minimal 5 produk).
- Menambah produk ke keranjang (ikon berubah warna/bentuk).
- Menghapus produk dari keranjang.
- Update jumlah item di keranjang secara *real-time* pada badge di AppBar.
- Halaman detail keranjang dengan total jumlah item.

## 3. Cuplikan Layar (Screenshots)
<img style="width:30%; height:auto;"  alt="WhatsApp Image 2026-06-20 at 19 10 42 (1)" src="https://github.com/user-attachments/assets/375e1bcd-2956-453a-87a2-8ca5f757f948" />
<img style="width:30%; height:auto;"  alt="WhatsApp Image 2026-06-20 at 19 10 42" src="https://github.com/user-attachments/assets/146381ba-a4d0-4f59-9ef2-5207e24dad86" />
<img style="width:30%; height:auto;" alt="WhatsApp Image 2026-06-20 at 19 10 43" src="https://github.com/user-attachments/assets/5d990faa-bae5-46d3-95f1-274ce023fde9" />
