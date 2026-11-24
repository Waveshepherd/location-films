<?php
declare(strict_types=1);

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/database.php';

function fetchUrlWithCurl(string $url): string|false
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'IMDbCo-StudentProject/1.0');
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($httpCode === 200 && $response !== false) ? $response : false;
}

$movies = $pdo->query('SELECT Id_movie, title FROM movie')->fetchAll();
$updateStmt = $pdo->prepare('UPDATE movie SET image_url = :url WHERE Id_movie = :id');

foreach ($movies as $movie) {
    $parts = explode(':', $movie['title']);
    $searchTitle = trim(reset($parts));

    $baseUrl = 'https://api.themoviedb.org/3/search/movie';
    $params = '?api_key=' . TMDB_API_KEY . '&query=' . urlencode($searchTitle) . '&language=fr-FR';
    $apiUrl = $baseUrl . $params;

    $jsonResponse = fetchUrlWithCurl($apiUrl);
    if ($jsonResponse === false) {
        echo "[ERREUR API] " . $movie['title'] . PHP_EOL;
        continue;
    }

    $data = json_decode($jsonResponse, true);
    $firstResult = isset($data['results']) && is_array($data['results']) ? reset($data['results']) : null;

    if (is_array($firstResult) && !empty($firstResult['poster_path'])) {
        $remoteUrl = 'https://image.tmdb.org/t/p/w500' . $firstResult['poster_path'];
        $imageContent = fetchUrlWithCurl($remoteUrl);

        if ($imageContent !== false) {
            $localFileName = 'movie_' . $movie['Id_movie'] . '.jpg';
            file_put_contents(__DIR__ . '/public/images/' . $localFileName, $imageContent);

            $localWebPath = '/images/' . $localFileName;
            $updateStmt->execute([
                'url' => $localWebPath,
                'id'  => $movie['Id_movie']
            ]);

            echo "[TÉLÉCHARGÉ] " . $movie['title'] . " -> " . $localWebPath . PHP_EOL;
        }
    } else {
        echo "[NON TROUVÉ] " . $movie['title'] . PHP_EOL;
    }
}
