
    <?php
    include '../nav.php';
    include '../../controller/ProductController.php';
    $id = $_GET['id'];
    $controller = new ProductController();
    $product = $controller->getProductById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $result = $controller->update($id, $name, $price, $quantity);

        if ($result) {
            header("Location: list.php");
            exit();
        } else {
            $errors = "Cannot update product";
        }
    }
    ?>

    <div class="container mt-5 col-6">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <h4 class="card-header font-weight-bold">Edit Product</h4>
            <div class="card-body">
                <form action="edit.php" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        <div class="invalid-feedback">Name is required</div>
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01" value="<?php echo $product['price']; ?>" required>
                        <div class="invalid-feedback">Price is required</div>
                    </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo $product['quantity_available']; ?>" required>
                        <div class="invalid-feedback">Quantity is required</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="list.php" type="submit" class="btn btn-secondary ">Back</a>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>