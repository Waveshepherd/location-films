# IMDb & Co — Plateforme de Location & Achat de Films en Ligne

Application web dynamique développée en **PHP 8** et **MariaDB** dans le cadre du module **1PHPD**.

## Fonctionnalités principales

* **Catalogue & Navigation :** Affichage des derniers ajouts sur l'accueil, filtrage par catégories (*Action*, *Drame*, *Science-Fiction*) via une relation plusieurs-à-plusieurs (`movie_categorie`), fiches détaillées des films et filmographie par réalisateur.

* **Moteur de recherche :** Recherche par titre de film ou nom de réalisateur (`LIKE`).

* **Gestion des utilisateurs :** Inscription, connexion sécurisée (`password_hash` / `password_verify`), gestion de session (`$_SESSION`), espace profil avec historique des achats et modification du mot de passe.

* **Panier persistant :** Sauvegarde des articles en base de données (`cart_item`), ajout sans doublon (`INSERT IGNORE`), suppression unitaire, vidage et validation d'achat (`purchase`).

* **Enrichissement via API :** Script CLI (`fetch_posters.php`) interrogeant l'API REST **TMDb** en JSON pour télécharger les affiches HD localement.

## Sécurité mise en œuvre

* **Injections SQL :** Utilisation exclusive de **PDO** avec requêtes préparées (`prepare` / `execute`) et désactivation de l'émulation (`PDO::ATTR_EMULATE_PREPARES => false`).

* **Failles XSS :** Échappement systématique des sorties HTML avec `htmlspecialchars()`.

* **Failles CSRF :** Protection des formulaires `POST` par jeton de session (`random_bytes` + `hash_equals`).

* **Qualité du code :** Typage strict activé (`declare(strict_types=1);`) et séparation modulaire (`config/`, `includes/`, `templates/`, `public/`).

## Installation et lancement en local

    1. **Importer la base de données :**

       ```bash
       mariadb -u dev -pdev film_rental < install.sql
       ```
    2. **Configurer l'API TMDb (optionnel pour retélécharger les affiches) :**

       ```bash
       cp config/config.example.php config/config.php
       # Renseigner votre clé API v3 dans config/config.php puis lancer :
       php fetch_posters.php
       ```
    3. **Démarrer le serveur web PHP :**
    
       ```bash
       php -S localhost:8000 -t public
       ```
       Ouvrir ensuite `http://localhost:8000` dans le navigateur.
