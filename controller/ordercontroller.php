<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once 'model/dbmodel.php';
$conn = db_connect();

// Make sure user is logged in
if (!isset($_SESSION['user']['login'])) {
    header("Location: index.php?r=login");
    exit;
}

// Get logged-in user ID
$userid = $_SESSION['user']['userid'];

// Get POST data from form
$ordername = $_POST['ordername'] ?? '';
$rname     = $_POST['rname'] ?? '';
$remail    = $_POST['remail'] ?? '';
$rphone    = $_POST['rphone'] ?? '';
$raddress  = $_POST['raddress'] ?? '';
$weight    = intval($_POST['weight'] ?? 0);
$date      = date('Y-m-d H:i:s');
$image     = ''; // optional, handle file upload if needed

// Prepare insert statement
$stmt = $conn->prepare("
    INSERT INTO courier 
        (uid, ordername, rname, remail, rphone, raddress, weight, date, image, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)
");
$stmt->bind_param("isssssiss", $userid, $ordername, $rname, $remail, $rphone, $raddress, $weight, $date, $image);

if($stmt->execute()){
    $_SESSION['message'] = "Order submitted successfully!";
    $_SESSION['status'] = "success";
} else {
    $_SESSION['message'] = "Failed to submit order!";
    $_SESSION['status'] = "error";
}

header("Location: index.php?r=track");
exit;
?>
