# Student Management — Laravel + Supabase PostgreSQL

A beginner-friendly Student Management CRUD MVP built with Laravel 13, Blade, Eloquent, and Supabase PostgreSQL.

## Stack

- Laravel 13
- PHP 8.3+
- Supabase PostgreSQL
- Laravel Eloquent ORM
- Blade templates
- Vite + plain CSS/JavaScript
- Git/GitHub ready

> Laravel 13 is the current stable major release. Laravel 13 requires PHP 8.3 or newer, so PHP 8.3+ is the practical minimum for this project.

## Features

- Create, list, view, edit, and delete students
- Backend validation for every create/update request
- Unique student email validation with update-safe ignore behavior
- Server-side search by name, email, or course
- Pagination on the student list
- Flash success/error messaging
- CSRF protection on web forms
- Browser confirmation before delete
- REST API for the same Student resource
- Laravel API Resource JSON formatting
- Environment-based Supabase database configuration
- No authentication, payments, complex roles, or unnecessary dashboard features

## Project structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/StudentController.php
│   │   ├── Controller.php
│   │   └── StudentController.php
│   └── Resources/StudentResource.php
└── Models/Student.php

database/
├── factories/StudentFactory.php
├── migrations/2026_08_30_000000_create_students_table.php
└── seeders/DatabaseSeeder.php

resources/views/
├── layouts/app.blade.php
└── students/
    ├── create.blade.php
    ├── edit.blade.php
    ├── index.blade.php
    ├── show.blade.php
    └── partials/form.blade.php

routes/
├── api.php
├── console.php
└── web.php
```

## Fresh installation

### 1. Requirements

Install locally:

- PHP 8.3+
- Composer 2.x
- Node.js 20+
- npm
- PostgreSQL connectivity (the database is Supabase PostgreSQL)
- Git

For PHP, make sure the PostgreSQL PDO extension is enabled (`pdo_pgsql`).

### 2. Install PHP dependencies

From the project directory:

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Create environment file

```bash
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell, use:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

### 5. Configure Supabase PostgreSQL

Open `.env` and replace the placeholder database values:

```env
DB_CONNECTION=pgsql
DB_HOST=your-project-ref.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-supabase-database-password
```

Use the exact PostgreSQL connection details provided by your Supabase project. Never commit real credentials.

If your Supabase project gives you a pooler connection instead of the direct database hostname, use the host, port, database, username, password, and SSL settings supplied by Supabase.

### 6. Run migrations

```bash
php artisan migrate
```

Optional development seed data:

```bash
php artisan db:seed
```

The seed creates 12 sample students.

### 7. Build frontend assets

```bash
npm run build
```

### 8. Start Laravel

```bash
php artisan serve
```

Open:

- Web CRUD: http://127.0.0.1:8000/students
- API: http://127.0.0.1:8000/api/students

For local frontend hot reload during development, use:

```bash
npm run dev
```

## Web routes

```text
GET     /students
GET     /students/create
POST    /students
GET     /students/{student}
GET     /students/{student}/edit
PUT     /students/{student}
DELETE  /students/{student}
```

Routes are declared with:

```php
Route::resource('students', StudentController::class);
```

## API routes

```text
GET     /api/students
POST    /api/students
GET     /api/students/{student}
PUT     /api/students/{student}
DELETE  /api/students/{student}
```

Example response:

```json
{
  "data": {
    "id": 1,
    "name": "Ali",
    "email": "ali@example.com",
    "phone": "03001234567",
    "course": "Flutter"
  }
}
```

Note: Laravel API Resources wrap a single resource in a `data` object by default. Collection and pagination responses use Laravel's standard resource collection structure.

### API status codes

- `200 OK` — successful read, update, or delete
- `201 Created` — successful create
- `422 Unprocessable Entity` — validation failure
- `404 Not Found` — missing student route-model binding

### API validation example

```bash
curl -X POST http://127.0.0.1:8000/api/students   -H "Accept: application/json"   -H "Content-Type: application/json"   -d '{"name":"Ali","email":"ali@example.com","phone":"03001234567","course":"Flutter"}'
```

## Search

The Students page sends the search term to Laravel as a query parameter:

```text
/students?search=Flutter
```

The controller performs the filtering with Eloquent/PostgreSQL using `ILIKE` across `name`, `email`, and `course`. No full dataset is downloaded to the browser for filtering.

## Validation rules

```text
name   → required|string|max:255
email  → required|email|unique:students,email
phone  → nullable|string|max:20
course → required|string|max:255
```

On update, the current student's existing email is ignored by the unique rule so saving without changing the email works correctly.

## Security notes

- Web forms use Laravel CSRF protection.
- All incoming student data is validated server-side.
- Eloquent is used instead of manually concatenated SQL.
- Blade escapes output with normal `{{ }}` syntax.
- Database credentials are read from environment variables.
- `.env` is ignored by Git and is not present in `.env.example`.
- API validation errors return JSON with HTTP `422`.

## Production deployment preparation

1. Provision a Laravel-compatible PHP runtime (PHP 8.3+).
2. Configure Supabase PostgreSQL using production environment variables.
3. Set production-safe environment values:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.example
DB_CONNECTION=pgsql
```

4. Install dependencies without development packages:

```bash
composer install --no-dev --optimize-autoloader
```

5. Build frontend assets:

```bash
npm install
npm run build
```

6. Run migrations:

```bash
php artisan migrate --force
```

7. Cache production configuration/routes/views where your hosting workflow supports it:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

8. Point the web server document root to `public/`.

Do not assume a generic Vercel PHP setup can run Laravel automatically. Use a Laravel-specific deployment configuration or a platform/runtime that explicitly supports the Laravel application lifecycle.

## Git/GitHub

Initialize and commit the repository:

```bash
git init
git add .
git commit -m "Build Laravel Supabase student CRUD MVP"
```

Create a GitHub repository, then add its remote and push:

```bash
git remote add origin https://github.com/YOUR_USERNAME/student-management.git
git branch -M main
git push -u origin main
```

The repository intentionally excludes:

```text
.env
/vendor
/node_modules
/public/build
```

## Architecture

```text
Browser
   ↓
Laravel Routes
   ↓
Controller
   ↓
Eloquent Model
   ↓
Supabase PostgreSQL
```

For the JSON API, Laravel Resource formatting sits between the controller and the HTTP response:

```text
Client
   ↓
/api Routes
   ↓
API Controller
   ↓
Eloquent Model
   ↓
StudentResource
   ↓
JSON response
```

## Notes for this MVP

This project deliberately avoids authentication, payments, complex roles, SPA frameworks, and unrelated packages. The goal is a small CRUD application that is easy to understand, deploy, and extend.
