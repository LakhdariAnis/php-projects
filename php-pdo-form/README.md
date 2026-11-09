# Developer Form (plain PHP + PDO)

The same developer-registration form as in the Laravel app, written without a framework.

- `db.php`: PDO connection to MySQL with exceptions on.
- `index.php`: loads the languages from the database and shows them as checkboxes. Output is escaped with `htmlspecialchars`. jQuery checks the form before it is sent.
- `process.php`: validates again on the server, keeps only languages that exist in the database, and inserts with a prepared statement.
- `database.sql`: creates the database and the two tables.

## Run (XAMPP / WAMP)

1. Import `database.sql` in phpMyAdmin.
2. Copy the folder to `htdocs/`.
3. Open `http://localhost/php-pdo-form/`.
