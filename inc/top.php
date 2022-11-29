<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tweeter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favicon.png">
</head>
<body>
<section class="section">
    <div class="container has-text-centered">
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php">
                    <img src="img/logo.png" alt="Logo Tweeter">
                </a>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item" href="index.php">
                        <span class="icon mr-1"><i class="fas fa-home"></i></span>
                        Accueil
                    </a>

                    <a class="navbar-item" href="tweet.php">
                        <span class="icon mr-1"><i class="fas fa-pen-alt"></i></span>
                        Postez un message
                    </a>

                </div>

                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary is-light" href="inscription.php">
                                <span class="icon mr-1"><i class="fas fa-heart"></i></span>
                                <strong>Inscription</strong>
                            </a>
                            <a class="button is-light">
                                <span class="icon mr-1"><i class="fas fa-user"></i></span>
                                Connexion
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</section>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="container">
        <div class="notification has-text-centered is-<?= $_SESSION['flash'][1] ?>"><?= $_SESSION['flash'][0] ?></div>
    </div>
    <?php
    //on a affiché le message, on peut donc le supprimer !
    unset($_SESSION['flash']);
    ?>
<?php endif; ?>
