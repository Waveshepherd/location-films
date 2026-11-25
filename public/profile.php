<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions.php';

requireLogin();

$userId = (int)$_SESSION['user_id'];
$feedback = '';
$isError = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
        $feedback = 'Jeton de sécurité invalide. Veuillez réessayer.';
        $isError = true;
    } else {
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $currentHash = getUserPasswordHash($pdo, $userId);

        if ($currentHash === false || !password_verify($currentPassword, $currentHash)) {
            $feedback = 'Le mot de passe actuel est incorrect.';
            $isError = true;
        } elseif (strlen($newPassword) < 6) {
            $feedback = 'Le nouveau mot de passe doit contenir au moins 6 caractères.';
            $isError = true;
        } else {
            updateUserPassword($pdo, $userId, $newPassword);
            $feedback = 'Mot de passe mis à jour avec succès !';
        }
    }
}

// Récupère l'historique d'achats de l'utilisateur
$purchases = getUserPurchases($pdo, $userId);

require_once __DIR__ . '/../templates/header.php';
?>

<section class="profile-header">
    <div>
        <h1>Mon Profil (<span class="highlight"><?= htmlspecialchars($_SESSION['username']) ?></span>)</h1>
        <p class="subtitle">Gérez votre compte et retrouvez vos films achetés.</p>
    </div>
    <a href="/logout.php" class="btn-danger">Se déconnecter</a>
</section>

<div class="profile-grid">
    <section class="card-panel">
        <h2>Mes films achetés (<?= count($purchases) ?>)</h2>
        <?php if (empty($purchases)): ?>
            <p class="subtitle" style="margin-top: 1rem;">Vous n'avez encore acheté aucun film.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Film</th>
                            <th>Date d'achat</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($purchases as $purchase): ?>
                            <tr>
                                <td><a href="/movie.php?id=<?= (int)$purchase['Id_movie'] ?>" class="director-link"><?= htmlspecialchars($purchase['title']) ?></a></td>
                                <td><?= date('d/m/Y H:i', strtotime($purchase['purchase_date'])) ?></td>
                                <td><?= number_format((float)$purchase['price'], 2, ',', ' ') ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>

    <section class="card-panel">
        <h2>Changer de mot de passe</h2>

        <?php if ($feedback !== ''): ?>
            <p style="color: <?= $isError ? '#fb7185' : '#4ade80' ?>; margin: 0.75rem 0; font-weight: 600;">
                <?= htmlspecialchars($feedback) ?>
            </p>
        <?php endif; ?>

        <form action="/profile.php" method="post" class="form-stack" style="margin-top: 1rem;">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

            <div class="form-group">
                <label for="current_password">Mot de passe actuel</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>

            <div class="form-group">
                <label for="new_password">Nouveau mot de passe (6 car. min.)</label>
                <input type="password" id="new_password" name="new_password" minlength="6" required>
            </div>

            <button type="submit" class="btn-primary">Mettre à jour</button>
        </form>
    </section>
</div>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
