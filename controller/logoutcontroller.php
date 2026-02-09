<?php
unset($_SESSION['user']['login']);
unset($_SESSION['user']['userid']);
unset($_SESSION['user']['username']);
unset($_SESSION['user']['sname']);
unset($_SESSION['user']['semail']);
unset($_SESSION['user']['sphone']);
unset($_SESSION['user']['saddress']);

redirect('login');
?>