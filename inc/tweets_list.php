<?php foreach($tweets as $tweet): ?>
    <article class="media">
        <figure class="media-left">
            <p class="image is-64x64">
                <img src="https://bulma.io/images/placeholders/128x128.png">
            </p>
        </figure>
        <div class="media-content">
            <div class="content">
                <p>
                    <a href="profile.php?user_id=<?= $tweet['author_id'] ?>">
                        <strong><?= $tweet['username'] ?></strong>
                    </a>
                    <br>
                    <?= $tweet['message'] ?>
                </p>
            </div>
            <nav class="level is-mobile">
                <div class="level-left">
                    <a class="level-item">
                        <span class="icon is-small"><i class="fas fa-reply"></i></span>
                    </a>
                    <a class="level-item">
                        <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                    </a>
                    <a class="level-item" href="add_like.php?tweet_id=<?= $tweet['id'] ?>">
                        <span class="icon is-small"><i class="fas fa-heart"></i></span>
                        <span class="ml-1"><?= $tweet['likes_quantity'] ?></span>
                    </a>
                </div>
            </nav>
        </div>
    </article>
<?php endforeach; ?>