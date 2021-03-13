<h1>Nova vest</h1>


<form method="post">
    <label>Naslov</label>
    <input type="text" name="News[news_title]" value="<?= htmlspecialchars($data['news_title'] ?? '') ?>">  
    <?php if (!empty($errors['news_title'])) :?>
        <p class="error"><?= htmlspecialchars($errors['news_title']) ?></p>
    <?php endif;?>
    <br>

    <label>Kategorija</label>
    <select name="News[news_category_id]">
        <?php foreach ($categories as $category):?>
        <?php
            $selected = '';
            if ($category['category_id'] == $data['category_id']) {
                $selected = ' selected';
            }
        ?>
        <option value="<?= $category['category_id'] ?>"<?=$selected?>><?= htmlspecialchars($category['category_name']) ?></option>
        <?php endforeach;?>
    </select>
    <br>
    
    <label>Vest</label>
    <textarea name="News[news_article]" rows="20"><?= $data['news_article'] ?? '' ?></textarea>
    <?php if (!empty($errors['news_article'])) :?>
        <p class="error"><?= htmlspecialchars($errors['news_article']) ?></p>
    <?php endif;?>
    <br>    
    
    <button>Sačuvaj</button>
    
</form>