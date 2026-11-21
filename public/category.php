<?php
require_once __DIR__ . '/../templates/header.php';

$cat = $_GET['cat'] ?? 'action';
$categoryTitle = ($cat === 'drama') ? 'Drame' : 'Action';

// Faux films de test selon la catégorie choisie
if ($cat === 'drama') {
    $movies = [
        [
            'id' => 8,
            'title' => 'Forrest Gump',
            'price' => 2.99,
            'image_url' => 'https://placehold.co'
        ],
        [
            'id' => 9,
            'title' => 'Parasite',
            'price' => 4.49,
            'image_url' => 'https://placehold.co'
        ]
    ];
} else {
    $movies = [
        [
            'id' => 1,
            'title' => 'Inception',
            'price' => 3.99,
            'image_url' => 'https://placehold.co'
        ],
        [
            'id' => 3,
            'title' => 'The Dark Knight',
            'price' => 3.99,
            'image_url' => 'https://placehold.co'
        ]
    ];
}
?>

<section class="movies-section">
    <h1>Catégorie : <span class="highlight"><?= htmlspecialchars($categoryTitle) ?></span></h1>
    <p class="subtitle">Parcourez notre sélection de films dans la catégorie <?= htmlspecialchars($categoryTitle) ?>.</p>

    <div class="movies-grid">
        <?php foreach ($movies as $movie): ?>
            <?php include __DIR__ . '/../templates/movie_card.php'; ?>
        <?php endforeach; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
