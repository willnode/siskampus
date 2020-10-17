# Siskampus

Sistem Kampus Indonesia. Modern, Integrated dan Open Source.

Sistem didesain sesederhana dan semodular mungkin. Oleh karena itu, sistem ini membutuhkan teknologi terbaru, PHP +7.2, Nginx dan PostgreSQL.

Masih WIP. Fokus masih di fitur dan UX. Keamanan mungkin diketatkan lain waktu.

Goal:
+ Penyetaraan kualitas akademik
+ Meningkatkan standar layanan
+ Memotong biaya maintenance

Modul:
+ Master (basis akun)
+ Meeting (arsip rapat)
+ Research (tugas akhir)
+ Payment (pembayaran gaji)
+ Welcome (pendaftaran baru)
+ Course (rumusan akademik)
+ Asset (pengelolaan aset)

Sponsor:
+ [UNWAHA](//unwaha.ac.id)
+ [Kampus anda?](mailto:willnode@wellosoft.net?subject=Saya+ingin+menjadi+partner+siskampus)

Instalasi:
+ `git clone` dan pindah ke root folder nginx
+ buat database baru, impor dan atur file .env di master & skripsi (lihat dari `env`)
+ `cd html/master && composer install && cd ../static && npm install && cd ../master`
+ bikin user student, lecturer, operator, id terserah dan data kosong `{}`
+ `php spark clear-user && php spark generate-user`

Running:
+ `nginx`
+ `php-cgi.exe -b 127.0.0.1:9000`
