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
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validation des champs du formulaire côté serveur car un utilisatreur peut désactiver les contrôles et contourner la validation côté client
        if ($username === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
            $error = 'Veuillez remplir tous les champs (mot de passe de 6 caractères minimum).';
        } elseif (userExists($pdo, $email, $username)) {
            $error = 'Cet email ou ce nom d\'utilisateur est déjà utilisé.';
        } else {
            // createUser() permet égaelement de récupérer son Id nouvellemement créé pour l'enregistrer dans la session
            $newUserId = createUser($pdo, $username, $email, $password);

            session_regenerate_id(true);
            $_SESSION['user_id'] = $newUserId;
            $_SESSION['username'] = $username;

            header('Location: /index.php');
            exit;
        }
    }
}

require_once __DIR__ . '/../templates/header.php';
?>

<section class="auth-box">
    <h1>Créer un compte</h1>
    <p class="subtitle">Rejoignez Internet Movies DataBase &amp; Co.</p>

    <?php if ($error !== ''): ?>
        <p style="color: #fb7185; margin-bottom: 1rem; font-weight: 600;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="/register.php" method="post" class="form-stack">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" placeholder="Muad'Dib14" required>
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe (6 car. min.)</label>
            <input type="password" id="password" name="password" minlength="6" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn-primary">S'inscrire</button>
    </form>

    <p class="auth-switch">Déjà inscrit ? <a href="/login.php" class="director-link">Connectez-vous</a></p>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
