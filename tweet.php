<?php
session_start();

include 'inc/db.php';

//Je traite ici mon formulaire

$error = "";

//la variable $_POST va contenir ou pas les données du formulaire.
//var_dump($_POST);

//est-ce-que le formulaire est soumis?
if(!empty($_POST)){
    //s'il n'est pas vide...

    //On récupère les données du form que l'on stocke dans nos variables
    //strip_tags() --> supprime les balises HTML potentiellement injectées dans le textarea
    $tweet = strip_tags($_POST['tweet']);

    //Validation des données

    //Vérifier que le champ texte n'est pas vide
    if(empty($tweet)){
        $error = "Veuillez écrire quelque chose svp";

        //Vérifier que le message ne contient pas plus de 255 caractères
    } elseif (mb_strlen($tweet) > 255){
        $error = "Vous ne pouvez pas saisir plus de 255 caractères !";
    }

    if($error == "") {
        //insérer le message en bdd si le message saisi est valide
        insertTweet($tweet);

        //todo : gerer le message en session lorsque tout s'est bien passé et l'afficher sur la page d'accueil
        $_SESSION["flash"] = ["Merci pour votre tweet !", "success"];

        header("Location: index.php");
        die();
    }
}

?>

<?php

include("inc/top.php");

?>

<main class="section">
<div class="container box">
    <h2 class="title is-4" id="monTitre"> A vous de tweeter ! </h2>
    <form method="post" novalidate="novalidate">
        <div class="field">
            <label for="tweet_input" class="label">Votre message</label>
            <div class="control">
                <textarea name="tweet" class="textarea <?= !empty($error) ? "is-danger" : "" ?>" id="tweet_input"
                          placeholder="Que la vie est belle aujourd'hui !"><?= isset($tweet) ? $tweet : "" ?></textarea>
            </div>
            <?php if($error != "") : ?>
                <p class="help is-danger"> <?= $error ?> </p>
            <?php endif; ?>


        </div>


        <div class="field">
            <div class="control">
                <button class="button is-info">Envoyer !</button>
            </div>
        </div>
    </form>
</div>
    <div class="content">
        <h4>Quelques bonnes règles de conduite</h4>
        <ul>
            <li>Ici on aime tout le monde et tout le monde il est gentil. Respect!</li>
            <li>Accusamus itaque laudantium, maiores mollitia nesciunt optio vitae voluptatem. Doloribus magni maxime molestias necessitatibus nulla quasi quis similique veniam. Accusamus aperiam, provident?</li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. a nesciunt optio vitae voluptatem. Doloribus magni maxime molestias necessitatibus nulla quasi quis similique veniam. Accusamus aperiam, provident?</li>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus itaque laudantium, maiores mollitia nesciunt optio vitae voluptatem. Doloribus magni maxime molestias necessitatibus nulla quasi quis similique veniam. Accusamus aperiam, provident?</li>
        </ul>
    </div>

</main>

<?php

include("inc/bottom.php");

?>

