
<?php
session_start();
$base_url = 'http://localhost/college-project/staff/';
$_SESSION['base_url'] = $base_url;
$_SESSION['active_url'] = '';
include 'helper/specialcharacter.php';
include 'helper/ErrorHelper.php';
include 'helper/RouteHelper.php';


if (isset($_GET['r'])) {
    $controller = $_GET['r'];
    switch ($controller) {
         case 'home':
            $_SESSION['active_url'] = 'home';
            include 'controller/homeController.php';
            break;
         case 'adminrequest':
            $_SESSION['active_url'] = 'adminrequest';
            include 'controller/requestcontroller.php';
            break;
         case 'order':
            $_SESSION['active_url'] = 'order';
            include 'controller/ordercontroller.php';
            break;
         case 'notification':
            $_SESSION['active_url'] = 'notification';
            include 'controller/notificationcontroller.php';
            break;
         case 'accept':
            $_SESSION['active_url'] = 'accept';
            include 'controller/acceptcontroller.php';
            break;
         case 'deliver':
            $_SESSION['active_url'] = 'deliver';
            include 'controller/deliveredcontroller.php';
            break;
         case 'logout':
            $_SESSION['active_url'] = 'logout';
            include 'controller/logoutcontroller.php';
            break;
 
        default :
            throwError(404, 'Requested page does not exists.');
            break;
    }
    return;
} else {
    include 'controller/homecontroller.php';
}
