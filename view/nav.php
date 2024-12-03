<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vending Machine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <style>
        .dropdown-toggle::after {
            display: none;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $username = $_SESSION['username'];
    $role = $_SESSION['role'];
    // include 'auth.php';
    ?>
    <div class="container-fluid p-0">
        <div class="navbar-light bg-light mb-5">
            <nav class="navbar navbar-expand-lg col-md-9 m-auto">
                <?php if ($role == 'user') : ?>
                    <a class="navbar-brand" href="dashboard.php">Product List</a>
                    <a class="navbar-brand" href="cart.php">Cart</a>
                <?php endif; ?>
                <?php if ($role == 'admin') : ?>
                    <a class="navbar-brand" href="../product/list.php">Product List</a>
                    <a class="navbar-brand" href="../transaction/list.php">Transaction List</a>
                <?php endif; ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active ml-3">
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-expanded="false">
                            <?php echo $username; ?>
                        </a>
                        <div class="dropdown-menu" style="left: 86% !important;">
                            <a class="dropdown-item" href="../logout.php">Logout</a>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>