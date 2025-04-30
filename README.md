# framework-phpfram-0.1
Selamat Datang di Framework PHP FRAM. Framework PHP yang ringan dan cepat untuk pengembangan web modern.
Framwork ini masih dalam pengembangan, jadi harap wajar jika masih terdapat banyak kekurangan.

Saran dan masukan untuk perbaikan dan penyempurnaan harap kabari saya
via Tiktok: https://www.tiktok.com/@m45h4run

TUTORIAL INSTALASI
==========
1.= Buka file config -> config.php

..= Sesuaikan keperluan yang ada (database dan base_url)

2.= Buat database mysql

..= sesuaikan dengan konfigurasi database dengan poin 1

3.= Buat tabel (user) karna ada bawaan CRUD di rancangan ini.


==========

/* untuk point 3

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
nama VARCHAR(255) NOT NULL,
email VARCHAR(255) UNIQUE NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

*/

==========


