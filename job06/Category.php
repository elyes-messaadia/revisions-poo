<?php

class Category
{
    // Propriétés privées
    private int $id;
    private string $name;
    private string $description;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    // Constructeur pour initialiser les propriétés
    public function __construct(int $id, string $name, string $description, DateTime $createdAt = null, DateTime $updatedAt = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->createdAt = $createdAt ?? new DateTime();
        $this->updatedAt = $updatedAt ?? new DateTime();
    }

    // Méthode pour récupérer tous les produits d'une catégorie
    public function getProducts(PDO $pdo): array
    {
        // Prépare la requête pour récupérer les produits associés à cette catégorie
        $query = $pdo->prepare("SELECT * FROM product WHERE category_id = :category_id");
        $query->execute(['category_id' => $this->id]);
        $productsData = $query->fetchAll(PDO::FETCH_ASSOC);

        $products = [];

        // Hydrater les objets Product avec les données récupérées
        foreach ($productsData as $productData) {
            $products[] = new Product(
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
        }

        return $products; // Retourne un tableau contenant des instances de Product
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
