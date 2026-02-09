<?php


include 'model/dbmodel.php';


if (empty($_POST)) {
    include 'view/registration.php';
    return;
}
try
{
    $flag = empty($_POST['name']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['confirmpassword']) || empty($_POST['email']) 
    || empty($_POST['phone']) || empty($_POST['address']);

    //validate user inputdata
    if ($flag) {
        $_SESSION['message']="All input field are required.";
        $_SESSION['status']="warning";
        include 'view/registration.php';
        return;
    }
    $password = filtertext($_POST['password']);
    if (strlen($password) < 7) {
        $_SESSION['message']="length of password must be >7";
        $_SESSION['status']="warning";
        include 'view/registration.php';
        return;
    }

    $name = nospace($_POST['name']);

       
if(!preg_match ('/^([a-zA-Z\s]+)$/', $name)){
    $_SESSION['message']="invalid name";
        $_SESSION['status']="warning";
         include 'view/registration.php';
         return;
    }

     //checking if username is already exists.
     $username= filtertext($_POST['username']);
     $valudate=find_user_by_username($username);
     if ($valudate){
        $_SESSION['message']="Username already taken";
        $_SESSION['status']="warning";
         include 'view/registration.php';
         return;
     }

   //checking password.
   
   // for encript eg:-$password = sha1($_POST['pass']);
   $cpassword = filtertext($_POST['confirmpassword']);
   if ($password != $cpassword) {
    $_SESSION['message']="password and confirm password is not matched";
    $_SESSION['status']="warning";
       include 'view/registration.php';
       return;
   }
   $phone = filtertext($_POST['phone']);


   

 
   $email =filtertext($_POST['email']);
   $valudate=find_user_by_email($email);
   if ($valudate){
      $_SESSION['message']="email already taken";
      $_SESSION['status']="warning";
       include 'view/registration.php';
       return;
   }




   $address = filtertext($_POST['address']);

   $gender= filtertext($_POST['gender']);

   $user = register_new_user($name, $username, $password, $email,$phone, $address,$gender);
   if ($user) {
    $_SESSION['message']="you have sucessfully registered";
        $_SESSION['status']="success";
       header("location:" . $base_url . "?r=login");
   } else {
       throwError(500, 'Unable to complete your request.');
   }
}
 catch (Exception $ex) {
    throwError();
}