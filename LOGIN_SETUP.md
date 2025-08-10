# Setup Sistem Login

## Langkah-langkah Setup

### 1. Jalankan Migration
```bash
php artisan migrate
```

### 2. Jalankan Seeder untuk User Default
```bash
php artisan db:seed --class=UserSeeder
```

Atau jalankan semua seeder:
```bash
php artisan db:seed
```

### 3. Akun Login Default

Setelah menjalankan seeder, Anda dapat login dengan akun berikut:

**Admin:**
- Email: `admin@dokumen.com`
- Password: `password123`

**Demo User:**
- Email: `demo@dokumen.com`
- Password: `demo123`

### 4. Akses Halaman

- **Login:** `/login`
- **Register:** `/register`
- **Dashboard:** `/dashboard` (memerlukan login)
- **Detail:** `/dashboard/detail` (memerlukan login)

### 5. Fitur yang Tersedia

- ✅ Halaman login dengan desain elegant
- ✅ Halaman register untuk pendaftaran user baru
- ✅ Sistem autentikasi lengkap
- ✅ Middleware untuk melindungi route
- ✅ Tombol logout di dashboard dan detail
- ✅ Remember me functionality
- ✅ Validasi form dengan pesan error dalam bahasa Indonesia
- ✅ Redirect otomatis setelah login/logout
- ✅ Session management

### 6. Keamanan

- Password di-hash menggunakan bcrypt
- CSRF protection pada semua form
- Session regeneration setelah login
- Middleware auth untuk route yang dilindungi

### 7. Desain

- Tema elegant dengan gradient teal
- Glass morphism effects
- Responsive design
- Animasi smooth
- Konsisten dengan tema dashboard yang sudah ada