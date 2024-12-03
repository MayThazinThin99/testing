<?php
include __DIR__ . '/../config/database.php';
class TransactionController
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get all transactions
    public function getTransactions()
    {
        $query = "SELECT products.name as product_name, users.username, transactions.id, quantity, total_price 
                  FROM transactions 
                  JOIN users ON transactions.user_id = users.id
                  JOIN products ON transactions.product_id = products.id;
                ";
        try {
            $stmt = $this->db->getPDO()->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching products: " . $e->getMessage());
        }
    }

    // Create a transaction
    public function createTransaction($name, $price, $quantity)
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

    //Get transaction by id
    public function getTransactionById($id)
    {
        $query = "SELECT products.name as product_name, users.username, transactions.id, quantity, total_price, transaction_date
                  FROM transactions 
                  JOIN users ON transactions.user_id = users.id
                  JOIN products ON transactions.product_id = products.id
                  WHERE transactions.id = :id;
                ";
        try {
            $stmt = $this->db->getPDO()->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching product: " . $e->getMessage());
        }
    }

    //Update the transaction
    public function updateTransaction($id, $name, $price, $quantity)
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
}
