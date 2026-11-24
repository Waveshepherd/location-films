<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../templates/header.php';

$idCategorie = (int)($_GET['id'] ?? 1);

// 1. Récupère le nom de la catégorie
$stmtCat = $pdo->prepare('SELECT Id_categorie, name FROM categorie WHERE Id_categorie = :id');
$stmtCat->execute(['id' => $idCategorie]);
$category = $stmtCat->fetch();

if (!$category) {
    echo '<p class="subtitle">Catégorie introuvable.</p>';
    require_once __DIR__ . '/../templates/footer.php';
    exit;
}

// 2. Récupère tous les films liés à cette catégorie via la table pivot
$stmtMovies = $pdo->prepare('
    SELECT m.* 
    FROM movie m
    JOIN movie_categorie mc ON m.Id_movie = mc.Id_movie
    WHERE mc.Id_categorie = :id
    ORDER BY m.title ASC
');
$stmtMovies->execute(['id' => $idCategorie]);
$movies = $stmtMovies->fetchAll();
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
