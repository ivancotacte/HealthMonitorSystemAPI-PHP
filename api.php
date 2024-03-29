<?php 
$heartRate = 0;
$weight = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    switch ($_POST['action']) {
        case 'insertHeartRate':
            insertHeartRate();
            break;
        case 'insertWeight':
            insertWeight();
            break;
        case 'showHeartRate':
            showHeartRate();
            break;
        case 'showWeight':
            showWeight();
            break;  
        default:
            break;
    }
}

function insertWeight() {
    include 'php/connect.php';
    
    global $weight;
    
    $weight = $_POST['weight'];
    $time = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO `tbl_weight`(`weight`, `created_at`) VALUES (:weight, :dt)");       
    $stmt->bindParam(":weight", $weight);
    $stmt->bindParam(":dt", $time);
    $stmt->execute();

    echo "success";
}   

function insertHeartRate() {
    include 'php/connect.php';
    
    global $heartRate;
    
    $heartRate = $_POST['heartRate'];
    $time = date("Y-m-d H:i:s");
    $stmt = $conn->prepare("INSERT INTO `tbl_logdata`(`heartRate`, `created_at`) VALUES (:heartRate, :dt)");       
    $stmt->bindParam(":heartRate", $heartRate);
    $stmt->bindParam(":dt", $time);
    $stmt->execute();

    echo "success";
}

function showHeartRate() {
    include 'php/connect.php';

    global $heartRate;

    $logs = $conn->query("SELECT * FROM `tbl_logdata` ORDER BY `tbl_logdata`.`id` DESC");
    
    if ($logs->rowCount() > 0) {
        $latest_data = $logs->fetch(PDO::FETCH_ASSOC);
        $heartRate = $latest_data['heartRate'];
    } else {
        echo "failed";
    }
    
    echo $heartRate;
}

function showWeight() {
    include 'php/connect.php';

    global $weight;

    $logs = $conn->query("SELECT * FROM `tbl_logdata` ORDER BY `tbl_logdata`.`id` DESC");
    
    if ($logs->rowCount() > 0) {
        $latest_data = $logs->fetch(PDO::FETCH_ASSOC);
        $weight = $latest_data['weight'];
    } else {
        echo "failed";
    }

    echo $weight;
}
?>
