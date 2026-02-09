<?php
include 'model/dbmodel.php';
$request = view_courier();
$i = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Courier Requests</title>

<style>
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
    padding: 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* ===== TITLE ===== */
.head {
    font-size: 28px;
    font-weight: 600;
    color: #ffa500;
    margin-bottom: 30px;
    text-align: center;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    max-width: 1200px;
    border-collapse: collapse;
    box-shadow: 0 6px 20px rgba(255,255,255,0.05);
    overflow: hidden;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #333;
}

th {
    background-color: #222;
    color: #ffa500;
    font-weight: 600;
}

td {
    background-color: #1a1a1a;
    color: #fff;
}

tr:hover td {
    background-color: #333;
    transform: scale(1.02);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
}

/* ===== BUTTON ===== */
button {
    padding: 6px 12px;
    border-radius: 6px;
    border: none;
    background: #ffa500;
    color: #111;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: darkorange;
    color: #fff;
}

/* ===== IMAGE ===== */
td img {
    max-width: 80px;
    border-radius: 6px;
}

/* ===== ACTION ICONS ===== */
td a i {
    color: #ffa500;
    transition: 0.3s;
}

td a i:hover {
    color: darkorange;
}

/* ===== RESPONSIVE ===== */
@media(max-width: 768px) {
    table, th, td {
        display: block;
        width: 100%;
    }
    tr {
        margin-bottom: 15px;
        display: block;
    }
    td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 45%;
        padding-left: 15px;
        font-weight: 600;
        color: #ffa500;
        text-align: left;
    }
}
</style>
</head>
<body>

<div class="head">Courier Requests</div>

<table>
<tr>
    <th>S.N</th>
    <th>Order Name</th>
    <th>To</th>
    <th>Phone</th>
    <th>Weight</th>
    <th>Sender</th>
    <th>Image</th>
    <th>Action</th>
</tr>

<?php while ($row = $request->fetch_assoc()) { 
    $i++;
    $uid = $row['oid'];
?>
<tr>
    <td data-label="S.N"><?php echo $i; ?></td>
    <td data-label="Order Name"><?php echo $row['ordername']; ?></td>
    <td data-label="To"><?php echo $row['rname']; ?></td>
    <td data-label="Phone"><?php echo $row['rphone']; ?></td>
    <td data-label="Weight"><?php echo $row['weight']; ?>KG</td>
    <td data-label="Sender">
        <a href="<?php echo $base_url; ?>?r=sender&uid=<?php echo $row['id']; ?>">
            <button>Details</button>
        </a>
    </td>
    <td data-label="Image">
        <img src="../<?php echo $row['image']; ?>" alt="pic"/>
    </td>
    <td data-label="Action">
        <a href="<?php echo $base_url; ?>?r=accept&uid=<?php echo $uid; ?>"><i class="fa-2x fa-solid fa-user-check"></i></a>
        <br><br>
        <a href="<?php echo $base_url; ?>?r=reject&uid=<?php echo $uid; ?>"><i class="fa-2x fa-solid fa-ban"></i></a>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
