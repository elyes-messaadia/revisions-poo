<?php

require_once 'db.php';          // Connexion à la base de données
require_once 'Product.php';      // Classe Product

// Création d'une nouvelle instance de Product (vide pour le moment)
$product = new Product();

// Utiliser findOneById pour récupérer le produit avec l'ID 7 (par exemple)
if ($product->findOneById($pdo, 7)) {
    // Si le produit est trouvé, on affiche ses détails
    echo "Produit ID : " . $product->getId() . "<br>";
    echo "Nom : " . $product->getName() . "<br>";
    echo "Photos : " . implode(', ', $product->getPhotos()) . "<br>";
    echo "Prix : " . $product->getPrice() . "<br>";
    echo "Description : " . $product->getDescription() . "<br>";
    echo "Quantité : " . $product->getQuantity() . "<br>";
    echo "Catégorie ID : " . $product->getCategoryId() . "<br>";
    echo "Créé le : " . $product->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
    echo "Mis à jour le : " . $product->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";
} else {
    // Si le produit n'est pas trouvé, afficher un message
    echo "Le produit avec l'ID 7 n'existe pas.";
}
