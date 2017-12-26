<?php

// skapa databasanslutning
$pdo = 'mysql:dbname='.$settings['db']['database'].';host='.$settings['db']['host'];
try {
    $pdo = new PDO($pdo, $settings['db']['user'], $settings['db']['password']);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die();
}