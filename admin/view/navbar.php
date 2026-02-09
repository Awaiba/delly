<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin</title>
<link rel="stylesheet" href="resources/styleadmin.css">

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
    ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['message'];?>",
            icon: "<?php echo $_SESSION['status'];?>",
            button: "OK",
        });
    </script>
    <?php
    unset($_SESSION['message']);
}
?>
<style>
/* ==== VARIABLES ==== */
:root {
    --main-color: #0b1220;
    --bg-color: #ffffff;
    --text-color: #e6eef9;
    --muted-color: #777777;
    --accent-color: #0f1724;
}

/* ==== RESET ==== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
    list-style: none;
    text-decoration: none;
}

/* ==== BODY ==== */
body {
    background: #f6f7fb;
    color: var(--text-color);
    min-height: 100vh;
    padding-top: 80px;
}

/* ==== NAVBAR ==== */
.navbar {
    width: 100%;
    height: 72px;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(90deg, #0f1724, #0b1220);
    padding: 0 2rem;
    z-index: 1000;
    box-shadow: 0 4px 18px rgba(2,6,23,0.35);
}

/* LOGO */
.navbar-koseli h1 {
    font-size: 22px;
    color: #fff;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* MENU */
.navbar-menu {
    color: white;
    display: flex;
    flex: 1;
    justify-content: flex-end; /* push menu right */

}

.navbar-menu ul {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.navbar-menu li {
    list-style: none;
}

.navbar-menu a {
    color: var(--text-color);
    font-size: 0.95rem;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    border: 1px solid rgba(255,255,255,0.03);
    transition: background-color 0.2s, transform 0.12s;
}

.navbar-menu a:hover {
    background-color: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    transform: translateY(-1px);
}

.navbar-menu a span {
    font-size: 1.4rem;
    color: var(--bg-color);
    transition: color 0.3s;
}

.navbar-menu a:hover span {
    color: var(--accent-color);
}

/* MOBILE NAV TOGGLE */
#mobile-nav-toggle {
    display: none;
    background: transparent;
    border: none;
    font-size: 1.5rem;
    color: #fff;
    cursor: pointer;
}

/* RESPONSIVE */
@media(max-width: 900px) {
    .navbar { padding: 0 1rem; }
    .navbar-menu ul { gap: 0.6rem; }
}

@media(max-width: 600px) {
    .navbar {
        flex-direction: row;
        height: auto;
        padding: 0.75rem 1rem;
        align-items: center;
    }

    .navbar-menu {
        flex: 1;
        justify-content: flex-end;
        margin-top: 0;
    }

    .navbar-menu ul {
        flex-direction: row;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    #mobile-nav-toggle {
        display: block;
    }
}
</style>
</head>
<body>

<?php
// Check admin session
if (empty($_SESSION['admin']['login'])) {
    $lin = $_SESSION['base_url'] . "?r=login";
    header('Location:' . $lin);
    exit;
}
?>

<div class="navbar">
    <div class="navbar-koseli">
        <h1><ion-icon name="bicycle"></ion-icon> Delly</h1>
        <button id="mobile-nav-toggle" aria-label="Toggle menu">☰</button>
    </div>

    <div class="navbar-menu">
        <ul>
            <li><a href="<?= $base_url ?>?r=home"><span><ion-icon name="home-sharp"></ion-icon></span>Home</a></li>
            <li><a href="<?= $base_url ?>?r=request"><span><ion-icon name="git-pull-request-sharp"></ion-icon></span>User Request</a></li>
            <li><a href="<?= $base_url ?>?r=addperson"><span><ion-icon name="person-add-sharp"></ion-icon></span>Add Delivery Person</a></li>
            <li><a href="<?= $base_url ?>?r=staff"><span><ion-icon name="people-sharp"></ion-icon></span>Staff</a></li>
            <li><a href="<?= $base_url ?>?r=user"><span><ion-icon name="people-sharp"></ion-icon></span>Users</a></li>
            <li><a href="<?= $base_url ?>?r=completeorder"><span><ion-icon name="document-text-sharp"></ion-icon></span>All Orders</a></li>
            <li><a href="<?= $base_url ?>?r=logout"><span><ion-icon name="log-out-sharp"></ion-icon></span>Logout</a></li>
        </ul>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="../../javascript/mobile-nav.js"></script>

</body>
</html>
