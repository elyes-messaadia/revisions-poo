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

    // Méthode pour récupérer la catégorie associée
    public function getCategory(PDO $pdo): ?Category
    {
        $query = $pdo->prepare("SELECT * FROM category WHERE id = :id");
        $query->execute(['id' => $this->category_id]);
        $categoryData = $query->fetch(PDO::FETCH_ASSOC);

        if ($categoryData) {
            return new Category(
                $categoryData['id'],
                $categoryData['name'],
                $categoryData['description'],
                new DateTime($categoryData['createdAt']),
                new DateTime($categoryData['updatedAt'])
            );
        }

        return null; // Retourne null si la catégorie n'existe pas
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

