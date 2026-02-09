<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Delly.com</title>

<link rel="stylesheet" href="css/sweetalert.css">
<link rel="icon" href="img/logo.png" type="image/png">

<style>
/* ===== RESET ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ===== BODY ===== */
body {
    min-height: 100vh;
    font-family: system-ui, sans-serif;
    color: #fff;

    background:
        linear-gradient(rgba(0,0,0,.75), rgba(0,0,0,.75)),
        url('img/11.jpg') center / cover no-repeat;
}

/* ===== NAVBAR ===== */
.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    padding: 1rem 2rem;

    display: flex;
    align-items: center;

    background: rgba(0,0,0,.7);
    backdrop-filter: blur(6px);
    z-index: 10;
}

.brand {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.logo {
    font-size: 4rem;
    font-weight: 700;
    color: #fff;
}

.icon {
    height: 55px;
}

/* ===== CENTER LAYOUT ===== */
.main {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ===== LOGIN BOX ===== */
.box {
    width: 420px;
    padding: 2.5rem;

    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(12px);

    border-radius: 20px;
    box-shadow: 0 30px 70px rgba(0,0,0,.9);
}

/* ===== AVATAR ===== */
.avatar {
    width: 110px;
    display: block;
    margin: 0 auto 1rem;
}

/* ===== HEADINGS ===== */
.box h1 {
    text-align: center;
    margin-bottom: 1.5rem;
}

/* ===== SELECT ===== */
.id {
    width: 100%;
    height: 42px;
    margin-bottom: 1.3rem;

    background: rgba(0,0,0,.6);
    border: none;
    border-radius: 25px;

    color: #fff;
    text-align: center;
}

/* ===== INPUTS ===== */
.box p {
    font-size: .9rem;
    margin-bottom: .3rem;
}

.box input[type="text"],
.box input[type="password"] {
    width: 100%;
    height: 40px;
    margin-bottom: 1.3rem;

    background: transparent;
    border: none;
    border-bottom: 1px solid #ccc;

    color: #fff;
    outline: none;
}

/* ===== SUBMIT ===== */
.box input[type="submit"] {
    width: 100%;
    height: 45px;
    margin-top: 1rem;

    background: #fff;
    color: #000;

    border: none;
    border-radius: 25px;
    font-size: 1rem;
    cursor: pointer;
    transition: .3s;
}

.box input[type="submit"]:hover {
    background: #000;
    color: #fff;
}

/* ===== LINKS ===== */
.box a {
    display: block;
    text-align: center;
    margin-top: 1rem;
    color: #ddd;
    text-decoration: none;
    font-size: .9rem;
}

.box h3 {
    margin-top: 1rem;
    padding: .6rem;
    border-radius: 25px;
    background: #fff;
    color: #000;
    font-size: .95rem;
}

.box h3:hover {
    background: #000;
    color: #fff;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 500px) {
    .box {
        width: 90%;
    }

    .logo {
        font-size: 2.5rem;
    }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="brand">
        <p class="logo">Delly</p>
        <img src="img/logoo.png" class="icon">
    </div>
</div>

<!-- CENTERED LOGIN -->
<div class="main">
    <div class="box">
        <img src="img/logoo.png" class="avatar">
        <h1>Login</h1>

        <form action="<?= $base_url ?>?r=login" method="post">

            <select name="usertype" class="id">
                <option value="user">User</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>

            <p>Username</p>
            <input type="text" name="username" placeholder="Enter Username" required>

            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password" required>

            <input type="submit" value="Sign In">
        </form>

        <a href="<?= $base_url ?>?r=lost">Lost your password?</a>
        <a href="<?= $base_url ?>?r=newreg"><h3>New Registration</h3></a>
    </div>
</div>

<script src="javascript/sweetalert.js"></script>

<?php
if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
?>
<script>
swal({
    title: "<?php echo $_SESSION['message']; ?>",
    icon: "<?php echo $_SESSION['status']; ?>",
    button: "OK",
});
</script>
<?php
unset($_SESSION['message']);
}
?>

<script src="javascript/mobile-nav.js"></script>

</body>
</html>
