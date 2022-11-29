<?php

function connect()
{
    //todo: insérer le message en bdd si le message saisi est valide
    $dbName = "tweeter"; //nom de la base de donnée
    $dbUser = "root"; //nom d'utilisateur MySQL
    $dbPass = ""; //son mot de passe
    $dbHost = "localhost"; //l'adresse ip du serveur mysql

    //ajoutez ;port=8989 à la fin si vous devez spécifier le port de MySQL
    $dsn = "mysql:dbname=$dbName;host=$dbHost;charset=utf8";

    //cette variable $pdo contient notre connexion à la bdd \o/
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        //affiche les messages d'erreurs SQL
        //repasser à ERRMODE_SILENT en prod !!!!
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        //pour récupérer les données uniquement sous forme de tableau associatif
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    return $pdo;
}

function insertTweet(string $tweet)
{
    $pdo = connect();
    $sql = "INSERT INTO tweets (id, author_id, message, likes_quantity, date_created) 
                VALUES (NULL, 666, :message, 0, NOW())";

    //echo $sql;

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":message" => $tweet,
        //":date" => date("Y-m-d H:i:s")
    ]);
}

function insertUser($email, $username, $passwordHash, $bio)
{
    $pdo = connect();

    $sql = "INSERT INTO users (email, username, password, bio, date_created, date_updated)
            VALUES (:email, :username, :password, :bio, NOW(), NOW())";

    $stmt = $pdo->prepare($sql);

    //remplace le tableau dans execute si on préfère
    //ou bindParam()  - cela ne peut pas etre une chaine
    //$stmt->bindValue(':email', $email);
    //$stmt->bindValue(':username', $username);
    //$stmt->bindValue(':password', $passwordHash);
    //$stmt->bindValue(':bio', $bio);

    return $stmt->execute([
        ':email' => $email,
        ':username' => $username,
        ':password' => $passwordHash,
        ':bio' => $bio,
    ]);

}

function getLatestTweets()
{
    $pdo = connect();

    $sql = "SELECT tweets.*, users.username FROM tweets
            JOIN users ON tweets.author_id = users.id
            ORDER BY date_created DESC 
            LIMIT 10;";
    $stmt = $pdo->prepare($sql); //à al place d'un prepare, je pouvais faire un query
    $stmt-> execute();
    return $stmt->fetchAll();
}

function getTweetById($id)
{
    $pdo = connect();
}

function getUserByEmail($email)
{
    $pdo = connect();

    $sql = "SELECT * FROM users 
            WHERE email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":email" => $email,
    ]);

    $result = $stmt->fetch(); // car je ne peut avoir qu'une ligne. Avec un fetchAll() j'ai un tableau dans un tableau
                                //et le premier tableau sert à rien ici
/*    if ($result === false){
        return null;
    }else{
        return $result;
    }
*/    return $result ? $result : null; //utilisation ternaire
}

function getUserByUsername($username)
{
    $pdo = connect();

    $sql = "SELECT * FROM users 
            WHERE username = :username";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":username" => $username,
    ]);

    $result = $stmt->fetch();
    return $result ? $result : null; //utilisation ternaire
}

function getUserById($id)
{
    $pdo = connect();

    $sql = "SELECT * FROM users 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":id" => $id,
    ]);

    $result = $stmt->fetch();
    return $result ? $result : null;
}

function getTweetsByUserId($userId)
{
    $pdo = connect();

    $sql = "SELECT tweets.*, users.username FROM tweets 
            JOIN users ON tweets.author_id = users.id
            WHERE author_id = :userId 
            ORDER BY date_created DESC  
            LIMIT 100";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':userId' => $userId]);

    return $stmt->fetchAll();
}

function incrementLikesQuantity($tweetId)
{
    $pdo = connect();

    //$pdo->beginTransaction();

    $sql = "UPDATE tweets 
            SET likes_quantity = likes_quantity + 1 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    //$pdo->commit();
    //$pdo->rollBack();

    return $stmt->execute([":id" => $tweetId]);
}