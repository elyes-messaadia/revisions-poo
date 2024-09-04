<?php

require_once 'Product.php'; // Inclut la classe Product

// Création d'une nouvelle instance de Product
$product = new Product(
    1,
    'T-shirt',
    ['https://picsum.photos/200/300'],
    1000, // Prix en centimes (par exemple, 10,00 €)
    'A beautiful T-shirt',
    10,  // Quantité
    new DateTime(),  // Date de création
    new DateTime()   // Date de mise à jour
);

// Utilisation des getters
var_dump($product->getId());
var_dump($product->getName());
var_dump($product->getPhotos());
var_dump($product->getPrice());
var_dump($product->getDescription());
var_dump($product->getQuantity());
var_dump($product->getCreatedAt());
var_dump($product->getUpdatedAt());

// Modification des valeurs avec les setters
$product->setName('T-shirt Premium');
$product->setPrice(2499); // Prix mis à jour
$product->setQuantity(5); // Quantité mise à jour

// Affichage des valeurs après modification
var_dump($product->getName());
var_dump($product->getPrice());
var_dump($product->getQuantity());
