<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;charset=utf8mb4', 'root', '');
    $stmt = $pdo->query("SELECT TABLE_NAME FROM information_schema.tables WHERE table_schema = 'MyApp_db'");
    $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if ($rows) {
        echo implode(PHP_EOL, $rows) . PHP_EOL;
    } else {
        echo 'No tables in information_schema for MyApp_db' . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
