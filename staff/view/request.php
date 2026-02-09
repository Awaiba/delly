<?php
include 'model/dbmodel.php';
$sid = $_SESSION['staff']['user_id'];
$request = view_courier();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Requests</title>

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- FONTAWESOME -->
<script src="https://kit.fontawesome.com/ee312ef85d.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
/* ===== RESET ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* BODY */
body {
    background-color: #0e1117; /* dark theme */
    color: #fff;
    min-height: 100vh;
    padding: 80px 2rem 2rem 2rem; /* space for navbar */
    display: flex;
    justify-content: center;
}

/* CONTAINER */
.box {
    width: 100%;
    max-width: 1200px;
}

/* CARD */
.card {
    background: #1a1c24;
    border-radius: 16px;
    padding: 20px 24px;
    margin-bottom: 24px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.5);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.6);
}

.section-title {
    font-size: 1rem;
    font-weight: 600;
    color: #ffb400;
    margin-bottom: 12px;
}

/* INFO GRID */
.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 12px;
    margin-bottom: 12px;
}

.info-grid div {
    display: flex;
    flex-direction: column;
}

.info-grid label {
    font-size: 0.75rem;
    color: #aaa;
    margin-bottom: 4px;
}

.info-grid span {
    font-size: 0.9rem;
    font-weight: 500;
    color: #fff;
}

/* IMAGE */
.img-container img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 8px;
}

/* ACTION BUTTON */
a i {
    display: inline-block;
    font-size: 1.2rem;
    padding: 8px 14px;
    border-radius: 8px;
    background: linear-gradient(135deg, #ff7b00, #ffb400);
    color: #fff;
    transition: all 0.2s ease-in-out;
}

a i:hover {
    transform: scale(1.1);
    box-shadow: 0 3px 10px rgba(255,183,0,0.6);
}

/* EMPTY MESSAGE */
.empty-message {
    text-align: center;
    font-size: 2rem;
    color: #ffa500;
    margin-top: 3rem;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .info-grid {
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    .img-container img {
        width: 60px;
        height: 60px;
    }
}
</style>

<?php
if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
?>
<script>
swal({
  title: "<?php echo $_SESSION['message']; ?>",
  icon: "<?php echo $_SESSION['status']; ?>",
  button: "ok",
});
</script>
<?php
unset($_SESSION['message']);
}
?>
</head>
<body>

<div class="box">
<?php if ($request && $request->num_rows > 0): $i=0; ?>
    <?php while($row = $request->fetch_assoc()): $i++; ?>
        <div class="card">
            <!-- Sender Info -->
            <div class="section-title"><?php echo $i; ?>. Sender</div>
            <div class="info-grid">
                <div><label>Date</label><span><?php echo $row['date']; ?></span></div>
                <div><label>Name</label><span><?php echo $row['name']; ?></span></div>
                <div><label>Email</label><span><?php echo $row['email']; ?></span></div>
                <div><label>Phone</label><span><?php echo $row['phone']; ?></span></div>
                <div><label>Address</label><span><?php echo $row['address']; ?></span></div>
                <div><label>Weight</label><span><?php echo $row['weight']; ?> kg</span></div>
            </div>

            <!-- Receiver Info -->
            <div class="section-title">Receiver</div>
            <div class="info-grid">
                <div class="img-container"><img src="../<?php echo $row['image']; ?>" alt="Receiver"/></div>
                <div><label>Name</label><span><?php echo $row['rname']; ?></span></div>
                <div><label>Email</label><span><?php echo $row['remail']; ?></span></div>
                <div><label>Phone</label><span><?php echo $row['rphone']; ?></span></div>
                <div><label>Address</label><span><?php echo $row['raddress']; ?></span></div>
                <div>
                    <label>Action</label>
                    <span>
                        <a href="<?php echo $base_url; ?>?r=accept&uid=<?php echo $row['oid']; ?>&sid=<?php echo $sid; ?>">
                            <i class="fa-regular fa-circle-check"></i>
                        </a>
                    </span>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <div class="empty-message">No requests yet, take a break! 🛌</div>
<?php endif; ?>
</div>

</body>
</html>
