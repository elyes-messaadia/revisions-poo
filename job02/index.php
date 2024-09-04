<?php

require_once 'Product.php'; // Inclut la classe Product
require_once 'Category.php'; // Inclut la classe Category

// Création d'une catégorie
$category = new Category(1, "Vêtements", "Vêtements pour homme et femme");

// Création d'un produit avec association de la catégorie
$product = new Product(
    1,
    "T-shirt",
    ["https://picsum.photos/200/300"],
    1999, // Prix en centimes (par exemple, 19,99 €)
    "Un T-shirt confortable",
    50,  // Quantité
    $category->getId(), // ID de la catégorie
    new DateTime(),  // Date de création
    new DateTime()   // Date de mise à jour
);

// Utilisation des getters pour tester les classes Product et Category
var_dump($category->getId());
var_dump($category->getName());
var_dump($category->getDescription());

var_dump($product->getId());
var_dump($product->getName());
var_dump($product->getCategoryId()); // Devrait correspondre à la catégorie
