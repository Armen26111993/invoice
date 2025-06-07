<?php

require_once 'config.php';

$files = glob(__DIR__ . '/migrations/*.sql');

foreach ($files as $file) {
    $sql = file_get_contents($file);
    $pdo->exec($sql);
}

echo "Migrations are completed !!!";
