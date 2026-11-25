<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $error = 'Jeton de sécurité invalide. Veuillez réessayer.';
    } else {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $user = getUserByEmail($pdo, $email);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['Id_user'];
            $_SESSION['username'] = $user['username'];

            header('Location: /index.php');
            exit;
        } else {
            $error = 'Email ou mot de passe incorrect.';
        }
    }
}

require_once __DIR__ . '/../templates/header.php';
?>

<section class="auth-box">
    <h1>Connexion</h1>
    <p class="subtitle">Connectez-vous pour accéder à votre panier et vos films.</p>

    <?php if ($error !== ''): ?>
        <p style="color: #fb7185; margin-bottom: 1rem; font-weight: 600;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="/login.php" method="post" class="form-stack">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

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
