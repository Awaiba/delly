<!DOCTYPE html>

<head>
    <title>Email Verify</title>
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
    margin: 0;
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
    font-size: 1.8rem;
}

/* ===== INPUTS ===== */
.box input[type="text"],
.box input[type="email"],
.box input[type="password"] {
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
        <h1>Verify the Following Details</h1>
        <br><br><br><br>
        <form action="<?php echo $base_url?>?r=lost" method="post">

            <!--<select name="usertype"class="id">
                <option value="1">User</option>
                 <option value="2">Staff</option>
                 <option value="3">Admin</option>
            </select> -->
            <p>Email</p>
            <input type="email" name="lemail" placeholder="Email" required>


            <input type="submit" value="Verify">
        </form>


    </div>














    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
 if(isset($_SESSION['message'])&& $_SESSION['message'] !='')
 {
     ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['message'];?>",
                //text: "You clicked the button!",
                icon: "<?php echo $_SESSION['status'];?>",
                button: "ok",
            });
        </script>
        <?php
     unset($_SESSION['message']);
 } 
  ?>


</body>


</html>