# Point-of-Sale (POS) Eloquent

**Course:** IT0049 (Web System Technologies)  
**Assessment:** Technical Formative Assessment 6 (TFA6) — From Arrays to Eloquent  
**Framework:** Laravel 13.x (PHP 8.3+)  
**Hosted Application:** [http://tfa6.freedev.app](http://tfa6.freedev.app)  
**GitHub Repository:** [https://github.com/aniciete/tfa6](https://github.com/aniciete/tfa6)  

---

## 1. Project Overview

This project extends and matures the Laravel Point-of-Sale (POS) system from TFA5 by replacing temporary in-memory static arrays with a fully integrated relational database tier powered by **Laravel Eloquent ORM**.

Following the foundational schema specifications established in **TFA2**, database migrations define the schema for `customers` and `users` tables, database seeders populate sample records, and Eloquent models (`Customer` and `User`) provide object-relational mapping without raw queries.

### Required Pages and Route Table

| URL Route | Route Name | Controller Action | Model / Data Source | View Template | Purpose |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `/` | `home` | `App\Http\Controllers\PageController::home` | N/A | `pages/home.blade.php` | POS application landing page with architectural overview and quick navigation |
| `/about` | `about` | `App\Http\Controllers\PageController::about` | Architecture Specification | `pages/about.blade.php` | Laravel MVC request execution lifecycle and Eloquent ORM storage memo |
| `/customers` | `customers.index` | `App\Http\Controllers\CustomerController::index` | `App\Models\Customer::all()` | `customers/index.blade.php` | Customer accounts directory listing full name, email, and phone |
| `/users` | `users.index` | `App\Http\Controllers\UserController::index` | `App\Models\User::all()` | `users/index.blade.php` | Staff user accounts directory listing username, full name, and role |

---

## 2. Technical Stack & Prerequisites

- **Language:** PHP 8.3 or higher (tested on PHP 8.5.11; deployment runs on PHP 8.2+)
- **Required PHP Extensions:** `pdo_sqlite`, `pdo_mysql`, `mbstring`, `openssl`, `curl`, `xml`, `bcmath`, `intl`, `gd`, `zip`
- **Package Managers:** Composer 2.x & npm 10.x / Node.js 22.x
- **Framework:** Laravel 13.x
- **Frontend & Bundling:** Blade + Tailwind CSS v4 + Vite
- **Typography & Theme:** Bright-Market Open-Ledger Design System (Self-hosted `Bricolage Grotesque` and `IBM Plex Mono`)
- **Database:**
  - **Local Development / Tests:** SQLite (`database/database.sqlite`) for instantaneous, zero-configuration setup.
  - **Production Hosting:** MySQL on InfinityFree (`sql110.infinityfree.com`, database: `if0_43258606_tfa6`).
  - **Schema & Seeder Export:** `database/schema_export.sql` containing standalone DDL and DML statements.

---

## 3. Local Development Setup

### 3.1 Clone the Repository
```bash
git clone https://github.com/aniciete/tfa6.git
cd tfa6
```

### 3.2 Install Dependencies
Install PHP dependencies:
```bash
composer install
```
Install frontend dependencies:
```bash
npm install
```

### 3.3 Configure Environment File
Copy the example environment template to `.env`:
```bash
cp .env.example .env
```
Generate the application key:
```bash
php artisan key:generate
```
Run database migrations and seeders:
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### 3.4 Build Frontend Assets
Compile assets for development or production:
```bash
npm run build
```

### 3.5 Start the Local Development Server
To launch both the PHP development server and Vite hot reload concurrently:
```bash
composer run dev
```
Or start the backend server individually:
```bash
php artisan serve
```
Access the application locally at: **[http://localhost:8000](http://localhost:8000)**.

---

## 4. Architectural & Data Design

### 4.1 Transition: From Arrays to Eloquent
In accordance with the TFA6 laboratory activity instructions:
1. **Migrations Matching TFA2 Schema:**
   - `customers` table (`0001_01_01_000003_create_customers_table.php`):
     - `id`: Primary key (bigint unsigned auto-increment)
     - `full_name`: varchar(100) NOT NULL
     - `email`: varchar(100) NOT NULL UNIQUE
     - `phone`: varchar(20) DEFAULT NULL
     - `created_at`, `updated_at`: timestamps
   - `users` table (`0001_01_01_000000_create_users_table.php`):
     - `id`: Primary key (bigint unsigned auto-increment)
     - `username`: varchar(50) NOT NULL UNIQUE
     - `full_name`: varchar(100) NOT NULL
     - `role`: varchar(50) NOT NULL DEFAULT 'Staff Member'
     - `created_at`, `updated_at`: timestamps

2. **Eloquent Models (`app/Models/`):**
   - `Customer.php`: Extends `Illuminate\Database\Eloquent\Model` with `$fillable = ['full_name', 'email', 'phone']`.
   - `User.php`: Extends `Illuminate\Foundation\Auth\User` with `$fillable = ['username', 'full_name', 'role']`.

3. **Database Seeders (`database/seeders/`):**
   - `CustomerSeeder`: Populates 5 canonical records (Elena Rostova, Marcus Vance, Aria Thorne, Julian Mercer, Sophia Lin).
   - `UserSeeder`: Populates 5 canonical staff records (Carlos Reyes, Beatriz Castro, Daniel Valdez, Camille Santos, Leo Navarro).
   - `DatabaseSeeder`: Orchestrates seeding via `$this->call([CustomerSeeder::class, UserSeeder::class])`.

4. **Controllers & Views:**
   - `CustomerController::index()` executes `Customer::query()->orderBy('id')->get()`.
   - `UserController::index()` executes `User::query()->orderBy('id')->get()`.
   - Blade views iterate retrieved Eloquent model collections, displaying live records within responsive open-ledger tables.

---

## 5. Running Automated Tests

Run the automated test suite using Artisan:
```bash
php artisan test
```
The test suite (`tests/Feature/PosEloquentTest.php`) validates:
- HTTP 200 OK responses across all four defined routes (`/`, `/about`, `/customers`, `/users`).
- Accessible semantic landmarks (`role="banner"`, `role="main"`, `role="contentinfo"`, and skip link `#main-content`).
- Accessible active navigation tracking (`aria-current="page"`).
- Accurate rendering of seeded records retrieved via Eloquent models.
- Seeders populating at least 5 sample records in both tables.
- Eloquent model CRUD and timestamp casting behaviors.
- Proper HTTP 404 response for unmapped routes.
- Integrity of local assets (`assets/css/style.css`, `favicon.svg`, and self-hosted `.woff2` font files).

---

## 6. InfinityFree & FTP Deployment Architecture

### 6.1 Shared Hosting & Zero-Friction Architecture
Deploying modern Laravel applications to shared hosting environments like InfinityFree involves several known challenges that were addressed in this implementation:
1. **Preventing Pure-FTPd Timeouts:** Uploading thousands of files individually over FTP triggers strict Pure-FTPd connection limits and drops transfers. Instead, the deployment utilizes a **single-archive upload + server-side extraction** pattern:
   - Packaging bundles all production files, compiled assets, pre-seeded SQLite database, and lean dependencies into `tfa6-infinityfree.zip`.
   - `curl -T` uploads the single archive and `extract.php` in a single reliable connection.
   - `extract.php` unpacks the archive via PHP's native `ZipArchive` extension directly inside `/htdocs`, provisions MySQL tables from `database/schema_export.sql`, cleans up the ZIP, and self-destructs.
2. **Dual-Path Static Asset Resolution:** On InfinityFree, the document root is permanently bound to `/htdocs`. To ensure all stylesheets, fonts, and icons resolve cleanly without 404 or MIME errors, assets are mirrored at both the root level (`/assets/`, `/build/`) and within `/public/`.
3. **Eliminating Mixed Content SSL Errors:** Modern browsers block insecure stylesheets when a user navigates via HTTPS. The application configures trusted proxies (`$middleware->trustProxies(at: '*')`) in `bootstrap/app.php` and outputs protocol-relative asset links, ensuring assets match the protocol under both HTTP and HTTPS.

### 6.2 Automated Deployment Execution
Deploy the application with a single command via Bash:
```bash
./deploy-infinityfree.sh
```
Or via Python:
```bash
python3 scripts/deploy_infinityfree.py
```

The script automatically packages the application, transfers files to `ftpupload.net`, removes the default `index2.html` placeholder, and provides the extraction trigger.

Live application: **[http://tfa6.freedev.app/](http://tfa6.freedev.app/)**
