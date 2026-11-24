<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

/**
 * Interroge l'API TMDb en direct pour récupérer l'URL de l'affiche d'un film
 */
function getMoviePosterUrl(string $title): string
{
    $parts = explode(':', $title);
    $searchTitle = trim($parts[0]);

    $apiUrl = 'https://themoviedb.org' . TMDB_API_KEY . '&query=' . urlencode($searchTitle) . '&language=fr-FR';

    $jsonResponse = @file_get_contents($apiUrl);
    if ($jsonResponse !== false) {
        $data = json_decode($jsonResponse, true);
        if (!empty($data['results'][0]['poster_path'])) {
            return 'https://tmdb.org' . $data['results'][0]['poster_path'];
        }
    }

    // Image de secours si l'API ne répond pas ou ne trouve pas le film
    return 'https://placehold.co' . urlencode($title);
}
