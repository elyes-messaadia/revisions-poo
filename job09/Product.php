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

    // Méthode pour créer un nouveau produit en base de données
    public function create(PDO $pdo): ?Product
    {
        // Préparer la requête SQL pour insérer un nouveau produit
        $query = $pdo->prepare("
            INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id)
            VALUES (:name, :photos, :price, :description, :quantity, :createdAt, :updatedAt, :category_id)
        ");

        // Exécuter la requête avec les propriétés de l'instance actuelle
        $success = $query->execute([
            'name' => $this->name,
            'photos' => implode(',', $this->photos), // Convertir le tableau de photos en chaîne
            'price' => $this->price,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'createdAt' => $this->createdAt->format('Y-m-d H:i:s'),
            'updatedAt' => $this->updatedAt->format('Y-m-d H:i:s'),
            'category_id' => $this->category_id
        ]);

        if ($success) {
            // Récupérer l'ID du produit nouvellement inséré
            $this->id = $pdo->lastInsertId();
            return $this; // Retourne l'instance actuelle avec l'ID mis à jour
        }

        return false; // Retourne false si l'insertion échoue
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    // Setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function setCategoryId(int $category_id): void
    {
        $this->category_id = $category_id;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}

