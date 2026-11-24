<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../templates/header.php';

$query = trim($_GET['q'] ?? '');
$movies = [];

if ($query !== '') {
    $stmt = $pdo->prepare('
        SELECT * FROM movie 
        WHERE title LIKE :search_title OR director LIKE :search_director 
        ORDER BY title ASC
    ');
    $likeParam = '%' . $query . '%';
    $stmt->execute([
        'search_title'    => $likeParam,
        'search_director' => $likeParam
    ]);
    $movies = $stmt->fetchAll();
}
?>

<section class="movies-section">
    <h1>Résultats pour « <span class="highlight"><?= htmlspecialchars($query) ?></span> »</h1>
    <p class="subtitle"><?= count($movies) ?> film(s) trouvé(s) par titre ou réalisateur.</p>

    <?php if (empty($movies)): ?>
        <p class="subtitle">Aucun film ne correspond à votre recherche.</p>
    <?php else: ?>
        <div class="movies-grid">
            <?php foreach ($movies as $movie): ?>
                <?php include __DIR__ . '/../templates/movie_card.php'; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
