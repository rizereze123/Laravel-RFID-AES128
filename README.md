Sistem Pengamanan Pintu RFID berbasis IoT dengan Algoritma Enkripsi AES-128 (Protokol Komunikasi MQTT).
Repository ini untuk Web Dashboard dalam pencatatan, pendataan, pendaftaran, dan manajemen pengguna hak akses kartu RFID.

Sistem ini merupakan buah hasil dari pengembangan dan penelitian yang dilakukan oleh Dhimaz Purnama Adjhi untuk menyelesaikan skripsinya dalam meraih gelar sarjana teknik. Inovasi ini diharapkan menjadi standar industri untuk ruangan dengan tingkat keamanan tinggi seperti ruangan server, ruang balita di rumah sakit, laboratorium, gudang, dan brankas. Dengan demikian, penelitian ini berkontribusi pada pengembangan paradigma keamanan yang lebih tangguh dalam protokol komunikasi MQTT melalui penerapan enkripsi data AES-128, meningkatkan integritas dan kerahasiaan data dalam sistem pengamanan pintu RFID berbasis IoT. Hasil penelitian menunjukkan bahwa implementasi algoritma enkripsi AES-128 berhasil mengamankan data penting seperti UID kartu/tag RFID pada sistem pengamanan pintu RFID berbasis IoT, mencegah penyalahgunaan hak akses, dan mengurangi risiko serangan network sniffing dan MiTM.

## Feature

-   Admin & Staff, History Pencatatan Masuk dan Keluar Pintu Saat Ini (Hari Ini)
-   Admin, History All Department Room (Filter, Reset, and Export to Excel)
-   Admin, Manajemen dan Pendaftaran Pengguna Staff Kartu RFID
-   Admin, Manajemen dan Pendaftaran Pengguna Staff Akun Web
-   Admin, Manajemen dan Pembuatan Doorlock RFID
-   Admin, Switching Mode Enrollment dan LogHistory
-   Admin, Aktivasi Pengguna Staff Kartu RFID dan Akun Web
-   Guest, Login dan SignUp

## Tech

-   Laravel 10
-   LAMP Stack
-   MQTTHandler Console for MQTTClient library
-   CryptoJS
-   Bootstrap 4
-   Ramsey for Random Generate UID library
-   Mattwebsite for Excel library
