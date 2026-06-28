#  Sada Sosial

SADA SOSIAL

---

## 🚀 Petunjuk Instalasi & Menjalankan Proyek

Follow this instruction for running this project into your local :

### 1. Prasyarat (Prerequisites)
Install
- **PHP**: version `>= 8.2` (Recommend : 8.3.6)
- **Composer**: newest version
- **Node.js**: version `>= 22`
- **NPM**: according to your node js version

---

### 2. Pemasangan Dependensi & Pengaturan Lingkungan

1. **Install Composer:**
   ```bash
   composer install
   ```

2. **Install NPM:**
   ```bash
   npm install
   ```

3. **Copy env**
   ```bash
   cp .env.example .env
   ```

4. **Generate Key**
   ```bash
   php artisan key:generate
   ```

---

### 3. Database Configuration

This project use MySQL as databases

1. **Change database on env from sqlite to mysql**


2. **Run**
   ```bash
   php artisan migrate --seed
   ```
---

### 4. Run the Application

Run development server and frontend server 

1. **Choose php artisan or NGINX**
   ```bash
   php artisan serve
   ```
   *You can use NGINX also***

2. **Run VITE DEV SERVER**
   ```bash
   npm run dev
   ```

---

member :