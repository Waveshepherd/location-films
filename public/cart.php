<?php
require_once __DIR__ . '/../templates/header.php';
?>

<section class="cart-section">
    <h1>Votre Panier</h1>

    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Film</th>
                    <th>Réalisateur</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Inception</strong></td>
                    <td>Christopher Nolan</td>
                    <td>3,99 €</td>
                    <td><button type="button" class="btn-danger">Supprimer</button></td>
                </tr>
                <tr>
                    <td><strong>Matrix</strong></td>
                    <td>Lana &amp; Lilly Wachowski</td>
                    <td>2,99 €</td>
                    <td><button type="button" class="btn-danger">Supprimer</button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="cart-summary">
        <button type="button" class="btn-outline">Vider le panier</button>
        <div class="cart-total-box">
            <span class="total-label">Total : <strong>6,98 €</strong></span>
            <button type="button" class="btn-primary">Valider et acheter</button>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
