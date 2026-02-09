<?php
include 'model/dbmodel.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Request</title>
  <style>
    /* ===== RESET & FONT ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    /* BODY */
    body {
        margin: 50px;
        position: relative;
        left: 23rem;
        width: 55%;
        background: #111; /* dark background */
        color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .box {
        width: 100%;
        overflow-x: auto;
    }

    /* TABLE */
    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        text-align: center;
        margin-top: 2rem;
    }

    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #444;
    }

    th {
        background-color: #d45726;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    tr {
        transition: all 0.2s ease-in;
        cursor: pointer;
        background-color: #222;
    }

    tr:nth-of-type(even) {
        background-color: #333;
    }

    tr:hover {
        background-color: #555;
        transform: scale(1.02);
        box-shadow: 2px 2px 12px rgba(0,0,0,0.2), -1px -1px 8px rgba(0,0,0,0.2);
    }

    th h2 {
        margin: 10px 0;
        font-size: 1.2rem;
        color: #fff;
    }

    a i {
        font-size: 1.5rem;
        color: #fff;
        padding: 6px 12px;
        border-radius: 5px;
        background: #d45726;
        transition: all 0.2s ease-in;
    }

    a i:hover {
        background: #b23f1a;
    }

    td img {
        max-width: 100px;
        border-radius: 5px;
    }

    /* EMPTY MESSAGE */
    .empty-message {
        text-align: center;
        font-size: 6rem;
        color: #ffa500;
        margin-top: 3rem;
        font-family: poppins, sans-serif;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        body {
            left: 0;
            width: 95%;
            margin: 20px auto;
        }
        table {
            font-size: 14px;
        }
        td img {
            max-width: 70px;
        }
        .empty-message {
            font-size: 1.5rem;
        }
    }
  </style>

  <script src="https://kit.fontawesome.com/ee312ef85d.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php
    if(isset($_SESSION['message']) && $_SESSION['message'] != '') {
  ?>
  <script>
    swal({
      title: "<?php echo $_SESSION['message'];?>",
      icon: "<?php echo $_SESSION['status'];?>",
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
<?php
$sid = $_SESSION['staff']['user_id'];
$request = view_courier();

if ($request && $request->num_rows > 0):
    $i = 0;
?>

<table>
<?php while ($row = $request->fetch_assoc()): $i++; ?>
<tr>
    <th colspan="7"><h2><?php echo $i; ?>. Sender</h2></th>
</tr>
<tr>
    <th>Date</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Weight</th>
</tr>
<tr>
    <td><?php echo $row['date']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['address']; ?></td>
    <td><?php echo $row['weight']; ?> kg</td>
</tr>

<tr>
    <th colspan="7"><h2>Receiver</h2></th>
</tr>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Action</th>
</tr>
<tr>
    <td><img src="../<?php echo $row['image']; ?>" alt="pic"/></td>
    <td><?php echo $row['rname']; ?></td>
    <td><?php echo $row['remail']; ?></td>
    <td><?php echo $row['rphone']; ?></td>
    <td><?php echo $row['raddress']; ?></td>
    <td>
        <a href="<?php echo $base_url; ?>?r=accept&uid=<?php echo $row['oid']; ?>&sid=<?php echo $sid; ?>">
            <i class="fa-regular fa-circle-check"></i>
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<?php else: ?>
    <div class="empty-message">
        No requests yet, take a break! 🛌
    </div>
<?php endif; ?>
</div>

</body>
</html>
