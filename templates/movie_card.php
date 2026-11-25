<article class="movie-card">
    <img src="<?= htmlspecialchars($movie['image_url']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
    <div class="movie-info">
        <h3>
            <a href="/movie.php?id=<?= (int)$movie['Id_movie'] ?>">
                <?= htmlspecialchars($movie['title']) ?>
            </a>
        </h3>
        <p class="price"><?= number_format((float)$movie['price'], 2, ',', ' ') ?> €</p>
        <form action="/cart.php" method="post">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
            <input type="hidden" name="movie_id" value="<?= (int)$movie['Id_movie'] ?>">
            <input type="hidden" name="action" value="add">
            <button type="submit" class="btn-primary">Ajouter au panier</button>
        </form>
    </div>
</article>
