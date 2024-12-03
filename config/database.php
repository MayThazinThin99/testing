<?php
class Database
{
    public $pdo;

    public function __construct()
    {

        $host = "localhost";
        $dbName = "vending_machine";
        $username = "root";
        $password = "root";

        try {
            $tempPdo = new PDO("mysql:host=$host", $username, $password);
            $tempPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $dbExists = $this->databaseExists($tempPdo, $dbName);

            if (!$dbExists) {
                // Create the database
                $sql1 = "CREATE DATABASE $dbName";
                $tempPdo->exec($sql1);

                $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->createTables();
            } else {
                $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            die("Database setup failed: " . $e->getMessage());
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    // Check if the database exists
    private function databaseExists($pdo, $dbName)
    {
        $query = "SHOW DATABASES LIKE :dbname";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':dbname' => $dbName]);

        return $stmt->rowCount() > 0;
    }

    // Create tables
    private function createTables()
    {
        $this->createAndInsertProductsTable();
        $this->createAndInsertUsersTable();
        $this->createTransactionsTable();
    }

    // Create and insert the products table
    private function createAndInsertProductsTable()
    {
        $query = "
            CREATE TABLE IF NOT EXISTS products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                price DECIMAL(10,2) NOT NULL,
                quantity_available INT NOT NULL
            );
        ";
        $this->executeQuery($query);

        $insertQuery = "INSERT INTO `products` (name, price, quantity_available)
            VALUES  ('Coke', 3.99, 50),
                    ('Pepsi', 6.89, 30),
                    ('Water', 4.50, 20)
        ";
        $this->executeQuery($insertQuery);
    }

    // Create and insert the users table
    private function createAndInsertUsersTable()
    {
        $query = "
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                phone VARCHAR(25),
                password VARCHAR(255) NOT NULL,
                address TEXT,
                role ENUM('admin', 'user') DEFAULT 'user'
            );
        ";
        $this->executeQuery($query);
        $adminPW = $this->passwordHashing('admin123');
        $userPW1 = $this->passwordHashing('user123');
        $userPW2 = $this->passwordHashing('user456');
        $insertQuery = "INSERT INTO `users` (username, email, phone, password, address, role)
            VALUES 
            ('admin', 'admin@aa.aa', '091212147', '$adminPW', 'no. 123, unknown street, unknown township', 'admin'),
            ('user1', 'user1@uu.uu', '091212147', '$userPW1', 'no. 123, unknown street, unknown township', 'user'),
            ('user2', 'user2@uu.uu', '091212147', '$userPW2', 'no. 123, unknown street, unknown township', 'user')
        ";
        $this->executeQuery($insertQuery);
    }

    // Create the transactions table
    private function createTransactionsTable()
    {
        $query = "
            CREATE TABLE IF NOT EXISTS transactions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                product_id INT NOT NULL,
                quantity INT NOT NULL,
                total_price DECIMAL(10,2) NOT NULL,
                status INT(1) NOT NULL,
                transaction_date DATETIME DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            );
        ";
        $this->executeQuery($query);
    }

    // Helper function to execute a query
    private function executeQuery($query)
    {
        try {
            $this->pdo->exec($query);
        } catch (PDOException $e) {
            die("Error executing query: " . $e->getMessage());
        }
    }

    private function passwordHashing($pw)
    {
        return password_hash($pw, PASSWORD_DEFAULT);
    }
}

new Database();
