Sistem Pengamanan Pintu RFID berbasis IoT dengan Algoritma Enkripsi AES-128 (Protokol Komunikasi MQTT).
Repository ini untuk Web Dashboard dalam pencatatan, pendataan, pendaftaran, dan manajemen pengguna hak akses kartu RFID.

Sistem ini merupakan buah hasil dari pengembangan dan penelitian yang dilakukan oleh Dhimaz Purnama Adjhi untuk menyelesaikan skripsinya dalam meraih gelar sarjana teknik. Inovasi ini diharapkan menjadi standar industri untuk ruangan dengan tingkat keamanan tinggi seperti ruangan server, ruang balita di rumah sakit, laboratorium, gudang, dan brankas. Dengan demikian, penelitian ini berkontribusi pada pengembangan paradigma keamanan yang lebih tangguh dalam protokol komunikasi MQTT melalui penerapan enkripsi data AES-128, meningkatkan integritas dan kerahasiaan data dalam sistem pengamanan pintu RFID berbasis IoT. Hasil penelitian menunjukkan bahwa implementasi algoritma enkripsi AES-128 berhasil mengamankan data penting seperti UID kartu/tag RFID pada sistem pengamanan pintu RFID berbasis IoT, mencegah penyalahgunaan hak akses, dan mengurangi risiko serangan network sniffing dan MiTM.

![Screenshot 2024-05-12 at 23-43-07 Login Smart Door-Lock RFID](https://github.com/user-attachments/assets/002c4abe-f425-4a89-8826-6284793b9fe7)
![Screenshot 2024-05-12 at 23-43-18 Register Smart Door-Lock RFID](https://github.com/user-attachments/assets/0c72c2d9-9b2b-449c-851a-d425416f280b)
![Screenshot 2024-05-12 at 23-44-31 Histori Smart Lock-Door Hari Ini](https://github.com/user-attachments/assets/2a2f7f1b-dccc-4878-b919-a75d920b2f0d)
![Screenshot 2024-05-13 at 21-22-41 List Pengguna Kartu RFID](https://github.com/user-attachments/assets/c4433b0c-d162-47a4-9686-448a5b549d97)
![Screenshot 2024-05-13 at 21-24-58 List Kartu RFID](https://github.com/user-attachments/assets/ffe9f1f4-ebec-47a4-8073-3a7ce69eee04)
![Screenshot 2024-05-13 at 21-25-09 List Perangkat DoorLock RFID](https://github.com/user-attachments/assets/70992838-67de-44d5-8957-6d15dda98fd2)
![Screenshot 2024-05-13 at 21-25-27 Histori DoorLock RFID](https://github.com/user-attachments/assets/304d28f1-611b-45b2-921f-aa9a71dd5941)
![Screenshot 2024-05-13 at 21-25-42 List Akun Website Pengguna](https://github.com/user-attachments/assets/99f0304d-0c3b-436a-badc-6445791b0042)

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

![Skenario Sistem Protokol Komunikasi MQTT drawio](https://github.com/user-attachments/assets/715c67b4-9709-40b7-b5ee-f5043fb4833b)
![erd(1) vpd(1)](https://github.com/user-attachments/assets/4befc0b4-b5ff-4af5-89df-e989d0ef5ed6)
![use case diagram](https://github.com/user-attachments/assets/bc53892d-6af6-41b1-b9da-5de4bf5cd175)
![sequence vpd](https://github.com/user-attachments/assets/82f662bf-e57a-4749-8ce6-2108ff4da690)
![sequence-enroll vpd](https://github.com/user-attachments/assets/d76fde14-57bc-4929-a96f-d6865a619b5c)
![Activity Diagram UML drawio](https://github.com/user-attachments/assets/8002a63d-791f-45ea-81a4-c1899971ce05)

