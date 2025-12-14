<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
try {
    $db = 'MyApp_db';
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname='.$db.';charset=utf8mb4', 'root', '');
    $stmt = $pdo->query('SHOW TABLES');
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if ($rows) {
        foreach ($rows as $r) { echo $r . PHP_EOL; }
    } else { echo 'No tables in DB: ' . $db . PHP_EOL; }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
