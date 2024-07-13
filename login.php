<?php
    session_start();
    include 'config/db.php';

    $msg = '';
    if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user) {
            $hashedPassword = $user['password'];
    
            if(password_verify(strtolower($password), $hashedPassword)) {
                $_SESSION['user_id'] = $user['IDNumber'];
                header("Location: dashboard.php");
                exit();
            } else {
                $msg = "<div class='alert alert-danger'>Incorrect password.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email not found.</div>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Login | Health Monitoring System</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-white shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/Untitled design.png" alt="Logo" class="d-inline" style="height: 40px;">
                <span class="d-none d-lg-inline">Health Monitoring System</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="features.php">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center min-vh-150">
        <div class="row border rounded-4 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #000000;"></div> 

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Login</h2>
                        <p>Access your health data and monitor your progress. Please enter your login details below.</p>
                    </div>
                    <?php echo $msg; ?>
                    <form id="myForm" action="" method="post" novalidate>
                        <div class="input-group mb-3">
                            <input type="email" id="email" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" required>
                            <div class="invalid-feedback">Please enter your email address.</div>
                        </div>
                        <div class="input-group mb-4">
                            <input type="password" id="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" required>
                            <div class="invalid-feedback">Please enter your password.</div>
                        </div>
                        <div class="input-group mb-3">
                        <button type="submit" name="submit" class="btn btn-lg w-100 fs-6" style="background-color: #000000; color: #ececec;">Sign In</button>
                        </div>
                    </form>
                    <div class="row">
                        <small>Don't have an account? <a href="register.php">Sign Up</a></small>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <?php include 'layouts/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
        'use strict';
        var form = document.getElementById("myForm");

        form.addEventListener("submit", function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        });
    </script>
</body>
</html>