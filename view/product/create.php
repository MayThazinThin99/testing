    <?php
    include '../nav.php';
    include '../../controller/ProductController.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $controller = new ProductController();
        $result = $controller->create($name, $price, $quantity);

        if ($result) {
            header("Location: list.php");
            exit();
        } else {
            $errors = "Cannot create product";
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
            <h4 class="card-header font-weight-bold">Create Product</h4>
            <div class="card-body">
                <form action="create.php" method="POST" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" maxlength="255" required>
                        <div class="invalid-feedback">Name is required</div>
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" class="form-control" required>
                        <div class="invalid-feedback">Price is required</div>
                    </div>
                    <div class="form-group">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity" class="form-control" required>
                        <div class="invalid-feedback">Quantity is required</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="list.php" type="submit" class="btn btn-secondary ">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
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