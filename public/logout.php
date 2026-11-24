<?php
declare(strict_types=1);

// 1. On récupère la session en cours pour pouvoir la détruire
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. On vide toutes les variables de session
session_unset();

// 3. On supprime le cookie de session côté navigateur par sécurité
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );
}

// 4. On détruit définitivement la session sur le serveur
session_destroy();

// 5. Redirection immédiate vers la page d'accueil (suivie de exit)
header('Location: /index.php');
exit;
