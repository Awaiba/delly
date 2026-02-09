
<?php
session_start();
$base_url = 'http://localhost/college-project/admin/';
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
        case 'addperson':
            $_SESSION['active_url'] = 'addperson';
            include 'controller/addcontroller.php';
            break;
         case 'staff':
            $_SESSION['active_url'] = 'staff';
            include 'controller/staffcontroller.php';
            break;
         case 'user':
            $_SESSION['active_url'] = 'user';
            include 'controller/usercontroller.php';
            break;
         case 'request':
            $_SESSION['active_url'] = 'request';
            include 'controller/requestcontroller.php';
            break;
         case 'notification':
            $_SESSION['active_url'] = 'notification';
            include 'controller/notificationcontroller.php';
            break;                
          case 'logout':
            $_SESSION['active_url'] = 'logout';
            include 'controller/logoutcontroller.php';
            break;
         case 'editstaff':
            $_SESSION['active_url'] = 'editstaff';
            include 'controller/editstaffcontroller.php';
            break;
        case 'edituser':
            $_SESSION['active_url'] = 'edituser';
            include 'controller/editusercontroller.php';
            break;
         case 'deleteuser':
            $_SESSION['active_url'] = 'deleteuser';
            include 'controller/deleteusercontroller.php';
            break;
        case 'deletestaff':
            $_SESSION['active_url'] = 'deletestaff';
            include 'controller/deletestaffcontroller.php';
            break;
        case 'accept':
            $_SESSION['active_url'] = 'accept';
            include 'controller/acceptcontroller.php';
            break;
        case 'reject':
            $_SESSION['active_url'] = 'reject';
            include 'controller/rejectcontroller.php';
            break;
        case 'sender':
            $_SESSION['active_url'] = 'sender';
            include 'controller/sendercontroller.php';
            break;
        case 'completeorder':
            $_SESSION['active_url'] = 'completeorder';
            include 'controller/completecontroller.php';
            break;
        case 'approvestaff':
            $_SESSION['active_url'] = 'approvestaff';
            include 'controller/approvestaffcontroller.php';
            break;
        case 'price':
            $_SESSION['active_url'] = 'price';
            include 'controller/pricecontroller.php';
            break;
        default :
            throwError(404, 'Requested page does not exists.');
            break;
    }
    return;
} else {
    include 'controller/homecontroller.php';
}
