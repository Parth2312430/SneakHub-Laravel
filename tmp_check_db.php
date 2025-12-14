<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;charset=utf8mb4', 'root', '');
    $dbs = $pdo->query('SHOW DATABASES')->fetchAll(PDO::FETCH_COLUMN);
    if ($dbs) {
        foreach ($dbs as $d) {
            echo $d . PHP_EOL;
        }
    } else {
        echo 'No databases returned.' . PHP_EOL;
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
