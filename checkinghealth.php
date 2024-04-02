<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'php/connect.php';

$msg = "";

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    $heartRate = $_POST['heartRate'];
    $weight = $_POST['weight'];

    $stmt = $conn->prepare("SELECT * FROM tbl_healthmonitor WHERE IDNumber = ?");
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $fetch = $result;

    if ($result) {
        $stmt = $conn->prepare("UPDATE tbl_healthmonitor SET heartRate = ?, weight = ? WHERE IDNumber = ?");
        $result = $stmt->execute([$heartRate, $weight, $id]);

        if ($result) {
            $msg = "<div class='alert alert-success'>Successfully.</div>";
            $mail = new PHPMailer(true);

            $current_time = date("Y-m-d H:i:s");

            $prompt = "what is love?";
            $ai_response = file_get_contents("https://hercai.onrender.com/v3/hercai?question=$prompt");
            if ($ai_response === false) {
                $ai_reply = "Error";
            }
            
            $ai_reply = json_decode($ai_response, true)['reply'];

            $message = "<html>
            <head>
            <title>Health Update</title>
            </head>
            <body>
            <p>Dear " . $fetch['firstName'] . " " . $fetch['lastName'] . ",</p>
            <p>We would like to inform you about the latest health update as of " . $current_time . ":</p>
            <ul>
                <li><strong>ID Number:</strong> " . htmlspecialchars($fetch['IDNumber']) . "</li>
                <li><strong>Height:</strong> " . htmlspecialchars($fetch['height']) . " cm </li>
                <li><strong>Weight:</strong> " . htmlspecialchars($fetch['weight']) . "</li>
                <li><strong>Heart Rate:</strong> " . htmlspecialchars($fetch['heartRate']) . "</li>
            </ul>
            <p>AI Response: " . $ai_reply . "</p>
            <p>Thank you for using our Health Monitoring System.</p>
            </body>
            </html>";

            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'cotactearmenion@gmail.com';        
                $mail->Password   = 'vpbw duhx omzy xgkw'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('cotactearmenion@gmail.com', 'GROUP 10 - LFSA322N002');
                $mail->addAddress($fetch['email']);

                $mail->isHTML(true);                        
                $mail->Subject = "Health Update - " . $fetch['firstName'] . " " . $fetch['lastName'];
                $mail->Body    =  $message;

                $mail->send();

                $msg = "<div class='alert alert-success'>Successfully.</div>";
            } catch (Exception $e) {
                $msg = "<div class='alert alert-danger'>Error sending email.</div>";    
            }
        } else {
            $msg = "<div class='alert alert-danger'>Error updating heart rate.</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>Error</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Checking your Health!</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100"> 
        <div class="row border rounded-3 p-3 bg-white shadow box-area">
            <div class="col-md-5 rounded-3 d-flex justify-content-center align-items-center flex-column left-box" style="background: #030067">
            </div>
            <div class="col-md-7 right-box">
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
                        <label for="showHeartRate" class="form-label">Heart Rate (bp):</label>
                        <div class="input-group mb-3">
                            <input type="heartRate" id="showHeartRate" name="heartRate" class="form-control bg-light fs-6" placeholder="00" required>
                            <div class="invalid-feedback">Please enter your heart rate.</div>   
                        </div>      
                        <label for="showWeight" class="form-label">Weight (kg):</label>   
                        <div class="input-group mb-3">
                            <input type="weight" id="showWeight" name="weight" class="form-control bg-light fs-6" placeholder="00" required>
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
                showWeight();
            }, 2500);
        });
    </script>
</body>
</html>