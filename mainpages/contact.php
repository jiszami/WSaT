<?php
require __DIR__ . '/../includes/auth.php';
$user = require_login('buyer');
?>
<!DOCTYPE html>

<html>

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> Fretastic: Contact </title>

        <link rel="icon" type="image/png" href="../images/fret.png">
        <link rel="stylesheet" href="../css/Contact.css">
        <link rel="stylesheet" href="../css/Profile.css">

    </head>

    <body>

        <header class="head"><img src="../images/Fretasticcc.png" class="logo" alt="Fretastic Logo">

      <?php require __DIR__ . '/../includes/profile_menu.php'; ?>


            <nav class="nav">

                <a href="home.php"><strong>Home</strong></a>
                <a href="products.php"><strong>Products</strong></a>
                <a href="services.php"><strong>Services</strong></a>

            </nav>

        </header>

        <main class="container">

            <div class="box"><h1>Contact Us</h1><p class="title">Get in Touch with Fretastic</p>

                <form class="form" action="#" method="post">
                    <input type="text" name="name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="message" placeholder="Write your message here..." rows="5" required></textarea>
                    <button type="submit">Send Message</button>
                </form>

            </div>

        </main>

        <footer class="footer">
            
        </footer>

    <script src="../js/profile.js"></script>

    </body>

</html>