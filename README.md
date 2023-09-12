# HOW TO CLONE FILE HERE

## Terdapat beberapa langkah-langkah yang harus di lakukan untuk melakukan clone file ini di device komputer anda
next step by step clone repository:

Untuk melakukan clone file Laravel dari GitHub menggunakan Git Bash, ikuti langkah-langkah berikut:

1. Buka Git Bash di komputer Anda.

2. Buka halaman repositori Laravel di GitHub yang ingin Anda clone.

3. Klik tombol "Code" (berwarna hijau) di atas daftar file.

4. Salin URL repositori yang disediakan. Misalnya, `https://github.com/username/repository.git`.

5. Kembali ke Git Bash, pindah ke direktori tempat Anda ingin menyimpan repositori Laravel yang di-clone. Gunakan perintah `cd` untuk berpindah direktori. Misalnya, jika Anda ingin menyimpannya di direktori `C:\xampp\htdocs`, gunakan perintah `cd C:/xampp/htdocs`.

6. Ketik perintah `git clone` diikuti dengan URL repositori yang telah Anda salin sebelumnya. Misalnya, `git clone https://github.com/username/repository.git`. Tekan Enter untuk menjalankan perintah.

7. Git Bash akan mulai mengunduh repositori Laravel dari GitHub. Tunggu sampai proses selesai.

8. Setelah selesai, Anda akan memiliki salinan repositori Laravel di direktori yang telah Anda tentukan sebelumnya.

Sekarang Anda dapat menggunakan dan mengelola repositori Laravel yang telah di-clone di komputer Anda.


## Sabar, Broo masih terdapat langkah-langkah yang wajib dilakukan setelah melakukan step-step diatas.
# Berikut step-step yang wajib dilakukan diantaranya adalah: 

Setelah melakukan clone repo Laravel, ada beberapa langkah yang perlu Anda lakukan untuk menjalankan aplikasi Laravel:

1. Buka terminal (Git Bash atau CMD) dan pindah ke direktori repo Laravel yang telah Anda clone. Gunakan perintah `cd` untuk berpindah direktori. Misalnya, jika direktori repo Laravel berada di `C:\xampp\htdocs\laravel-app`, gunakan perintah `cd C:/xampp/htdocs/laravel-app`.

2. Pastikan Anda telah menginstal dependencies yang diperlukan. Jalankan perintah `composer install` untuk menginstal dependencies PHP menggunakan Composer. Pastikan Composer telah terinstal di sistem Anda sebelum menjalankan perintah ini.

3. Salin file `.env.example` menjadi `.env`. Jalankan perintah `cp .env.example .env` di terminal (Linux/Mac) atau `copy .env.example .env` di Command Prompt (Windows).

4. Generate kunci aplikasi Laravel dengan menjalankan perintah `php artisan key:generate`.

5. Atur koneksi database di file `.env` sesuai dengan konfigurasi database Anda. Pastikan parameter seperti `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` telah diatur dengan benar.

6. Jalankan migrasi database dengan menjalankan perintah `php artisan migrate`. Ini akan membuat tabel-tabel database yang dibutuhkan oleh aplikasi Laravel.
7. Jika terdapat data dummy, maka lakukan perintah php artisan db:seed
   // NOTE: secara default file tersebut terdapat data dummy/fake untuk admin, maka wajib melakukan  setep ini

9. Setelah migrasi selesai, Anda dapat menjalankan aplikasi Laravel dengan perintah `php artisan serve`. Ini akan menjalankan server pengembangan lokal dan memberikan URL aplikasi (biasanya `http://localhost:8000`).

Setelah menjalankan langkah-langkah di atas, Anda seharusnya dapat mengakses aplikasi file Laravel yang telah Anda clone dengan menggunakan URL yang diberikan oleh perintah `php artisan serve`. Pastikan Anda juga telah mengonfigurasi web server (misalnya Apache atau Nginx) jika ingin menjalankan aplikasi di lingkungan yang berbeda.

### IF HAS BUG OR ERROR PLEASE CONTAT ME ON BIO MY PROFILE GITHUB..
### ENJOY, THANKS YOU. HAVE A NICE DAY.! ###
