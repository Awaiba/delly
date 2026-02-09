<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'view/navbar.php';
include 'model/dbmodel.php'; // Make sure this file defines view_order()

// Make sure user is logged in
if (!isset($_SESSION['user']['login'])) {
    header("Location: index.php?r=login");
    exit;
}

$userid = $_SESSION['user']['userid'];

// Fetch only orders for the logged-in user
$request = view_order($userid);  

include 'view/track.php';
