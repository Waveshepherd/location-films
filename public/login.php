<?php
require_once __DIR__ . '/../templates/header.php';
?>

<section class="auth-box">
    <h1>Connexion</h1>
    <p class="subtitle">Connectez-vous pour accéder à votre panier et vos films.</p>

    <form action="/login.php" method="post" class="form-stack">
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-primary">Se connecter</button>
    </form>

    <p class="auth-switch">Pas encore de compte ? <a href="/register.php" class="director-link">Inscrivez-vous</a></p>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
