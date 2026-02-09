<?php
include 'view/navbar.php';
include 'model/dbmodel.php';

$users = view_staff();
include 'view/staff.php';
include 'view/footer.php';
?>