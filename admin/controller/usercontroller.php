<?php
include 'view/navbar.php';
 
include 'model/dbmodel.php';

$users = view_users();
include 'view/user.php';
include 'view/footer.php';
?>