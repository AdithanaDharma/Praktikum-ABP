# Widget Showcase Project

Proyek ini menampilkan penggunaan berbagai widget dasar di Flutter.

## Penjelasan Widget

Berikut adalah penjelasan singkat untuk setiap widget yang digunakan dalam proyek ini:

1. **Container**
   Widget serbaguna yang digunakan untuk dekorasi, memberikan padding, margin, serta mengatur ukuran (lebar/tinggi) sebuah elemen. Dalam proyek ini digunakan sebagai kotak berwarna.

2. **GridView**
   Widget untuk menampilkan elemen dalam bentuk kisi (grid) dua dimensi. Sangat berguna untuk layout seperti galeri foto atau menu dalam bentuk ikon.

<img width="1920" height="999" alt="image" src="https://github.com/user-attachments/assets/b53408db-ca8a-4d14-83d8-a40b83718991" />

3. **ListView**
   Widget linear yang menampilkan anak-anaknya (children) secara berurutan (vertikal atau horizontal). Digunakan untuk daftar item yang jumlahnya sedikit dan statis.

4. **ListView.builder**
   Varian dari ListView yang membuat item secara dinamis hanya saat item tersebut akan ditampilkan di layar. Sangat efisien untuk menampilkan data dari array atau daftar yang panjang.

   <img width="1915" height="962" alt="image" src="https://github.com/user-attachments/assets/61be3e81-a3a8-4cb9-8fa7-736c94683319" />

6. **ListView.separated**
   Mirip dengan `ListView.builder`, namun memiliki parameter tambahan `separatorBuilder` untuk menyisipkan widget pembatas (seperti garis Divider) di antara setiap item list.

7. **Stack**
   Widget yang memungkinkan kita untuk menumpuk satu widget di atas widget lainnya. Widget pertama dalam daftar `children` berada di paling bawah, dan widget terakhir berada di paling atas.

<img width="1918" height="515" alt="image" src="https://github.com/user-attachments/assets/f2f548be-aba5-46d5-9db9-bfef8ab5bb9c" />

