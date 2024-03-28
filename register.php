<?php
include 'php/connect.php';
$msg = "";

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $suffix = $_POST['suffix'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $height = $_POST['height'];
    $contactNum = $_POST['contactNum'];
    $email = $_POST['email'];
    
    $select = "SELECT * FROM tbl_healthmonitor WHERE email='{$email}'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $msg = "<div class='alert alert-danger'>Email already exists.</div>";
    } else {
        $current_time = date("Y-m-d H:i:s");
        $stmt = $conn->prepare("INSERT INTO tbl_healthmonitor (firstName, middleName, lastName, suffix, age, gender, height, contactNum, email, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $stmt->execute([$firstName, $middleName, $lastName, $suffix, $age, $gender, $height, $contactNum, $email, $current_time]);

        if ($result) {
            $msg = "<div class='alert alert-success'>Account successfully created.</div>";

            $newId = mysqli_insert_id($conn);
            header("Location: checking.php?id=$newId");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100"> 
    <div class="row border rounded-3 p-3 bg-white shadow box-area">
        <div class="col-md-5 rounded-3 d-flex justify-content-center align-items-center flex-column left-box"
             style="background: #030067">
        </div>
        <div class="col-md-7 right-box">
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>User Registration Form</h2>
                    <p>To register for Health Monitoring, please make sure you meet the following requirements:</p>
                </div>
                <div>
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
                            <select name="suffix" id="suffix" class="form-select bg-light fs-6">
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
                            <input type="text" class="form-control bg-light fs-6" id="phone" required pattern="[0-9]{11}" placeholder="Enter Phone Number" />
                            <div class="invalid-feedback">Please enter a valid 11-digit phone number.</div>
                        </div>
                        <label class="form-label">Email address:</label>
                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" class="form-control bg-light fs-6" placeholder="example@example.com" required />
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="input-group mb-2">
                            <button type="submit" name="submit" class="btn btn-lg w-100 fs-6" style="background-color: #030067; color: #ececec;">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    'use strict'
    var form = document.getElementById("myForm");

    form.addEventListener("submit", function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        let phoneInput = document.getElementById("phone");
        let phoneRegex = /^[0-9]{11}$/;
        if (!phoneRegex.test(phoneInput.value)) {
            phoneInput.setCustomValidity("Please enter a valid 11-digit phone number.");
        } else {
            phoneInput.setCustomValidity("");
        }

        form.classList.add('was-validated');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
