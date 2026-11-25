<?php
declare(strict_types=1);

require_once __DIR__ . '/../includes/session.php';

// 1. Vide toutes les variables de la session courante
$_SESSION = [];

// 2. Supprime le cookie de session dans le navigateur du visiteur
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

// 3. Détruit définitivement le fichier de session côté serveur
session_destroy();

// 4. Redirige vers la page d'accueil
header('Location: /index.php');
exit;
