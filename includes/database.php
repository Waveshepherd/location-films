<?php
declare(strict_types=1);

$host = '127.0.0.1';
$db = 'film_rental';
$user = 'dev';
$pass = 'dev';
$charset = 'utf8mb4';

// Renseignement des informations de connexion à la base de données
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// On passe les options directement dans le constructeur pour qu'elles soient appliquée dès la connexion avec la BDD
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Oblige le PDO à lancer une exception en cas d'erreur SQL
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Evite les doublons de clés dans les tableaux associatifs retournés par fetchAll()
    PDO::ATTR_EMULATE_PREPARES   => false, // Permet d'envoyer la requête SQL dans un premier temps puis la donnée utilisateur dans un second temps : évite les injections SQL
];

try {
    // Création d'un objet PDO pour se connecter à la base de données
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Utilisation de la classe native de PHP pour récupérer les erreurs liées à la base de données
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}