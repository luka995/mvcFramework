<h1><?= htmlspecialchars($naslov) ?></h1>
<form method="post">
    
    <label>Email</label>
    <input type="text" name="User[user_email]" value="<?=$data['user_email'] ?? ''?>">  
    <?php if (!empty($errors['user_email'])) :?>
        <p class="error"><?= htmlspecialchars($errors['user_email']) ?></p>
    <?php endif;?>       
    <br>
    
    <label>Lozinka</label>
    <input type="password" name="User[password]" value="<?=$data['password'] ?? ''?>">  
    <?php if (!empty($errors['user_pwd'])) :?>
        <p class="error"><?= htmlspecialchars($errors['user_pwd']) ?></p>
    <?php endif;?>  
    <br>
    
    <button>Prijava</button>
    
</form>