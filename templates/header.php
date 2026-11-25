<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions.php';
$cartCount = isset($pdo) ? getCartCount($pdo) : 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb &amp; Co - Location &amp; Achat de Films</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container nav-content">
            <a href="/index.php" class="logo">IMDb &amp; Co</a>
            
            <form action="/search.php" method="get" class="search-bar">
                <input type="text" name="q" placeholder="Titre ou réalisateur..." required>
                <button type="submit">Rechercher</button>
            </form>

            <nav class="nav-links">
                <a href="/category.php?id=1">Action</a>
                <a href="/category.php?id=2">Drame</a>
                <a href="/category.php?id=3">Science-Fiction</a>
                
                <?php if (isLoggedIn()): ?>
                    <a href="/cart.php">Panier (<?= $cartCount ?>)</a>
                    <a href="/profile.php" class="btn-outline">Profil (<?= htmlspecialchars($_SESSION['username']) ?>)</a>
                    <a href="/logout.php" class="btn-danger">Déconnexion</a>
                <?php else: ?>
                    <a href="/login.php" class="btn-outline">Connexion</a>
                    <a href="/register.php" class="btn-primary">Inscription</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container">
