<?php
include '../nav.php';
include '../../controller/ProductController.php';
$controller = new ProductController();
$products = $controller->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$productId] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1,
        ];
    }
    $msg = "Product added to cart successfully.";
}
?>
<div class="container-fluid p-0 my-5">
    <?php if (isset($msg)) : ?>
        <div class="alert alert-success alert-dismissible fade show mt-5 col-6 text-center" role="alert">
            <?php echo $msg; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <div class="col-md-9 m-auto">
        <div class="card mt-5 bg-light">
            <div class="card-body">
                <div class="row">
                    <?php foreach ($products as $key => $row) : ?>
                        <div class="col-md-4 mb-5 text-center">
                            <div class="card p-3 rounded">
                                <div><?php echo htmlspecialchars($row['name']); ?></div>
                                <div><?php echo number_format($row['price'], 2); ?></div>
                                <!-- <button class="btn btn-primary btn-block mt-2">Add to cart</button> -->
                                <form method="POST" action="dashboard.php">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                    <button type="submit" class="btn btn-primary btn-block mt-2">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

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