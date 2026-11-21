<?php
require_once __DIR__ . '/../templates/header.php';

$query = trim($_GET['q'] ?? '');

// Simulation de résultats de recherche pour le visuel
$movies = [
    [
        'id' => 1,
        'title' => 'Inception',
        'price' => 3.99,
        'image_url' => 'https://placehold.co'
    ],
    [
        'id' => 2,
        'title' => 'Interstellar',
        'price' => 4.99,
        'image_url' => 'https://placehold.co'
    ]
];
?>

<section class="movies-section">
    <h1>Résultats pour « <span class="highlight"><?= htmlspecialchars($query) ?></span> »</h1>
    <p class="subtitle"><?= count($movies) ?> film(s) trouvé(s) par titre ou réalisateur.</p>

    <?php if (empty($movies)): ?>
        <p class="empty-msg">Aucun film ne correspond à votre recherche.</p>
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
