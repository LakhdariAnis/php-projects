# Student Manager (Laravel 12)

Small Laravel app with two parts:

- **Students**: full CRUD (list, search, paginate, view, add, edit, delete) with server-side validation.
- **Developers**: a registration form (full name + languages known). Languages come from the database. The form is checked in jQuery first and validated again on the server.

## What it shows

- Resource routes and controllers, route model binding
- Eloquent model, migrations, factory and seeder
- Validation rules (unique email that ignores the current row on update, regex, `exists`) and custom error messages
- Blade layouts, `old()` input, flash messages, Bootstrap 5 pagination
- Query Builder (`DB::table`) next to Eloquent
- Feature tests with PHPUnit and an in-memory SQLite database

## Run

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Open http://127.0.0.1:8000

## Tests

```bash
php artisan test
```
