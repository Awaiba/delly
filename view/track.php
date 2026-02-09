<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'model/dbmodel.php';

// Make sure user is logged in
if (!isset($_SESSION['user']['login'])) {
    header("Location: index.php?r=login");
    exit;
}

$userid = $_SESSION['user']['userid'];

// Fetch orders for logged-in user
$orders = view_order($userid); // make sure view_order returns an array
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Track Orders</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #0e1117;
    color: #fff;
    min-height: 100vh;
    padding: 80px 2rem 2rem;
    display: flex;
    justify-content: center;
}

.container {
    width: 100%;
    max-width: 1200px;
}

h2.page-title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 2rem;
    color: #ffb400;
}

.order-card {
    background-color: #1a1c24;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.5);
    transition: all 0.25s ease;
}

.order-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.6);
}

.order-card h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #ffb400;
    margin-bottom: 0.5rem;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1rem;
}

th, td {
    text-align: left;
    padding: 8px 12px;
    font-size: 0.95rem;
}

th {
    color: #ffb400;
    text-transform: uppercase;
    font-weight: 600;
}

td img {
    max-width: 80px;
    border-radius: 8px;
}

.status {
    font-weight: 600;
    color: #ffa500;
}

.empty-message {
    text-align: center;
    font-size: 1.5rem;
    color: #ffa500;
    margin-top: 2rem;
}

@media (max-width: 768px) {
    td img { max-width: 60px; }
    td, th { padding: 6px 8px; font-size: 0.85rem; }
}
</style>
</head>
<body>

<div class="container">
    <h2 class="page-title">My Courier Orders</h2>

    <?php if (!empty($orders)): ?>
        <?php foreach($orders as $i => $row): ?>
        <div class="order-card">
            <h3>Order #<?= $i + 1 ?>: <?= htmlspecialchars($row['ordername'] ?? 'N/A') ?></h3>
            <p><strong>Date:</strong> <?= htmlspecialchars($row['date'] ?? 'N/A') ?></p>


            <!-- Receiver Info -->
            <h3>Receiver Info</h3>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>
                        <?php if(!empty($row['image'])): ?>
                            <img src="<?= htmlspecialchars($row['image']) ?>" alt="Product Image">
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($row['rname'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['remail'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['rphone'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['raddress'] ?? 'N/A') ?></td>
                    <td class="status">
                        <?php
                        switch($row['status'] ?? -1) {
                            case 0: echo "Pending"; break;
                            case 1: echo "Admin Approved"; break;
                            case 2: echo "Courier Rejected"; break;
                            case 3: echo "On the way"; break;
                            case 4: echo "Delivered"; break;
                            default: echo "Error"; break;
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-message">
            No orders found for your account.
        </div>
    <?php endif; ?>
</div>

</body>
</html>
