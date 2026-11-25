<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../templates/header.php';

$movieId = (int)($_GET['id'] ?? 0);
$movie = getMovieById($pdo, $movieId);

if (!$movie) {
    echo '<p class="subtitle">Film introuvable.</p>';
    require_once __DIR__ . '/../templates/footer.php';
    exit;
}

$categories = getCategoriesByMovieId($pdo, $movieId);
?>

<section class="movie-details">
    <div class="movie-poster">
        <img src="<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
    </div>

    <div class="movie-content">
        <div class="badges">
            <?php foreach ($categories as $cat): ?>
                <a href="/category.php?id=<?= (int)$cat['Id_categorie'] ?>" class="badge">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <h1><?= htmlspecialchars($movie['title']) ?></h1>
        <p class="meta">Réalisé par <a href="/director.php?name=<?= urlencode($movie['director']) ?>" class="director-link"><?= htmlspecialchars($movie['director']) ?></a></p>
        <p class="meta">Acteurs : <?= htmlspecialchars($movie['actors']) ?></p>

        <p class="short-plot"><?= htmlspecialchars($movie['shortplot']) ?></p>
        <p class="full-plot"><?= htmlspecialchars($movie['plot']) ?></p>

        <div class="purchase-box">
            <span class="price-large"><?= number_format((float)$movie['price'], 2, ',', ' ') ?> €</span>
            <form action="/cart.php" method="post">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="movie_id" value="<?= (int)$movie['Id_movie'] ?>">
                <button type="submit" class="btn-primary">Ajouter au panier</button>
            </form>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
