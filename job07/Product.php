<?php

class Product
{
    // Propriétés privées
    private int $id;
    private string $name;
    private array $photos;
    private int $price;
    private string $description;
    private int $quantity;
    private DateTime $createdAt;
    private DateTime $updatedAt;
    private int $category_id; // Référence à une catégorie

    // Constructeur pour initialiser les propriétés avec des valeurs par défaut
    public function __construct(
        int $id = 0,
        string $name = '',
        array $photos = [],
        int $price = 0,
        string $description = '',
        int $quantity = 0,
        int $category_id = 0,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->photos = $photos;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->category_id = $category_id;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
    }

    // Méthode findOneById pour récupérer un produit par ID et hydrater l'instance
    public function findOneById(PDO $pdo, int $id): bool
    {
        // Préparer et exécuter la requête SQL
        $query = $pdo->prepare("SELECT * FROM product WHERE id = :id");
        $query->execute(['id' => $id]);
        $productData = $query->fetch(PDO::FETCH_ASSOC);

        if ($productData) {
            // Si le produit est trouvé, on hydrate l'instance actuelle avec les données
            $this->id = $productData['id'];
            $this->name = $productData['name'];
            $this->photos = explode(',', $productData['photos']);
            $this->price = $productData['price'];
            $this->description = $productData['description'];
            $this->quantity = $productData['quantity'];
            $this->category_id = $productData['category_id'];
            $this->createdAt = new DateTime($productData['createdAt']);
            $this->updatedAt = new DateTime($productData['updatedAt']);

            return true;  // Retourne vrai si le produit a été trouvé et hydraté
        }

        return false;  // Retourne faux si aucun produit n'est trouvé avec cet ID
    }

    // Getters et setters (inchangés)
}
