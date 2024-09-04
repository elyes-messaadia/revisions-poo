<?php

require_once 'db.php'; // Connexion à la base de données
require_once 'Product.php'; // Inclut la classe Product

// Récupération de tous les produits
$query = $pdo->query("SELECT * FROM product");
$products = $query->fetchAll(PDO::FETCH_ASSOC);

// Affichage des produits
foreach ($products as $product) {
    echo "Produit : " . $product['name'] . "<br>";
    echo "Description : " . $product['description'] . "<br>";
    echo "Prix : " . $product['price'] . " centimes<br>";
    echo "Quantité : " . $product['quantity'] . "<br>";
    echo "Catégorie ID : " . $product['category_id'] . "<br><br>";
}
