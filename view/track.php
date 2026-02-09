<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'model/dbmodel.php';

// Make sure user is logged in
if (!isset($_SESSION['user']['login'])) {
    header("Location: index.php?r=login");
    exit;
}

$userid = $_SESSION['user']['userid'];
$request = view_order($userid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Track Orders</title>

<style>
/* ===== FONT & RESET ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
* {
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

/* ===== BODY ===== */
body {
    background-color: #111;
    color: #fff;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    padding: 2rem;
}

/* ===== HEADING ===== */
h2 {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 2rem;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    max-width: 1200px;
    border-collapse: collapse;
    background-color: #222;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(255,255,255,0.1);
    text-align: center;
    margin-bottom: 2rem;
}

/* TABLE HEAD */
th {
    background-color: #000;
    color: #fff;
    padding: 15px;
    font-weight: 600;
}

/* TABLE CELLS */
td {
    padding: 12px;
    color: #fff;
}

/* TABLE ROWS */
tr {
    transition: all .2s ease-in;
    cursor: pointer;
}

/* HOVER EFFECT */
tr:hover {
    background-color: #333;
    transform: scale(1.02);
}

/* IMAGE IN TABLE */
td img {
    max-width: 100px;
    border-radius: 5px;
}

/* RESPONSIVE */
@media screen and (max-width: 768px) {
    table, th, td {
        display: block;
        width: 100%;
    }
    th {
        text-align: left;
    }
    td {
        text-align: left;
        margin-bottom: 10px;
    }
}
</style>

</head>
<body>

<h2 style="text-align:center;">My Courier Orders</h2>

<table>
    <tr>
        <th>S.N</th>
        <th>Order Name</th>
        <th>Receiver Name</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Weight</th>
        <th>Product Image</th>
        <th>Status</th>
    </tr>

    <?php if (!empty($request)): ?>
        <?php foreach($request as $i => $row): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($row['ordername']) ?></td>
                <td><?= htmlspecialchars($row['rname']) ?></td>
                <td><?= htmlspecialchars($row['rphone']) ?></td>
                <td><?= htmlspecialchars($row['raddress']) ?></td>
                <td><?= htmlspecialchars($row['weight']) ?> kg</td>
                <td>
                    <?php if(!empty($row['image'])): ?>
                        <img src="<?= htmlspecialchars($row['image']) ?>" alt="Product Image">
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    switch($row['status']) {
                        case 0: echo "Pending"; break;
                        case 1: echo "Admin has Approved"; break;
                        case 2: echo "Courier Rejected"; break;
                        case 3: echo "On the way"; break;
                        case 4: echo "Delivered"; break;
                        default: echo "Error"; break;
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No orders found.</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>
