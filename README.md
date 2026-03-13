# Nickel Mine Vehicle Monitoring System

Sistem Manajemen Armada Kendaraan yang dirancang khusus untuk operasional pertambangan nikel. Aplikasi ini menangani pemesanan aset, persetujuan bertingkat, monitoring konsumsi BBM otomatis, dan penjadwalan servis berkala.

## Fitur Unggulan

-   **Dashboard Dinamis**: Visualisasi statistik kendaraan, intensitas pemakaian, dan biaya servis menggunakan Chart.js.
-   **Persetujuan Bertingkat (Multi-level Approval)**: Alur pemesanan yang memerlukan persetujuan dari Supervisor (Layer 1) dan Manager (Layer 2).
-   **Tracking BBM Otomatis**: Menghitung konsumsi BBM secara otomatis berdasarkan rasio bahan bakar kendaraan setelah perjalanan selesai.
-   **Service & Maintenance**: Pencatatan riwayat servis dan pengingat jadwal servis berikutnya.
-   **Laporan Periodik**: Ekspor riwayat penggunaan kendaraan ke format Excel (.xlsx).
-   **Responsive & Modern UI**: Menggunakan tema warna *Earthy Palette* yang elegan dan navigasi yang dioptimalkan untuk berbagai perangkat.
-   **Pagination**: Manajemen data besar yang rapi di semua tabel utama.

## Teknologi

-   **Backend**: Laravel 11.x (PHP 8.2+)
-   **Frontend**: Tailwind CSS, Blade, Chart.js
-   **Database**: SQLite (Default)
-   **Package Utama**: `maatwebsite/excel` (Reporting)

## Akun Demo (Default)

| Role | Email | Password |
|------|-------|----------|
| **Admin** | `admin@nikel.com` | `password` |
| **Supervisor** | `supervisor@nikel.com` | `password` |
| **Manager** | `manager@nikel.com` | `password` |

## Instalasi & Setup

1. **Clone Repository**
2. **Install Dependencies**
   ```bash
   composer install
   npm install && npm run dev
   ```
3. **Konfigurasi Environment**
   Salin `.env.example` ke `.env` dan jalankan `php artisan key:generate`.
4. **Migrasi & Seed Data**
   ```bash
   php artisan migrate:fresh --seed
   ```
5. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

## Arsitektur & Logika
Aplikasi ini dibangun dengan logika bisnis yang ketat:
- **Asset Locking**: Kendaraan dan Driver yang statusnya `in_use` akan terkunci otomatis dan tidak muncul di form pesanan baru.
- **BBM Logic**: Konsumsi BBM = `Jarak Tempuh (KM)` / `Rasio BBM Mobil (KM/Liter)`.

## Physical Data Model
<img width="1074" height="1036" alt="Screenshot 2026-03-13 041949" src="https://github.com/user-attachments/assets/366b3735-6cdb-49ad-bece-6ae33f121266" />

## Activity Diagram
<img width="531" height="1060" alt="Screenshot 2026-03-13 041741" src="https://github.com/user-attachments/assets/534d970a-7c75-47ae-a06c-ad6329999871" />

---
