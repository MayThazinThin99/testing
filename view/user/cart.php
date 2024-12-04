<?php
include '../nav.php';
$totalPrice = 0;
if (isset($_POST['add'])) {
    $productId = $_POST['product_id'];
    $_SESSION['cart'][$productId]['quantity'] += 1;
}
if (isset($_POST['remove'])) {
    $productId = $_POST['product_id'];
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] -= 1;
        if ($_SESSION['cart'][$productId]['quantity'] <= 0) {
            unset($_SESSION['cart'][$productId]);
        }
    }
}
?>

<div class="container mt-5 col-md-9">
    <div class="card">
        <h4 class="card-header font-weight-bold">Cart List</h4>
        <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) : ?>
            <p class="text-center">There is no data.</p>
        <?php else : ?>
            <div class="card-body">
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $item) : ?>
                            <tr>
                                <td>1</td>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo number_format($item['price'], 2); ?></td>
                                <td><?php echo $item['quantity']; ?></td>
                                <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td>
                                    <span class="d-flex">
                                        <form method="POST" action="cart.php" class="mr-2">
                                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                            <button type="submit" name="remove">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512" width="23" height="23">
                                                    <path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 
                                                    0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="POST" action="cart.php">
                                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                            <button type="submit" name="add">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 448 512" width="23" height="23">
                                                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0
                                                        144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 
                                                        144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 
                                                        0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </span>
                            </tr>
                            <?php $totalPrice += $item['price'] * $item['quantity']; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><strong>Total Price: </strong><?php echo number_format($totalPrice, 2); ?></p>
                <a href="checkout.php">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
</body>

</html>