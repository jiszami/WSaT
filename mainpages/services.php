<?php
require __DIR__ . '/../includes/auth.php';
$user = require_login('buyer');
?>
<!DOCTYPE html>

<html>

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> Fretastic: Services </title>

        <link rel="icon" type="image/png" href="../images/fret.png">
        <link rel="stylesheet" href="../css/Services.css">
        <link rel="stylesheet" href="../css/Cart.css">
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

        <section id="services"><h2>Guitar Tutorials</h2>

            <div class="videolist">

                <div class="video"><img src="../images/Screenshot 2026-10-11 193011.png" alt="Guitar Tutorial"><h3>Guitar Tutorial</h3>
                    <p>Learn how to change your acoustic guitar strings with this step-by-step tutorial.</p>
                    <a class="watch" href="https://youtu.be/JeDBU_LjHCY?si=SrAbm8O-W5z0MsKL" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="../images/Screenshot 2026-11-02 073829.png" alt="Parts of the Guitar"><h3>Parts of the Guitar</h3>
                    <p>Learn about the different parts of a guitar and their functions.</p>
                    <a class="watch" href="https://youtu.be/_C1ISlvM09g?si=gXnC2LtrhkwA3-ID" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="../images/Screenshot 2026-11-02 074205.png" alt="Learn 3 chordsd in 3 minutes"><h3>Learn 3 Chords in 3 Minutes</h3>
                    <p>Learn how to play three essential guitar chords in just three minutes.</p>
                    <a class="watch" href="https://youtu.be/d52MZJw-hIE?si=uW0CZxLKtUlkZSeL" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="../images/Screenshot 2026-11-02 074452.png" alt="Guitar History"><h3>Guitar History</h3>
                    <p>Learn about the evolution of the guitar and its impact on music.</p>
                    <a class="watch" href="https://youtu.be/pP-vCSjLtto?si=1153iHBqgulmFSMi" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="../images/Screenshot 2026-11-02 074703.png" alt="Which Guitar is Right for You?"><h3>Which Guitar is Right for You?</h3>
                    <p>Learn how to choose the right guitar based on your playing style and preferences.</p>
                    <a class="watch" href="https://youtu.be/ib1weRKLuLA?si=yIF5ukWr2aHgUX07" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="../images/Screenshot 2026-11-02 075206.png" alt="Clean Your Acoustic Guitar"><h3>Clean Your Acoustic Guitar</h3>
                    <p>Learn how to properly clean and maintain your acoustic guitar.</p>
                    <a class="watch" href="https://youtu.be/Ii-6NZPgO7Y?si=oreNGBsVx1n3uHte" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="../images/Screenshot 2026-11-02 075420.png" alt="Guitar Types"><h3>Guitar Types</h3>
                    <p>Learn about the different types of guitars and their unique characteristics.</p>
                    <a class="watch" href="https://youtu.be/hEOuGs7m8bw?si=QehQZQzdkMjeuCpy" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="../images/Screenshot 2026-11-02 075801.png" alt="Happy Birthday Easy Fingerstyle"><h3>Happy Birthday Easy Fingerstyle</h3>
                    <p>Learn how to play "Happy Birthday" with an easy fingerstyle technique.</p>
                    <a class="watch" href="https://youtu.be/WeN9ynT6rFk?si=tj-MzFeNRW9_TMgf" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="" alt="Guitar Tutorial"><h3>Guitar Tutorial</h3>
                    <p>Tutorial</p>
                    <a class="watch" href="" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="" alt="Guitar Tutorial"><h3>Guitar Tutorial</h3>
                    <p>Tutorial</p>
                    <a class="watch" href="" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="" alt="Guitar Tutorial"><h3>Guitar Tutorial</h3>
                    <p>Tutorial</p>
                    <a class="watch" href="" target="_blank">Watch on YouTube</a>
                </div>

                <div class="video"><img src="" alt="Guitar Tutorial"><h3>Guitar Tutorial</h3>
                    <p>Tutorial</p>
                    <a class="watch" href="" target="_blank">Watch on YouTube</a>
                </div>

            </div>

        </section>

        <footer class="footer">
            <a href="contact.php">Contact Us</a>
        </footer>

        <script src="../js/cart.js"></script>

    <script src="../js/profile.js"></script>

    </body>

</html>