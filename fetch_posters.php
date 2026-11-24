<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/database.php';

$movies = $pdo->query('SELECT Id_movie, title FROM movie')->fetchAll();
$updateStmt = $pdo->prepare('UPDATE movie SET image_url = :url WHERE Id_movie = :id');

foreach ($movies as $movie) {
    $parts = explode(':', $movie['title']);
    $searchTitle = trim($parts);

    $apiUrl = 'https://themoviedb.org' . TMDB_API_KEY . '&query=' . urlencode($searchTitle) . '&language=fr-FR';

    $jsonResponse = @file_get_contents($apiUrl);
    if ($jsonResponse === false) {
        echo "[ERREUR API] " . $movie['title'] . PHP_EOL;
        continue;
    }

    $data = json_decode($jsonResponse, true);

    if (!empty($data['results']['poster_path'])) {
        $remoteUrl = 'https://tmdb.org' . $data['results']['poster_path'];
        $imageContent = @file_get_contents($remoteUrl);

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
