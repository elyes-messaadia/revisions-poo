<?php

require_once 'db.php';          // Connexion à la base de données
require_once 'Product.php';      // Classe Product
require_once 'Category.php';     // Classe Category

// Requête pour récupérer la catégorie avec l'ID 1 (par exemple)
$query = $pdo->prepare("SELECT * FROM category WHERE id = :id");
$query->execute(['id' => 1]);  // Tu peux modifier l'ID pour tester une autre catégorie
$categoryData = $query->fetch(PDO::FETCH_ASSOC);

if ($categoryData) {
    // Hydrater l'instance de Category
    $category = new Category(
        $categoryData['id'],
        $categoryData['name'],
        $categoryData['description'],
        new DateTime($categoryData['createdAt']),
        new DateTime($categoryData['updatedAt'])
    );

    // Récupérer tous les produits associés à cette catégorie
    $products = $category->getProducts($pdo);

    if (!empty($products)) {
        echo "Produits dans la catégorie " . $category->getName() . " :<br>";
        foreach ($products as $product) {
            echo "Produit : " . $product->getName() . " (Prix : " . $product->getPrice() . " centimes)<br>";
        }
    } else {
        echo "Aucun produit trouvé pour cette catégorie.";
    }

} else {
    echo "Catégorie non trouvée.";
}
