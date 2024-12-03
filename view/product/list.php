    <?php
    include '../nav.php';
    include '../../controller/ProductController.php';
    $controller = new ProductController();
    $products = $controller->index();
    ?>
    <div class="container mt-5 col-md-9">
        <div class="d-flex justify-content-between">
            <div>
                <a href="create.php" class="btn btn-primary btn-sm mb-3">Create</a>
            </div>
        </div>
        <div class="card">
            <h4 class="card-header font-weight-bold">Product List</h4>
            <?php if (!empty($products)) : ?>
                <div class="card-body">
                    <table class="table table-borderless table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Transaction Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $key => $row) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo number_format($row['price'], 2); ?></td>
                                    <td><?php echo $row['quantity_available']; ?></td>
                                    <td>
                                        <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-info">View</a>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                                        <a href="list.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger"
                                            onclick="return confirm('Are you sure to delete?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p class="text-center">There is no data.</p>
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