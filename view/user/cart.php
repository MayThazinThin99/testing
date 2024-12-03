<?php
echo "this is testing";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Validate input
    if (!is_numeric($productId) || !is_numeric($productPrice) || !is_numeric($quantity) || $quantity <= 0) {
        echo "Invalid input.";
        exit();
    }

    // Add product to the session cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$productId] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $quantity
        ];
    }

    echo "Product added to cart.";
}
<?php
session_start();
include '../nav.php'

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<p>Your cart is empty.</p>";
    exit();
}

$totalPrice = 0;
?>

<h1>Shopping Cart</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['cart'] as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item['name']); ?></td>
            <td><?php echo number_format($item['price'], 2); ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
        </tr>
        <?php $totalPrice += $item['price'] * $item['quantity']; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<p><strong>Total Price: </strong><?php echo number_format($totalPrice, 2); ?></p>
<a href="checkout.php">Proceed to Checkout</a>
<script
    src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
</body>

</html>