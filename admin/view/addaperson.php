<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add a Delivery Person</title>

<style>
/* ==== FONT & RESET ==== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* ==== BODY ==== */
body {
    min-height: 100vh;
    background: #111;          /* dark background */
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
}

/* ==== CONTAINER ==== */
.container {
    width: 100%;
    max-width: 700px;
    background-color: #222;    /* dark card */
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.4);
}

/* ==== TITLE ==== */
.container .title {
    font-size: 28px;
    font-weight: 600;
    text-align: center;
    margin-bottom: 20px;
}

/* ==== FORM ==== */
.content form .user-details {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

form .input-box {
    flex: 1 1 calc(50% - 20px);
    display: flex;
    flex-direction: column;
}

form .input-box span.details {
    margin-bottom: 6px;
    font-weight: 500;
}

.user-details .input-box input,
.user-details .input-box select {
    height: 45px;
    padding-left: 12px;
    border-radius: 5px;
    border: 1px solid #444;
    background: #111;
    color: #fff;
    font-size: 16px;
    transition: all 0.3s ease;
}

.user-details .input-box input:focus,
.user-details .input-box select:focus {
    border-color: orange;
    outline: none;
}

/* ==== BUTTON ==== */
form .button {
    margin-top: 30px;
}

form .button input {
    width: 100%;
    padding: 12px 0;
    border-radius: 5px;
    border: none;
    background: orange;
    color: #111;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

form .button input:hover {
    background: #ffb347;
    transform: scale(0.98);
}

/* ==== ERROR TEXT ==== */
span#error, span[id$='error'] {
    color: #ff6b6b;
    font-size: 0.85rem;
    margin-bottom: 3px;
}

/* ==== RESPONSIVE ==== */
@media(max-width: 600px) {
    form .input-box {
        flex: 1 1 100%;
    }
}
</style>

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

<script>
// Validation functions
function check() {
    var len = document.form.password.value.length;
    document.getElementById("perror").innerHTML = (len > 7 ? "" : "Weak password");
}

function name_validate() {
    var name = document.forms["form"]["name"].value.trim();
    var nameformat = /^[a-zA-Z\s]*$/;
    if (!name) { document.getElementById('nerror').innerHTML = "Name required"; }
    else if (!nameformat.test(name)) { document.getElementById('nerror').innerHTML = "Only letters allowed"; }
    else { document.getElementById('nerror').innerHTML = ""; }
}

function username_validate() {
    var uname = document.forms["form"]["username"].value.trim();
    document.getElementById('uerror').innerHTML = uname ? "" : "Username required";
}

function password_validate() {
    var pass = document.forms["form"]["password"].value;
    var cpass = document.forms["form"]["confirmpassword"].value;
    document.getElementById('cerror').innerHTML = (pass === cpass ? "" : "Passwords do not match");
}

function email_validate() {
    var email = document.forms["form"]["email"].value.trim();
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!email) { document.getElementById('eerror').innerHTML = "Email required"; }
    else if (!mailformat.test(email)) { document.getElementById('eerror').innerHTML = "Invalid email"; }
    else { document.getElementById('eerror').innerHTML = ""; }
}

function phone_validate() {
    var phone = document.forms["form"]["phone"].value.trim();
    var phoneformat = /^98\d{8}$/;
    if (!phone) { document.getElementById('pherror').innerHTML = "Phone required"; }
    else if (!phoneformat.test(phone)) { document.getElementById('pherror').innerHTML = "Must start with 98 and be 10 digits"; }
    else { document.getElementById('pherror').innerHTML = ""; }
}

function address_validate() {
    var address = document.forms["form"]["address"].value.trim();
    document.getElementById('aerror').innerHTML = address ? "" : "Address required";
}
</script>

</head>
<body>

<div class="container">
    <div class="title">Add a Delivery Person</div>
    <div class="content">
        <form action="<?= $base_url ?>?r=addperson" method="POST" name="form">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Full Name</span>
                    <span id='nerror'></span>
                    <input type="text" name="name" placeholder="Person Name" value="<?php echo isset($_POST['name'])? $_POST['name']:''; ?>" oninput="name_validate();">
                </div>
                <div class="input-box">
                    <span class="details">Username</span>
                    <span id='uerror'></span>
                    <input type="text" name="username" placeholder="Username" value="<?php echo isset($_POST['username'])? $_POST['username']:''; ?>" oninput="username_validate();" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <span id='perror'></span>
                    <input type="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password'])? $_POST['password']:''; ?>" oninput="check();" required>
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <span id='cerror'></span>
                    <input type="password" name="confirmpassword" placeholder="Confirm Password" value="<?php echo isset($_POST['confirmpassword'])? $_POST['confirmpassword']:''; ?>" oninput="password_validate();" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <span id='eerror'></span>
                    <input type="text" name="email" placeholder="Email" value="<?php echo isset($_POST['email'])? $_POST['email']:''; ?>" oninput="email_validate();" required>
                </div>
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <span id='pherror'></span>
                    <input type="text" name="phone" maxlength="10" placeholder="Phone Number" value="<?php echo isset($_POST['phone'])? $_POST['phone']:''; ?>" oninput="phone_validate();" required>
                </div>
                <div class="input-box">
                    <span class="details">Address</span>
                    <span id='aerror'></span>
                    <input type="text" name="address" placeholder="Address" value="<?php echo isset($_POST['address'])? $_POST['address']:''; ?>" oninput="address_validate();" required>
                </div>
                <div class="input-box">
                    <span class="details">Gender</span>
                    <select name="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>

            <div class="button">
                <input type="submit" value="Add" onclick="return confirm('Are you sure you want to register?');">
            </div>
        </form>
    </div>
</div>

</body>
</html>
