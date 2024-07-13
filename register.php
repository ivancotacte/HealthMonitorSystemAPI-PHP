<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    include 'config/db.php';

    $msg = '';

    if (isset($_GET['status']) && $_GET['status'] == 'email_sent') {
        $msg = "<div class='alert alert-success'>Email sent successfully.</div>";
    }

    if(isset($_POST['submit'])) {
        $firstName = ucfirst($_POST['firstName']);
        $middleName = ucfirst($_POST['middleName']);
        $lastName = ucfirst($_POST['lastName']);
        $suffixName = $_POST['suffixName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $height = $_POST['height'];
        $contactNumber = $_POST['contactNumber'];
        $email = $_POST['email'];        

        $currentDate = date('Ymd');
        $randomID = "HMS-" . $currentDate . str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $randomDigits = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $password = $firstName . $lastName . $randomDigits;
        $lowercasePassword = strtolower($password); 
        $hashedPassword = password_hash($lowercasePassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE email = ?");  
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            $msg = "<div class='alert alert-danger'>Email already exists.</div>";
        } else {
            $current_TimeDate = date("Y-m-d H:i:s");
            $stmt = $conn->prepare("INSERT INTO tbl_users (IDNumber, firstName, middleName, lastName, suffix, age, gender, height, contactNum, email, password, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([$randomID, $firstName, $middleName, $lastName, $suffixName, $age, $gender, $height, $contactNumber, $email, $hashedPassword, $current_TimeDate]);

            if ($result) {

                try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'cotactearmenion@gmail.com';        
                    $mail->Password   = 'eptg zrey kmju fnri'; 
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;
        
                    $mail->setFrom('cotactearmenion@gmail.com', 'GROUP 10 - LFSA322N002');
                    $mail->addAddress($email);
        
                    $mail->isHTML(true);                        
                    $mail->Subject = "Welcome to the Health Monitoring System";
                    $mail->Body    = "Dear " . ucfirst($firstName) . " " . ucfirst($lastName) . ",<br><br>Your temporary password is: <strong>" . $password . "</strong><br>Your ID is: <strong>" . $randomID . "</strong><br><br>Please log in and change your password as soon as possible.";
        
                    $mail->send();
                } catch (Exception $e) {
                    $msg = "<div class='alert alert-danger'>Error sending email: {$mail->ErrorInfo}</div>";    
                }
                
                $_SESSION['randomID'] = $randomID;
                $msg = "<div class='alert alert-success'>Account successfully created.</div>";
                header("Location: checkinghealth.php");
                exit();
            } else {
                $msg = "<div class='alert alert-danger'>Failed to create account.</div>";
            }
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
    <title>Register | Health Monitoring System</title>
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

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-4 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #000000;">
            </div>

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>User Registration Form</h2>
                        <p>To check your health status, please ensure that you fulfill the following criteria:</p>
                    </div>
                    <?php echo $msg; ?>
                    <form id="myForm" action="" method="post" novalidate>
                        <label class="form-label">First Name:</label>
                        <div class="input-group mb-2">
                            <input type="text" name="firstName" class="form-control bg-light fs-6" placeholder="Juan" required />
                            <div class="invalid-feedback">Please enter your first name.</div>
                        </div>
                        <label class="form-label">Middle Name:</label>
                        <div class="input-group mb-2">
                            <input type="text" name="middleName" class="form-control bg-light fs-6" placeholder="" />
                        </div>
                        <label class="form-label">Last Name:</label>
                        <div class="input-group mb-2">
                            <input type="text" name="lastName" class="form-control bg-light fs-6" placeholder="Dela Cruz" required />
                            <div class="invalid-feedback">Please enter your last name.</div>
                        </div>
                        <label class="form-label">Suffix:</label>
                        <div class="input-group mb-2">
                            <select name="suffixName" id="suffix" class="form-select bg-light fs-6">
                                <option value="">Select suffix</option>
                                <option value="jr">Jr</option>
                                <option value="sr">Sr</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                            </select>
                        </div>
                        <label class="form-label">Age:</label>
                        <div class="input-group mb-2">
                            <input type="number" name="age" class="form-control bg-light fs-6" placeholder="Enter your age" required />
                            <div class="invalid-feedback">Please enter your age.</div>
                        </div>
                        <label class="form-label">Gender:</label>
                        <div class="input-group mb-2">
                            <select name="gender" id="gender" class="form-select bg-light fs-6" required>
                                <option value="">Select your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <div class="invalid-feedback">Please select your gender.</div>
                        </div>
                        <label class="form-label">Height (CM):</label>
                        <div class="input-group mb-2">
                            <input type="number" name="height" placeholder="Enter your height" class="form-control bg-light fs-6" required />
                            <div class="invalid-feedback">Please enter your height.</div>
                        </div>
                        <label class="form-label">Contact Number:</label>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control bg-light fs-6" name="contactNumber" id="phone" required pattern="[0-9]{11}" placeholder="Enter Phone Number" />
                            <div class="invalid-feedback">Please enter a valid 11-digit phone number.</div>
                        </div>
                        <label class="form-label">Email address:</label>
                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" class="form-control bg-light fs-6" placeholder="example@example.com" required />
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="input-group mb-2">
                            <button type="submit" name="submit" class="btn btn-lg w-100 fs-6" style="background-color: #000000; color: #ececec;">Submit</button>
                        </div>
                    </form>
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
