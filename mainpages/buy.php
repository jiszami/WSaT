<?php
require __DIR__ . '/../includes/auth.php';
$auth = handle_auth('buyer');
$isRegister = $auth['mode'] === 'register';
?>
<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> Fretastic: Buyer Account </title>

        <link rel="icon" type="image/png" href="../images/fret.png">
        <link rel="stylesheet" href="../css/Buy.css">
        <link rel="stylesheet" href="../css/Auth.css">

    </head>

    <body>

        <header class="head">
            <img src="../images/Fretasticcc.png" class="logo" alt="Fretastic Logo"> <h1> Find your sound. </h1>
        </header>

        <main class="box">

            <section class="content"> <p class="title"><?= $isRegister ? 'Create your buyer account.' : 'Sign in or create an account to continue.' ?></p>

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

                <form method="post" action="buy.php<?= $isRegister ? '?mode=register' : '' ?>" autocomplete="on">
                    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                    <input type="hidden" name="action" value="<?= $isRegister ? 'register' : 'login' ?>">

                    <?php if ($isRegister): ?>
                        <input type="text" name="username" placeholder="Username" value="<?= e($auth['old']['username'] ?? '') ?>" minlength="3" maxlength="80" autocomplete="username" required>
                        <input type="email" name="email" placeholder="Email" value="<?= e($auth['old']['email'] ?? '') ?>" maxlength="254" autocomplete="email" required>
                        <input type="password" name="password" placeholder="Password (min. 8 characters)" minlength="8" maxlength="72" autocomplete="new-password" required>
                        <input type="password" name="confirm" placeholder="Confirm password" minlength="8" maxlength="72" autocomplete="new-password" required>

                        <button type="submit" class="btn"> CREATE ACCOUNT </button>
                        <p class="switch">Already have an account? <a href="buy.php">Sign in</a></p>
                    <?php else: ?>
                        <input type="text" name="identifier" placeholder="Username or Email" value="<?= e($auth['old']['identifier'] ?? '') ?>" maxlength="254" autocomplete="username" required>
                        <input type="password" name="password" placeholder="Password" maxlength="72" autocomplete="current-password" required>

                        <button type="submit" class="btn"> SIGN IN </button>
                        <p class="switch">New to Fretastic? <a href="buy.php?mode=register">Create an account</a></p>
                    <?php endif; ?>
                </form>

            </section>

        </main>

        <footer class="footer">
            <a href="mailto:202580087@psu.edu.ph"> Contact Us </a>
        </footer>

    </body>
</html>
