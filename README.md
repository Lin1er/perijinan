# Website Perizinan Anak Asrama

Website ini dirancang untuk mempermudah proses pengelolaan perizinan keluar dan kembali bagi siswa asrama. Dengan sistem ini, orang tua, guru, dan pihak keamanan dapat berkolaborasi secara efisien dalam mengelola izin pulang.

## Fitur

- **Pendaftaran Akun Orang Tua**: Orang tua dapat membuat akun untuk mengajukan izin pulang anak.
- **Pengajuan Izin Pulang**: Orang tua dapat mengajukan izin pulang dengan detail alasan dan tanggal.
- **Verifikasi Guru**: Guru berwenang dapat menyetujui atau menolak pengajuan izin dengan memberikan alasan.
- **Validasi Pos Satpam**: Pos satpam memvalidasi status siswa saat dijemput dan saat kembali ke asrama.
- **Notifikasi Real-Time**: Sistem mengirim notifikasi status pengajuan izin.
- **Status Perizinan**: Siswa memiliki status yang jelas.

## Teknologi

Aplikasi ini dibangun dengan teknologi berikut:
- **Backend**: Laravel 11
- **Frontend**: Blade, Tailwind CSS
- **Database**: MySQL
- **Manajemen Role dan Permission**: Spatie/Permission
- **Real-Time Notification**: Pusher atau Laravel Echo
- **PDF Generator**: Laravel DOMPDF (dengan Tailwind CSS untuk styling)
- **Tunneling**: Ngrok untuk testing akses online

## Instalasi

### Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL atau MariaDB
- Node.js
- Ngrok (opsional)

### Langkah Instalasi

1. Clone repository ini:
    ```bash
    git clone https://github.com/username/izin-asrama.git
    ```

2. Masuk ke folder proyek:
    ```bash
    cd izin-asrama
    ```

3. Install dependensi backend:
    ```bash
    composer install
    ```

4. Salin file `.env.example` ke `.env` dan sesuaikan konfigurasi database:
    ```bash
    cp .env.example .env
    ```

5. Generate key aplikasi:
    ```bash
    php artisan key:generate
    ```

6. Jalankan migrasi dan seeder:
    ```bash
    php artisan migrate --seed
    ```

7. Install dependensi frontend:
    ```bash
    npm install
    ```

8. Build assets frontend:
    ```bash
    npm run dev
    ```

9. Jalankan server aplikasi:
    ```bash
    php artisan serve
    ```

10. (Opsional) Jalankan Ngrok untuk akses dari internet:
    ```bash
    ngrok http 8000
    ```

Aplikasi akan berjalan di `http://localhost:8000`.

## Penggunaan

- **Orang Tua**: 
  - Mendaftar akun untuk mengajukan izin pulang anak.
  - Memantau status pengajuan izin.
- **Guru**:
  - Memverifikasi pengajuan izin dengan menyetujui atau menolak.
- **Satpam**:
  - Memvalidasi status siswa saat dijemput dan saat kembali ke asrama.

## Kontribusi

Kami menerima kontribusi untuk meningkatkan aplikasi ini. Fork repository ini, buat cabang baru (`git checkout -b fitur-baru`), lakukan perubahan, dan kirim pull request.

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
