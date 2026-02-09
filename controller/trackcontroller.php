<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'view/navbar.php';
include 'model/dbmodel.php';

// Make sure user is logged in
if (!isset($_SESSION['user']['login'])) {
    header("Location: index.php?r=login");
    exit;
}

$userid = $_SESSION['user']['userid'];
$request = view_order($userid);  // Now this will work
include 'view/track.php';
?>
