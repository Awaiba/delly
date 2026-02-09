<?php
include 'view/navbar.php';

// Make sure user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// Base URL for form action
$base_url = "index.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Send Courier</title>

<link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script>
$(function() {
    $("#date_picker").datepicker({ minDate: 0 });

    // Validate file type
    $("#FilUploader").change(function() {
        const allowed = ['jpg','jpeg','png'];
        const ext = $(this).val().split('.').pop().toLowerCase();
        if (!allowed.includes(ext)) {
            alert("Only JPG, JPEG, PNG allowed");
            $(this).val('');
        }
    });
});

// Validation functions
function name_validate() {
    const name = document.forms["form"]["rname"].value.trim();
    const regex = /^[a-zA-Z\s]+$/;
    document.getElementById('nerror').innerText = !name ? "Name required" : (!regex.test(name) ? "Only alphabets allowed" : "");
}

function email_validate() {
    const email = document.forms["form"]["remail"].value.trim();
    const regex = /^\S+@\S+\.\S+$/;
    document.getElementById('eerror').innerText = !email ? "Email required" : (!regex.test(email) ? "Invalid email" : "");
}

function phone_validate() {
    const phone = document.forms["form"]["rphone"].value.trim();
    const regex = /^98\d{8}$/;
    document.getElementById('pherror').innerText = !phone ? "Phone required" : (!regex.test(phone) ? "Must start with 98 and 10 digits" : "");
}

function address_validate() {
    const address = document.forms["form"]["raddress"].value.trim();
    document.getElementById('adderror').innerText = !address ? "Address required" : "";
}

function date_validate() {
    const date = document.forms["form"]["date"].value.trim();
    document.getElementById('derror').innerText = !date ? "Date required" : "";
}
</script>

<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }
body { background-color:#111; color:#fff; min-height:100vh; display:flex; flex-direction:column; justify-content:center; align-items:center; padding:2rem; }
form { width:100%; max-width:800px; }
.content-table { width:100%; border-collapse:collapse; border-radius:10px; overflow:hidden; box-shadow:0 0 15px rgba(255,255,255,0.1); background-color:#222; }
.content-table th, .content-table td { padding:12px 15px; text-align:left; }
.content-table th { background-color:#000; font-weight:600; text-align:center; }
.content-table td input, .content-table td input[type="file"] { width:100%; padding:10px; border-radius:5px; border:1px solid #555; background-color:#333; color:#fff; }
input[readonly] { background-color:#111; color:#ccc; }
input::placeholder { color:#bbb; }
span.error { color:red; font-size:0.9rem; }
input[type="submit"] { background:orange; border:none; padding:12px 25px; border-radius:10px; cursor:pointer; font-size:1rem; font-weight:500; transition:0.3s; }
input[type="submit"]:hover { background:darkorange; }
@media screen and (max-width:600px) { .content-table, .content-table th, .content-table td { display:block; width:100%; } .content-table th { text-align:left; } .content-table td { margin-bottom:10px; } }
</style>
</head>

<body>

<h2>Send Courier</h2>

<form name="form" action="<?= $base_url ?>?r=sendcourier" method="post" enctype="multipart/form-data">
<table class="content-table">
<tr>
    <td>Order Name:</td>
    <td colspan="3"><input type="text" name="ordername" placeholder="Order Name" required></td>
</tr>

<tr>
    <td colspan="4">
        <span id="nerror" class="error"></span>
        <span id="eerror" class="error"></span>
        <span id="pherror" class="error"></span>
        <span id="adderror" class="error"></span>
        <span id="derror" class="error"></span>
    </td>
</tr>

<tr>
    <th colspan="2">SENDER</th>
    <th colspan="2">RECEIVER</th>
</tr>

<tr>
    <td>Name:</td>
    <td><input type="text" value="<?= htmlspecialchars($_SESSION['user']['sname']) ?>" readonly></td>
    <td>Name:</td>
    <td><input type="text" name="rname" placeholder="Receiver Name" oninput="name_validate();" required></td>
</tr>

<tr>
    <td>Email:</td>
    <td><input type="text" value="<?= htmlspecialchars($_SESSION['user']['semail']) ?>" readonly></td>
    <td>Email:</td>
    <td><input type="text" name="remail" placeholder="Receiver Email" oninput="email_validate();" required></td>
</tr>

<tr>
    <td>Phone:</td>
    <td><input type="text" value="<?= htmlspecialchars($_SESSION['user']['sphone']) ?>" readonly></td>
    <td>Phone:</td>
    <td><input type="text" maxlength="10" name="rphone" placeholder="Receiver Phone" oninput="phone_validate();" required></td>
</tr>

<tr>
    <td>Address:</td>
    <td><input type="text" value="<?= htmlspecialchars($_SESSION['user']['saddress']) ?>" readonly></td>
    <td>Address:</td>
    <td><input type="text" name="raddress" placeholder="Receiver Address" oninput="address_validate();" required></td>
</tr>

<tr>
    <td>Weight (kg):</td>
    <td><input type="number" name="weight" min="1" value="1" required></td>
    <td>Date:</td>
    <td><input type="text" id="date_picker" name="date" placeholder="Select Date" oninput="date_validate();" required></td>
</tr>

<tr>
    <td>Item Image:</td>
    <td colspan="3"><input type="file" accept=".jpg,.jpeg,.png" name="simg" id="FilUploader" required></td>
</tr>

<tr>
    <td colspan="4" style="text-align:center;">
        <input type="submit" value="Place Order" onclick="return confirm('Are you sure?')">
    </td>
</tr>
</table>
</form>

</body>
</html>
