<?php
include __DIR__ . '/../config/database.php';

class ProductController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all products
    public function index()
    {
        $query = "SELECT * FROM products";
        try {
            $stmt = $this->db->getPDO()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching products: " . $e->getMessage());
        }
    }

    // Create a product
    public function create($name, $price, $quantity)
    {
        $query = "INSERT INTO products (name, price, quantity_available) VALUES (:name, :price, :quantity)";
        try {
            $stmt = $this->db->getPDO()->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error creating product: " . $e->getMessage());
        }
    }

    //Get product by id
    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        try {
            $stmt = $this->db->getPDO()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching product: " . $e->getMessage());
        }
    }

    //Update the product
    public function update($id, $name, $price, $quantity)
    {
        $query = "UPDATE products SET name = :name, price = :price, quantity_available = :quantity WHERE id = :id";
        try {
            $stmt = $this->db->getPDO()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Error updating product: " . $e->getMessage());
        }
    }

    //Add to cart
    public function addToCart($productId, $quantity)
    {
        session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }

        header("Location: cart.php");
        exit;
    }
}
