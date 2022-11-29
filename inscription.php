<?php
session_start();

if (empty($_SESSION['user'])){

}
include 'inc/db.php';

//traite le formulaire tout en haut du fichier

//initialise le tableau d'éventuelles erreurs
$errors = [];

//la variable $_POST contient les données du form s'il est soumis, ou un tableau vide sinon
//var_dump($_POST);

//est-ce que le formulaire est soumis ?
if (!empty($_POST)){
    //il n'est pas vide, donc le form est soumis...

    //récupère nos données dans nos propres variables
    //le strip_tags() permet de retirer les balises HTML (si qqn essaie de nous faire une attaque XSS)
    $email = strip_tags($_POST['email']);
    $username = strip_tags($_POST['username']);
    $password = $_POST['password'];
    $bio = strip_tags($_POST['bio']);

    //validation des données

    //l'email est requis... est-il vide ?
    if (empty($email)){
        $errors['email'] = "Veuillez saisir un email !";
    }
    //est-ce que le format de l'email est ok ?
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Votre email $email n'est pas valide !";
    }
    //vérifier l'unicité de l'email avec une requête SELECT à la bdd !
    elseif (getUserByEmail($email)){
        $errors['email'] = "Ce compte existe déjà avec cet email !";
    }

    //username est requis
    if (empty($username)){
        $errors['username'] = "Veuillez saisir un pseudo !";
    }
    //longueur minimale
    elseif(mb_strlen($username) < 3){
        $errors['username'] = "3 caractères minimum svp !";
    }
    //longueur maximale
    elseif(mb_strlen($username) > 30){
        $errors['username'] = "30 caractères maximum svp !";
    }
    //vérifier l'unicité du pseudo avec une requête SELECT à la bdd !
      //dans phpStorm [ctrl]+clic sur la fonction pour ouvrir
      // le fichier où se trouve la fonction
    elseif (getUserByUsername($username)){
        $errors['username'] = "Pseudo déjà pris !";
    }

    //validation du mot de passe
    if(mb_strlen($password) < 12){
        $errors['password'] = "8 caractères minimum svp !";
    }
    //regex pour minimum 12 caractères et une lettre et un chiffre piquée ici
    //https://stackoverflow.com/questions/19605150/regex-for-password-must-contain-at-least-eight-characters-at-least-one-number-a
    $regex = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{12,}$/";
    if(!preg_match($regex, $password)){
        $errors['password'] = "au moins une lettre et un chiffre please !";
    }

    //on ne valide pas la bio, elle est facultative

    //var_dump($errors);

    //si tout est valide...
    if (empty($errors)){
        //hash le mdp avec l'algo actuel de PHP
        $passwordHash = password_hash($password, PASSWORD_DEFAULT, [
            'cost' => 11 //on augmente un peu la lenteur de l'algo par sécurité
        ]);
        //die($passwordHash);

        //créer le compte dans la bdd...
        //requête insert
        insertUser($email, $username, $passwordHash, $bio);

        //todo : gerer le message en session lorsque tout s'est bien passé et l'afficher sur la page d'accueil
        $_SESSION["flash"] = ["Bienvenue !", "success"];

        //redirige vers une autre page
        header("Location: index.php");
        //on arrête l'exécution du script ici (pour être sûr que le reste du code ci-dessous ne soit pas exécuté)
        die();
    } else {
        $_SESSION["flash"] = ["Il y a des erreurs. Veuillez corriger SVP", "danger"];
    }
}

//le haut de notre html
//pour éviter la répétition de ce code sur toutes les pages
include("inc/top.php");
?>

    <main class="section">
        <div class="container box">
            <div class="columns">
                <div class="column is-three-fifths">
                    <h2 class="title is-4">Créer mon compte</h2>
                    <div>
                        <form method="post" novalidate="novalidate">
                            <div class="field">
                                <label for="email_input">Votre email</label>
                                <div class="control">
                                    <input type="email" value="<?= isset($email) ? $email : "" ?>" class="input <?= !empty($errors['email']) ? "is-danger" : "" ?>" id="email_input" name="email" placeholder="yo@gmail.com">
                                </div>
                                <?php if(!empty($errors['email'])): ?>
                                    <p class="help is-danger"><?= $errors['email'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="field">
                                <label for="username_input">Votre pseudo</label>
                                <div class="control">
                                    <input type="text" value="<?= isset($username) ? $username : "" ?>" class="input <?= !empty($errors['username']) ? "is-danger" : "" ?>" id="username_input" name="username" placeholder="yoyo">
                                </div>
                                <?php if(!empty($errors['username'])): ?>
                                    <p class="help is-danger"><?= $errors['username'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="field">
                                <label for="password_input">Votre mot de passe</label>
                                <div class="control">
                                    <input type="password" class="input <?= !empty($errors['password']) ? "is-danger" : "" ?>" id="password_input" name="password">
                                </div>
                                <?php if(!empty($errors['password'])): ?>
                                    <p class="help is-danger"><?= $errors['password'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="field">
                                <label for="bio_input">Votre bio</label>
                                <div class="control">
                            <textarea class="textarea <?= !empty($errors['bio']) ? "is-danger" : "" ?>"
                                      id="bio_input" name="bio"><?= isset($bio) ? $bio : "" ?></textarea>
                                </div>
                                <?php if(!empty($errors['bio'])): ?>
                                    <p class="help is-danger"><?= $errors['bio'] ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button class="button">Créer mon compte</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="column">
                    <div class="content">
                        <h3>Déjà membre ?</h3>
                        <p><a href="#" class="button is-light">Connexion par ici !</a></p>
                        <h3>Nos sponsors</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae blanditiis consectetur deleniti, dignissimos dolor error esse in laborum minus natus odio quo repellat, totam? Architecto aut deserunt enim suscipit tempora?</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

<?php
include 'inc/bottom.php';
?>