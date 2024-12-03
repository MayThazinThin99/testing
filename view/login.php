<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);
    }
    ?>
    <div class="container mt-5 col-4">
        <?php if (isset($errors)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $errors; ?>
            </div>
        <?php endif; ?>
        <div class="card">
            <h4 class="card-header font-weight-bold">Login</h4>
            <form action="controller/LoginController.php" method="POST" class="needs-validation" novalidate>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required />
                        <div class="invalid-feedback">Email is required</div>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="####" required />
                        <div class="invalid-feedback">Password is required</div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block my-2 mt-4" name="login">Login</button>
                    <div class="text-center">Not a member?
                        <a href="register.php" type="submit" style="text-decoration: none;">Sign Up</a>
                    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>

</html>