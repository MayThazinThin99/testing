    <?php
    include '../nav.php';
    include 'controller/transactionController.php';
    $id = $_GET['id'];
    $controller = new TransactionController();
    $transactions = $controller->getTransactionById($id);
    ?>
    <div class="container mt-5 col-6">
        <div class="card">
            <h4 class="card-header font-weight-bold">Transaction Detail</h4>
            <div class="card-body">
                <h3><?php echo htmlspecialchars($transactions['username']); ?></h3>
                <div class="my-3"><i>Product Name : </i><span> <?php echo htmlspecialchars($transactions['product_name']); ?></span></div>
                <div class="my-3"><i>Quantity : </i><span> <?php echo number_format($transactions['quantity']); ?></span></div>
                <div class="my-3"><i>Total Price : </i><span> <?php echo number_format($transactions['total_price']); ?></span></div>
                <div class="my-3"><i>Transaction Date : </i><span> <?php echo htmlspecialchars($transactions['transaction_date']); ?></span></div>
                <a href="list.php" type="submit" class="btn btn-secondary ">Back</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>