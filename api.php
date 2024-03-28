<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    switch ($_POST['action']) {
        case 'insertHeartRate':
            insertHeartRate();
            break;
        case 'insertWeight':
            insertWeight();
            break;
        case 'showProcess':
            showProcess();
            break;
        default:
            break;
    }
}

function insertHeartRate() {
    include 'php/connect.php';
    
    $heartRate = $_POST['heartRate'];
    $time = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO `tbl_logdata`(`heartRate`, `created_at`) VALUES (:heartRate, :dt)");       
    $stmt->bindParam(":heartRate", $heartRate);
    $stmt->bindParam(":dt", $time);
    $stmt->execute();

    echo "success";
}

function showProcess() {
    include 'php/connect.php';

    $logs = $conn->query("SELECT * FROM `tbl_logdata` ORDER BY `tbl_logdata`.`id` DESC");
    
    if ($logs->rowCount() > 0) {
        $latest_data = $logs->fetch(PDO::FETCH_ASSOC);
        echo $latest_data['heartRate'];
    } else {
        echo "failed";
    }
}


?>