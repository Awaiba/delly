<?php
if (empty($_POST)) {
    include 'view/contactus.php';
    return;
}try
    {
        $flag = empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message']);

    //validate user inputdata
    if ($flag) {
        $_SESSION['message']="All input field are required.";
        $_SESSION['status']="warning";
        include 'view/contactus.php';
        return;
    }

      $UserName = $_POST['name'];
       $Email = $_POST['email'];
       $Subject = $_POST['subject'];
       $Msg = $_POST['message'];
       $mailheader = "From:".$UserName."<".$Email.">\r\n";

       $to = "roshankarki1276@gmail.com";

           if(mail($to,$Subject,$Msg,$mailheader))
           {
            $_SESSION['message']="success";
            $_SESSION['status']="success";
               header("location:" . $base_url . "?r=login");
           } 

    else
    {
        $_SESSION['message']="Your Message has been Sent";
            $_SESSION['status']="success";
        header("location:" . $base_url . "?r=login");
    }
}
catch (Exception $ex) {
   throwError();
}
?>