<?php
try {
    $env = file_get_contents('.env');
    preg_match('/DB_DATABASE=(.*)/', $env, $m);
    $db = trim($m[1]);
    preg_match('/DB_USERNAME=(.*)/', $env, $m);
    $user = trim($m[1]);
    preg_match('/DB_PASSWORD=(.*)/', $env, $m);
    $pass = trim($m[1]);
    preg_match('/DB_HOST=(.*)/', $env, $m);
    $host = trim($m[1]);

    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $stmt = $pdo->query("SELECT status, count(*) as total FROM certificates GROUP BY status");
    echo "DB STATUS:\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- {$row['status']}: {$row['total']}\n";
    }
}
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
