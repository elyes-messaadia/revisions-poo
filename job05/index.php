<?php

require_once 'db.php';          // Connexion à la base de données
require_once 'Product.php';      // Classe Product
require_once 'Category.php';     // Classe Category

// Requête pour récupérer le produit avec l'ID 7
$query = $pdo->prepare("SELECT * FROM product WHERE id = :id");
$query->execute(['id' => 7]);
$productData = $query->fetch(PDO::FETCH_ASSOC);

if ($productData) {
    // Hydrater l'instance Product avec les données récupérées
    $product = new Product(
        $productData['id'],
        $productData['name'],
        explode(',', $productData['photos']),
        $productData['price'],
        $productData['description'],
        $productData['quantity'],
        $productData['category_id'],
        new DateTime($productData['createdAt']),
        new DateTime($productData['updatedAt'])
    );

    // Récupérer la catégorie associée
    $category = $product->getCategory($pdo);

    if ($category) {
        // Afficher les informations de la catégorie
        echo "Catégorie associée au produit :<br>";
        echo "ID : " . $category->getId() . "<br>";
        echo "Nom : " . $category->getName() . "<br>";
        echo "Description : " . $category->getDescription() . "<br>";
        echo "Créée le : " . $category->getCreatedAt()->format('Y-m-d H:i:s') . "<br>";
        echo "Mise à jour le : " . $category->getUpdatedAt()->format('Y-m-d H:i:s') . "<br>";
    } else {
        echo "Catégorie non trouvée.<br>";
    }

} else {
    echo "Le produit avec l'ID 7 n'existe pas.";
}
