<footer class="footer">
    <div class="container">
        <nav class="menu columns">
            <div class="column is-two-fifth">
                <p class="menu-label">
                    Général
                </p>
                <ul class="menu-list">
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="tweet.php">Poster un tweet</a></li>
                </ul>
            </div>
            <div class="column is-two-fifth">
                <p class="menu-label">
                    Comptes
                </p>
                <ul class="menu-list">
                    <li><a href="inscription.php">Inscription</a></li>
                    <li><a href="login.php">Connexion</a></li>
                    <li><a href="#">Supprimer mon compte</a></li>
                </ul>
            </div>
            <div class="column is-two-fifth">
                <p class="menu-label">
                    Informations légales
                </p>
                <ul class="menu-list">
                    <li><a href="#">RGPD</a></li>
                    <li><a href="http://opensource.org/licenses/mit-license.php">The source code is licensed</a></li>
                    <li><a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">The website content is licensed</a></li>
                </ul>
            </div>
        </nav>

        <div class="content has-text-centered">
            <p>
                <strong>Tweeter</strong> &copy; <?= date('Y')?> by <a href="https://www.eni-ecole.fr">ENI Ecole Informatique</a>.
            </p>
            <p>Pages vues : <?php //echo $_SESSION['pageViews'] ?></p>
        </div>
    </div>
</footer>
</body>
</html>