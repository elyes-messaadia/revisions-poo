<?php

require_once 'db.php';          // Connexion à la base de données
require_once 'Product.php';      // Classe Product

// Utiliser findAll pour récupérer tous les produits
$products = Product::findAll($pdo);

if (!empty($products)) {
    // Si des produits sont trouvés, on les affiche
    foreach ($products as $product) {
        echo "Produit ID : " . $product->getId() . "<br>";
        echo "Nom : " . $product->getName() . "<br>";
        echo "Photos : " . implode(', ', $product->getPhotos()) . "<br>";
        echo "Prix : " . $product->getPrice() . "<br>";
        echo "Description : " . $product->getDescription() . "<br>";
        echo "Quantité : " . $product->getQuantity() . "<br>";
        echo "Catégorie ID : " . $product->getCategoryId() . "<br>";
        echo "Créé le : " . $product->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
        echo "Mis à jour le : " . $product->getUpdatedAt()->format('Y-m-d H:i:s') . "<br><br>";
    }
} else {
    echo "Aucun produit trouvé.";
}
