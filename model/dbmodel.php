<?php
// DATABASE CONNECTION
if (!function_exists('db_connect')) {
    function db_connect() {
        $conn = new mysqli("localhost", "root", "", "koseli");
        if ($conn->connect_error) die("DB Connection failed: " . $conn->connect_error);
        return $conn;
    }
}

// SEND COURIER
if (!function_exists('send_courier')) {
    function send_courier($user, $ordername, $rname, $remail, $rphone, $raddress, $weight, $date, $image) {
        $conn = db_connect();
        $sql = "INSERT INTO courier (uid, sid, ordername, rname, remail, rphone, raddress, weight, date, image, status)
                VALUES (?, NULL, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) { error_log("Prepare failed: ".$conn->error); return false; }

        $stmt->bind_param("isssssiss", $user, $ordername, $rname, $remail, $rphone, $raddress, $weight, $date, $image);
        $result = $stmt->execute();
        if (!$result) error_log("Execute failed: ".$stmt->error);

        $stmt->close();
        $conn->close();
        return $result;
    }
}

// VIEW ORDER
if (!function_exists('view_order')) {
    function view_order($userid) {
        $conn = db_connect();
        $stmt = $conn->prepare("SELECT * FROM courier WHERE uid=? ORDER BY date DESC");
        if (!$stmt) { error_log("Prepare failed: ".$conn->error); $conn->close(); return false; }
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }
}

function user_login($username, $password) {

    $conn = db_connect();

    $sql = "SELECT * FROM user where username='$username' and password='$password' limit 1";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        return $row;
    } 
    else 
    {
        return false;
    }
}



function staff_login($username, $password) {

    $conn = db_connect();

    $sql = "SELECT * FROM staff where username='$username' and password='$password' limit 1";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        return $row;
    } 
    else 
    {
        return false;
    }
}




function admin_login($username, $password) {

    $conn = db_connect();

    $sql = "SELECT * FROM admin where username='$username' and password='$password' limit 1";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        return $row;
    } 
    else 
    {
        return false;
    }
}


 
function find_user_by_username($username)
{
    $conn= db_connect();
    $sql = "SELECT * FROM user where username='$username' limit 1";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function find_user_by_email($email)
{
    $conn= db_connect();
    $sql = "SELECT * FROM user where email='$email' limit 1";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function register_new_user($name, $username, $password, $email,$phone, $address,$gender)
{

    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO user (name,username,password,email,phone,address,gender) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param ('sssssss', $name, $username, $password, $email,$phone, $address,$gender);
    


    $result = $stmt->execute();
    if ($result) {
        $stmt->close();
        $conn->close();
        return $result;
    } else {
        $stmt->close();
        $conn->close();
        return false;
    }
}

function lost($email)
{
   
    $conn = db_connect();

    $sql = "SELECT * FROM user where email='$email'limit 1";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        return $row;
    } 
    else 
    {
        return false;
    }
}

function search($email)
{
$conn = db_connect();
$sql = "SELECT * from user where email='$email'";
$result = $conn->query($sql);
$conn->close();
if($result)
{
    return $result;
}
else
{
    return false;
}
}


function update_password($newpassword,$email)
{ $conn = db_connect();
    $sql = "UPDATE `user` SET `password`='$newpassword' WHERE `email`='$email'";
$result = $conn->query($sql);
if($result){
        
        $conn->close();
        return $result;
}
else {
        
        $conn->close();
        return false;
}
}

function delete_password($newpassword,$email)       
{ $conn = db_connect();
    $sql = "DELETE FROM `user` WHERE `email`='$email'";
$result = $conn->query($sql);
if($result){        
        $conn->close();
        return $result;
}
else {    
        $conn->close();
        return false;
}
}               
function update_email($newemail,$email)       
{ $conn = db_connect();
    $sql = "UPDATE `user` SET `email`='$newemail' WHERE `email`='$email'";                                                                                                  
    $result = $conn->query($sql);
    if($result){
        $conn->close();
        return $result;
    }
    else {
        $conn->close(); 
        return false;


    }
}
function update_password_confirm($newpassword,$email)
{ $conn = db_connect();
    $sql = "UPDATE `user` SET `password`='$newpassword' WHERE `email`='$email'";
$result = $conn->query($sql);
if($result){
        $conn->close();
        return $result;
}
else {
        $conn->close();
        return false;
}
}
function update_email_confirm($newemail,$email)
{ $conn = db_connect();
    $sql = "UPDATE `user` SET `email`='$newemail' WHERE `email`='$email'";
$result = $conn->query($sql);
if($result){
        $conn->close();
        return $result;
}
else {
        $conn->close();
        return false;
}
}   

?>
