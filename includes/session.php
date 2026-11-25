<?php
declare(strict_types=1);

// Démarrage de la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Génération d'un token CSRF si ce n'est pas déjà fait
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Vérifie si la clef ['user_id'] existe = si l'utilisateur est connecté et empêche une erreur si la session n'est pas initialisée
function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

// Redirige vers la page de connexion si l'utilisateur n'est pas connecté permet de protéger les pages qui nécessitent une authentification
function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: /login.php');
        exit;
    }
}

// Vérifie si le token du formulaire est le même que celui stocké dans la session
function verifyCsrfToken(?string $token): bool
{
    return isset($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
}