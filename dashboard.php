<?php
    session_start();
    include 'config/db.php';

    if(!isset($_SESSION['user_id'])) {
        header('location: index.php');
        exit();
    }

    $msg = '';

    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE IDNumber = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $msg = '<div class="alert alert-danger">User not found.</div>';
        header('location: logout.php');
        exit();
    } else {
        $idNumber = htmlspecialchars($user['IDNumber']);
        $firstName = htmlspecialchars($user['firstName']);
        $middleName = htmlspecialchars($user['middleName']);
        $lastName = htmlspecialchars($user['lastName']);
        $suffixName = htmlspecialchars($user['suffix']);
        $age = htmlspecialchars($user['age']);
        $gender = htmlspecialchars($user['gender']);
        $height = htmlspecialchars($user['height']);
        $weight = htmlspecialchars($user['weight']);
        $heartRate = htmlspecialchars($user['heartRate']);
        $SpO2 = htmlspecialchars($user['SpO2']);
        $contactNumber = htmlspecialchars($user['contactNum']);
        $email = htmlspecialchars($user['email']);
        $airesponse = htmlspecialchars($user['ai_response']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['updatedata'])) {
            $_SESSION['randomID'] = $user['IDNumber'];
            header('location: checkinghealth.php');
            exit();
        } else if (isset($_POST['logout'])) {
            header('location: logout.php');
            exit();
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
    <title>Dashboard | Health Monitoring System</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .profile-card {
            width: 100%;
            max-width: 500px;
            border-radius: 15px;
            overflow: hidden;
        }
        .profile-card-header {
            background: #000000;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .profile-card-body {
            padding: 20px;
        }
        .profile-card-body p {
            margin: 10px 0;
        }
        .profile-card-body span {
            font-weight: bold;
        }
        .btn-logout, .btn-update {
            width: 100%;
        }
        .btn-logout {
            background: #dc3545;
            color: white;
        }
        .btn-update {
            background: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card profile-card shadow-lg">
            <div class="card-header profile-card-header">
                <h2>Welcome, <?php echo "$firstName $middleName $lastName"; ?></h2>
            </div>
            <div class="card-body profile-card-body bg-light">
                <?php echo $msg; ?>
                <p>ID Number: <span><?php echo $idNumber; ?></span></p>
                <p>First Name: <span><?php echo $firstName; ?></span></p>
                <p>Middle Name: <span><?php echo $middleName; ?></span></p>
                <p>Last Name: <span><?php echo $lastName; ?></span></p>
                <p>Suffix: <span><?php echo $suffixName; ?></span></p>
                <p>Age: <span><?php echo $age; ?></span></p>
                <p>Gender: <span><?php echo $gender; ?></span></p>
                <p>Height: <span><?php echo $height; ?></span></p>
                <p>Weight: <span><?php echo $weight; ?></span></p>
                <p>Heart Rate: <span><?php echo $heartRate; ?></span></p>
                <p>SpO2: <span><?php echo $SpO2; ?></span></p>
                <p>Contact Number: <span><?php echo $contactNumber; ?></span></p>
                <p>Email: <span><?php echo $email; ?></span></p>
                <p>AI Response: <span><?php echo $airesponse; ?></span></p>
                <form method="post">
                    <button type="submit" name="updatedata" class="btn btn-update mt-4">Update Data</button>
                    <button type="submit" name="logout" class="btn btn-logout mt-2">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <?php include 'layouts/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>