<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Staff List</title>

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
        margin-top: 4rem;

    background-color: #111;
    color: #fff;
    min-height: 100vh;
    padding: 2rem;
}

/* ===== HEADING ===== */
h1 {
    text-align: center;
    margin-bottom: 2rem;
    font-size: 2rem;
}

/* ===== TABLE STYLING ===== */
.box {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #222;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(255,255,255,0.1);
}

th, td {
    padding: 12px 15px;
    text-align: center;
    color: #fff;
}

th {
    background-color: #000;
    font-weight: 600;
}

tr:hover {
    background-color: #333;
    transform: scale(1.02);
    transition: all 0.2s ease-in-out;
    cursor: pointer;
}

/* ===== ACTION ICONS ===== */
a {
    color: orange;
    font-size: 1.2rem;
    text-decoration: none;
}

a:hover {
    color: darkorange;
}

/* ===== RESPONSIVE ===== */
@media screen and (max-width: 768px) {
    table, th, td {
        display: block;
        width: 100%;
    }
    tr {
        margin-bottom: 15px;
        display: block;
    }
    th {
        text-align: left;
        background-color: #111;
        padding: 10px;
    }
    td {
        text-align: left;
        padding: 10px;
        border-top: 1px solid #444;
    }
}
</style>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
 if(isset($_SESSION['message']) && $_SESSION['message'] !='') {
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
</head>
<body>

<h1>STAFF LIST</h1>

<div class="box">
<?php
if($users) $i=0;
echo "<table>
<tr>
    <th>S.N</th>
    <th>Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Gender</th>
    <th colspan='2'>Action</th>
</tr>";

while ($row = $users->fetch_assoc()) {
    $i++;
    echo "
    <tr>
        <td>$i</td>
        <td>{$row['name']}</td>
        <td>{$row['username']}</td>
        <td>{$row['email']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['address']}</td>
        <td>{$row['gender']}</td>
        <td><a href='{$base_url}?r=editstaff&id={$row['id']}'><ion-icon name='create-outline'></ion-icon></a></td>
        <td><a href='{$base_url}?r=deletestaff&id={$row['id']}'><ion-icon name='trash-outline'></ion-icon></a></td>
    </tr>";
}

echo "</table>";
?>
</div>

</body>
</html>
