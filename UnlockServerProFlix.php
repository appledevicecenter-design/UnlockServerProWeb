<?php
// Tu API Key de TMDb
$apiKey = 'XRrSedAvFu93xs50edlqpA6Biued4yrHERWQFTEVNYjEB08LnJGvOw=='; // reemplaza con tu API Key de TMDb

// URL para películas populares
$url = "https://api.themoviedb.org/3/movie/popular?api_key=$apiKey&language=es-ES&page=1";

// Función para hacer la petición con cURL
function fetchData($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// Obtenemos los datos de la API
$data = fetchData($url);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnlockServerProFlix - Películas Populares</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 2rem;
        }

        .card {
            background: white;
            margin: 1rem;
            padding: 1rem;
            border-radius: 8px;
            width: 200px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            text-align: center;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            border-radius: 5px;
        }

        .card h3 {
            font-size: 1rem;
            margin: 0.5rem 0;
        }

        .card p {
            margin: 0;
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>UnlockServerProFlix - Películas Populares</h1>
    </header>

    <div class="container">
        <?php if(isset($data['results'])): ?>
            <?php foreach($data['results'] as $movie): ?>
                <div class="card">
                    <img src="https://image.tmdb.org/t/p/w500<?= $movie['poster_path'] ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
                    <h3><?= htmlspecialchars($movie['title']) ?></h3>
                    <p>Rating: <?= $movie['vote_average'] ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se pudieron cargar las películas.</p>
        <?php endif; ?>
    </div>
</body>
</html>
