<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../templates/header.php';

$movies = getLatestMovies($pdo, 8);
?>

<section class="hero">
    <h1>Bienvenue sur <span class="highlight">IMDb &amp; Co</span></h1>
    <p class="subtitle">Découvrez les derniers ajouts de notre catalogue de films en location et à l'achat.</p>
</section>

<section class="movies-section">
    <h2>Derniers ajouts</h2>
    <div class="movies-grid">
        <?php foreach ($movies as $movie): ?>
            <?php include __DIR__ . '/../templates/movie_card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
