# Fretastic - Setup (PHP + MySQL)

1. Install XAMPP (or any Apache + PHP 8+ + MySQL/MariaDB stack) and start **Apache** and **MySQL**.
2. Copy this `WSaT_html` folder into `C:\xampp\htdocs\`.
3. Open phpMyAdmin (http://localhost/phpmyadmin) -> **SQL** tab -> paste/run `database/fretastic.sql`
   (run it as `root`; it creates the `Fretastic` database, the `fretastic_app` user and the `users` table).
4. Open http://localhost/WSaT_html/ and use **Buy Guitars** or **Sell Products** to register, then sign in.

Database credentials live in `config/config.php`. They must match the user in `database/fretastic.sql`.

Protected pages (redirect to login if you are not signed in):
- Buyer: home.php, products.php, services.php, contact.php
- Seller: seller.php, sales.php
