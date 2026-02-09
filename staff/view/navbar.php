<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff</title>
    <link rel="stylesheet" href="css/stylestaff.css">
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
:root {
    --main-color: #000000; /* black */
    --bg: #ffffff;         /* white */
    --text: #ffffff;       /* primary text (black on white) */
    --muted: #777777;      /* subdued gray */
    --accent: #000000;     /* accent color (black) */
}

* {
    margin: 0;
    box-sizing: border-box;
    list-style-type: none;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
}

body {
    margin-top: 80px;
    padding: 0;
}

/* --- TOP NAVBAR --- */
.navbar {
    width: 100%;
    height: 80px;          /* adjust height */
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: var(--main-color);
    padding: 0 2rem;
    z-index: 100;
}

/* LOGO */
.navbar-delly {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.navbar-delly h1 {
    font-size: 28px;
    color: var(--bg);
    margin: 0;
    padding: 0;
    line-height: 1;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* MENU */
.navbar-menu {
    display: flex;
    gap: 2rem; /* space between menu items */
    align-items: center;
}

.navbar-menu ul {
    display: flex;
    gap: 2.5rem;
    align-items: end;
}

.navbar-menu li {
    list-style: none;
    position: relative;
    display: flex;
    align-items: center;
}

.navbar-menu ul li a {
    color: var(--bg);
    font-size: 1rem;
    text-decoration: none;
    padding: 0.75rem 1rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
    transition: background-color 0.3s ease, color 0.3s ease;
    border: 1px solid transparent;
}

.navbar-menu ul li a:hover {
    background-color: var(--bg);
    color: var(--main-color);
}

/* ICONS */
.navbar-menu a span {
    font-size: 1.4rem;
    color: var(--bg);
    transition: color 0.3s ease;
}

.navbar-menu a:hover span {
    color: var(--main-color);
}

/* optional: make navbar responsive */
@media(max-width: 768px) {
    .navbar {
        flex-direction: column;
        height: auto;
        padding: 1rem;
    }
    .navbar-menu {
        flex-direction: column;
        gap: 1rem;
        margin-top: 1rem;
    }
}


.footer {
    position: fixed;
    color: var(--muted);
    padding-left: 3.2rem;
    bottom: 10px;
    text-align: center;
}
    </style>
</head>

<body>


<!--check session -->
<?php
            if (empty($_SESSION['staff']['login'])) 
            {
                $lin = $_SESSION['base_url'] . "?r=login";
                           header('location:' . $lin);
                          
                        } else {
                          
                        }
                        ?>
    <div class="navbar">
        <div class="navbar-delly">
            <div style="display:flex;align-items:center;gap:.5rem;justify-content:space-between;width:100%">
                <h1 style="margin:0">Delly
                    <ion-icon name="bicycle"></ion-icon>
                </h1>
                <button id="mobile-nav-toggle" aria-label="Toggle menu" style="background:transparent;border:none;font-size:1.25rem;cursor:pointer;display:none">☰</button>
            </div>
            <div class="navbar-menu">
                <ul>
                    <li>
                        <a href="<?= $base_url ?>?r=home"><span class="icon">
                                <ion-icon name="home-sharp"></ion-icon>
                            </span>
                            <span>Home</span></a>
                    </li>
                    <li>
                        <a href="<?= $base_url ?>?r=adminrequest"><span class="icon">
                            <ion-icon name="shield-checkmark"></ion-icon>
                            </span>
                            <span>Admin Request</span></a>
                    </li>
              
                    <li>
                        <a href="<?= $base_url ?>?r=order"><span class="icon">
                        <ion-icon name="receipt"></ion-icon>
                            </span>
                            <span>My Orders</span></a>
                    </li>
                  <!--  <li>
                        <a href="<?= $base_url ?>?r=notification"><span class="icon">
                                <ion-icon name="notifications-circle-sharp"></ion-icon>
                            </span>
                            <span>Notification</span></a>
                    </li>-->
                    <li>
                        <a href="<?= $base_url ?>?r=logout"><span class="icon">
                                <ion-icon name="log-out-sharp"></ion-icon>
                            </span>
                            <span>logout</span></a>
                    </li>
                </ul>
            </div>

        </div>
    </div>








    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../../javascript/mobile-nav.js"></script>
</body>

</html>