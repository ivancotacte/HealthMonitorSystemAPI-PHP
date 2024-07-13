<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Features | Health Monitoring System</title>
</head>
<style>
    .box-area {
        width: 900px;
        margin-top: 5px;
    }
</style>
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="features.php">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-4 p-4 bg-white shadow box-area">
            <h2 class="mb-4">Features of the Smart Portable Heart Rate Sensor System</h2>
            <ul class="list-group p-1">
                <li class="list-group-item">Real-time monitoring of heart rate and pulse oximetry using the MAX30102 sensor.</li>
                <li class="list-group-item">ESP32 sends data to the website via API integration.</li>
                <li class="list-group-item">LCD I2C display for real-time data visualization.</li>
                <li class="list-group-item">Automated email notifications with AI-generated health responses upon user registration.</li>
                <li class="list-group-item">
                    Example AI response:
                    <blockquote class="blockquote fs-6">
                        <p class="mb-4">As a doctor, I would first like to say that having a resting heart rate of 93 beats per minute and a SpO2 of 100% suggests that your heart and lungs are functioning well. Your weight of 77.48kg is within a healthy range and your age of 23 years is considered young and generally healthy. To maintain your overall health and well-being, I recommend the following:</p>
                        <ul>
                            <li><strong>Healthy Diet:</strong> Make sure you are eating a balanced diet rich in fruits, vegetables, whole grains, lean proteins, and healthy fats. Avoid excessive amounts of processed foods, sugars, and unhealthy fats.</li>
                            <li><strong>Regular Exercise:</strong> Engage in regular physical activity such as aerobic exercises, strength training, or any form of exercise you enjoy. Aim for at least 150 minutes of moderate-intensity exercise per week.</li>
                            <li><strong>Stress Management:</strong> Find ways to manage stress through techniques like mindfulness, meditation, yoga, or hobbies that help you relax.</li>
                            <li><strong>Regular Check-ups:</strong> It's important to have regular check-ups with your healthcare provider to monitor your overall health and to address any health concerns that may arise.</li>
                            <li><strong>Hydration:</strong> Drink an adequate amount of water each day to stay hydrated and help your body function properly.</li>
                            <li><strong>Avoid Smoking and Excessive Alcohol:</strong> If you smoke, consider quitting, and limit alcohol intake to promote overall health.</li>
                        </ul>
                        <p class="mb-4">Remember, these are general recommendations and it's always best to consult with a healthcare provider for personalized advice based on your individual health needs. Stay proactive about your health and continue to prioritize healthy habits for a long and vibrant life.</p>
                    </blockquote>
                </li>
            </ul>
        </div>
    </div>

    <?php include 'layouts/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
