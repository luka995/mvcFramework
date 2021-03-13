<?php foreach ($newsList as $post) :?>
<div>
    <h3><a href="index.php?controller=News&action=view&newsId=<?= $post['news_id'] ?>"><?= htmlspecialchars($post['news_title']) ?></a></h3>
    <p>Objavio:<?= htmlspecialchars($post['user_first'] . ' ' . $post['user_last']) ?>, dana: <?= $post['news_date'] ?>
        <br>
        Katgorija: <?= htmlspecialchars($post['category_name']) ?>
    </p>
    <hr>
    <article>
        <?= \app\view\View::excerpt($post['news_article']) ?>
    </article>
    <hr>
</div>
<?php endforeach; ?>

