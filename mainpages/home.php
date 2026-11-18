<?php
require __DIR__ . '/../includes/auth.php';
$user = require_login('buyer');
?>
<!DOCTYPE html>

<html>

  <head>

      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>Fretastic: Home</title>

      <link rel="icon" type="image/png" href="../images/fret.png">
      <link rel="stylesheet" href="../css/Home.css">
      <link rel="stylesheet" href="../css/Cart.css">

  </head>

  <body>

    <header class="head"><img src="../images/Fretasticcc.png" class="logo" alt="Fretastic Logo"> 

      <nav class="nav">

        <a href="home.php" target="_self"><strong>Home</strong></a>
        <a href="products.php" target="_self"><strong>Products</strong></a>
        <a href="services.php" target="_self"><strong>Services</strong></a>
                <a href="logout.php"><strong>Log Out</strong></a>

      </nav>
      
    </header>

    <div class="box">

      <div class="content"><h2>Top-selling products this month</h2>

        <div class="product"> 
          <a href="../brands/clifton.html" target="_blank">
          <img src="../images/CliftonKseries.webp" class="img" alt="Clifton K Series GS Mini Dreadnought"> </a>
          <p>Clifton K Series GS Mini Dreadnought</p> 
          <button type="button" class="add-to-cart" data-name="Clifton K Series GS Mini Dreadnought" data-price="7799" data-img="../images/CliftonKseries.webp">Add to Cart</button>
        </div>

        <div class="product">
          <a href="../brands/ligaya.html" target="_blank"> 
          <img src="../images/LGYVintageVibe.webp" class="img" alt="LGY Vintage Vibe S V2"> </a> 
          <p>LGY Vintage Vibe S V2</p>
          <button type="button" class="add-to-cart" data-name="LGY Vintage Vibe S V2" data-price="7799" data-img="../images/LGYVintageVibe.webp">Add to Cart</button>
        </div>

        <div class="product">
          <a href="../rjguitars.html" target="_blank">
          <img src="../images/JazzcasterBass.jpg" class="img" alt="Jazzcaster Bass Guitar"> </a>
          <p>Jazzcaster Bass Guitar</p>
          <button type="button" class="add-to-cart" data-name="Jazzcaster Bass Guitar" data-price="7799" data-img="../images/JazzcasterBass.jpg">Add to Cart</button>
        </div>

        <div class="product">
          <a href="../brands/clifton.html" target="_blank">
          <img src="../images/CliftonPioneerStrat.jpg" class="img" alt="Clifton Pioneer Stratocaster Package"> </a>
          <p>Clifton Pioneer Stratocaster Package</p>
          <button type="button" class="add-to-cart" data-name="Clifton Pioneer Stratocaster Package" data-price="7799" data-img="../images/CliftonPioneerStrat.jpg">Add to Cart</button>
        </div>

      </div>

    </div>

    <footer class="footer">
            <a href="contact.php">Contact Us</a>
    </footer>

    <script src="../js/cart.js"></script>

  </body>

</html>