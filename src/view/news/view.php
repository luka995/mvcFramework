<div>
    <h3><a href="index.php?controller=News&action=view&newsId=<?= $post['news_id'] ?>"><?= htmlspecialchars($post['news_title']) ?></a></h3>    
    <p>Objavio:<?= htmlspecialchars($post['user_first'] . ' ' . $post['user_last']) ?>, dana: <?= $post['news_date'] ?>
        <br>
        Katgorija: <?= htmlspecialchars($post['category_name']) ?>
        <?php if (app\model\User::isAdmin()):?>
            <br>
            <a href="index.php?controller=News&action=delete&newsId=<?= $post['news_id'] ?>">Izbriši</a>
        <?php endif;?>
    </p>
    <hr>
    <article>
        <?= $post['news_article'] ?>
    </article>
    <hr>

    <h3>Komentari</h3>
    <label>Novi komentar</label>
    <form method="post">
        <textarea name="Comment[comment_message]"></textarea>
        <button>Objavi</button>
    </form>
    
    <?php foreach ($comments as $comment):?>
    <div>
        <p>Objavio: <?= htmlspecialchars($comment['user_first'] . ' ' . $comment['user_last'])?> , dana: <?= $comment['comment_date']?>
        <?php if (app\model\Comment::canDelete($comment['comment_user_id'])):?>
            <a href="index.php?controller=News&action=deleteComment&commentId=<?=$comment['comment_id']?>">Izbriši</a>
        <?php endif;?>
        </p>
        <p><?= htmlspecialchars($comment['comment_message']) ?></p>
    </div>
    <hr>
    <?php endforeach;?>
    
</div>