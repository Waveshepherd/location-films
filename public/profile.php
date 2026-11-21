<?php
require_once __DIR__ . '/../templates/header.php';
?>

<section class="profile-header">
    <div>
        <h1>Mon Profil (<span class="highlight">Cinephile14</span>)</h1>
        <p class="subtitle">Gérez votre compte et retrouvez vos films achetés.</p>
    </div>
    <a href="/logout.php" class="btn-danger">Se déconnecter</a>
</section>

<div class="profile-grid">
    <!-- Liste des films achetés -->
    <section class="card-panel">
        <h2>Mes films achetés</h2>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Film</th>
                        <th>Date d'achat</th>
                        <th>Prix</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="/movie.php?id=1" class="director-link">Inception</a></td>
                        <td>19/11/2026</td>
                        <td>3,99 €</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Formulaire changement de mot de passe -->
    <section class="card-panel">
        <h2>Changer de mot de passe</h2>
        <form action="/profile.php" method="post" class="form-stack">
            <div class="form-group">
                <label for="current_password">Mot de passe actuel</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>

            <div class="form-group">
                <label for="new_password">Nouveau mot de passe</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>

            <button type="submit" class="btn-primary">Mettre à jour</button>
        </form>
    </section>
</div>

<?php
require_once __DIR__ . '/../templates/footer.php';
?>
