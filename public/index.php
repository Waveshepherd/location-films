<?php
require_once __DIR__ . '/../templates/header.php';

// Tableau temporaire de films pour tester le rendu visuel
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
    ],
    [
        'id' => 3,
        'title' => 'The Dark Knight',
        'price' => 3.99,
        'image_url' => 'https://placehold.co'
    ],
    [
        'id' => 4,
        'title' => 'Matrix',
        'price' => 2.99,
        'image_url' => 'https://placehold.co'
    ]
];
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
