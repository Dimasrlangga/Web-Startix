# SMART Ticketing System

Sistem tiket pintar yang mengintegrasikan web application dengan perangkat IoT untuk manajemen tiket event.

## Fitur Utama

1. Pembelian tiket online
2. Pembayaran dengan batas waktu 30 menit
3. QR Code untuk akses event
4. Sistem RFID untuk admin/staff
5. Keypad untuk akses darurat
6. Integrasi dengan AWS Cloud

## Persyaratan Sistem

### Web Application (Laravel)

-   PHP >= 8.1
-   Composer
-   MySQL/MariaDB
-   Node.js & NPM
-   AWS Account (untuk cloud storage)

### IoT Components (Raspberry Pi 3B)

-   Raspberry Pi 3B
-   RFID-RC522 Module
-   Pi Camera Module
-   Servo Motor
-   Keypad 4x4
-   Jumper Wires
-   Power Supply

## Instalasi

### 1. Web Application (Laravel)

```bash
# Clone repository
git clone [repository-url]

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Konfigurasi database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_ticketing
DB_USERNAME=root
DB_PASSWORD=

# Migrasi database
php artisan migrate

# Jalankan server
php artisan serve
npm run dev
```

### 2. IoT Setup (Raspberry Pi)

#### Hardware Setup

1. Hubungkan komponen sesuai diagram:

    - RFID-RC522:

        - SDA -> GPIO8
        - SCK -> GPIO11
        - MOSI -> GPIO10
        - MISO -> GPIO9
        - GND -> GND
        - RST -> GPIO25
        - 3.3V -> 3.3V

    - Servo Motor:

        - Signal -> GPIO18
        - VCC -> 5V
        - GND -> GND

    - Keypad 4x4:

        - R1 -> GPIO17
        - R2 -> GPIO27
        - R3 -> GPIO22
        - R4 -> GPIO23
        - C1 -> GPIO24
        - C2 -> GPIO25
        - C3 -> GPIO8
        - C4 -> GPIO7

    - Pi Camera:
        - Hubungkan ke port CSI

#### Software Setup

```bash
# Install dependencies
sudo apt-get update
sudo apt-get install python3-pip python3-dev
sudo apt-get install libzbar0
sudo apt-get install libopencv-dev

# Install Python packages
cd iot
pip3 install -r requirements.txt

# Konfigurasi API URL
# Edit file ticket_system.py dan ubah API_URL ke URL aplikasi Laravel Anda
```

## Penggunaan

### Web Application

1. Akses `http://localhost:8000`
2. Login sebagai admin untuk mengelola event
3. Pengguna dapat membeli tiket melalui website
4. QR Code akan dikirim ke email setelah pembayaran

### IoT System

1. Jalankan program Python:

```bash
python3 ticket_system.py
```

2. Mode Normal:

    - Scan QR Code dari tiket
    - Scan RFID card untuk admin/staff
    - Gunakan keypad untuk akses darurat:
        - 1234: Buka gerbang
        - A123: Mode pendaftaran kartu RFID

3. Mode Daftar Kartu:
    - Scan kartu RFID baru
    - Masukkan data admin/staff
    - Kartu akan terdaftar di sistem

## Keamanan

1. QR Code dienkripsi dan hanya bisa dibaca oleh sistem
2. Data tiket disimpan di AWS Cloud
3. Pembayaran memiliki batas waktu 30 menit
4. Akses darurat melalui keypad dengan kode khusus
5. Logging semua aktivitas akses

## Troubleshooting

1. Jika kamera tidak terdeteksi:

    ```bash
    sudo raspi-config
    # Enable Camera
    sudo reboot
    ```

2. Jika RFID tidak berfungsi:

    - Periksa koneksi kabel
    - Pastikan power supply cukup (3.3V)

3. Jika servo tidak bergerak:
    - Periksa koneksi kabel
    - Pastikan power supply 5V cukup

## Kontribusi

Silakan buat pull request untuk kontribusi. Untuk perubahan besar, buka issue terlebih dahulu untuk mendiskusikan perubahan yang diinginkan.

## Lisensi

[MIT License](LICENSE)
