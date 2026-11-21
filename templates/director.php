<?php
require_once __DIR__ . '/../templates/header.php';

$directorName = $_GET['name'] ?? 'Christopher Nolan';

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
    <h1>Films réalisés par <span class="highlight"><?= htmlspecialchars($directorName) ?></span></h1>
    <p class="subtitle">Découvrez toutes les vidéos disponibles de ce réalisateur dans notre catalogue.</p>

    <div class="movies-grid">
        <?php foreach ($movies as $movie): ?>
            <?php include __DIR__ . '/../templates/movie_card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
