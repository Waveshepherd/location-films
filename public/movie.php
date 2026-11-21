<?php
require_once __DIR__ . '/../templates/header.php';
?>

<section class="movie-details">
    <div class="movie-poster">
        <img src="https://placehold.co" alt="Inception">
    </div>

    <div class="movie-meta">
        <span class="badge">Action</span>
        <h1>Inception</h1>
        
        <p class="meta-line">
            <strong>Réalisateur :</strong> 
            <a href="/director.php?name=Christopher+Nolan" class="director-link">Christopher Nolan</a>
        </p>
        
        <p class="meta-line">
            <strong>Acteurs :</strong> Leonardo DiCaprio, Joseph Gordon-Levitt, Elliot Page
        </p>

        <p class="description">
            Dom Cobb est un voleur expérimenté dans l'art périlleux de l'extraction : sa spécialité consiste à s'approprier les secrets les plus précieux d'un individu, enfouis au plus profond de son subconscient, pendant qu'il rêve.
        </p>

        <div class="purchase-box">
            <span class="detail-price">3,99 €</span>
            <button type="button" class="btn-primary">Ajouter au panier</button>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
