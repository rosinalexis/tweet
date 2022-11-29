<?php
//prévient PHP qu'on veut utiliser les sessions pour cette requête actuelle !
//doit être appelée avant tout echo ou avant le html !
session_start();

//la variable $_SESSION contient toutes les infos de session
//c'est obligatoirement un tableau associatif

//si c'est la première visite...
//if (empty($_SESSION['pageViews'])) {
//    $_SESSION["pageViews"] = 1;
//}
//sinon on incrémente
//else {
//    $_SESSION["pageViews"]++;
//}

//supprime une seule donnée de la session
//unset($_SESSION["pageViews"]);

//supprime toutes les données de session
//session_destroy();

include 'inc/db.php';

include 'inc/top.php';
?>

    <section>
        <div class="container has-text-centered">
            <h1 class="title">
                Rejoignez notre communauté&nbsp;Tweeter&nbsp;!
            </h1>
            <p class="subtitle mt-2">
                <a href="inscription.php" class="is-uppercase">
                    <span class="icon"><i class="fas fa-star"></i></span>
                    Créez votre compte maintenant
                    <span class="icon"><i class="fas fa-star"></i></span>
                </a>
            </p>
        </div>

    </section>
    <main class="section">
        <div class="container">
            <h3 class="title is-3">Les derniers tweets</h3>

            <?php
                $tweets = getLatestTweets();

                //var_dump($tweets);

                include 'inc/tweets_list.php';
            ?>

        </div>
    </main>

<?php
include 'inc/bottom.php';
?>