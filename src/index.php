<?php
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'appuser';
$pass = getenv('DB_PASS') ?: 'apppassword';
$dbname = getenv('DB_NAME') ?: 'hellodb';

$status = '';
$statusClass = '';
$dbVersion = '';
$visits = 0;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5
    ]);

    $pdo->exec("INSERT INTO visits (visited_at) VALUES (NOW())");

    $visits = $pdo->query("SELECT COUNT(*) FROM visits")->fetchColumn();

    $dbVersion = $pdo->query("SELECT VERSION()")->fetchColumn();

    $status = 'Conexion exitosa a MySQL';
    $statusClass = 'success';
} catch (PDOException $e) {
    $status = 'Error de conexion: ' . $e->getMessage();
    $statusClass = 'error';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola Mundo - Docker App</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="bg-blobs">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <header class="header">
        <div class="header-inner">
            <div class="logo">
                <i class="fa-solid fa-cube"></i>
                <span>DockerApp</span>
            </div>
            <nav class="nav-pills">
                <span><i class="fa-brands fa-php"></i> PHP</span>
                <span><i class="fa-brands fa-docker"></i> Docker</span>
                <span><i class="fa-solid fa-database"></i> MySQL</span>
            </nav>
        </div>
    </header>

    <main class="main">
        <section class="hero">
            <p class="eyebrow"><i class="fa-solid fa-sparkles"></i> Aplicacion Docker en ejecucion</p>
            <h1 class="title">Hola,<br><em>Mundo.</em></h1>
            <p class="subtitle">Una aplicacion PHP containerizada con Docker Compose, conectada a MySQL en tiempo real.</p>
        </section>

        <section class="cards">

            <div class="card card-status <?= $statusClass ?>">
                <div class="card-icon">
                    <?php if ($statusClass === 'success'): ?>
                        <i class="fa-solid fa-circle-check"></i>
                    <?php else: ?>
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <h3>Estado de la Base de Datos</h3>
                    <p><?= htmlspecialchars($status) ?></p>
                    <?php if ($dbVersion): ?>
                        <span class="badge"><i class="fa-solid fa-tag"></i> MySQL <?= $dbVersion ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($statusClass === 'success'): ?>
            <div class="card card-visits">
                <div class="card-icon">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div class="card-body">
                    <h3>Visitas Registradas</h3>
                    <div class="big-number"><?= number_format($visits) ?></div>
                    <p>Almacenadas en la tabla <code>visits</code></p>
                </div>
            </div>
            <?php endif; ?>

            <div class="card card-stack">
                <div class="card-icon">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div class="card-body">
                    <h3>Stack Tecnologico</h3>
                    <ul class="stack-list">
                        <li><i class="fa-brands fa-docker"></i> Docker Compose</li>
                        <li><i class="fa-brands fa-php"></i> PHP 8.2 + Apache</li>
                        <li><i class="fa-solid fa-database"></i> MySQL 8.0</li>
                        <li><i class="fa-solid fa-network-wired"></i> Red interna Docker</li>
                    </ul>
                </div>
            </div>

            <div class="card card-info">
                <div class="card-icon">
                    <i class="fa-solid fa-server"></i>
                </div>
                <div class="card-body">
                    <h3>Informacion del Servidor</h3>
                    <ul class="info-list">
                        <li><span>Host</span><code><?= gethostname() ?></code></li>
                        <li><span>IP</span><code><?= $_SERVER['SERVER_ADDR'] ?? 'N/A' ?></code></li>
                        <li><span>PHP</span><code><?= PHP_VERSION ?></code></li>
                        <li><span>Hora</span><code><?= date('H:i:s') ?></code></li>
                    </ul>
                </div>
            </div>

        </section>
    </main>

    <footer class="footer">
        <p><i class="fa-solid fa-heart"></i> Creado con Docker Compose &mdash; <?= date('Y') ?></p>
    </footer>

    <script src="js/app.js"></script>
</body>
</html>