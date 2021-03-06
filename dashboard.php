<?php
include('configuration.php');
include('function.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$secure = new Secure();
$session = new Session();

$session->isLogin();
$session->isAdmin();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Dashboard</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main>
        <div class="container py-4">
            <header class="pb-3 mb-4 border-bottom border-warning d-flex">
                <div>
                    <a href="/securecode" class="d-flex align-items-center text-warning text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img">
                            <title>Bootstrap</title>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path>
                        </svg>
                        <span class="fs-4 text-upercase">secure crud</span>
                    </a>
                </div>
                <?php if ($_SESSION['is_loggged']) { ?>
                    <div class="flex-grow-1 text-end p-1 text-warning fs-4">
                        <?php echo '<a href="./user_profile.php" class="btn btn-outline-warning btn-sm"><span class="text">' . $secure->xecho($_SESSION['user_name']) . '</span></a>'; ?>
                    </div>
                <?php } ?>
            </header>

            <div class="p-3 bg-purple rounded-3 text-warning">
                <div class="container-fluid">
                    <h1 class="display-5 fw-bold text-uppercase">Kursus Secured Programming</h1>
                    <p class="fs-4">Secure coding is the practice of developing computer software in a way that guards against the accidental introduction of security vulnerabilities. Defects, bugs and logic flaws are consistently the primary cause of commonly exploited software vulnerabilities.</p>
                </div>
            </div>

            <div class="row justify-content-center align-items-md-stretch">
                <div class="col-md-12">
                    <div class="card m-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3 text-center">Dashboard</h5>

                            <div class="d-flex flex-row bd-highlight mb-3 justify-content-center">
                                <a class="p-2 mx-1 btn btn-warning" href="./user_list.php">User List</a>                                
                                <a class="p-2 mx-1 btn btn-warning" href="./register.php">User Register</a>                                
                                <a class="p-2 mx-1 btn btn-warning" href="./user_profile.php">User Profile</a>                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <footer class="pt-3 mt-4 text-warning border-top border-warning">
                ?? 2021
            </footer>
        </div>
    </main>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>
