<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>About Us | Health Monitoring System</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .card-img-top {
            width: 85%;
            margin-left: auto;
            margin-right: auto;
            padding: 20px 10px 10px 10px;
            display: block;
        }
        h6 {
            color: #333;
            font-size: 14px;
            font-weight: bold;
        }
        .box-area {
            max-width: 900px;
            margin-top: 5px;
        }
        @media screen and (max-width: 768px){
            .card-img-top {
                width: 55%;
                margin-left: auto;
                margin-right: auto;
                display: block;
            }
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="features.php">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center min-vh-150">
        <div class="row border rounded-4 p-4 bg-white shadow box-area">
            <h2 class="text-center mb-4">About Us</h2>
            <p class="mb-4">Welcome to the Smart Portable Heart Rate Sensor System project. Our goal is to provide a reliable solution for real-time heart rate and pulse oximetry monitoring. Utilizing the advanced MAX30102 sensor module, we ensure accurate and dependable health data collection for users on the go.</p>
            <h4 class="text-center mb-4">Members</h4>
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex flex-wrap justify-content-center">
                            <div class="card mx-2 mb-3" style="width: 12rem; border-radius: 15px; border: 2px solid #000000;">
                                <img src="images/Mhigie D. Molon.png" class="card-img-top rounded-circle" alt="Mhigie D. Molon">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Molon, Mhigie D.</h6>
                                </div>
                            </div>
                            <div class="card mx-2 mb-3" style="width: 12rem; border-radius: 15px; border: 2px solid #000000;">
                                <img src="images/Symon Cedrick R. Zoleta.png" class="card-img-top rounded-circle" alt="Symon Cedrick R. Zoleta">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Zoleta, Symon Cedrick R.</h6>
                                </div>
                            </div>
                            <div class="card mx-2 mb-3" style="width: 12rem; border-radius: 15px; border: 2px solid #000000;">
                                <img src="images/Bryan Miguel G. Gomez.png" class="card-img-top rounded-circle" alt="Bryan Miguel G. Gomez">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Gomez, Bryan Miguel G.</h6>
                                </div>
                            </div>
                            <div class="card mx-2 mb-3" style="width: 12rem; border-radius: 15px; border: 2px solid #000000;">
                                <img src="images/Johann Sebastian Kyle M. Manapsal.png" class="card-img-top rounded-circle" alt="Johann Sebastian Kyle M. Manapsal">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Manapsal, Johann Sebastian Kyle M.</h6>
                                </div>
                            </div>
                            <div class="card mx-2 mb-3" style="width: 12rem; border-radius: 15px; border: 2px solid #000000;">
                                <img src="images/Sherwin Kenjie Tom H. Cruz.png" class="card-img-top rounded-circle" alt="Sherwin Kenjie Tom H. Cruz">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Cruz, Sherwin Kenjie Tom H.</h6>
                                </div>
                            </div>
                            <div class="card mx-2 mb-3" style="width: 12rem; border-radius: 15px; border: 2px solid #000000;">
                                <img src="images/John Vincent E. Habig.png" class="card-img-top rounded-circle" alt="John Vincent E. Habig">
                                <div class="card-body text-center">
                                    <h6 class="card-title">Habig, John Vincent E.</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <?php include 'layouts/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
