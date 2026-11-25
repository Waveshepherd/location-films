<?php
declare(strict_types=1);

//On spécifie le type de retour de chaque fonction car cela permet d'éviter les erreurs de type

//Si l'utilisateur est connecté, on récupère le nombre d'éléments dans le panier
function getCartCount(PDO $pdo): int
{
    if (!isLoggedIn()) {
        return 0;
    }

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM cart_item WHERE Id_user = :user_id');
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    return (int)$stmt->fetchColumn();
}

function addToCart(PDO $pdo, int $userId, int $movieId): void
{   
    // INSERT IGNORE évite une erreur si le film est déjà dans le panier
    $stmt = $pdo->prepare('INSERT IGNORE INTO cart_item (Id_user, Id_movie) VALUES (:user_id, :movie_id)');
    $stmt->execute(['user_id' => $userId, 'movie_id' => $movieId]);
}

function removeFromCart(PDO $pdo, int $userId, int $movieId): void
{
    $stmt = $pdo->prepare('DELETE FROM cart_item WHERE Id_user = :user_id AND Id_movie = :movie_id');
    $stmt->execute(['user_id' => $userId, 'movie_id' => $movieId]);
}

function clearCart(PDO $pdo, int $userId): void
{
    $stmt = $pdo->prepare('DELETE FROM cart_item WHERE Id_user = :user_id');
    $stmt->execute(['user_id' => $userId]);
}

function getCartItems(PDO $pdo, int $userId): array
{
    $stmt = $pdo->prepare('
        SELECT m.Id_movie, m.title, m.director, m.price 
        FROM movie m
        JOIN cart_item c ON m.Id_movie = c.Id_movie
        WHERE c.Id_user = :user_id
    ');
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll();
}

function checkoutCart(PDO $pdo, int $userId): bool
{
    $items = getCartItems($pdo, $userId);
    if (empty($items)) {
        return false;
    }

    $stmtBuy = $pdo->prepare('INSERT INTO purchase (Id_user, Id_movie) VALUES (:user_id, :movie_id)');
    foreach ($items as $item) {
        $stmtBuy->execute(['user_id' => $userId, 'movie_id' => $item['Id_movie']]);
    }

    clearCart($pdo, $userId);
    return true;
}

// On spécifie false ici car si un utilisateur modifie l'URL sur un id de catégorie qui n'existe pas on renvoie false qui permet de gérer l'erreur et de renvoyer un message
function getCategoryById(PDO $pdo, int $idCategorie): array|false
{
    $stmt = $pdo->prepare('SELECT Id_categorie, name FROM categorie WHERE Id_categorie = :id');
    $stmt->execute(['id' => $idCategorie]);
    return $stmt->fetch();
}

function getMoviesByCategory(PDO $pdo, int $idCategorie): array
{
    $stmt = $pdo->prepare('
        SELECT m.* 
        FROM movie m
        JOIN movie_categorie mc ON m.Id_movie = mc.Id_movie
        WHERE mc.Id_categorie = :id
        ORDER BY m.title ASC
    ');
    $stmt->execute(['id' => $idCategorie]);
    return $stmt->fetchAll();
}

function getMoviesByDirector(PDO $pdo, string $director): array
{
    if ($director === '') {
        return [];
    }

    $stmt = $pdo->prepare('SELECT * FROM movie WHERE director = :director ORDER BY title ASC');
    $stmt->execute(['director' => $director]);
    return $stmt->fetchAll();
}

function getLatestMovies(PDO $pdo, int $limit = 8): array
{
    $stmt = $pdo->prepare('SELECT * FROM movie ORDER BY Id_movie DESC LIMIT :limit');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function userExists(PDO $pdo, string $email, string $username): bool
{
    $stmt = $pdo->prepare('SELECT Id_user FROM user WHERE email = :email OR username = :username');
    $stmt->execute(['email' => $email, 'username' => $username]);
    return (bool)$stmt->fetch();
}

function createUser(PDO $pdo, string $username, string $email, string $plainPassword): int
{
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO user (username, email, password) VALUES (:username, :email, :password)');
    $stmt->execute([
        'username' => $username,
        'email'    => $email,
        'password' => $hashedPassword
    ]);
    return (int)$pdo->lastInsertId();
}

function getUserByEmail(PDO $pdo, string $email): array|false
{
    $stmt = $pdo->prepare('SELECT Id_user, username, password FROM user WHERE email = :email');
    $stmt->execute(['email' => $email]);
    return $stmt->fetch();
}

function getUserPasswordHash(PDO $pdo, int $userId): string|false
{
    $stmt = $pdo->prepare('SELECT password FROM user WHERE Id_user = :id');
    $stmt->execute(['id' => $userId]);
    return $stmt->fetchColumn();
}

function updateUserPassword(PDO $pdo, int $userId, string $newPlainPassword): void
{
    $newHash = password_hash($newPlainPassword, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('UPDATE user SET password = :pwd WHERE Id_user = :id');
    $stmt->execute(['pwd' => $newHash, 'id' => $userId]);
}

function getUserPurchases(PDO $pdo, int $userId): array
{
    $stmt = $pdo->prepare('
        SELECT m.Id_movie, m.title, m.price, p.purchase_date
        FROM purchase p
        JOIN movie m ON p.Id_movie = m.Id_movie
        WHERE p.Id_user = :user_id
        ORDER BY p.purchase_date DESC
    ');
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll();
}

function searchMovies(PDO $pdo, string $query): array
{
    if ($query === '') {
        return [];
    }

    $stmt = $pdo->prepare('
        SELECT * FROM movie 
        WHERE title LIKE :search_title OR director LIKE :search_director 
        ORDER BY title ASC
    ');
    $likeParam = '%' . $query . '%';
    $stmt->execute([
        'search_title'    => $likeParam,
        'search_director' => $likeParam
    ]);
    return $stmt->fetchAll();
}

function getMovieById(PDO $pdo, int $movieId): array|false
{
    $stmt = $pdo->prepare('SELECT * FROM movie WHERE Id_movie = :id');
    $stmt->execute(['id' => $movieId]);
    return $stmt->fetch();
}

function getCategoriesByMovieId(PDO $pdo, int $movieId): array
{
    $stmt = $pdo->prepare('
        SELECT c.Id_categorie, c.name 
        FROM categorie c
        JOIN movie_categorie mc ON c.Id_categorie = mc.Id_categorie
        WHERE mc.Id_movie = :id
    ');
    $stmt->execute(['id' => $movieId]);
    return $stmt->fetchAll();
}
