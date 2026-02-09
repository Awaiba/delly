<?php
// Redirect to login if user is not logged in
if (empty($_SESSION['user']['login'])) {
    $lin = $_SESSION['base_url'] . "?r=login";
    header('Location: ' . $lin);
    exit();
}

// Base URL for links
$base_url = $_SESSION['base_url'] ?? '/';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
        :root {
            --main-color: #000000;
            --bg: #ffffff;
            --text: #ffffff;
            --muted: #777777;
            --accent: #000000;
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

        .navbar {
            width: 100%;
            height: 80px;
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

        .navbar-menu {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .navbar-menu ul {
            display: flex;
            gap: 2.5rem;
            align-items: center;
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

        .navbar-menu a span {
            font-size: 1.4rem;
            color: var(--bg);
            transition: color 0.3s ease;
        }

        .navbar-menu a:hover span {
            color: var(--main-color);
        }

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
    <div class="navbar">
        <div class="navbar-delly">
            <h1><ion-icon name="bicycle"></ion-icon>Delly</h1>
            <button id="mobile-nav-toggle" aria-label="Toggle menu"
                style="background:transparent;border:none;font-size:1.25rem;cursor:pointer;display:none;color:#fff">☰</button>
        </div>
        <div class="navbar-menu">
            <ul>
                <li><a href="<?= $base_url ?>?r=site"><span class="icon"><ion-icon name="home-sharp"></ion-icon></span><span>Home</span></a></li>
                <li><a href="<?= $base_url ?>?r=price"><span class="icon"><ion-icon name="cash"></ion-icon></span><span>Prices</span></a></li>
                <li><a href="<?= $base_url ?>?r=sendcourier"><span class="icon"><ion-icon name="send"></ion-icon></span><span>Send Courier</span></a></li>
                <li><a href="<?= $base_url ?>?r=track"><span class="icon"><ion-icon name="location"></ion-icon></span><span>Track</span></a></li>
                <li><a href="<?= $base_url ?>?r=logout"><span class="icon"><ion-icon name="log-out-sharp"></ion-icon></span><span>Logout</span></a></li>
            </ul>
        </div>
    </div>

    <div class="footer">
        <p>Copyright@waibanish<br>
            <a href="delly@gmail.com">Delly@gmail.com</a>
        </p>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="javascript/sweetalert.js"></script>
    <?php if (isset($_SESSION['message']) && $_SESSION['message'] != '') : ?>
        <script>
            swal({
                title: "<?= $_SESSION['message'] ?>",
                icon: "<?= $_SESSION['status'] ?>",
                button: "OK",
            });
        </script>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
</body>

</html>
