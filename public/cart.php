<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions.php';

// Vérifie si l'utilisateur est connecté, sinon redirige vers la page de connexion
requireLogin();

// Récupère l'ID de l'utilisateur connecté depuis la session côté serveur
$userId = (int)$_SESSION['user_id'];
// Permet de retourner un message à l'utilisateur après une action sur le panier (ajout, suppression, achat)
$message = '';

// Traitement des actions POST (Ajouter, Supprimer, Vider, Valider l'achat)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    $action = $_POST['action'] ?? '';
    $movieId = (int)($_POST['movie_id'] ?? 0);

    if ($action === 'add' && $movieId > 0) {
        addToCart($pdo, $userId, $movieId);
        header('Location: /cart.php');
        exit;
    }

    if ($action === 'remove' && $movieId > 0) {
        removeFromCart($pdo, $userId, $movieId);
        header('Location: /cart.php');
        exit;
    }

    if ($action === 'clear') {
        clearCart($pdo, $userId);
        header('Location: /cart.php');
        exit;
    }

    if ($action === 'checkout' && checkoutCart($pdo, $userId)) {
        $message = 'Merci pour votre achat ! Vos films sont disponibles dans votre profil.';
    }
}

// Récupère le contenu actuel du panier
$cartMovies = getCartItems($pdo, $userId);
// Récupère le total du panier en additionnant les prix des films
$total = array_sum(array_column($cartMovies, 'price'));

require_once __DIR__ . '/../templates/header.php';
?>

<section class="cart-section">
    <h1>Votre Panier</h1>

    <?php if ($message !== ''): ?>
        <p style="color: #4ade80; margin-bottom: 1rem; font-weight: 600;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if (empty($cartMovies)): ?>
        <p class="subtitle">Votre panier est vide. Parcourez notre catalogue pour ajouter des films !</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Film</th>
                        <th>Réalisateur</th>
                        <th>Prix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartMovies as $item): ?>
                        <tr>
                            <td><a href="/movie.php?id=<?= (int)$item['Id_movie'] ?>" class="director-link"><strong><?= htmlspecialchars($item['title']) ?></strong></a></td>
                            <td><?= htmlspecialchars($item['director']) ?></td>
                            <td><?= number_format((float)$item['price'], 2, ',', ' ') ?> €</td>
                            <td>
                                <form action="/cart.php" method="post">
                                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="movie_id" value="<?= (int)$item['Id_movie'] ?>">
                                    <button type="submit" class="btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="cart-summary">
            <form action="/cart.php" method="post">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <input type="hidden" name="action" value="clear">
                <button type="submit" class="btn-outline">Vider le panier</button>
            </form>

            <div class="cart-total-box">
                <span class="total-label">Total : <strong><?= number_format((float)$total, 2, ',', ' ') ?> €</strong></span>
                <form action="/cart.php" method="post">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                    <input type="hidden" name="action" value="checkout">
                    <button type="submit" class="btn-primary">Valider et acheter</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
