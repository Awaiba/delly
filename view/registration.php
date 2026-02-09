<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>New User Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
/* ===== BODY ===== */
body {
    min-height: 100vh;
    font-family: system-ui, sans-serif;
    color: #fff;
    background:
        linear-gradient(rgba(0,0,0,.75), rgba(0,0,0,.75)),
        url('img/11.jpg') center / cover no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ===== CONTAINER ===== */
.container {
    width: 420px;
    padding: 2.5rem;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    box-shadow: 0 30px 70px rgba(0,0,0,.9);
}

/* ===== AVATAR / LOGO ===== */
.avatar {
    width: 110px;
    display: block;
    margin: 0 auto 1rem;
}

/* ===== HEADINGS ===== */
.container .title {
    text-align: center;
    font-size: 25px;
    font-weight: 500;
    margin-bottom: 1.5rem;
}

/* ===== INPUTS ===== */
.container input[type="text"],
.container input[type="password"],
.container select {
    width: 100%;
    height: 40px;
    margin-bottom: 1.3rem;
    background: transparent;
    border: none;
    border-bottom: 1px solid #ccc;
    color: #fff;
    outline: none;
    padding-left: 10px;
    border-radius: 5px;
}

/* ===== BUTTON ===== */
.container input[type="submit"] {
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

.container input[type="submit"]:hover {
    background: #000;
    color: #fff;
}

/* ===== LABELS ===== */
.container p {
    font-size: .9rem;
    margin-bottom: .3rem;
}

/* ===== SELECT ===== */
.container select {
    height: 42px;
    background: rgba(0,0,0,.6);
    border-radius: 25px;
    text-align: center;
}

/* ===== ERROR MESSAGES ===== */
span.error {
    color: red;
    font-size: 0.8rem;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 500px) {
    .container {
        width: 90%;
    }
}
</style>
</head>

<body>

<div class="container">
    <img src="img/logoo.png" class="avatar">
    <div class="title">Registration</div>

    <form action="<?= $base_url ?>?r=newreg" method="post" name="form" onsubmit="return validation();">
        
        <p>Full Name</p>
        <input type="text" name="name" placeholder="Enter your name" value="<?php echo isset($_POST['name'])? $_POST['name']:''; ?>" oninput="name_validate();">
        <span id="nerror" class="error"></span>

        <p>Username</p>
        <input type="text" name="username" placeholder="Enter your username" value="<?php echo isset($_POST['username'])? $_POST['username']:''; ?>" oninput="username_validate();">
        <span id="uerror" class="error"></span>

        <p>Password</p>
        <input type="password" name="password" placeholder="Enter your password" value="<?php echo isset($_POST['password'])? $_POST['password']:''; ?>" oninput="check();">
        <span id="perror" class="error"></span>

        <p>Confirm Password</p>
        <input type="password" name="confirmpassword" placeholder="Confirm your password" value="<?php echo isset($_POST['confirmpassword'])? $_POST['confirmpassword']:''; ?>" oninput="password_validate();">
        <span id="cerror" class="error"></span>

        <p>Email</p>
        <input type="text" name="email" placeholder="Enter your email" value="<?php echo isset($_POST['email'])? $_POST['email']:''; ?>" oninput="email_validate();">
        <span id="eerror" class="error"></span>

        <p>Phone Number</p>
        <input type="text" name="phone" maxlength="10" placeholder="Enter your number" value="<?php echo isset($_POST['phone'])? $_POST['phone']:''; ?>" oninput="phone_validate();">
        <span id="pherror" class="error"></span>

        <p>Address</p>
        <input type="text" name="address" placeholder="Enter your address" value="<?php echo isset($_POST['address'])? $_POST['address']:''; ?>" oninput="address_validate();">
        <span id="adderror" class="error"></span>

        <p>Gender</p>
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>

        <input type="submit" name="submit" value="Register" onclick="return confirm('Are you sure you want to Register?');">
    </form>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
if(isset($_SESSION['message']) && $_SESSION['message'] !='') {
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
</body>
</html>
