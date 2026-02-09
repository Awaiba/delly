<?php
// Include helpers and DB
include 'helper/specialcharacter.php';
include 'helper/RouteHelper.php';
include 'model/dbmodel.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If form is not submitted, show home page
if (empty($_POST)) {
    include 'view/home.php';
    return;
}

try {
    // Validate input
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['message'] = "Username and Password are required";
        $_SESSION['status']  = "error";
        include 'view/home.php';
        return;
    }

    $username = filterText($_POST['username']);
    $password = filterText($_POST['password']);
    $usertype = $_POST['usertype'];

    switch ($usertype){
        case 'user':
            $user = user_login($username, $password);  
            if ($user) {
                $_SESSION['user']['login'] = TRUE;
                $_SESSION['user']['userid'] = $user['id'];
                $_SESSION['user']['username'] = $user['username'];
                $_SESSION['user']['sname'] = $user['name'];
                $_SESSION['user']['semail'] = $user['email'];
                $_SESSION['user']['sphone'] = $user['phone'];
                $_SESSION['user']['saddress'] = $user['address'];
                redirect('site');
            } else {
                $_SESSION['message'] = "Username and Password is incorrect";
                $_SESSION['status']  = "error";
                include 'view/home.php';
            }
            break;

        case 'staff':
            $staff = staff_login($username, $password);
            if ($staff) {
                $_SESSION['staff'] = [
                    'login'    => true,
                    'user_id'  => $staff['id'],
                    'user_name'=> $staff['username']
                ];
                header("Location: staff/");
                exit;
            }
            break;

        case 'admin':
            $admin = admin_login($username, $password);
            if ($admin) {
                $_SESSION['admin'] = [
                    'login'    => true,
                    'user_id'  => $admin['id'],
                    'user_name'=> $admin['username']
                ];
                header("Location: admin/");
                exit;
            }
            break;
    }

    // If login fails
    $_SESSION['message'] = "Username and Password is incorrect";
    $_SESSION['status']  = "error";
    include 'view/home.php';

} catch (Exception $ex) {
    include 'controller/ErrorController.php';
}
?>
