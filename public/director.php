<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../templates/header.php';

$directorName = trim($_GET['name'] ?? '');

$stmt = $pdo->prepare('SELECT * FROM movie WHERE director = :director ORDER BY title ASC');
$stmt->execute(['director' => $directorName]);
$movies = $stmt->fetchAll();
?>

<section class="movies-section">
    <h1>Films réalisés par <span class="highlight"><?= htmlspecialchars($directorName) ?></span></h1>
    <p class="subtitle"><?= count($movies) ?> film(s) disponible(s) dans notre catalogue.</p>

    <div class="movies-grid">
        <?php foreach ($movies as $movie): ?>
            <?php include __DIR__ . '/../templates/movie_card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
