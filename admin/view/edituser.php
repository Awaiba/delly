<?php if($edit){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User Details</title>

<style>
/* ===== FONT & RESET ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* ===== BODY ===== */
body {
    min-height: 100vh;
    background-color: #111;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem;
}

/* ===== CONTAINER ===== */
.container {
    background-color: #222;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(255,255,255,0.05);
    width: 100%;
    max-width: 700px;
}

/* ===== TITLE ===== */
.container .title {
    text-align: center;
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 25px;
    color: #ffa500;
}

/* ===== FORM ===== */
form {
    width: 100%;
}

.user-details {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.input-box {
    flex: 1 1 calc(50% - 20px);
    display: flex;
    flex-direction: column;
}

.input-box span.details {
    font-weight: 500;
    margin-bottom: 6px;
    color: #ccc;
}

.input-box input,
.input-box select {
    height: 45px;
    padding: 0 15px;
    border: 1px solid #555;
    border-radius: 6px;
    font-size: 16px;
    background-color: #111;
    color: #fff;
    transition: all 0.3s ease;
}

.input-box input:focus,
.input-box select:focus {
    border-color: #ffa500;
    box-shadow: 0 0 5px rgba(255,165,0,0.4);
    outline: none;
}

/* ===== BUTTONS ===== */
.button {
    margin-top: 25px;
    text-align: center;
}

.button input[type="submit"],
.input-box input[type="reset"] {
    padding: 12px 25px;
    border-radius: 6px;
    border: none;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    margin: 0 5px;
    transition: all 0.3s ease;
}

.button input[type="submit"] {
    background: #ffa500;
    color: #111;
}

.button input[type="submit"]:hover {
    background: darkorange;
    color: #fff;
}

.input-box input[type="reset"] {
    background: #555;
    color: #fff;
}

.input-box input[type="reset"]:hover {
    background: #333;
}

/* ===== RESPONSIVE ===== */
@media(max-width: 600px) {
    .user-details {
        flex-direction: column;
    }
    .input-box {
        flex: 1 1 100%;
    }
}
</style>
</head>
<body>

<div class="container">
    <div class="title">Edit User Details</div>
    <div class="content">
        <?php while ($row = $edit->fetch_assoc()) { ?>
        <form action="<?php echo $base_url; ?>?r=edituser&id=<?php echo $id; ?>" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Full Name</span>
                    <input type="text" name="name" value="<?php echo $row['name'] ?>">
                </div>
                <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" name="username" value="<?php echo $row['username'] ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="text" name="password" value="<?php echo $row['password'] ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="text" name="confirmpassword" value="<?php echo $row['password'] ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="text" name="email" value="<?php echo $row['email'] ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="text" name="phone" value="<?php echo $row['phone'] ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Address</span>
                    <input type="text" name="address" value="<?php echo $row['address'] ?>" required>
                </div>
                <div class="input-box">
                    <span class="details">Gender</span>
                    <select name="gender">
                        <option value="Male" <?php if($row['gender']=="Male") echo "selected"; ?>>Male</option>
                        <option value="Female" <?php if($row['gender']=="Female") echo "selected"; ?>>Female</option>
                    </select>
                </div>
                <div class="input-box">
                    <input type="reset" value="Clear">
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Edit">
            </div>
        </form>
        <?php } ?>
    </div>
</div>

</body>
</html>
<?php } ?>
