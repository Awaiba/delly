<?php
include 'model/dbmodel.php';
include 'view/navbar.php';

?>

<style>
/* ===== FONT & RESET ===== */
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
    padding: 50px 2rem;
}

/* ===== TABLE CONTAINER ===== */
.box {
    background-color: #222;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(255,255,255,0.05);
    width: 90%;
    margin: 0 auto;
    overflow-x: auto;
}

/* ===== TABLE ===== */
table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

th, td {
    padding: 12px 15px;
    border-bottom: 1px solid #555;
}

th {
    background-color: #d45726;
    color: #fff;
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

/* ===== ROW HOVER ===== */
tr {
    transition: all 0.2s ease-in;
}

tr:hover {
    background-color: #333;
    transform: scale(1.01);
    box-shadow: 2px 2px 12px rgba(0,0,0,0.2), -1px -1px 8px rgba(0,0,0,0.2);
}

/* ===== BUTTONS ===== */
button {
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    background: #d45726;
    color: #fff;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease-in;
}

button:hover {
    background: darkorange;
    color: #111;
}

/* ===== IMAGE ===== */
td img {
    max-width: 80px;
    border-radius: 5px;
}

/* ===== STATUS CELLS ===== */
td.status {
    font-weight: 600;
    border-radius: 5px;
    padding: 5px 10px;
}

/* STATUS COLORS */
.status-pending { background: grey; color: white; }
.status-approved { background: #ffa500; color: #111; }
.status-rejected { background: red; color: white; }
.status-staff { background: blue; color: white; }
.status-completed { background: green; color: white; }

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    body {
        padding: 20px;
    }
    table {
        font-size: 14px;
    }
    td img {
        max-width: 60px;
    }
}
</style>

<div class="box">
<?php
$request = view_order();
if($request)
?>
<table>
<tr>
   <th>User</th>
   <th>Staff</th>
   <th>Date</th>
   <th>Order Name</th>
   <th>To-</th>
   <th>Phone</th>
   <th>Weight</th>
   <th>Image</th>
   <th>Status</th>
</tr>
<?php
while ($row = $request->fetch_assoc()) {
    $uid= $row['oid'];
?>
<tr>
<td><a href="<?php echo $base_url; ?>?r=sender&uid=<?php echo $row['id']; ?>"><button>Details</button></a></td>
<?php if ($row['sid'] !=0){ ?>
<td><a href="<?php echo $base_url; ?>?r=approvestaff&sid=<?php echo $row['sid']; ?>"><button>Details</button></a></td>
<?php } else { ?><td>- - -</td><?php } ?>
<td><?php echo $row['date']; ?></td>
<td><?php echo $row['ordername']; ?></td>
<td><?php echo $row['rname']; ?></td>
<td><?php echo $row['rphone']; ?></td>
<td><?php echo $row['weight']; ?> KG</td>
<td><img src="../<?php echo $row['image']; ?>" alt="pic"/></td>

<?php 
// STATUS CLASS
switch($row['status']) {
    case 0: $class = 'status-pending'; $text='Pending'; break;
    case 1: $class = 'status-approved'; $text='Approved'; break;
    case 2: $class = 'status-rejected'; $text='Rejected'; break;
    case 3: $class = 'status-staff'; $text='Staff Approved'; break;
    case 4: $class = 'status-completed'; $text='Completed'; break;
    default: $class=''; $text='-';
}
?>
<td class="status <?php echo $class; ?>"><?php echo $text; ?></td>

</tr>
<?php } ?>
</table>
</div>
