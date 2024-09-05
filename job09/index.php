<?php

require_once 'db.php';          // Connexion à la base de données
require_once 'Product.php';      // Classe Product

// Création d'une nouvelle instance de Product
$product = new Product(
    0,
    'T-shirt',
    ['https://picsum.photos/200/300'],
    1000, // Prix en centimes
    'A beautiful T-shirt',
    10,   // Quantité
    1,    // ID de la catégorie
    new DateTime(),
    new DateTime()
);

// Utiliser la méthode create() pour insérer le produit en base de données
$newProduct = $product->create($pdo);

if ($newProduct) {
    // Si l'insertion réussit, afficher les détails du produit avec l'ID généré
    echo "Produit créé avec succès :<br>";
    echo "ID : " . $newProduct->getId() . "<br>";
    echo "Nom : " . $newProduct->getName() . "<br>";
    echo "Photos : " . implode(', ', $newProduct->getPhotos()) . "<br>";
    echo "Prix : " . $newProduct->getPrice() . "<br>";
    echo "Description : " . $newProduct->getDescription() . "<br>";
    echo "Quantité : " . $newProduct->getQuantity() . "<br>";
    echo "Catégorie ID : " . $newProduct->getCategoryId() . "<br>";
    echo "Créé le : " . $newProduct->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
    echo "Mis à jour le : " . $newProduct->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";
} else {
    echo "Échec de la création du produit.";
}
