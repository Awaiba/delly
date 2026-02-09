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
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        background-color: #111; /* dark background */
        color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 2rem;
    }

    .box {
        width: 95%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        text-align: center;
        font-size: 0.95rem;
    }

    thead tr {
        background-color: #000;
        color: #fff;
        font-weight: bold;
    }

    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #444;
    }

    tbody tr {
        background-color: #222;
        transition: all 0.2s ease-in;
        cursor: pointer;
    }

    tbody tr:nth-of-type(even) {
        background-color: #333;
    }

    tbody tr:hover {
        background-color: #555;
        transform: scale(1.02);
        box-shadow: 2px 2px 12px rgba(0,0,0,0.2), -1px -1px 8px rgba(0,0,0,0.2);
    }

    img {
        max-width: 100px;
        border-radius: 5px;
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    td a {
        display: inline-block;
        padding: 6px 12px;
        background-color: #d6491e;
        border-radius: 5px;
        font-weight: 500;
        transition: 0.2s;
    }

    td a:hover {
        background-color: #b23f1a;
        color: #fff;
    }

    @media screen and (max-width: 768px) {
        th, td {
            padding: 8px 10px;
            font-size: 0.85rem;
        }
        img {
            max-width: 70px;
        }
    }
  </style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
} ?>
</head>
<body>

<div class="box">
<?php
$sid = $_SESSION['staff']['user_id'];
$request = view_order($sid);
if($request) $i=0;
?>

<table>
<tr>
    <th>Order <br>Name</th>
    <th>Product <br>Image</th>
    <th>Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Weight</th>
    <th>Action</th>
</tr>

<?php while ($row = $request->fetch_assoc()) { $i++; ?>
<tr>
    <td><?php echo $row['ordername']; ?></td>
    <td><img src="../<?php echo $row['image']; ?>" alt="pic"/></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['address']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['rname']; ?></td>
    <td><?php echo $row['raddress']; ?></td>
    <td><?php echo $row['rphone']; ?></td>
    <td><?php echo $row['weight']; ?>kg</td>
    <td>
        <?php if ($row['status'] == '3') { ?>
            <a href="<?php echo $base_url; ?>?r=deliver&sid=<?php echo $row['oid']; ?>">Delivered <i class="fa-2x fa-regular fa-circle-check"></i></a>
        <?php } else { ?>
            <span style="display:inline-block;padding:6px 12px;background:#d6491e;border-radius:5px;">Thank you!</span>
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>
</div>

</body>
</html>
