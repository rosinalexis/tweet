<?php
    session_start();

    include("inc/db.php");

    //récupère l'id du tweet à liker
    $tweetId = $_GET['tweet_id'];

    //récupère l'id du tweet à liker
    $tweetId = $_GET['tweet_id'];

    //incrémente le nombre de likes sur ce touite !
    incrementLikesQuantity($tweetId);

    //var_dump($_SERVER);

    //redirige à tout coup !
    //la variable contient l'URL d'où provient l'utilisateur
    header("Location: " . $_SERVER['HTTP_REFERER']);
    die();