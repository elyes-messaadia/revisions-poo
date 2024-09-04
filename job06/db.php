<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=draft_shop', 'root', ''); // Remplace 'root' et '' par tes identifiants MySQL si nécessaire
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
