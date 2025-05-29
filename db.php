<?php
$pdo = new PDO('mysql:host=localhost;dbname=birthday_db', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>