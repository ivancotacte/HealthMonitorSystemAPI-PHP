
<?php 
$heartRate = 0;
$SP02 = 0;
$weight = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    switch ($_POST['action']) {
        case 'insertWeight':
            insertWeight();
            break;
        case 'showWeight':
            showWeight();
            break; 
        case 'insertHeartRateSP01':
            insertHeartRateSP01();
            break;
        case 'showHeartRate':
            showHeartRate();
            break;
        case 'showSPO2':
            showSPO2();
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

function showWeight() {
    include 'php/connect.php';

    global $weight;

    $logs = $conn->query("SELECT * FROM `tbl_weight` ORDER BY `tbl_weight`.`id` DESC");
    
    if ($logs->rowCount() > 0) {
        $latest_data = $logs->fetch(PDO::FETCH_ASSOC);
        $weight = $latest_data['weight'];
    } else {
        echo "failed";
    }

    echo $weight;
}



function insertHeartRateSP01() {
    include 'php/connect.php'; 
    
    global $heartRate;
    global $SPO2;
    
    $heartRate = $_POST['heartRate'];
    $SPO2 = $_POST['SpO2'];
    $time = date("Y-m-d H:i:s");
    
    $stmt = $conn->prepare("INSERT INTO `tbl_logdata`(`heartRate`, `SpO2`, `created_at`) VALUES (:heartRate, :SPO2, :dt)");
    $stmt->bindParam(":heartRate", $heartRate);
    $stmt->bindParam(":SPO2", $SPO2);
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

function showSPO2() {
    include 'php/connect.php';

    global $SP02;

    $logs = $conn->query("SELECT * FROM `tbl_logdata` ORDER BY `tbl_logdata`.`id` DESC");

    if ($logs->rowCount() > 0) {
        $latest_data = $logs->fetch(PDO::FETCH_ASSOC);
        $SP02 = $latest_data['SpO2'];
    } else {
        echo "failed";
    }

    echo $SP02;
}
?>
