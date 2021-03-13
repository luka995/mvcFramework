<h1><?= htmlspecialchars($naslov) ?></h1>
<form method="post">
    <label>Ime</label>
    <input type="text" name="User[user_first]" value="<?=$data['user_first'] ?? ''?>">  
    <?php if (!empty($errors['user_first'])) :?>
        <p class="error"><?= htmlspecialchars($errors['user_first']) ?></p>
    <?php endif;?>
    <br>
        
    <label>Prezime</label>
    <input type="text" name="User[user_last]" value="<?=$data['user_last'] ?? ''?>">  
    <?php if (!empty($errors['user_last'])) :?>
        <p class="error"><?= htmlspecialchars($errors['user_last']) ?></p>
    <?php endif;?>    
    <br>
    
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
    
    <button>Registruj</button>
    
</form>