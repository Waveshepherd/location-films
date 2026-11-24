<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../templates/header.php';

$stmt = $pdo->query('SELECT * FROM movie ORDER BY Id_movie DESC LIMIT 8');
$movies = $stmt->fetchAll();
?>

<section class="hero">
    <h1>Bienvenue sur Internet Movies DataBase &amp; Co</h1>
    <p>Découvrez notre catalogue de films en ligne, recherchez vos réalisateurs favoris et achetez vos vidéos en quelques clics.</p>
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

