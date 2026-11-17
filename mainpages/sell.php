<?php
require __DIR__ . '/../includes/auth.php';
$auth = handle_auth('seller');
$isRegister = $auth['mode'] === 'register';
?>
<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Fretastic: Seller Account</title>

        <link rel="icon" type="image/png" href="../images/fret.png">
        <link rel="stylesheet" href="../css/Sell.css">
        <link rel="stylesheet" href="../css/Auth.css">

    </head>

    <body>

        <header class="head"><img src="../images/Fretasticcc.png" class="logo" alt="Fretastic Logo"></header>
        
        <main class="box">

            <section class="content"><h2>Welcome to Fretastic</h2><p><?= $isRegister ? 'Register your brand and let other people discover your products.' : 'Let other people discover your products.' ?></p>

                <?php if ($auth['notice']): ?>
                    <p class="alert success" role="status"><?= e($auth['notice']) ?></p>
                <?php endif; ?>

                <?php if ($auth['errors']): ?>
                    <div class="alert error" role="alert">
                        <?php foreach ($auth['errors'] as $msg): ?>
                            <p><?= e($msg) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="sell.php<?= $isRegister ? '?mode=register' : '' ?>" autocomplete="on">
                    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                    <input type="hidden" name="action" value="<?= $isRegister ? 'register' : 'login' ?>">

                    <?php if ($isRegister): ?>
                        <input type="text" name="username" placeholder="Brand or Company Name" value="<?= e($auth['old']['username'] ?? '') ?>" minlength="3" maxlength="80" autocomplete="organization" required>
                        <input type="email" name="email" placeholder="Email" value="<?= e($auth['old']['email'] ?? '') ?>" maxlength="254" autocomplete="email" required>
                        <input type="password" name="password" placeholder="Password (min. 8 characters)" minlength="8" maxlength="72" autocomplete="new-password" required>
                        <input type="password" name="confirm" placeholder="Confirm password" minlength="8" maxlength="72" autocomplete="new-password" required>

                        <button type="submit" class="btn">REGISTER BRAND</button>
                        <p class="switch">Already registered? <a href="sell.php">Sign in</a></p>
                    <?php else: ?>
                        <input type="text" name="identifier" placeholder="Brand Name or Email" value="<?= e($auth['old']['identifier'] ?? '') ?>" maxlength="254" autocomplete="username" required>
                        <input type="password" name="password" placeholder="Password" maxlength="72" autocomplete="current-password" required>

                        <button type="submit" class="btn">SIGN IN</button>
                        <p class="switch">New seller? <a href="sell.php?mode=register">Register your brand</a></p>
                    <?php endif; ?>
                </form>

            </section>

        </main>

        <footer class="footer">
            <a href="mailto:202580087@psu.edu.ph">Contact Us</a>
        </footer>

    </body>

</html>
