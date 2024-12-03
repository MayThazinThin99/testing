<?php
session_start();
include __DIR__ . '/../config/database.php';


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    try {
        $db = new Database();
        $pdo = $db->getPDO();

        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify(password: $password, hash: $user['password'])) {
                $_SESSION['login'] = 'true';
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];
                if ($user['role'] === 'admin') {
                    header('Location: ../view/product/list.php');
                } else {
                    header('Location: ../view/user/dashboard.php');
                }
                exit;
            } else {
                $errors = "Password is incorrect.";
            }
        } else {
            $errors = "No user found with this email.";
        }
        $_SESSION['errors'] = $errors;
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    if (strlen($phone) < 10) {
        $errors = "Phone must be at least 10 digits.";
    }

    if (strlen($password) < 6) {
        $errors = "Password must be at least 6 characters.";
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    try {
        $db = new Database();
        $pdo = $db->getPDO();
        
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetchColumn() > 0) {
            $errors = "Email is already registered.";
        }
        if ($errors != null) {
            $_SESSION['errors'] = $errors;
            header("Location: ../view/register.php");
            exit();
        }

        $query = "INSERT INTO users (username, email, phone, password, address, role)
            VALUES (:username, :email, :phone, :password, :address, 'user')
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':phone' => $phone,
            ':password' => $hashedPassword,
            ':address' => $address
        ]);
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>