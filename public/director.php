<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../templates/header.php';

$director = trim($_GET['name'] ?? '');
$movies = getMoviesByDirector($pdo, $director);
?>

<section class="movies-section">
    <h1>Films réalisés par <span class="highlight"><?= htmlspecialchars($director) ?></span></h1>
    <p class="subtitle"><?= count($movies) ?> film(s) disponible(s) dans notre catalogue.</p>

    <?php if (empty($movies)): ?>
        <p class="subtitle">Aucun film trouvé pour ce réalisateur.</p>
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
