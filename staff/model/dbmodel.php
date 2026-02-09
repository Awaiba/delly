<?php

function db_connect() {
    $db['host'] = "localhost";
    $db['username'] = "root";
    $db['password'] = "";
    $db['db_name'] = "koseli";
    $conn = new mysqli($db['host'], $db['username'], $db['password'], $db['db_name']);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}



function view_courier()
{
$conn = db_connect();
$sql = "SELECT * from courier INNER JOIN user ON courier.uid=user.id WHERE courier.status='1'";
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



function accept($sid,$uid) 
{
    $conn = db_connect();
    $sql = "UPDATE courier SET sid='$sid', status='3'  WHERE oid='$uid'";
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

function view_order($sid)
{
$conn = db_connect();

$sql = "SELECT * from courier JOIN user ON courier.uid=user.id WHERE courier.sid='$sid'";
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





function deliver($sid) 
{
    $conn = db_connect();
    $sql = "UPDATE courier SET status='4' WHERE oid=$sid";
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





function delete($id) {
    $conn = db_connect();
    $sql = "Delete from courier where oid=$id";
    $conn->query($sql);
    if ($conn->affected_rows > 0) {
        $conn->close();
        return TRUE;
    } else {
        $conn->close();
        return false;
    }
}

?>