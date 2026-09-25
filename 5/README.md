# Assignment 5 — AJAX, PHP, SQL & Node JS

## Requirements covered
1. Basic Node.js server using only built-in `http` module → `node/server.js`
2. MySQL database + table + 5 sample records → `sql/college.sql`
3. PHP + AJAX fetch/display → `php/fetch.php`
4. AJAX form insert → `php/insert.php`
5. Live AJAX search → `php/fetch.php`
6. PHP array total/average + grade → `php/stats.php`
7. AJAX Edit/Delete → `php/update.php`, `php/delete.php`
8. AJAX column sorting → `fetch.php` with `sort` and `order`

## Setup

### 1. MySQL
Use XAMPP/WAMP/MAMP or another MySQL installation.

Import `sql/college.sql` in phpMyAdmin or MySQL.

The project currently uses:
- Database: `college`
- Table: `students1`
- User: `root`
- Password: empty

If your MySQL password is different, edit `php/db.php`.

### 2. PHP server
Open a terminal inside the `5` folder and run:

```powershell
php -S localhost:8000
```

Then open:

```text
http://localhost:8000/index.html
```

Do not open `index.html` by double-clicking it because PHP/AJAX requests need a server.

### 3. Node.js
Open another terminal inside `5\node`:

```powershell
node server.js
```

Open:

```text
http://localhost:3000
```

It should display:

```text
Hello Node
```

## Important note about Q2
The assignment says the table should be named after your own roll number. This project uses `students1` because that is the table name configured for this assignment. If your teacher strictly requires your roll number, replace `students1` in:
- `sql/college.sql`
- `php/db.php`
- any SQL queries if you change the variable approach

Then import the SQL again.

## PHP mysqli
If PHP reports `Class "mysqli" not found`, enable the mysqli extension in your `php.ini`:

```ini
extension=mysqli
```

Restart the PHP development server after changing `php.ini`.

## Visual features
The page includes responsive styling, cards, live search, AJAX messages, grade badges, edit modal, delete confirmation, sortable columns, and mobile-friendly layout.
