<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../templates/header.php';

// Récupère l'ID de la catégorie depuis l'URL et le sécurise en int pour getCategoryById et si pas de id on le met à 1 par défaut
$idCategorie = (int)($_GET['id'] ?? 1);
$category = getCategoryById($pdo, $idCategorie);

if (!$category) {
    echo '<p class="subtitle">Catégorie introuvable.</p>';
    require_once __DIR__ . '/../templates/footer.php';
    exit;
}

$movies = getMoviesByCategory($pdo, $idCategorie);
?>

<section class="movies-section">
    <h1>Catégorie : <span class="highlight"><?= htmlspecialchars($category['name']) ?></span></h1>
    <p class="subtitle"><?= count($movies) ?> film(s) disponible(s) dans cette catégorie.</p>

    <div class="movies-grid">
        <?php foreach ($movies as $movie): ?>
            <?php include __DIR__ . '/../templates/movie_card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>

