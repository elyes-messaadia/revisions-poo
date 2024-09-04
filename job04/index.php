<?php

require_once 'db.php';          // Connexion à la base de données
require_once 'Product.php';      // Classe Product

// Récupération du produit avec l'ID 7
$query = $pdo->prepare('SELECT * FROM product WHERE id = :id');
$query->execute(['id' => 7]);
$productData = $query->fetch(PDO::FETCH_ASSOC);

// Vérifier si le produit avec l'ID 7 existe
if ($productData) {
    // Hydrater l'instance Product avec les données récupérées
    $product = new Product(
        $productData['id'],
        $productData['name'],
        explode(',', $productData['photos']), // On suppose que les photos sont stockées en chaîne séparée par des virgules
        $productData['price'],
        $productData['description'],
        $productData['quantity'],
        $productData['category_id'],
        new DateTime($productData['createdAt']),
        new DateTime($productData['updatedAt'])
    );

    // Afficher les détails du produit
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
    echo "Le produit avec l'ID 7 n'existe pas.";
}
