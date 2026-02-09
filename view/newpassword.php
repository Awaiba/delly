<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Change Password</title>
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

/* ===== BOX ===== */
.box {
    width: 420px;
    padding: 2.5rem;
    background: rgba(0,0,0,0.55);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    box-shadow: 0 30px 70px rgba(0,0,0,.9);
    text-align: center;
}

/* ===== HEADINGS ===== */
.box h1 {
    margin-bottom: 2rem;
}

/* ===== INPUTS ===== */
.box input[type="text"],
.box input[type="email"] {
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

/* ===== LABELS ===== */
.box p {
    font-size: .9rem;
    margin-bottom: .3rem;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 500px) {
    .box {
        width: 90%;
    }
}
</style>
</head>

<body>

<div class="box">
    <h1>Enter the New Password</h1>
    <form action="<?php echo $base_url?>?r=newpass" method="post">
        <?php
        if($password){
            while ($row = $password->fetch_assoc()) {
        ?>
            <p>Name</p>
            <input type="text" name="name" value="<?php echo $row['name'] ?>" readonly>

            <p>Email</p>
            <input type="email" name="email" value="<?php echo $row['email'] ?>" readonly>

            <p>New Password</p>
            <input type="text" name="newpassword" placeholder="New Password" required>

            <p>Confirm Password</p>
            <input type="text" name="newcpassword" placeholder="Confirm Password" required>

            <input type="submit" value="Change">
        <?php 
            }}
        ?>
    </form>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
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
