<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    include 'config/db.php';

    $msg = '';
    $id = $_GET['id'] ?? null;

    $stmt = $conn->prepare("SELECT * FROM tbl_users WHERE IDNumber = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if (isset($_POST['submit'])) {
        $heartRate = $_POST['heartRate'];
        $SpO2 = $_POST['SpO2'];
        $weight = $_POST['weight'];

        $stmt = $conn->prepare("UPDATE tbl_users SET heartRate = ?, SpO2 = ?, weight = ? WHERE IDNumber = ?");
        $updateResult = $stmt->execute([$heartRate, $SpO2, $weight, $id]);
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
    <title>Checking Health | Health Monitoring System</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-4 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #000000;">
            </div>

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Checking your Health!</h2>
                        <p><strong>Instructions:</strong></p>
                        <ol>
                            <li>Place your finger on the sensor and hold it for 20 seconds. Remove your finger when you hear a beep.</li>
                            <li>Step onto the weight scale and wait for 5 seconds. Step off when you hear a beep.</li>
                            <li>Wait for the system to automatically detect and populate your heart rate and weight values.</li>
                            <li>Click the submit button to save the data.</li>  
                        </ol>
                    </div>
                    <?php echo $msg; ?>
                    <form id="myForm" action="" method="post" novalidate>
                        <label for="showHeartRate" class="form-label">Heart Rate (bpm):</label>
                        <div class="input-group mb-3">
                            <input type="text" id="showHeartRate" name="heartRate" class="form-control bg-light fs-6" placeholder="00" required>
                            <div class="invalid-feedback">Please enter your heart rate.</div>   
                        </div>
                        <label for="showSP02" class="form-label">Oxygen saturation (SpO2):</label>
                        <div class="input-group mb-3">
                            <input type="text" id="showSPO2" name="SpO2" class="form-control bg-light fs-6" placeholder="00" required>
                            <div class="invalid-feedback">Please enter your oxygen saturation.</div>
                        </div>
                        <label for="showWeight" class="form-label">Weight (kg):</label>   
                        <div class="input-group mb-3">
                            <input type="text" id="showWeight" name="weight" class="form-control bg-light fs-6" placeholder="00" required>
                            <div class="invalid-feedback">Please enter your weight.</div>       
                        </div>
                        <div class="input-group">
                            <button type="submit" name="submit" class="btn btn-lg w-100 fs-6" style="background-color: #030067; color: #ececec;">
                                Submit
                            </button>
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
        'use strict'
        var form = document.getElementById("myForm");

        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });     
    </script>      
    <script type="text/javascript">
        $(document).ready(function() {
            function showHeartRate() {
                $.ajax({
                    url: 'api.php',
                    type: 'POST',
                    data: {
                        action: 'showHeartRate'
                    },
                    dataType: 'html',
                    success: function(result) {
                        $('#showHeartRate').val(result);
                    },
                    error: function() {
                        alert("Failed to show the logs");
                    }
                })
            }
            function showSPO2() {
                $.ajax({
                    url: 'api.php',
                    type: 'POST',
                    data: {
                        action: 'showSPO2'
                    },
                    dataType: 'html',
                    success: function(result) {
                        $('#showSPO2').val(result);
                    },
                    error: function() {
                        alert("Failed to show the logs");
                    }
                })
            }
            function showWeight() {
                $.ajax({
                    url: 'api.php',
                    type: 'POST',
                    data: {
                        action: 'showWeight'
                    },
                    dataType: 'html',
                    success: function(result) {
                        $('#showWeight').val(result);
                    },
                    error: function() {
                        alert("Failed to show the logs");
                    }
                })
            }   
            setInterval(function() {
                showHeartRate();
                showSPO2();
                showWeight();
            }, 2500);
        });
    </script>
</body>
</html>