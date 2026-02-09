
<?php

function db_connect() {
    $db['host'] = "localhost";
    $db['username'] = "root";
    $db['password'] = "";
    $db['db_name'] = "delly";
    $conn = new mysqli($db['host'], $db['username'], $db['password'], $db['db_name']);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


 
function find_staff_by_username($username)
{
    $conn= db_connect();
    $sql = "SELECT * FROM staff where username='$username' limit 2";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function find_staff_by_email($email)
{
    $conn= db_connect();
    $sql = "SELECT * FROM staff where email='$email' limit 2";
    $result = $conn->query($sql);
    $conn->close();
    if ($result->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}


function register_new_staff($name, $username, $password, $email,$phone, $address,$gender)
{

    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO staff (name,username,password,email,phone,address,gender) VALUES (?,?,?,?,?,?,?)");
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


function view_users()
{
$conn = db_connect();
$sql = "SELECT * from user";
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


function view_staff()
{
$conn = db_connect();
$sql = "SELECT * from staff";
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




function view_courier()
{
$conn = db_connect();
$sql = "SELECT * from courier INNER JOIN user ON courier.uid=user.id WHERE courier.status='0'";
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

function view_order()
{
$conn = db_connect();
$sql = "SELECT * from courier INNER JOIN user ON courier.uid=user.id ";
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



function deletestaff($id) {
    $conn = db_connect();
    $sql = "Delete from staff where id=$id";
    $conn->query($sql);
    if ($conn->affected_rows > 0) {
        $conn->close();
        return TRUE;
    } else {
        $conn->close();
        return false;
    }
}


function deleteuser($id) {
    $conn = db_connect();
    $sql = "Delete from user where id=$id";
    $conn->query($sql);
    if ($conn->affected_rows > 0) {
        $conn->close();
        return TRUE;
    } else {
        $conn->close();
        return false;
    }
}

function accept($uid) {
    $conn = db_connect();
    $sql = "UPDATE `courier` SET `status`='1' WHERE oid=$uid";
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

function reject($uid) {
    $conn = db_connect();
    $sql = "UPDATE `courier` SET `status`='2' WHERE oid=$uid";
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




function editstaff($id)
{
$conn = db_connect();
$sql = "SELECT * from staff where id='$id'";
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




function updatestaff($id, $name, $username, $password, $email,$phone, $address,$gender)
{
    $conn = db_connect();
    $stmt = $conn->prepare("update staff set name = ? , username = ? , password = ?, email = ? , phone = ? , address = ? , gender = ? where id = ?");
    $stmt->bind_param('sssssssi',$name, $username, $password, $email,$phone, $address,$gender,$id);
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


function editusers($id)
{
$conn = db_connect();
$sql = "SELECT * from user where id='$id'";
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



function updateusers($id, $name, $username, $password, $email,$phone, $address,$gender)
{
    $conn = db_connect();
    $stmt = $conn->prepare("update user set name = ? , username = ? , password = ?, email = ? , phone = ? , address = ? , gender = ? where id = ?");
    $stmt->bind_param('sssssssi',$name, $username, $password, $email,$phone, $address,$gender,$id);
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



function sender($id)
{
$conn = db_connect();
$sql = "SELECT * from user where id='$id'";
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


function acceptstaff($id)
{
$conn = db_connect();
$sql = "SELECT * from staff where id='$id'";
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

function price()
{
    $conn= db_connect();
    $sql ="SELECT * FROM price";
    $result = $conn->query($sql);
    $conn->close();
    if($result)
    {
        return $result;
    }
    else{
        return false;
    }
}



?>

