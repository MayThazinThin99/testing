<?php
include '../nav.php';
include '../../controller/ProductController.php';
$controller = new ProductController();
$products = $controller->index();
?>
<div class="container-fluid p-0 my-5">
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
                                <form method="POST" action="ProductController.php?action=add_to_cart">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="quantity" value="1">
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
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".add-to-cart").click(function() {
            let productId = $(this).data("id");
            let productName = $(this).data("name");
            let productPrice = $(this).data("price");

            // Send product details to server via AJAX
            $.ajax({
                url: 'add_to_cart.php',
                type: 'POST',
                data: {
                    product_id: productId,
                    name: productName,
                    price: productPrice,
                    quantity: 1 // Default quantity
                },
                success: function(response) {
                    alert(response);
                },
                error: function() {
                    alert("Failed to add product to cart.");
                }
            });
        });
    });
</script> -->

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