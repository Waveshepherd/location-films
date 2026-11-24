<article class="movie-card">
    <img src="<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
    <div class="movie-info">
        <h3>
            <a href="/movie.php?id=<?= (int)$movie['Id_movie'] ?>">
                <?= htmlspecialchars($movie['title']) ?>
            </a>
        </h3>
        <p class="price"><?= number_format((float)$movie['price'], 2, ',', ' ') ?> €</p>
        <button type="button" class="btn-primary">Ajouter au panier</button>
    </div>
</article>
