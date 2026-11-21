<?php
require_once __DIR__ . '/../templates/header.php';
?>

<section class="auth-box">
    <h1>Créer un compte</h1>
    <p class="subtitle">Rejoignez Internet Movies DataBase &amp; Co.</p>

    <form action="/register.php" method="post" class="form-stack">
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" placeholder="Cinephile14" required>
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-primary">S'inscrire</button>
    </form>

    <p class="auth-switch">Déjà inscrit ? <a href="/login.php" class="director-link">Connectez-vous</a></p>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
