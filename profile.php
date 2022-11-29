<?php
    session_start();

    include("inc/db.php");
    include("inc/top.php");

    //récupère l'id du user à afficher
    $userId = $_GET['user_id'];

    //appelle notre fonction pour récupérer les infos de cet user
    $user = getUserById($userId);

    //récupère les tweets de cet user
    $tweets = getTweetsByUserId($userId);
?>

    <main class="section">
        <div class="container content">
            <h2>Profil de <?= $user['username'] ?></h2>

            <?php include 'inc/tweets_list.php'; ?>
        </div>
    </main>

<?php
include("inc/bottom.php");
?>
