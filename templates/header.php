<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb & Co - Location & Achat de Films</title>
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
                <a href="/category.php?cat=action">Action</a>
                <a href="/category.php?cat=drama">Drame</a>
                <a href="/cart.php">Panier (0)</a>
                <a href="/login.php" class="btn-outline">Connexion</a>
                <a href="/register.php" class="btn-primary">Inscription</a>
            </nav>
        </div>
    </header>
    <main class="container">
