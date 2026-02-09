<?php
include 'model/dbmodel.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$base_url = "index.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $ordername = trim($_POST['ordername']);
        $rname     = trim($_POST['rname']);
        $remail    = trim($_POST['remail']);
        $rphone    = trim($_POST['rphone']);
        $raddress  = trim($_POST['raddress']);
        $weight    = (int) $_POST['weight'];
        $date      = trim($_POST['date']);
        $user      = $_SESSION['user']['userid'];

        if (!$ordername || !$rname || !$remail || !$rphone || !$raddress || !$weight || !$date) {
            $_SESSION['message'] = "All fields are required!";
            $_SESSION['status']  = "error";
            header("Location: {$base_url}?r=sendcourier");
            exit;
        }

        if (empty($_FILES['simg']['name'])) {
            $_SESSION['message'] = "Please upload an image.";
            $_SESSION['status']  = "error";
            header("Location: {$base_url}?r=sendcourier");
            exit;
        }

        $target_dir = "images/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);

        $filename = uniqid() . '_' . basename($_FILES['simg']['name']);
        $target_file = $target_dir . $filename;
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, ['jpg','jpeg','png'])) {
            $_SESSION['message'] = "Invalid image type. Only JPG, JPEG, PNG allowed.";
            $_SESSION['status']  = "error";
            header("Location: {$base_url}?r=sendcourier");
            exit;
        }

        if (!move_uploaded_file($_FILES['simg']['tmp_name'], $target_file)) {
            $_SESSION['message'] = "Failed to upload image.";
            $_SESSION['status']  = "error";
            header("Location: {$base_url}?r=sendcourier");
            exit;
        }

        // Insert into database
        $courier = send_courier($user, $ordername, $rname, $remail, $rphone, $raddress, $weight, $date, $target_file);

        if ($courier) {
            $_SESSION['message'] = "Your courier has been sent to Admin for approval.";
            $_SESSION['status']  = "success";
        } else {
            $_SESSION['message'] = "Unable to send courier. Database error.";
            $_SESSION['status']  = "error";
        }

        header("Location: {$base_url}?r=sendcourier");
        exit;

    } catch (Exception $ex) {
        error_log($ex->getMessage());
        $_SESSION['message'] = "An unexpected error occurred.";
        $_SESSION['status'] = "error";
        header("Location: {$base_url}?r=sendcourier");
        exit;
    }
}

// --- SHOW FORM (INCLUDE HTML) ---
include 'view/navbar.php';
include 'view/sendcourier.php';
exit;
?>
