<h1 align="center">RSS Reader Application</h1>
### Aplikasi ini dibuat untuk memenuhi [test pemrograman](https://github.com/sonarid/programming-test-1) sebagai Junior Programmer di [Sonar Platform](https://www.sonarplatform.com/)

### Spesifikasi Program

- Dibuat dengan menggunakan bahasa pemrograman PHP dan database MySQL
- Menggunakan RSS Feed Portal Berita [vice.com](https://www.vice.com/id/rss?locale=id_id)
- Menampilkan List All Articles berupa:
  - Title,
  - Published Date,
  - Aksi untuk melihat details article
- Menampillan Details Article berupa:
  - URL
  - Judul
  - Waktu Tayang
  - Konten Lengkap

### Cara menggunakan? (Tutorial menjalankan menggunakan XAMPP)

- Gunakan tools XAMPP dan mengaktifkan module Apache, dan MySQL
- Pindahkan folder `rssreader` ke dalam folder `xampp/htdocs`
- Masuk PHPMyAdmin untuk membuat database baru dan import rssreader.sql yang terdapat pada folder database
- Setelah berhasil import, buka file db.php, kemudian atur dbname sesuai dengan nama database yang dibuat
- Atur juga file action.php dan ubah nama rssreader sesuai dengan nama database yang dibuat
- Jalankan file index.php di browser dengan mengunjungi [localhost/rssreader](https://localhost/rssreader)
- Note: pastikan koneksi internet aktif.

### Teknologi yang digunakan

- PHP-OOP,
- PDO-MySQL,
- Ajax,
- Datatable,
- SweetAlert 2,
- Bootstrap 4,
- Font Awesome.

---
