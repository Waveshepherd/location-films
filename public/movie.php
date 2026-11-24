<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../templates/header.php';

$idMovie = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare('SELECT * FROM movie WHERE Id_movie = :id');
$stmt->execute(['id' => $idMovie]);
$movie = $stmt->fetch();

if (!$movie) {
    echo '<p class="subtitle">Film introuvable.</p>';
    require_once __DIR__ . '/../templates/footer.php';
    exit;
}

// Récupère les catégories associées à ce film
$stmtCats = $pdo->prepare('
    SELECT c.Id_categorie, c.name 
    FROM categorie c
    JOIN movie_categorie mc ON c.Id_categorie = mc.Id_categorie
    WHERE mc.Id_movie = :id
');
$stmtCats->execute(['id' => $idMovie]);
$categories = $stmtCats->fetchAll();
?>

<section class="movie-details">
    <div class="movie-poster">
        <img src="<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
    </div>

    <div class="movie-meta">
        <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
            <?php foreach ($categories as $cat): ?>
                <a href="/category.php?id=<?= (int)$cat['Id_categorie'] ?>" class="badge">
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <h1><?= htmlspecialchars($movie['title']) ?></h1>
        
        <p class="meta-line">
            <strong>Réalisateur :</strong> 
            <a href="/director.php?name=<?= urlencode($movie['director']) ?>" class="director-link">
                <?= htmlspecialchars($movie['director']) ?>
            </a>
        </p>
        
        <p class="meta-line">
            <strong>Acteurs :</strong> <?= htmlspecialchars($movie['actors']) ?>
        </p>

        <p class="description">
            <?= htmlspecialchars($movie['plot'] ?: $movie['shortplot']) ?>
        </p>

        <div class="purchase-box">
            <span class="detail-price"><?= number_format((float)$movie['price'], 2, ',', ' ') ?> €</span>
            <button type="button" class="btn-primary">Ajouter au panier</button>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
